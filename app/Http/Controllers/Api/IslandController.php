<?php

namespace App\Http\Controllers\Api;

use App\Models\Island;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IslandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $islands = Island::all();
        return response()->json($islands);
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
    public function show(Island $island)
    {
        return response()->json($island);
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
