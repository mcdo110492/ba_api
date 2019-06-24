<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['username', 'password']);

        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(['user' => auth()->user()]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout Success']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function respondWithToken($token)
    {
        return response()->json(['access_token' => $token, 'expires_in' => auth()->factory()->getTTL() * 480]); // TTL for 8 hours
    }
}
