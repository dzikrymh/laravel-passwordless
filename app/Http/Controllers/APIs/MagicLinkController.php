<?php

namespace App\Http\Controllers\APIs;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class MagicLinkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $token = $user->createToken('magic-link', ['*'], now()->addDay())->plainTextToken;
        $expiresAt = now()->addDay()->diffForHumans();

        return ResponseFormatter::success([
            'type' => 'Bearer',
            'token' => $token,
            'expires_at' => $expiresAt,
            'user' => $user,
        ], 'User logged in with magic link');
    }
}
