<?php

namespace App\Http\Controllers;

use App\Mail\MagicLoginLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
        ]);
        
        $user = User::create($request->only('name', 'email'));
    
        Mail::to($user->email)->send(new MagicLoginLink($user->email));
    
        session()->flash('status', 'We have emailed you a verification link!');
    
        return back();
    }
}
