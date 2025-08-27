<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function paparBorangLogin()
    {
        return view('auth.template-login');
    }

    public function prosesDataLogin(Request $request)
    {
        // $_POST[];
        // $_GET[];

        // Dapatkan semua data daripada template-login
        // $data = $request->all();


        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email', 'min:3'],
            'password' => ['required', 'min:3'],
            'remember' => ['nullable', 'sometimes']
        ]);

        return $credentials;

        // // Attempt to authenticate the user
        // if (auth()->attempt($credentials)) {
        //     // Regenerate the session to prevent fixation attacks
        //     $request->session()->regenerate();

        //     // Redirect to intended page or dashboard
        //     return redirect()->intended('/dashboard');
        // }

        // // If authentication fails, redirect back with an error message
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }
}
