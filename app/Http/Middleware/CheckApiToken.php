<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            throw ValidationException::withMessages([
                'token' => ['Token não é válido!'],
            ]);
        }

        if ($user) {
            return $next($request);
        }
        
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }
}
