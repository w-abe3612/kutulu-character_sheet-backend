<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterInfosRequest;
use App\Http\Requests\UpdateCharacterInfosRequest;
use \Illuminate\Http\JsonResponse;
use App\Models\CharacterInfos;

class CharacterInfosController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = [];
        $result = CharacterInfos::find($id);

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }
}
