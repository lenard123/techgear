<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateContactRequest;
use App\Http\Requests\Customer\UpdateAddressRequest;
use App\Services\UserAddressService;

class ProfileController extends Controller
{
    public function index()
    {

        $address = new UserAddressService(auth()->user());

        return view('customer.profile.index')
            ->with('user', auth()->user())
            ->with('user_info', auth()->user()->info())
            ->with('address', $address);
    }

    public function updateAddress(UpdateAddressRequest $request)
    {
        //Empty values are excluded when I use
        //the fill method :(
        $user_info = auth()->user()->info();
        $user_info->region_id = $request->region_id;
        $user_info->province_id = $request->province_id;
        $user_info->city_id = $request->city_id;
        $user_info->barangay_id = $request->barangay_id;
        $user_info->street = $request->street;
        $user_info->unit = $request->unit;
        $user_info->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'Address updated successfully.');
    }

    public function updateContact(UpdateContactRequest $request)
    {
        $user = auth()->user();
        $user->fill($request->validated());
        $user->save();

        $user_info = $user->info();
        $user_info->phone = $request->phone;
        $user_info->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'Info updated successfully.');
    }
}
