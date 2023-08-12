<?php
 
namespace App\Services\Kutulu;
use App\Models\AbilityValues;
use Illuminate\Support\Facades\DB;
use Throwable;
/**
 * 
 */
class AbilityValuesService
{
    public function getAbilityValues($character_id = null, $auth_user_id = null)
    {
        $result = [];
        try {
            $result = AbilityValues::where('character_info_id', $character_id)
                ->where('user_id', $auth_user_id)
                ->get();
        } catch (Throwable $th) {  
            return $th;
        }
        return $result;
    }

    public function getAbilityValuesView( $userPageToken = null, $characterPageToken = null)
    {
        $result = [];

        // todo 一度で取得できる感じのロジックにする
        try {
            $user = DB::table('users')
                ->select('id as user_id')
                ->where('public_page_token', $userPageToken )
                ->first();
        
            $characterInfo = DB::table('character_infos')
                ->select('id as character_id')
                ->where('user_id', $user->id )
                ->where('public_page_token', $characterPageToken )
                ->first();

            if ( !empty($user) && !empty( $characterInfo ) ) {
                $result = AbilityValues::where('character_info_id', $characterInfo->character_id)
                    ->where('user_id', $user->id )
                    ->get();
            }
        } catch (Throwable $th) {  
            return $th;
        }

        return $result;
    }

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