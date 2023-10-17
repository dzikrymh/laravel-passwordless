<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class LoginFromMagicLinkController extends Controller
{
    public function __invoke(User $user)
    {
        auth()->login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
