<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MagicLoginLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::exists(User::class, 'email')],
        ]);
    
        // Sending email
        Mail::to($request->email)->send(new MagicLoginLink($request->email));
        
        // Flash message
        session()->flash('status', 'We have emailed you a magic link!');
        
        // Redirect
        return back();
    }
}
