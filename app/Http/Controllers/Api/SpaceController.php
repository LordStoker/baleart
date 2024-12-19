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
    public function index(Request $request)
    {
        //$spaces = Space::all();
        //$spaces = Space::with(['user', 'comments', 'modalities', 'services', 'address'])->get(); //Se indican las relaciones de la clase que usamos
                                                                                                    // para ver los datos relacionados
        // $spaces = Space::paginate(3);  // crea una sortida amb paginació
        // $spaces = Space::with(["user", "modalities", "comments", "comments.images"])->get();
        $query = Space::with([
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
            'user.role',
        ]);
            
        if ($request->has('isla')) {
            $query->whereHas('address.municipality.island', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->isla . '%');
            });
        }
            $spaces = $query->get();
        return (SpaceResource::collection($spaces));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function show($value)
{
    // Determinar si el valor es un número (para buscar por ID) o no (para regNumber)
    $space = is_numeric($value)?
        Space::with([
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
            'user.role',
        ])->findOrFail($value) : //Buscar por ID
        Space::with([
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
            'user.role',
        ])->where('regNumber', $value)->firstOrFail(); // Buscar por regNumber

    // Retornar el recurso
    return new SpaceResource($space);
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
