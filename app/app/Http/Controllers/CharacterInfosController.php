<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterInfosRequest;
use App\Http\Requests\UpdateCharacterInfosRequest;
use \Illuminate\Http\JsonResponse;
use App\Models\CharacterInfos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CharacterInfosController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = [];
        $result = CharacterInfos::where('user_id', intval( Auth::id()))->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }
}
