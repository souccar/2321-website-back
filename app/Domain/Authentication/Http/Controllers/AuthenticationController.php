<?php

namespace App\Domain\Authentication\Http\Controllers;

use App\Helpers\AhcResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        // $credentials = request(['email', 'password']);
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return AhcResponse::sendResponse([], false, $validator->errors());
        }

        if (!Auth::attempt($credentials)) {
            return AhcResponse::sendResponse([], false, ['user name or password is incorrect']);
        }
        $user = Auth::user();

        $token = $user->createToken(
            $user->name . '_' . Carbon::now(),
            ['*'],
            Carbon::now()->addDays(1)
        )->plainTextToken;

        return AhcResponse::sendResponse([
            'user' => Auth::user(),
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $token = \Laravel\Sanctum\PersonalAccessToken::findToken($request->header('Authorization'));
        if ($token != null) {
            $isDeleted = $token->delete();
            if ($isDeleted) {
                return AhcResponse::
                    sendResponse(['Logged Out Successfully!'], true, []);
            } else {
                return AhcResponse::sendResponse([], false, ["Error"]);
            }
        } else {
            return AhcResponse::sendResponse([], false, ["token not found"]);
        }
    }

    public function getUserByToken(Request $request)
    {
        $token = \Laravel\Sanctum\PersonalAccessToken::findToken($request->header('Authorization'));
        if ($token != null) {
            if ($token->expires_at < Carbon::now()) {
                return AhcResponse::sendResponse([], false, ['token has expired']);
            }
            return $token->tokenable;
        }
        return AhcResponse::sendResponse([], false, ['token not found']);
    }

}
