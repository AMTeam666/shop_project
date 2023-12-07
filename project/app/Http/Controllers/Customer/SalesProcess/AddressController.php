<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\AddressRequest;
use App\Models\Address;
use App\Models\Market\Delivery;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function addressAndDelivery()
    {
        //check profile
        $user = Auth::user();
        $provinces = Province::all();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $deliveries = Delivery::all();

        if(empty(CartItem::where('user_id', $user->id)->count()))
        {
            return redirect()->route('customers.sales-process.cart');
        }

        return view('customers.market.sales-process.address-and-delivery', compact('cartItems', 'provinces', 'deliveries'));
    }


    public function getCities(Province $province)
    {
       $cities = $province->cities;
       if($cities != null)
       {
        return response()->json(['status' => true, 'cities' => $cities]);
       }
       else{
        return response()->json(['status' => false, 'cities' => null]);
       }
    }

    public function addAddress(AddressRequest $request)
    {   
        $inputs = $request->all();
        
        $inputs['user_id'] = auth()->user()->id;

        $address = Address::create($inputs);
        return redirect()->back();
        
    }

    public function updateAddress(AddressRequest $request, Address $address)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;

        $address->update($inputs);

        return redirect()->back();
    }

    
}
