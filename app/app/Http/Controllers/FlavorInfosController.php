<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlavorInfosRequest;
use App\Http\Requests\UpdateFlavorInfosRequest;
use \Illuminate\Http\JsonResponse;
use App\Models\FlavorInfos;
use App\Models\CharacterInfos;

class FlavorInfosController extends Controller
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
        $result = CharacterInfos::find($character_info_id)->flavor_infos()->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFlavorInfosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFlavorInfosRequest $request)
    {
        //
        return response()->json([], 500);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlavorInfos  $flavorInfos
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlavorInfos $flavorInfos)
    {
        //
        return response()->json([], 500);
    }
}
