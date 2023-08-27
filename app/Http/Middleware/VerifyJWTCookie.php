<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTCookie
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookieToken = $request->cookie('jwt');

        if ($cookieToken) {
            try {
                JWTAuth::setToken($cookieToken)->authenticate();
                return $next($request);
            } catch (\Throwable $e) {
                Log::error($e->getMessage());
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
