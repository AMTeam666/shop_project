<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\AddressRequest;
use App\Models\Address;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
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
        $inputs['postal_code'] = convertPersianToEnglish($request->postal_code);

        $address->update($inputs);

        return redirect()->back();
    }

    public function choseAddressAndDelivery(Request $request)
    {
            $request->validate([
                'address_id' => 'required|exists:addresses,id',
                'delivery_id' => 'required|exists:delivery,id',
            ]);

            $user = auth()->user();
            $inputs = $request->all();
    
            //calc price
            $cartItems = CartItem::where('user_id', $user->id)->get();
            $totalProductPrice = 0;
            $totalDiscount = 0;
            $totalFinalPrice = 0;
            $totalFinalDiscountPriceWithNumbers = 0;
            foreach ($cartItems as $cartItem)
            {
                $totalProductPrice += $cartItem->cartItemProductPrice();
                $totalDiscount += $cartItem->cartItemProductDiscount();
                $totalFinalPrice += $cartItem->cartItemFinalPrice();
                $totalFinalDiscountPriceWithNumbers += $cartItem->cartItemFinalDiscount();
            }
    
            //commonDiscount
            $commonDiscount = CommonDiscount::where([['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();
            if($commonDiscount)
            {
                $inputs['common_discount_id'] = $commonDiscount->id;

                 $commonPercentageDiscountAmount = $totalFinalPrice * ($commonDiscount->percentage / 100);
                 if($commonPercentageDiscountAmount > $commonDiscount->discount_ceiling)
                 {
                    $commonPercentageDiscountAmount = $commonDiscount->discount_ceiling;
                 }
                 if($commonDiscount != null and $totalFinalPrice >= $commonDiscount->minimal_order_amount)
                 {
                    $finalPrice = $totalFinalPrice - $commonPercentageDiscountAmount;
                 }
                 else{
                    $finalPrice = $totalFinalPrice;
                 }
            }
            else{
                $commonPercentageDiscountAmount = null;
                $finalPrice = $totalFinalPrice;
            }
    
    
            $inputs['user_id'] = $user->id;
            $inputs['order_final_amount'] = $finalPrice;
            $inputs['order_discount_amount'] = $totalFinalDiscountPriceWithNumbers;
            $inputs['order_common_discount_amount'] = $commonPercentageDiscountAmount;
            $inputs['order_total_products_discount_amount'] = $inputs['order_discount_amount'] + $inputs['order_common_discount_amount'];
            $order = Order::updateOrCreate(
                ['user_id' => $user->id, 'order_status' => 0],
                $inputs
            );
            return redirect()->route('customer.sales-process.show-payment');
    }

    
}
