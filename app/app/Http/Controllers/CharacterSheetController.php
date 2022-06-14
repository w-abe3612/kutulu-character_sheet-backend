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
/*
        CharacterInfos::where('id','=',$id);
        FlavorInfos::where('character_info_id','=',$id);
        SpecialzedSkills::where('character_info_id','=',$id);
        AbilityValues::where('character_info_id','=',$id);
        ::with(['author', 'publisher'])->get();

        return $task
                ? response()->json($task, 200)
                : response()->json([], 500);*/

        $test = array(
            "CharacterInfos" => CharacterInfos::find(1),
            "ability_values" => CharacterInfos::find(1)->ability_values()->first()
        );

        return CharacterInfos::find(1)->ability_values()->get();
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
    }
}
