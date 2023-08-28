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

        if (!$token = auth()->attempt($request->only(['username', 'password']))) {
            return response()->json(["message" => "Unauthorized", "user" => auth()->user()], 401);
        }

        return $this->responseWithJWT($token, auth()->user());
    }

    public function check(){
        return response()->json(["user" => auth()->user()]);
    }

    public function responseWithJWT($token,$user = null)
    {
        $cookie = cookie('jwt', $token, config('app.JWT_MINUTES_EXPIRATION', 60), null, null, false, true);

        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'expires_in' => config('app.JWT_MINUTES_EXPIRATION', 60) * 60,
            'user' => $user->only("username"),
        ])->withCookie($cookie);
    }
}
