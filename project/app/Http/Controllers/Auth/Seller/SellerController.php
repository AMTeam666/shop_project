<?php

namespace App\Http\Controllers\Auth\Seller;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Auth\Seller\SellerRequest;

class SellerController extends Controller
{
    public function form()
    {
        return view('customers.auth.seller.form');
    }

    public function confirm(SellerRequest $request, ImageService $image)
    {
        $user= Auth::user();
        $national_code = convertArabicToEnglish($request->national_code);
        $national_code = convertPersianToEnglish($national_code);

       $inputs = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'national_code' => $national_code,
        'store_name' => $request->store_name,
        'user_type' => 2,
        'seen' => 0,
       ];

        if ($request->hasFile('accepted_photo_path')) {
            $image->setExclusiveDirectory('accepted_photo_path' . DIRECTORY_SEPARATOR. $inputs['first_name']. ' ' . $inputs['last_name']);
            $result = $image->save($request->file('accepted_photo_path'));
            if ($result === false) {
                return redirect()->route('seller.form')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['accepted_photo_path'] = $result;
        }
        $user->update($inputs);  

           return redirect()->route('customers.home')->with('success', 'ثبت نام شما به عنوان فروشنده با موفقیت انجام شد .. طی 24 ساعت آینده بعد از تایید مدارک پنل شما باز خواهد شد');
    }
}
