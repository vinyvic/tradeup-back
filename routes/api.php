<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', [AuthController::class, 'auth']);
Route::get('token', [AuthController::class, 'token']);
Route::get('/cep/{cep}', [ApiController::class, 'index'])->middleware(CheckApiToken::class);