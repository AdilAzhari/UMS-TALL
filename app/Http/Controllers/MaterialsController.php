<?php

namespace App\Http\Controllers;

use App\Models\materials;
use App\Http\Requests\StorematerialsRequest;
use App\Http\Requests\UpdatematerialsRequest;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorematerialsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(materials $materials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(materials $materials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatematerialsRequest $request, materials $materials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(materials $materials)
    {
        //
    }
}
