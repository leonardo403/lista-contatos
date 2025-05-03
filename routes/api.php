<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
            AuthController,
            ContactController,
            AddressController};

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('contacts', ContactController::class);
    Route::apiResource('addresses', AddressController::class)->except(['index']);
    Route::get('cep/{cep}', [AddressController::class, 'viaCep']);
    Route::get('addresses/{id}/map', [AddressController::class, 'mapsUrl']);
});
