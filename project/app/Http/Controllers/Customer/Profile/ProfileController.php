<?php

namespace App\Http\Controllers\Customer\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('customers.profile.profile');
    }

    public function edit()
    {
        return view('customers.profile.profile-edit');
    }

    public function update(UpdateProfileRequest $request)
    {
      $inputs = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'national_code' => $request->national_code,
      ];

      $user = auth()->user();
      $user->update($inputs);

      return redirect()->route('customer.profile.show')->with('success', 'اطلاات با موفقیت ویرایش شد');
    }
}
