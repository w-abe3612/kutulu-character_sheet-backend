<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbilityValuesRequest;
use App\Http\Requests\UpdateAbilityValuesRequest;
use \Illuminate\Http\JsonResponse;
use App\Models\AbilityValues;
use App\Models\CharacterInfos;

class AbilityValuesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($character_info_id)
    {
        $result = [];
        $result = CharacterInfos::find($character_info_id)->ability_values()->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }
}
