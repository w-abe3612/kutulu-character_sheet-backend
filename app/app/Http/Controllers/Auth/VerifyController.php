<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\RegisterUser;
use App\Models\User;

class VerifyController extends AuthController
{
    /**
     * Complete registration
     * 登録を完了させる
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        // 仮登録のデータをトークンで取得
        $registerUser = $this->getRegisterUser($request->token);

        // 取得できなかった場合
        if (!$registerUser) {
            return $this->responseFailed('register not found.');
        }

        // 仮登録のデータでユーザを作成
        $user = $this->createUser($registerUser->toArray());

        // event
        event(new Registered($user));
        return response()->json([],201);
    }

    /**
     * getRegisterUser
     *
     * @param mixed $token
     * @return RegisterUser
     */
    private function getRegisterUser($token)
    {
        // トークンで仮登録ユーザデータを取得
        $registerUser = RegisterUser::where('token', $token)->first();

        // 取得できた場合は仮登録データを削除
        if ($registerUser) {
            RegisterUser::destroy($registerUser->email);
        }

        // モデルを返す
        return $registerUser;
    }

    /**
     * createUser
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => $data['password'],
        ]);
        $userId = $user->id;
        $user->public_page_token = $this->public_pageToken( $userId );
        $user->save();

        return $user;
    }
}