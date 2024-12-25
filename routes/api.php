<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ZoneController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\IslandController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ModalityController;
use App\Http\Controllers\Api\SpaceTypeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');




Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::put('/user/{value}', [UserController::class, 'update']);
    // Route::get('/user', [UserController::class, 'index']); 
    Route::get('/user/{user}', [UserController::class, 'show']); 
    Route::post('/user', [UserController::class, 'store']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);
    Route::post('/space/{space}/comment', [SpaceController::class, 'storeComment']);
    Route::apiresource('space', SpaceController::class); 
});
//Route::apiresource('user', UserController::class);



Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);



//Route::put('user/{user}', [UserController::class, 'update']);
// Route::apiresource('role', RoleController::class);

//Route::apiresource('comment', CommentController::class);
//Route::apiresource('address', AddressController::class);
// Route::apiresource('image', ImageController::class);
// Route::apiresource('island', IslandController::class);
// Route::apiresource('modality', ModalityController::class);
// Route::apiresource('service', ServiceController::class);
// Route::apiresource('spacetype', SpaceTypeController::class);
// Route::apiresource('zone', ZoneController::class);
