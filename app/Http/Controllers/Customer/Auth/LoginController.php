<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated(), $request->has('remember')))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()
            ->withInput()
            ->withErrors([
                'password' => 'Invalid Password',
            ]);
    }
}
