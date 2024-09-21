<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class CustomAuthorizationHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->hasHeader('x-berapiapi-key')) {
            return response()->json([
                'error' => 'Api key required'
            ], 422);

        } else {
            $token = $request->header('x-berapiapi-key');

            // Validasi token terhadap database Sanctum (PersonalAccessTokens)
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken) {
                return $next($request);   

            } else {
                return response()->json([
                    'error' => 'Invalid Api Key'
                ], 422);
            }     
        }        
    }
}
