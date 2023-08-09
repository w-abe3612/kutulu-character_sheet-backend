<?php

namespace App\Http\Controllers\Kutulu;
use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\FlavorInfos;
use App\Http\Requests\StoreFlavorInfosRequest;
use App\Http\Requests\UpdateFlavorInfosRequest;
use App\Services\Kutulu\FlavorInfosService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FlavorInfosController extends Controller
{
    private $flavorInfosService;
    function __construct(FlavorInfosService $flavorInfosService) {
        $this->flavorInfosService = $flavorInfosService;
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

        $result = $this->flavorInfosService->getFlavorInfos($character_id, Auth::id());

        return $result
            ? response()->json($result, 200)
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
        $userPageToken = !empty($request->userPageToken )? $request->userPageToken :null;
        $characterPageToken = !empty($request->characterPageToken )? $request->characterPageToken :null;
        $user_id = !empty($request->user_id)? $request->user_id :null;

        $result = $this->flavorInfosService->getFlavorInfosView($user_id, $characterPageToken, $characterPageToken);

        return $result
            ? response()->json($result, 200)
            : response()->json([], 500);
    }

    /**
     * FlavorInfoを作成するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    /*
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
    }*/

    /**
     * FlavorInfoを更新するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    /*
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
    }*/
}
