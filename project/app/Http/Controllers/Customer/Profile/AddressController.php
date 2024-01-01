<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Models\Address;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
   
    public function showAddress()
    {
        $provinces = Province::all();
        return view('customers.profile.my-address', compact('provinces'));
    }

    public function deleteAddress(Address $address)
    {
        $address->delete();
        return redirect()->route('customer.profile.address')->with('success','آدرس با موفقیت حذف شد ');
    }
}
