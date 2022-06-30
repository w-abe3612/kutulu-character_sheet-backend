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
    public function show_index( $user_id )
    {
        $result = [];
        // localstrageを変更して、悪いことしようとしてる人は403返す
        if ( intval( $user_id ) !== intval( Auth::id() ) ) {
            return response()->json([], 403 );
        }
        $result = User::find( intval( Auth::id() ) )->charactor_index()->get();

        return $result
            ? response()->json($result, 201)
            : response()->json([], 500);
    }
}
