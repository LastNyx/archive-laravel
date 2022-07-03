<?php

use App\Http\Controllers\Api\ArtistsController;
use App\Http\Controllers\Api\SetListsController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/artists', [ArtistsController::class, 'index']);
Route::post('/artists', [ArtistsController::class, 'store']);
Route::get('/artists/{id}', [ArtistsController::class, 'show']);
Route::put('/artists/{id}', [ArtistsController::class, 'update']);
Route::delete('/artists/{id}', [ArtistsController::class, 'destroy']);

Route::post('/artists/sets', [SetListsController::class, 'store']);
Route::get('/artists/sets/{id}', [SetListsController::class, 'show']);
Route::put('/artists/sets/{id}', [SetListsController::class, 'update']);
Route::delete('/artists/sets/{id}', [SetListsController::class, 'destroy']);
