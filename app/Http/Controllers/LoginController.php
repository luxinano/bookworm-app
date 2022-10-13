<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json($user);
        }
        return response()->json('Login failed: Invalid username or password.', 422);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response('', 204);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->access_token = $user->createToken("API_TOKEN")->plainTextToken;
            return response()->json($user);
        }
        return response()->json('Login failed: Invalid username or password.', 422);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json('', 204);
    }
}
