<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AuthController;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Arcanedev\NoCaptcha\NoCaptchaV2;

final class LoginController extends AuthController
{
    /**
     * login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws HttpException
     */
    public function login(Request $request)
    {
        // already logged in
        /*
        if ( Auth::check() ) {
            return response()->json([], 402);
        }*/

        $captcha = new NoCaptchaV2(env('RECAPTCHAV3_SECRET', 'no-captcha-secret'), env('RECAPTCHAV3_SITEKEY', 'no-captcha-sitekey'));
        $response = $captcha->verify(!empty( $request->reCaptureToken ) ? $request->reCaptureToken: '');

        if (!$response->isSuccess()) {
            return response()->json([], 401);
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $result = array(
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'public_page_token' => Auth::user()->public_page_token,
            );
 
            return response()->json( $result ,201);
        }

        return response()->json([], 401);
    }

    /**
     * logout
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // session refresh
        $request->session()->invalidate();

        // regenerate token
        $request->session()->regenerateToken();

        // success login response
        return response()->json([], 201);
    }
}