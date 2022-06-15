<?php

namespace App\Http\Controllers;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\CharacterInfos;
use App\Models\AbilityValues;
use App\Models\FlavorInfos;
use App\Models\SpecialzedSkills;

class CharacterSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $test = array(
            "character_info" => CharacterInfos::find(1),
            "ability_values" => CharacterInfos::find(1)->ability_values()->get(),
            "specialzed_skills" => CharacterInfos::find(1)->specialzed_skills()->get(),
            "flavor_infos" => CharacterInfos::find(1)->flavor_infos()->get()
        );

        return $test
            ? response()->json($test, 200)
            : response()->json([], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return response()->json([], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return response()->json([], 500);
    }
}
