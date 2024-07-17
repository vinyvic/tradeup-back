<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class apiController extends Controller
{
    function index(string $cep)
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        if ($response->ok()){
            return $response->json();
        }
        else {
            return ['erro' => 'CEP não encontrado'];
        }
    }
}
