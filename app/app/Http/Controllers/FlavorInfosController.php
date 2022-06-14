<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlavorInfosRequest;
use App\Http\Requests\UpdateFlavorInfosRequest;
use App\Models\FlavorInfos;

class FlavorInfosController extends Controller
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
     * @param  \App\Http\Requests\StoreFlavorInfosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFlavorInfosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlavorInfos  $flavorInfos
     * @return \Illuminate\Http\Response
     */
    public function show(FlavorInfos $flavorInfos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlavorInfos  $flavorInfos
     * @return \Illuminate\Http\Response
     */
    public function edit(FlavorInfos $flavorInfos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFlavorInfosRequest  $request
     * @param  \App\Models\FlavorInfos  $flavorInfos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFlavorInfosRequest $request, FlavorInfos $flavorInfos)
    {
        //
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
    }
}
