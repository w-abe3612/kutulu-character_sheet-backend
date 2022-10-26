<?php

namespace App\Http\Controllers;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests\StoreSpecialzedSkillsRequest;
use App\Http\Requests\UpdateSpecialzedSkillsRequest;
use App\Models\SpecialzedSkills;
use Illuminate\Support\Facades\Auth;

class SpecialzedSkillsController extends Controller
{
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $result = [];
        $result = SpecialzedSkills::where('character_info_id', $request->character_id)
                    ->where('user_id', Auth::id() )
                    ->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }
}
