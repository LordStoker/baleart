<?php

namespace App\Http\Controllers\Api;

use App\Models\Modality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modalities = Modality::all();
        return response()->json($modalities);
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
    public function show(Modality $modality)
    {
        return response()->json($modality);
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
