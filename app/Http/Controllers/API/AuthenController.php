<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthenLoginRequest;
use App\Http\Requests\AuthenRegisterRequest;

class AuthenController extends Controller
{

    public function register(AuthenRegisterRequest $request)
    {
        $validated_request = $request->validated();
        $validated_request['password'] = Hash::make($request->password);
        $user = User::create($validated_request);

        return response()->json(['Successfully'=>$user],200);
    }

    public function login(AuthenLoginRequest $request)
    {
        $validated_request = $request->validated();
        if (!auth()->attempt($validated_request)) {
            return response(['Failed' => 'Wrong username or password'], 401);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        //return response(['user' => auth()->user(), 'access_token' => $accessToken]);

        return response()->json(['Successfully' => ['user'=>auth()->user()]],200);
    }
}
