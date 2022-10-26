<?php

namespace App\Http\Controllers;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests\StoreFlavorInfosRequest;
use App\Http\Requests\UpdateFlavorInfosRequest;
use App\Models\FlavorInfos;
use Illuminate\Support\Facades\Auth;

class FlavorInfosController extends Controller

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
        $result = FlavorInfos::where('character_info_id', $request->character_id)
                    ->where('user_id', Auth::id() )
                    ->get();
        return response()->json($result, 201);
/*
        return $result
            ? response()->json($result, 201)
            : response()->json([], 501);
*/
    }
}
