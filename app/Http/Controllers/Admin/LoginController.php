<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.home'));
        } 

        return back()->withInput()->withErrors([
            'message'=>'Wrong Email or Password!!'
        ]);
    }

    public function attemptLogin(LoginRequest $request)
    {
        return Auth::guard('admin')->attempt(
            $request->validated(),
            $request->has('remember')
        );
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login');
    }
}
