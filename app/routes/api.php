<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
//api/v1/flavor_infos/{character_info_id}
//api/v1/flavor_infos/delete/{$id}
//api/v1/flavor_infos/add/{$id}
Route::get('/v1/flavor_infos/{character_info_id}', [FlavorInfosController::class, 'show']);

//api/v1/specialzed_skills/{character_info_id}
//api/v1/specialzed_skills/delete/{$id}
//api/v1/specialzed_skills/add/{$id}
Route::get('/v1/specialzed_skills/{character_info_id}', [SpecialzedSkillsController::class, 'show']);

//api/v1/ability_values/{character_info_id}
//api/v1/ability_values/delete/{$id}
//api/v1/ability_values/add/{$id}
Route::get('/v1/ability_values/{character_info_id}', [AbilityValuesController::class, 'show']);

//api/v1/character_infos/{$id}
Route::get('/v1/character_infos/{id}', [CharacterInfosController::class, 'show']);

// todo apiを整理して必要なレスポンスを割り出す
// Route::get('/v1/character/{id}', [CharacterSheetController::class, 'show']);

//api/v1/characters
//api/v1/character/search
//api/v1/character/create
//api/v1/character/edit/{$id}
//api/v1/character/delete/{$id}

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
