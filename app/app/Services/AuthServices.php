<?php
namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Password;
use Torann\Hashids\Facade\Hashids;

class AuthServices
{
    /**
     * 公開用のURLの生成の際にidを隠す為のトークンの作成
     * @return string
     */
    public function public_pageToken( $something_id = 0 )
    {
        $result = '';

        if ( !empty($something_id) ) {
            $result = Hashids::encode($something_id);
        }
        return $result;
    }
}