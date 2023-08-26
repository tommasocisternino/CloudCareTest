<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!$token = auth()->attempt($request->only(['username','password']))) {
            return response()->json(["message" => "Unauthorized", "user" => auth()->user()], 401);
        }

        return $this->responseWithJWT($token, auth()->user()->toArray());
    }

    public function responseWithJWT($token, array $user = null)
    {
        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'expires_in' => 3600,
            'user' => $user
        ]);
    }
}
