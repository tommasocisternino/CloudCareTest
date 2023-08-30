<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'string|required',
            'password' => 'string|required',
        ]);

        if (!$token = auth()->attempt($request->only(['username', 'password']))) {
            return response()->json(["message" => "Unauthorized"], 401);
        }

        return $this->responseWithJWT($token, auth()->user());
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::fromUser(auth()->user()));

        auth()->logout();

        return response()->json(["message" => "Logged out"
        ], 200);
    }

    public function responseWithJWT($token, $user = null)
    {
        $cookie = cookie('jwt', $token, config('jwt.ttl', 60), null, null, false, true);

        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'expires_in' => config('jwt.ttl', 60) * 60,
            'user' => $user->only("username"),
        ])->withCookie($cookie);
    }
}
