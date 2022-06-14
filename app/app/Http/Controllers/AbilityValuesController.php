<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbilityValuesRequest;
use App\Http\Requests\UpdateAbilityValuesRequest;
use App\Models\AbilityValues;

class AbilityValuesController extends Controller
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
     * @param  \App\Http\Requests\StoreAbilityValuesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbilityValuesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbilityValues  $abilityValues
     * @return \Illuminate\Http\Response
     */
    public function show(AbilityValues $abilityValues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbilityValues  $abilityValues
     * @return \Illuminate\Http\Response
     */
    public function edit(AbilityValues $abilityValues)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbilityValuesRequest  $request
     * @param  \App\Models\AbilityValues  $abilityValues
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbilityValuesRequest $request, AbilityValues $abilityValues)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbilityValues  $abilityValues
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbilityValues $abilityValues)
    {
        //
    }
}
