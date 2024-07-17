<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cep/{cep}', [App\Http\Controllers\apiController::class, 'index'])->name('cep');
