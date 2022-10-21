<?php

namespace App\Http\Controllers;

use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\CharacterInfos;
use App\Models\AbilityValues;
use App\Models\FlavorInfos;
use App\Models\SpecialzedSkills;
use Illuminate\Support\Facades\Auth;

class CharacterSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = [];
        $result = CharacterInfos::where('user_id', Auth::id() )->where('delete_flg','<>', '1')->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => Auth::id()
        ]);

        $charactorInfo = CharacterInfos::create( $request->all() );

        return $charactorInfo
                ? response()->json($charactorInfo, 201)
                : response()->json([], 501);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @param  int  $character_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $result = [];
        $result = CharacterInfos::where('id', $request->character_id)
                                ->where('user_id', Auth::id() )
                                ->where('delete_flg','!=',true)
                                ->get();

        return $result
            ? response()->json($result, 201)
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
    public function delete(Request $request)
    {
        $target_chara = 
            CharacterInfos::where('id', $request->character_id)
                            ->where('user_id', Auth::id() )
                            ->get();
                            

        $target_chara[0]->delete_flg = true;
        $target_chara->deleted_at = date('Y-m-d H:i:s');

        return $target_chara[0]->update()
                ? response()->json($target_chara,201)
                : response()->json([], 500);
    }
}
