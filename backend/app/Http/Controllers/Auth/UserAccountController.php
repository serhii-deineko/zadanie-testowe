<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Modules\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    public function changePassword(Request $request)
    {
        try {

            $data = $request->validate([
                'password_current' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255', 'confirmed'],
            ]);
    
            $userID = Auth::id();
            $passwordConfirm = $data['password_current'];
            $passwordNew = $data['password'];

            // Validate Password
            $verifyPassword = new Password;
            if(!$verifyPassword->verifyPassword($passwordNew)) throw new Exception($verifyPassword->error);
            
            // Check Current Password
            $user = User::find($userID);
            if(!Hash::check($passwordConfirm, $user->password)) throw new Exception('Ups, the given password is incorrect.');
            
            // Update Password
            $user->update([
                'password' => Hash::make($passwordNew)
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => 'Success! Your password has been changed.',
        ], 200);
    }

    public function deleteAccount(Request $request)
    {
        try {
            $data = $request->validate([
                'password' => ['required', 'string', 'max:255'],
            ]);
    
            $userID = Auth::id();
            $password = $data['password'];

            // Check Current Password
            $user = User::find($userID);
            if(!Hash::check($password, $user->password)) throw new Exception('The given password is incorrect.');

            // Delete User
            $user->delete();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => 'Your account has been removed.',
        ], 200);
    }
}
