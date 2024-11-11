<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request) {

        //sleep(1);




        //validate
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:300r'],
            'name' => ['required', 'max:255'],
             'email' => ['required', 'email', 'max:225', 'unique:users'],
             '  password' => ['required', 'confirmed']
        ]);

        if ($request->hasFile('avatar')) {
            Storage::disk('public')->put('avatars', $request->avatar);
        }


        //Register
        $user = User::create($fields);

        //Login
        Auth::login($user);

        //Redirect
        return redirect()->route('dashboard');
    }

    public function login(Request $request){
        // Validate the incoming request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $request->remember)) {
            // Regenerate session to protect against session fixation attacks
            $request->session()->regenerate();

            // Redirect to intended location after login
            return redirect()->intended('dashboard');
        }

        // If authentication fails, return back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

     public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
