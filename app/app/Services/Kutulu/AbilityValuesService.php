<?php
 
namespace App\Services\Kutulu;
 
/**
 * 
 */
class AbilityValuesService
{
    public function show(Request $request)
    {
        $result = [];
        $result = AbilityValues::where('character_info_id', $request->character_id)
                    ->where('user_id', Auth::id() )
                    ->get();
        return $result;
    }

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