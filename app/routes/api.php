<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;

use App\Http\Controllers\CharacterSheetController;
use App\Http\Controllers\Kutulu\FlavorInfosController;
use App\Http\Controllers\Kutulu\KutuluInfoController;
use App\Http\Controllers\Kutulu\AbilityValuesController;
use App\Http\Controllers\Kutulu\SpecialzedSkillsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ユーザー仮登録
Route::post('/v1/registration/', [RegisterController::class, 'register']);

// ユーザーアクティベート
Route::post('/v1/verify/', [VerifyController::class, 'verify']);

//ログイン・ログアウト
Route::post('/v1/login/',[LoginController::class, 'login']);
Route::post('/v1/logout/',[LoginController::class, 'logout']);

// キャラクター情報取得
Route::get('/v1/other_user_info/view/', [KutuluInfoController::class, 'view']);
Route::get('/v1/character_infos/view/', [CharacterSheetController::class, 'view']);
Route::get('/v1/specialzed_skills/view/', [SpecialzedSkillsController::class, 'view']);
Route::get('/v1/flavor_infos/view/', [FlavorInfosController::class, 'view']);
Route::get('/v1/ability_values/view/', [AbilityValuesController::class, 'view']);
Route::get('/v1/kutulu_info/view/', [KutuluInfoController::class, 'view']);

// ログインチェック
Route::get('/v1/user/', function () {
    $result = array(
        'id'  => null,
        'name'=> '',
        'public_page_token' => '',
    );

    if ( Auth::check() ) {
        $result = array(
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'public_page_token' => Auth::user()->public_page_token,
        );
    } 

    return response()->json($result, 201);
});

// create ユーザー
// delete ユーザー
Route::group(['middleware' => 'auth:sanctum'] , function() {

    // キャラクター一覧取得
    Route::get('/v1/characters/', [CharacterSheetController::class, 'index']);
    
    // キャラクター情報取得
    Route::get('/v1/character_infos/', [CharacterSheetController::class, 'show']);
    Route::get('/v1/specialzed_skills/', [SpecialzedSkillsController::class, 'show']);
    Route::get('/v1/flavor_infos/', [FlavorInfosController::class, 'show']);
    Route::get('/v1/ability_values/', [AbilityValuesController::class, 'show']);
    Route::get('/v1/kutulu_info/', [KutuluInfoController::class, 'show']);

    // create キャラクター
    Route::post('/v1/character/create/', [CharacterSheetController::class, 'create']);
    // put キャラクター更新
    Route::post('/v1/character/edit/', [CharacterSheetController::class, 'update']);
    // delete キャラクター削除
    Route::post('/v1/character/delete/', [CharacterSheetController::class, 'delete']);
});

// テスト用

// 読み込み遅延系

// キャラクター情報取得
Route::get('/v1/test/delay/character_infos/', function () {
    sleep(10);
    return response()->json([], 200);
});

// 失敗系

// キャラクター情報取得
Route::get('/v1/test/failure/character_infos/', function () {
    return response()->json([], 500);
});

