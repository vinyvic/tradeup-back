<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Authentication
    function auth(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas não correspondem.'],
            ]);
        }
        else {
            return response()->json(['token' => $user->createToken($request->device_name, ['*'], now()->addWeek())->plainTextToken]);
        }

    }

    function checkToken(Request $request) {
        $user = auth('sanctum')->user();

        if (!$user) {
            throw ValidationException::withMessages([
                'token' => ['Token não é válido!'],
            ]);
        }

        return response()->json(['ok' => true]);
    }
}
