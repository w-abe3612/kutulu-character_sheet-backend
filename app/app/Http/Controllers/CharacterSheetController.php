<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kutulu\KutuluInfoController;
use App\Http\Controllers\Kutulu\FlavorInfosController;
use App\Http\Controllers\Kutulu\AbilityValuesController;
use App\Http\Controllers\Kutulu\SpecialzedSkillsController;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\CharacterInfos;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CharacterSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = [];
        $result = CharacterInfos::where('user_id', Auth::id() )
                    ->select('id','image_name','image_path','player_character','public_page_token','updated_at')
                    ->where('delete_flg','<>', '1')
                    ->paginate(10);

        return $result
            ? response()->json($result, 201)
            : response()->json([], 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => Auth::id()
        ]);

        $charactorInfo = CharacterInfos::create( $request->all() );

        return $charactorInfo
                ? response()->json($charactorInfo, 201)
                : response()->json([], 501);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $requestInfo            = $request->characterInfo[ 0 ];
        $requestInfo['user_id'] = Auth::id();
        $charactorInfo          = CharacterInfos::create( $requestInfo );
        $character_id           = $charactorInfo->id;

        // 公開画面表示時にidを秘匿する為のハッシュを作成
        $charactorInfo->public_page_token = $this->public_pageToken( $character_id );
        
        // ここら辺に画像の保存機能がつく
        $charactorInfo->image_name = ''; // s3へ送信後にパスを保存
        $charactorInfo->image_path = ''; // s3へ送信後にファイル名保存
        $charactorInfo->save();

        KutuluInfoController::create($request->kutuluInfo[0], $character_id);
        AbilityValuesController::create($request->abilityValues, $character_id);
        FlavorInfosController::create($request->flavorInfo, $character_id);
        SpecialzedSkillsController::create($request->specializedSkill, $character_id);

        return response()->json([], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // todo エラー時にエラー文を返す機能
        $character_id = $request->characterId;
        $requestCharacterInfo = $request->characterInfo[0];
        $characterInfo = CharacterInfos::where('id', $character_id)
                            ->where('user_id', Auth::id() )
                            ->where('delete_flg','<>', '1')
                            ->first();

        $characterInfo->player_character = $requestCharacterInfo['player_character'];
        $characterInfo->player_name      = $requestCharacterInfo['player_name'];

        $characterInfo->update();

        // todo ここら辺にbase64で送信された画像をs3へ画像を保存して、urlパスと画像名をDBへ挿入するロジックを作成

        KutuluInfoController::edit($request->kutuluInfo[0],$character_id);
        AbilityValuesController::edit($request->abilityValues,$character_id);
        FlavorInfosController::edit($request->flavorInfo,$character_id);
        SpecialzedSkillsController::edit($request->specializedSkill,$character_id);

        return response()->json([], 201);

        return response()->json($characterInfo->update(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @param  int  $character_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $result = [];
        $result = CharacterInfos::where('id', $request->character_id)
                    ->where('user_id', Auth::id() )
                    ->where('delete_flg','!=',true)
                    ->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {
        $result = [];

        // userのidを取得
        // todo 一度で取得できる感じのロジックにする
        $users = DB::table('users')
            ->select('id as user_id')
            ->where('public_page_token', $request->userPageToken )
            ->first();

        if ( !empty($users) ) {

            $characterInfo = CharacterInfos::where('user_id', $users->user_id)
                ->where('public_page_token',$request->characterPageToken)
                ->where('delete_flg','!=',true)
                ->first();

            $result = !empty($characterInfo) 
                ? array(
                    "player_name" => $characterInfo->player_name,
                    "player_character" => $characterInfo->player_character,
                    "image_path" => $characterInfo->image_path,
                    "image_name" => $characterInfo->image_name,
                ): [];
        }


        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $target_chara = 
            CharacterInfos::where('id', $request->character_id)
                ->where('user_id', Auth::id() )
                ->get();
                            

        $target_chara[0]->delete_flg = true;
        $target_chara->deleted_at = date('Y-m-d H:i:s');

        return $target_chara[0]->update()
                ? response()->json($target_chara,201)
                : response()->json([], 500);
    }

    /**
     * 画像をデコードして、保存する
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function storeImage($base64Context, $storage, $dir)
    {
        try {
            preg_match('/data:image\/(\w+);base64,/', $base64Context, $matches);
            $extension = $matches[1];

            $img = preg_replace('/^data:image.*base64,/', '', $base64Context);
            $img = str_replace(' ', '+', $img);
            $fileData = base64_decode($img);

            $dir = rtrim($dir, '/').'/';
            $fileName = md5($img);
            $path = $dir.$fileName.'.'.$extension;

            Storage::disk($storage)->put($path, $fileData);

            return $path;

        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
    }

    /**
     * 公開用のURLの生成の際にidを隠す為のトークンの作成
     * @return string
     */
    public function public_pageToken( $something_id = 0 )
    {
        $result = '';
        if ( !empty($something_id) ) {
            $result = hash_hmac('sha256', $something_id, config('app.public_page_creating_key'));
        }
        return $result;
    }
}
