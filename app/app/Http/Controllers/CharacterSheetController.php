<?php

namespace App\Http\Controllers;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\CharacterInfos;
use App\Models\AbilityValues;
use App\Models\FlavorInfos;
use App\Models\SpecialzedSkills;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

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
        $result = CharacterInfos::where('user_id', Auth::id() )->where('delete_flg','<>', '1')->get();

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

    public function storeImage($base64Context, $storage, $dir)
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

    public function create(Request $request)
    {
        // フィールドの仕分け作業はサーバーサイドのお仕事になりそう
        //　todo 要リファクタリング
        // エラーハンドリング
        /*
        $ci = $request->characterInfo[0];
        $fi = $request->flavorInfoValue;
        $av = $request->abilityValues;
        $ss = $request->specializedSkill;
        */
/*
        $ci['user_id'] = Auth::id();
        $charactorInfo = CharacterInfos::create($ci);
        $character_id = $charactorInfo->id;
*/

        //Storage::put('avatars/1', $content);
        //dd($request);
        //$request->hasFile('characterInfo_0_image_path');
        //$characterInfo = array();
        $result = $this->storeImage($request->characterInfo[0]['image_path'], 'local', '');
        
        return response()->json($result, 201);

/*
        foreach($fi as $key => $val){
            $fi[$key]['user_id'] = Auth::id();
            $fi[$key]['character_info_id'] = $character_id;
            $fi[$key]['flavor_info_value'] = !empty($fi[$key]['flavor_info_value'])?$fi[$key]['flavor_info_value']:'';
        }

        $flaverinfo = FlavorInfos::insert($fi);
 */
        //$flaverinfo = FlavorInfos::insert($fi);
        /*
        return $flaverinfo
            ? response()->json($flaverinfo, 201)
            : response()->json([], 500);
        */
    /*    
        foreach($av as $key => $val){
            $av[$key]['user_id'] = Auth::id();
            $av[$key]['character_info_id'] = $character_id;
        }
        $abilityvalue = AbilityValues::insert($av);
        */
        /*
        return $abilityvalue
            ? response()->json($abilityvalue, 201)
            : response()->json([], 500);
        */
        /*
        foreach($ss as $key => $val){
            $ss[$key]['user_id'] = Auth::id();
            $ss[$key]['character_info_id'] = $character_id;
        }
        $test = SpecialzedSkills::insert($ss);
        
        return response()->json($test, 201);
        */
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return response()->json([], 500);
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
}
