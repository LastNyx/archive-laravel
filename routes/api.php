<?php

use App\Http\Controllers\Api\ArtistsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/artists', [ArtistsController::class, 'index']);
Route::post('/artists', [ArtistsController::class, 'store']);
Route::get('/artists/{id}', [ArtistsController::class, 'show']);
Route::put('/artists/{id}', [ArtistsController::class, 'update']);
Route::delete('/artists/{id}', [ArtistsController::class, 'destroy']);
