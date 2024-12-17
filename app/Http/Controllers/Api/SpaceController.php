<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$spaces = Space::all();
        //$spaces = Space::with(['user', 'comments', 'modalities', 'services', 'address'])->get(); //Se indican las relaciones de la clase que usamos
                                                                                                // para ver los datos relacionados
        // $spaces = Space::paginate(3);  // crea una sortida amb paginació


        // $spaces = Space::with(["user", "modalities", "comments", "comments.images"])->get();
         $spaces = Space::with(["user", "modalities", "comments", "comments.images"])->paginate(1);  // post amb les taules relacionades, paginada
        return response()->json($spaces);
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
    public function show(Space $space)
    {
        $space->with(['address', 'modalities', 'services', 'space_type', 'comments', 'comments.images', 'user'])->get();
        return response()->json($space);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $space = Space::where('email', $request->input('email'))->firstOrFail();
        $space->update($request->all());
        return response()->json($space);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
