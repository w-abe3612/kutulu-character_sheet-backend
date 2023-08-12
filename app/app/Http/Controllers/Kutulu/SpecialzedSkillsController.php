<?php

namespace App\Http\Controllers\Kutulu;
use App\Http\Controllers\Controller;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\SpecialzedSkills;
use App\Http\Requests\StoreSpecialzedSkillsRequest;
use App\Http\Requests\UpdateSpecialzedSkillsRequest;
use App\Services\Kutulu\SpecialzedSkillsService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpecialzedSkillsController extends Controller
{
    private $specialzedSkills;
    function __construct(SpecialzedSkillsService $specialzedSkills) {
        $this->specialzedSkills = $specialzedSkills;
    }
    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $result = [];
        $character_id = !empty($request->character_id )? $request->character_id :null;

        $result = $this->specialzedSkills->getSpecialzedSkills($character_id, Auth::id());

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

        $result = $this->specialzedSkills->getSpecialzedSkillsView($characterPageToken, $characterPageToken);

        return $result
            ? response()->json($result, 200)
            : response()->json([], 500);
    }

    /**
     * SpecialzedSkillを作成するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function create($create_request = null,$character_id = null)
    {
        $result = '';
        $infos = [];

        if( !empty( $create_request ) && !empty( $character_id ) ) {
            $infos = $create_request;

            foreach( $infos as $key => $val ) {
                $infos[$key]['user_id']           = Auth::id();
                $infos[$key]['character_info_id'] = $character_id;
            }
            $result = SpecialzedSkills::insert( $infos );
        }

        return $result;
    }

    /**
     * SpecialzedSkillを更新するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function edit( $update_request = null, $character_id = null )
    {
        $result = '';
        $update_values = [];

        $old_specialzed_skill = 
            SpecialzedSkills::where('character_info_id', $character_id)
                                ->where('user_id', Auth::id() )
                                ->get();

        if ( !empty( $update_request ) && !empty( $character_id ) ) {
            foreach ( $update_request as $update_value ) {
                foreach( $old_specialzed_skill as $old_value  ) {

                    if ( $old_value['skill_param'] === $update_value['skill_param'] ) {
                        $update_values[] = [
                            'id' => $old_value['id'],
                            'user_id' => Auth::id(),
                            'character_info_id' => $character_id,
                            'skill_name'  => $update_value['skill_name'],
                            'skill_order' => $update_value['skill_order'],
                            'skill_param' => $update_value['skill_param'],
                            'skill_value' => $update_value['skill_value']
                        ];
                    }
                }
            }

            $result = SpecialzedSkills::upsert( $update_values, 
                        ['id','user_id','character_info_id'], 
                        ['skill_name' , 'skill_order', 'skill_param','skill_value'] );
        }

        return $result;
    }
}
