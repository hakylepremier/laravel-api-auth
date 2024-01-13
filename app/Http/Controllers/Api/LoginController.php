<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $user = User::where('email', $request->only(['email']))->first();

        $token = $user->createToken('myapptoken')->plainTextToken;

        return new JsonResponse(
            [
                'message' => 'Login Succesful',
                'code' => 'login_success',
                'token' => $token,
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();

        return new JsonResponse(
            [
                'code' => 'logout_success',
                'message' => 'Logged Out Successfully',
            ],
            200
        );

    }

}
