<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpaceResource;

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
        $spaces = Space::with([
            'address',
            'modalities',
            'services',
            'space_type',
            'comments' => function ($query) {
                $query->where('status', 'y'); // Filtrar comentarios con status "y"
            },
            'comments.images',
            'user',
            'address.zone',
            'address.municipality',
            'address.municipality.island', 
            'user.role'])->get(); 
        return (SpaceResource::collection($spaces));
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
        $space->load([
            'address',
            'modalities',
            'services',
            'space_type',
            'comments' => function ($query) {
                $query->where('status', 'y'); // Filtrar comentarios con status "y"
            },
            'comments.images',
            'user',
            'address.zone',
            'address.municipality',
            'address.municipality.island', 
            'user.role']);
        //return response()->json($space);
        return (new SpaceResource($space));
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
