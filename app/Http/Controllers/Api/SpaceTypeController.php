<?php

namespace App\Http\Controllers\Api;

use App\Models\SpaceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpaceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spacestypes = SpaceType::all();
        return response()->json($spacestypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SpaceType $spacetype)
    {
        return response()->json($spacetype);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
