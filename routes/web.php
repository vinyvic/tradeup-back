<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('cep', function () {
    return view('cep');
})->name('form-cep');