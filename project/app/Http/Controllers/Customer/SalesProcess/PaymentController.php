<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Models\Market\CartItem;
use App\Models\Market\OrderItem;
use App\Models\Market\CashPayment;
use App\Http\Controllers\Controller;
use App\Models\Market\OnlinePayment;
use Illuminate\Support\Facades\Auth;
use App\Models\Market\OfflinePayment;

class PaymentController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->first();

        return view('customers.market.sales-process.payment', compact('cartItems', 'order'));
    }

    public function copanDiscount(Request $request)
    {
        $request->validate(
            ['copan' => 'required']
        );

        $copan = Copan::where([['code', $request->copan], ['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();
        if ($copan != null) {
            if ($copan->user_id != null) {
                $copan = Copan::where([['code', $request->copan], ['status', 1], ['end_date', '>', now()], ['start_date', '<', now()], ['user_id', auth()->user()->id]])->first();
                if ($copan == null) {
                    return redirect()->back();
                }
            }

            $order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->where('copan_id', null)->first();

            if ($order) {
                if ($copan->amount_type == 0) {
                    $copanDiscountAmount = $order->order_final_amount * ($copan->amount / 100);
                    if ($copanDiscountAmount > $copan->discount_ceiling) {
                        $copanDiscountAmount = $copan->discount_ceiling;
                    }
                } else {
                    $copanDiscountAmount = $copan->amount;
                }

                $order->order_final_amount = $order->order_final_amount - $copanDiscountAmount;

                $finalDiscount = $order->order_total_products_discount_amount + $copanDiscountAmount;

                $order->update(
                    ['copan_id' => $copan->id, 'order_copan_discount_amount' => $copanDiscountAmount, 'order_total_products_discount_amount' => $finalDiscount]
                );

                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function paymentSubmit(Request $request)
    {
        $request->validate([
            'payment_type' => 'required',
        ]);

        $order = Order::where('user_id', auth()->user()->id)->where('order_status', 0)->first();
        $cartItems = CartItem::where('user_id', auth()->user()->id)->get();
        $cash_receiver = null;

        switch ($request->payment_type) {

            case 1:
                $target = OnlinePayment::class;
                $type = 0;
                break;
            case 2:
                $target = OfflinePayment::class;
                $type = 1;
                break;
            case 3:
                $target = CashPayment::class;
                $type = 2;
                $cash_receiver = $request->cash_receiver ? $request->cash_receiver : null;
                break;
        }

        $paymented = $target::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'pay_date' => now(),
            'cash_receiver' => $cash_receiver,
            'status' => 1
        ]);

        $payment = Payment::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'type' => $type,
            'paymentable_id' => $paymented->id,
            'paymentable_type' => $target,
            'status' => 1
        ]);

        $order->update(
            ['status' => 2,
            'payment_type' => $type
        ]);

        foreach($cartItems as $cartItem){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product' => $cartItem->product,
                'amazing-sale-id' => $cartItem->product->activeAmazingSale()->id ?? null,
                'amazing_sale_object' => $cartItem->product->activeAmazingSale() ?? null,
                'amazing_sale_discount_amount' => empty($cartItem->product->activeAmazingSale()) ? 0 : $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSale()->percentage / 100) ,
                'number' => $cartItem->number,
                'final_product_price' => empty($cartItem->product->activeAmazingSale()) ? ($cartItem->cartItemProductPrice()) : ($cartItem->cartItemProductPrice()) - ($cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSale()->percentage / 100)) ,
                'final_total_price' =>  empty($cartItem->product->activeAmazingSale()) ? ($cartItem->cartItemProductPrice()) * ($cartItem->number) : ($cartItem->cartItemProductPrice()) - ($cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSale()->percentage / 100)) * ($cartItem->number),
                'color_id ' => $cartItem->color_id ?? null,
                'guarantee_id  ' => $cartItem->guarantee_id  ?? null,

            ]);
            $cartItem->product->incrementSoldNumberCount($cartItem->number);
            $cartItem->product->decreaseFrozenNumberCount($cartItem->number);
            $cartItem->delete();
        }
            
         
        return redirect()->route('customers.home')->with('success', 'سفارش شما با موفقیت ثبت شد ');
        


    }
}
