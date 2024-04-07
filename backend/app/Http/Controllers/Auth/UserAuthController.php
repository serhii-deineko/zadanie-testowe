<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function authUser()
    {
        $user = Auth::user();
        
        return response()->json([
            'id' => $user->id,
            'email' => $user->email,
        ], 200);
    }

    public function loginUser(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Check Credentials
            if (Auth::attempt([
                    'email' => $credentials['email'],
                    'password' => $credentials['password']
            ])){
                $token = Auth::user()->createToken('user')->accessToken;
                return response()->json([
                    'token' => $token,
                    'message' => 'Session started.'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function logoutUser()
    {
        try {
            Auth::user()->token()->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
        return response()->json([
            'message' => 'Session removed.'
        ], 200);
    }
}
