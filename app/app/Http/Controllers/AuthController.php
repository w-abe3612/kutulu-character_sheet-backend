<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Password;
use Torann\Hashids\Facade\Hashids;

class AuthController extends Controller
{
    /**
     * ユーザネームをemailにするかnameにするか
     *
     * @return string
     */
    
    protected function username()
    {
        return 'email';
    }

    /**
     * 認証に使うパラメータを取得
     *
     * @param  Request $request
     * @return Array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * password hash
     * パスワードのhash
     *
     * @param string $password
     * @return string
     */
    protected function passwordHash($password)
    {
        return Hash::make($password);
    }

    /**
     * create activation token
     * トークンを作成する
     * @return string
     */
    protected function createToken()
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

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

    /**
     * Determine if the token has expired.
     *
     * @param string $createdAt
     * @return bool
     */
    protected function tokenExpired($expires, $createdAt)
    {
        return Carbon::parse($createdAt)
            ->addSeconds($expires)
            ->isPast();
    }


    /**
     * Validate the user register request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
    }

    /**
     * Validate the forgot request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateForgot(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
        ]);
    }

    /**
     * responseSuccess
     * 成功のレスポンス
     *
     * @param string $message
     * @param array $additions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseSuccess(string $message, array $additions = [])
    {
        return response()->json(array_merge(['message' => trans($message)], $additions), 201);
    }

    /**
     * responseFailed
     * 失敗のレスポンス
     *
     * @param string $message
     * @param array $additions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseFailed(string $message)
    {
        return response()->json(['message' => trans($message)], 403);
    }

    /**
     * responseInvalid
     * インヴァリッドのレスポンス
     *
     * @param string $message
     * @param array $errors array in array
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseInvalid(string $message, array $errors = [])
    {
        foreach ($errors as &$error) {
            foreach ($error as &$value) {
                $value = trans($value);
            }
        }

        return response()->json([
            'message' => trans($message),
            'errors' => $errors,
        ], 422);
    }
}
