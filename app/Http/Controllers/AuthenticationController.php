<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AuthenticationController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $credentials = compact('username', 'password');

        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where(['username' => $username])->get()->first();

        $userData = ['username' => $user->username, 'role' => $user->role, 'status' => $user->status, 'name' => $user->name,'id' => $user->id];

        return $this->respondWithToken($token, $userData);
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

    public function respondWithToken($token, $user = null)
    {
        return response()->json(['user' => $user,'access_token' => $token, 'expires_in' => auth()->factory()->getTTL() * 480]); // TTL for 8 hours
    }
}
