<?php

namespace App\Http\Controllers\Api;

use auth;
use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpaceResource;
use App\Http\Resources\CommentResource;
use App\Http\Requests\GuardarSpaceRequest;

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
            'comments.user',
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
    public function storeComment(GuardarSpaceRequest $request, $value)
    {
        $space = is_numeric($value) ?
        Space::findOrFail($value) :
        Space::where('regNumber', $value)->firstOrFail();

        $comment = $space->comments()->create([
            'comment' => $request->comment,
            'score' => $request->score,
            'status' => 'n',
            'user_id' => auth()->id()
        ]);


        $images = $request->input('images', []);
        foreach($images as $image) {
            $comment->images()->create([
                'url' => $image,
            ]);
        }

        $comment->load(['user', 'images']);

        return new CommentResource($comment);
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
            'comments.user',
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
            'comments.user',
        ])->where('regNumber', $value)->firstOrFail(); // Buscar por regNumber

    // Retornar el recurso
    return new SpaceResource($space);
}


    /**
     * Update the specified resource in storage.
     */

     
    // public function update(Request $request, string $id)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
