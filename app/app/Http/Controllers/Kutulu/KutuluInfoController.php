<?php

namespace App\Http\Controllers\Kutulu;
use App\Http\Controllers\Controller;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\KutuluInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Kutulu\KutuluInfoService;

class KutuluInfoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $result = [];
        $result = KutuluInfo::where('character_info_id', $request->character_id)
                    ->where('user_id', Auth::id() )
                    ->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 501);
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

        // todo 一度で取得できる感じのロジックにする
        $users = DB::table('users')
            ->select('id as user_id')
            ->where('public_page_token', $request->userPageToken )
            ->first();
        
        $characterInfo = DB::table('character_infos')
            ->select('id as character_id')
            ->where('user_id', $users->user_id)
            ->where('public_page_token', $request->characterPageToken)
            ->where('delete_flg', '!=', true)
            ->first();

        if ( !empty($users) && !empty($characterInfo) ) {
            $result = KutuluInfo::where('character_info_id', $characterInfo->character_id)
                ->where('user_id', $users->user_id )
                ->get();
        }

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }

    /**
     * KutuluInfoを作成するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function create($create_request = null,$character_id = null)
    {
        $result = '';
        $infos = [];
        if ( !empty( $create_request ) && !empty( $character_id ) ) {
            $infos = $create_request;
            $infos['user_id'] = Auth::id();
            $infos['character_info_id'] = $character_id;

            $result = KutuluInfo::create( $infos );
        }

        return $result;
    }

    /**
     * KutuluInfoを更新するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function edit($update_request = null, $character_id = null )
    {
        $result = '';
        if ( !empty( $update_request ) && !empty( $character_id ) ) {
            $kutuluInfo = KutuluInfo::where('character_info_id', $character_id )
                        ->where('user_id', Auth::id() )
                        ->first();

            $kutuluInfo->character_title      = $update_request['character_title'];
            $kutuluInfo->injury_value         = $update_request['injury_value'];
            $kutuluInfo->possession_item      = !empty( $update_request['possession_item'] )? $update_request['possession_item']: '';
            $kutuluInfo->character_preference = !empty( $update_request['character_preference'] )? $update_request['possession_item']: '';

            $result = $kutuluInfo->update();
        }

        return $result;
    }
}
