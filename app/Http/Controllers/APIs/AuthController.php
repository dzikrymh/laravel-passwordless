<?php

namespace App\Http\Controllers\APIs;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\APIs\LoginRequest;
use App\Http\Requests\APIs\RegisterRequest;
use App\Mail\APIMagicLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Sending email
        Mail::to($request->email)->send(new APIMagicLink($request->email));

        // Flash message
        return ResponseFormatter::success(null, 'We have emailed you a magic link!');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('name', 'email'));
    
        Mail::to($user->email)->send(new APIMagicLink($user->email));

        return ResponseFormatter::success(null, 'We have emailed you a verification link!');
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        
        return ResponseFormatter::success(null, 'User logged out');
    }
}
