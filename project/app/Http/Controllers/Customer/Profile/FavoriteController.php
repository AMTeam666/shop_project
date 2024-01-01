<?php

namespace App\Http\Controllers\Customer\Profile;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function favoriteShow()
    {
        return view('customers.profile.favorites');
    }

    public function deleteFavorite(Product $product)
    {
        $user = auth()->user();
        $user->products()->detach($product);
        return redirect()->route('customer.profile.favorite')->with('success','محصول با موفقیت از علاقه مندی ها حذف شد ');
    }
}
