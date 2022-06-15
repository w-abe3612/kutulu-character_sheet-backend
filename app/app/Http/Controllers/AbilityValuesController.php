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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAbilityValuesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbilityValuesRequest $request)
    {
        //
        return response()->json([], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbilityValues  $abilityValues
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbilityValues $abilityValues)
    {
        //
        return response()->json([], 500);
    }
}
