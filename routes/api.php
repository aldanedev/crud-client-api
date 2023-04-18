<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/clients', [ClientController::class, 'list']);
Route::middleware(['auth:sanctum'])->post('/clients', [ClientController::class, 'save']);
Route::middleware(['auth:sanctum'])->put('/clients/{id}', [ClientController::class, 'update']);
Route::middleware(['auth:sanctum'])->delete('/clients/{id}', [ClientController::class, 'delete']);
