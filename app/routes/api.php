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

/*
↓これにログイン時のみで使うapiを入れる
Route::group(['middleware' => 'auth:sanctum'] , function(){
});
*/

// get view公開用の画面用API


// get キャラクターIDに紐づくキャラクター情報
//Route::get('/v1/character/{user_id}/view/{character_id}/', [CharacterSheetController::class, 'show']);

// 

// ユーザー仮登録
Route::post('/v1/registration/', [RegisterController::class, 'register']);

// ユーザーアクティベート
Route::post('/v1/verify/', [VerifyController::class, 'verify']);

//ログイン・ログアウト
Route::post('/v1/login/',[LoginController::class, 'login']);
Route::post('/v1/logout/',[LoginController::class, 'logout']);

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