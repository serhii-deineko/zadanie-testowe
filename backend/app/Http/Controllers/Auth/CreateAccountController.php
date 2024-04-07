<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Modules\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CreateAccountController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
            ]);
    
            // Validate Password
            $verifyPassword = new Password;
            if(!$verifyPassword->verifyPassword($data['password'])) throw new Exception($verifyPassword->error);

            // Create User Account
            User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errorType' => 'email'
            ], 422);
        }
        
        return response()->json([
            'message' => 'Success! Your account has been created.',
        ], 200);
    }
}
