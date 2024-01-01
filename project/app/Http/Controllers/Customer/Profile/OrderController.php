<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Models\Address;
use App\Models\Favorite;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\OrderItem;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function showOrders()
    {
      $type = request()->type;
        if(isset(request()->type)){
            if(request()->type == 0){
                $orders = auth()->user()->orders()->where('payment_status', 0)->orderBy('id', 'desc')->get();
            }elseif(request()->type == 3){
                $orders = auth()->user()->orders()->where('payment_status', 1)->where('delivery_status', 1)->orderBy('id', 'desc')->get();
            }elseif(request()->type == 2){
                $orders = auth()->user()->orders()->where('payment_status', 1)->where('delivery_status', 2)->orderBy('id', 'desc')->get();
            }else
            $orders = auth()->user()->orders()->where('order_status', request()->type)->orderBy('id', 'desc')->get();
        }
        else{
            $orders = auth()->user()->orders()->orderBy('id', 'desc')->get();
        }
        
        return view('customers.profile.order', compact('orders', 'type'));
    }

}
