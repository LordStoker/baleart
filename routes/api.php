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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//El except va implícito en el apiresource, pero así lo dejamos clarificado en el código
Route::apiresource('user', UserController::class)->except('create', 'edit');
Route::apiresource('role', RoleController::class)->except('create', 'edit');;
Route::apiresource('space', SpaceController::class)->except('create', 'edit');;
Route::apiresource('comment', CommentController::class)->except('create', 'edit');;
Route::apiresource('address', AddressController::class)->except('create', 'edit');;
Route::apiresource('image', ImageController::class)->except('create', 'edit');;
Route::apiresource('island', IslandController::class)->except('create', 'edit');;
Route::apiresource('modality', ModalityController::class)->except('create', 'edit');;
Route::apiresource('service', ServiceController::class)->except('create', 'edit');;
Route::apiresource('spacetype', SpaceTypeController::class)->except('create', 'edit');;
Route::apiresource('zone', ZoneController::class)->except('create', 'edit');;
