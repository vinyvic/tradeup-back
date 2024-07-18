<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class apiController extends Controller
{
    function index(string $cep)
    {
        if (strlen($cep) != 8) {
            return response()->json([
                'ok' => false,
                'message' => 'O CEP deve ter 8 digitos',
            ], 422);
        }

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful()) {
            $dataFetched = $response->json();

            if (!isset($dataFetched['erro'])) {
                return $dataFetched;
            }
        } 

        return response()->json([
            'ok' => false,
            'message' => "O Endereço do CEP $cep não foi encontrado via API",
        ], 422);
    }
}
