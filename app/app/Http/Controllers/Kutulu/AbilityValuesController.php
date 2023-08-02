<?php

namespace App\Http\Controllers\Kutulu;
use App\Http\Controllers\Controller;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests\StoreAbilityValuesRequest;
use App\Http\Requests\UpdateAbilityValuesRequest;

use App\Models\AbilityValues;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Kutulu\AbilityValuesService;

class AbilityValuesController extends Controller
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
        $result = AbilityValues::where('character_info_id', $request->character_id)
                    ->where('user_id', Auth::id() )
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

        // todo 一度で取得できる感じのロジックにする
        $users = DB::table('users')
            ->select('id as user_id')
            ->where('public_page_token', $request->userPageToken )
            ->first();
        
        $characterInfo = DB::table('character_infos')
            ->select('id as character_id')
            ->where('user_id', $users->user_id )
            ->where('public_page_token', $request->characterPageToken )
            ->where('delete_flg', '!=', true)
            ->first();

        if ( !empty($users) && !empty( $characterInfo ) ) {
            $result = AbilityValues::where('character_info_id', $characterInfo->character_id)
                ->where('user_id', $users->user_id )
                ->get();
        }

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }

    /**
     * AbilityValueを作成するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function create( $create_request = null,$character_id = null )
    {
        $result = '';
        $infos = [];

        if ( !empty( $create_request ) && !empty( $character_id ) ) {
            $infos = $create_request;

            foreach( $infos as $key => $val ) {
                $infos[$key]['user_id'] = Auth::id();
                $infos[$key]['character_info_id'] = $character_id;
            }
            $result = AbilityValues::insert( $infos );
        }
        return $result;
    }

    /**
     * AbilityValueを更新するコントローラー
     * リクエスト経由ではなく、CharacterSheetControllerから呼び出される
     *
     * @param  int  $id
     * @return 
     */
    public function edit( $update_request = null,$character_id = null )
    {
        $result = '';
        $update_values = [];

        $old_ability_value = 
            AbilityValues::where('character_info_id', $character_id )
                        ->where('user_id', Auth::id() )
                        ->get();

        if ( !empty( $update_request ) && !empty( $character_id ) ) {
            foreach ( $update_request as $update_value) {
                foreach( $old_ability_value as $old_value ) {

                    if ( $old_value['skill_param'] === $update_value['skill_param'] ) {
                        $update_values[] = [
                            'id' => $old_value['id'],
                            'user_id' => Auth::id(),
                            'character_info_id' => $character_id,
                            'skill_name'  => $update_value['skill_name'],
                            'skill_order' => $update_value['skill_order'],
                            'skill_param' => $update_value['skill_param'],
                            'skill_type'  => $update_value['skill_type'],
                            'skill_value' => $update_value['skill_value']
                        ];
                    }
                }
            }

            $result = AbilityValues::upsert($update_values, 
                        ['id','user_id','character_info_id'], 
                        ['skill_name' , 'skill_order', 'skill_param','skill_type','skill_value']);
        }
        return $result;
    }
}
