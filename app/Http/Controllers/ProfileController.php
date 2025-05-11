<?php

namespace App\Http\Controllers;

use App\Enums\AddressType;
use App\Http\Requests\passwordUpdateRequest;
use App\Http\Requests\profileRequest;
use App\Models\Country;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function view(Request $request)
    {
        $user = $request->user();
        $customer = $user->customer;
        $shippingAddress = $customer->shippingAddress ?? new CustomerAddress(['type', AddressType::Shipping]);
        $billingAddress = $customer->billingAddress ?? new CustomerAddress(['type', AddressType::Billing]);
        $countries = Country::query()->orderBy('name')->get();
        return view('profile.edit', compact('customer', 'user', 'shippingAddress', 'billingAddress', 'countries'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(profileRequest $request)
    {
        $customerData = $request->validated();
        $shippingData = $customerData['shipping'];
        $billingData = $customerData['billing'];

        $user = $request->user();

        $customer = $user->customer;
        $customer->update($customerData);
        if ($customer->shippingAddress) {
            $customer->shippingAddress->update($shippingData);
        } else {
            $shippingData['customer_id'] = $customer->user_id;
            $shippingData['type'] = AddressType::Shipping->value;
            CustomerAddress::create($shippingData);
        }
        if ($customer->billingAddress) {
            $customer->billingAddress->update($billingData);
        } else {
            $billingData['customer_id'] = $customer->user_id;
            $billingData['type'] = AddressType::Billing->value;
            CustomerAddress::create($billingData);
        }
        $request->session()->flash('flash_message', 'Profile was successfully updated.');
        return Redirect::route('profile');
    }

    public function passwordUpdate(passwordUpdateRequest $request)
    {
        $user = $request->user();
        $passwordDAta = $request->validated();

        $user->password = Hash::make($passwordDAta['new_password']);
        $user->save();
        $request->session()->flash('flash_message', 'Password was successfully updated.');
        return Redirect::route('profile');
    }
}
