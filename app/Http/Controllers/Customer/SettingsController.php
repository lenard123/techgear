<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateEmailRequest;
use App\Http\Requests\Customer\UpdatePasswordRequest;

class SettingsController extends Controller
{
    public function index()
    {
        return view('customer.settings.index');
    }

    public function updateEmail(UpdateEmailRequest $request)
    {
        auth()->user()->update($request->validated());

        return redirect()
            ->route('settings.index')
            ->with('success', 'Email updated successfully.');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        $user->password = $request->password;
        $user->save();
        return redirect()
            ->route('settings.index')
            ->with('success', 'Password updated successfully.');
    }
}
