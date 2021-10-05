<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class LoginController extends Controller
{
    protected $user=null;
     public function __construct(UserRepository $user)
     {
         $this->user=$user;
     }
     
    public function authenticate(Request $request)
    {
       dd("Hello");

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user=$this->user->where('email',$request->email)->get();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Auth::login($user);

            return redirect()->intended('user.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
