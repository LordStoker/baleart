<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //  public function index()
    // {
    //       $users = User::all();
    //      $users = User::with(['role', 'comments', 'spaces'])->get();
    //      return UserResource::collection($users);
    // }

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
    public function show($value)
    {

        // return response()->json($user);
        $user = is_numeric($value) ?
        User::with(['spaces', 'comments', 'comments.images', 'role'])->findOrFail($value) :
        User::with(['spaces', 'comments', 'comments.images', 'role'])->where('email', $value)->firstOrFail();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuardarUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return (new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
