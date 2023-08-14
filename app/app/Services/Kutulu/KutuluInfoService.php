<?php
 
namespace App\Services\Kutulu;
use App\Models\KutuluInfo;
use Illuminate\Support\Facades\DB;
use Throwable;
/**
 * 
 */
class KutuluInfoService
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKutuluInfo($character_id = null,$auth_user_id = null)
    {
        $result = [];
        try {
            $result = KutuluInfo::where('character_info_id', $character_id )
                ->where('user_id', $auth_user_id )
                ->get();
        } catch (Throwable $th) {  
            return $th;
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKutuluInfoView($userPageToken = null,$characterPageToken = null)
    {
        $result = [];
        try {
            // todo 一度で取得できる感じのロジックにする
            $user = DB::table('users')
                ->select('id as user_id')
                ->where('public_page_token', $userPageToken )
                ->first();
        
            $characterInfo = DB::table('character_infos')
                ->select('id as character_id')
                ->where('user_id', $user->id)
                ->where('public_page_token', $characterPageToken)
                ->first();

            if ( !empty($user) && !empty($characterInfo) ) {
                $result = KutuluInfo::where('character_info_id', $characterInfo->character_id)
                    ->where('user_id', $user->id )
                    ->get();
            }
        } catch (Throwable $th) {  
            return $th;
        }

        return $result;
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

/*

*/