<?php

namespace App\Http\Controllers\Kutulu;
use App\Http\Controllers\Controller;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests\StoreFlavorInfosRequest;
use App\Http\Requests\UpdateFlavorInfosRequest;
use App\Models\FlavorInfos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Kutulu\FlavorInfosService;

class FlavorInfosController extends Controller

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
        $result = FlavorInfos::where('character_info_id', $request->character_id)
                    ->where('user_id', Auth::id() )
                    ->get();
        return response()->json($result, 201);
/*
        return $result
            ? response()->json($result, 201)
            : response()->json([], 501);
*/
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
            $result = FlavorInfos::where('character_info_id', $characterInfo->character_id)
                    ->where('user_id', $users->user_id )
                    ->get();
        }

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }

    /**
     * FlavorInfoを作成するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function create($create_request,$character_id)
    {
        $result = '';
        $infos = [];
        
        if( !empty($create_request) && !empty($character_id) ) {
            $infos = $create_request;

            foreach($create_request as $key => $val){
                $infos[$key]['user_id'] = Auth::id();
                $infos[$key]['character_info_id'] = $character_id;
                $infos[$key]['flavor_info_value'] = !empty( $infos[$key]['flavor_info_value'] )
                                                        ? $infos[$key]['flavor_info_value']: '';
            }
            $result = FlavorInfos::insert($infos);
        }
 
        return $result;
    }

    /**
     * FlavorInfoを更新するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function edit($update_request,$character_id)
    {
        $result = '';
        $update_values = [];

        $old_flavor_info = 
            FlavorInfos::where('character_info_id', $character_id)
                        ->where('user_id', Auth::id() )
                        ->get();

        if ( !empty( $update_request ) && !empty( $character_id ) ) {
            foreach ( $update_request as $request_value) {
                foreach( $old_flavor_info as $old_value  ) {
                    if( $old_value['flavor_info_param'] === $request_value['flavor_info_param'] ) {
                        $result_values[] = [
                            'id' => !empty($old_value['id'])? $old_value['id']: '',
                            'user_id' => Auth::id(),
                            'character_info_id' => $character_id,
                            'flavor_info_name'  => $request_value['flavor_info_name'] ,
                            'flavor_info_order' => $request_value['flavor_info_order'] ,
                            'flavor_info_param' => $request_value['flavor_info_param'] ,
                            'flavor_info_value' => $request_value['flavor_info_value'] ,
                        ];
                    }
                }
            }
            
            $result = FlavorInfos::upsert( $result_values, 
                    ['id','user_id','character_info_id'], 
                    ['flavor_info_name' , 'flavor_info_order', 'flavor_info_param','flavor_info_value']);
        }

        return $result;
    }
}
