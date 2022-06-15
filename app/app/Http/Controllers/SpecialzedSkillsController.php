<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecialzedSkillsRequest;
use App\Http\Requests\UpdateSpecialzedSkillsRequest;
use \Illuminate\Http\JsonResponse;
use App\Models\SpecialzedSkills;
use App\Models\CharacterInfos;

class SpecialzedSkillsController extends Controller
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
        $result = CharacterInfos::find($character_info_id)->specialzed_skills()->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpecialzedSkillsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialzedSkillsRequest $request)
    {
        //
        return response()->json([], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialzedSkills  $specialzedSkills
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialzedSkills $specialzedSkills)
    {
        //
        return response()->json([], 500);
    }
}
