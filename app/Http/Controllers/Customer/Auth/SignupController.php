<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\SignupRequest;
use App\Models\User;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('customer.auth.signup');
    }

    public function signup(SignupRequest $request)
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect()->route('home');
    }
}
