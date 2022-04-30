<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credintials = $request->only(['email', 'password']);

        if(!auth()->attempt($credintials)){
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        $user = User::with('company')->find(auth()->user()->id);

        return response()->json(['token' => $token, 'user' => $user], 200);
    }

}
