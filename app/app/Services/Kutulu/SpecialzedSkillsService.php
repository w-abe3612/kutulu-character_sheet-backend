<?php
 
namespace App\Services\Kutulu;
use Illuminate\Support\Facades\DB;
use App\Models\SpecialzedSkills;
use Throwable;
/**
 * 
 */
class SpecialzedSkillsService
{
    public function getSpecialzedSkills($character_id = null,$auth_user_id = null) {
        $result = [];

        try {
            if (!empty($character_id) && !empty($auth_user_id)) {
                $result = SpecialzedSkills::where('character_info_id', $character_id)
                ->where('user_id', $auth_user_id )
                ->get();
            }

        } catch (Throwable $th) {  
            return $th;
        }

        return $result;
    }

    public function getSpecialzedSkillsView($user_id =null,$userPageToken = null,$characterPageToken = null) {
        $result = [];
        try {
            // todo 一度で取得できる感じのロジックにする
            $users = DB::table('users')
                ->select('id as user_id')
                ->where('public_page_token', $userPageToken )
                ->first();
        
            $characterInfo = DB::table('character_infos')
                ->select('id as character_id')
                ->where('user_id', $user_id)
                ->where('public_page_token', $characterPageToken)
                ->first();
        
            if ( !empty($users) && !empty($characterInfo) ) {
                $result = SpecialzedSkills::where('character_info_id', $characterInfo->character_id)
                    ->where('user_id', $user_id )
                    ->get();
            }
        } catch (Throwable $th) {  
            return $th;
        }

        return $result;
    }

    public function createSpecialzedSkills($auth_user_id = null,$create_request=[],$character_id = null) {
        $result = false;
        $infos = [];

        try {
            if( !empty( $create_request ) && !empty( $character_id ) ) {
                $infos = $create_request;
    
                foreach( $infos as $key => $val ) {
                    $infos[$key]['user_id']           = $auth_user_id;
                    $infos[$key]['character_info_id'] = $character_id;
                }
                $result = SpecialzedSkills::insert( $infos );
            }

        } catch (Throwable $th) {  
            return $th;
        }

        return $result;
    }

    public function editSpecialzedSkills($auth_user_id = null,$character_id = null,$update_request = null) {
        $result = false;
        $update_values = [];

        try {
            $old_specialzed_skill = 
                SpecialzedSkills::where('character_info_id', $character_id)
                    ->where('user_id', $auth_user_id )
                    ->get();
    
            if ( !empty( $update_request ) && !empty( $character_id ) ) {
                foreach ( $update_request as $update_value ) {
                    foreach( $old_specialzed_skill as $old_value  ) {
    
                        if ( $old_value['skill_param'] === $update_value['skill_param'] ) {
                            $update_values[] = [
                                'id' => $old_value['id'],
                                'user_id' => $auth_user_id,
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
        } catch (Throwable $th) {  
            return $th;
        }

        return $result;
    }
}