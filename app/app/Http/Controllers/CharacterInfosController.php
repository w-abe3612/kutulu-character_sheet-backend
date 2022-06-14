<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterInfosRequest;
use App\Http\Requests\UpdateCharacterInfosRequest;
use App\Models\CharacterInfos;

class CharacterInfosController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCharacterInfosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCharacterInfosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CharacterInfos  $characterInfos
     * @return \Illuminate\Http\Response
     */
    public function show(CharacterInfos $characterInfos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CharacterInfos  $characterInfos
     * @return \Illuminate\Http\Response
     */
    public function edit(CharacterInfos $characterInfos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCharacterInfosRequest  $request
     * @param  \App\Models\CharacterInfos  $characterInfos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCharacterInfosRequest $request, CharacterInfos $characterInfos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CharacterInfos  $characterInfos
     * @return \Illuminate\Http\Response
     */
    public function destroy(CharacterInfos $characterInfos)
    {
        //
    }
}
