<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmPasswordController extends Controller
{
    public function showConfirmPasswordForm()
    {
        return view('admin.auth.confirm-password');
    }

    public function confirmPassword(Request $request)
    {
        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => 'The provided password does not match our records.'
            ]);
        }

        $request->session()->passwordConfirmed();

        return redirect()->intended();
    }
}
