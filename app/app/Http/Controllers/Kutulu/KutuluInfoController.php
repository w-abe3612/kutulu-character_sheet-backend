<?php

namespace App\Http\Controllers\Kutulu;
use App\Http\Controllers\Controller;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\KutuluInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\Kutulu\KutuluInfoService;

class KutuluInfoController extends Controller
{
    private $kutuluInfo;
    function __construct(KutuluInfoService $kutuluInfo) {
        $this->kutuluInfo = $kutuluInfo;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $result = [];
        $character_id = !empty($request->character_id )? $request->character_id :null;
        $result = $this->kutuluInfo->getKutuluInfo($character_id, Auth::id());

        return $result
            ? response()->json($result, 200)
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
        $userPageToken = !empty($request->userPageToken )? $request->userPageToken :null;
        $characterPageToken = !empty($request->characterPageToken )? $request->characterPageToken :null;

        $result = $this->kutuluInfo->getKutuluInfoView($characterPageToken, $characterPageToken);

        return $result
            ? response()->json($result, 200)
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
