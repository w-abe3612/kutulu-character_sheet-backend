<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyController;

use App\Http\Controllers\CharacterSheetController;
use App\Http\Controllers\FlavorInfosController;
use App\Http\Controllers\SpecialzedSkillsController;
use App\Http\Controllers\AbilityValuesController;
use App\Http\Controllers\CharacterInfosController;

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

/*
↓これにログイン時のみで使うapiを入れる
Route::group(['middleware' => 'auth:sanctum'] , function(){
});
*/


// get キャラクターIDに紐づくキャラクター情報
Route::get('/v1/character/view/{user_id}/{character_id}/', [CharacterSheetController::class, 'show']);

// ユーザー仮登録
Route::post('/v1/registration/', [RegisterController::class, 'register']);

// ユーザーアクティベート
Route::post('/v1/verify/', [VerifyController::class, 'verify']);

//ログイン・ログアウト
Route::post('/v1/login/',[LoginController::class, 'login']);
Route::post('/v1/logout/',[LoginController::class, 'logout']);



// create ユーザー
// delete ユーザー
Route::group(['middleware' => 'auth:sanctum'] , function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //
    Route::get('/v1/characters/{character_id}', [CharacterSheetController::class, 'show']);

    // create キャラクター
    Route::post('/v1/character/create/', [CharacterSheetController::class, 'store']);
    // put キャラクター更新
    // Route::put('/v1/character/edit/{character_id}', [CharacterSheetController::class, 'edit']);
    // delete キャラクター削除
    Route::delete('/v1/character/delete/{character_id}', [CharacterSheetController::class, 'delete']);

    // ユーザーに紐づくキャラクターを全て出力する
    Route::get('/v1/characters', [CharacterInfosController::class, 'index']);
});