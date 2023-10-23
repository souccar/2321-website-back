<?php

namespace App\Domain\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json($data);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Login Failed!'],401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        return response()->json([
            'data' => [
                'user' => Auth::user(),
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged Out Successfully!'
        ]);
    }

}
