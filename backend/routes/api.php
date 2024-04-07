<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\UserAccountController;
use App\Http\Controllers\Auth\CreateAccountController;

// Create Account
Route::post('/create-account', [CreateAccountController::class, 'register'])
    ->name('create.account');

// Login
Route::post('/login', [UserAuthController::class, 'loginUser'])
    ->middleware(['throttle:6,1'])    
    ->name('login');

Route::middleware(['auth:api'])->group(function () {
    // Auth
    Route::get('/auth', [UserAuthController::class, 'authUser'])
        ->name('auth');

    // Logout
    Route::post('/logout', [UserAuthController::class, 'logoutUser'])
        ->name('logout'); 

    // Create PDF
    Route::post('/create-pdf', [PdfController::class, 'createPdf'])
        ->name('create.pdf');
        
    // Change Password
    Route::post('/user-change-password', [UserAccountController::class, 'changePassword'])
        ->name('user.change.password');
    
    // Delete User
    Route::post('/user-delete-account', [UserAccountController::class, 'deleteAccount'])
        ->name('user.delete.account');
});
