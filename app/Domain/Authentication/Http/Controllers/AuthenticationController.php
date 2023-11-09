<?php

namespace App\Domain\Authentication\Http\Controllers;

use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return AhcResponse::sendResponse([], false, ['message' => 'Login Failed!']);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return AhcResponse::sendResponse([
            'user' => Auth::user(),
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return AhcResponse::
        sendResponse(['message' => 'Logged Out Successfully!'], true, []);
    }

}
