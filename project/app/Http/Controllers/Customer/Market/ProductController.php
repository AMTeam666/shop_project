<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product(Product $product)
    {
     
        $relatedProducts = Product::all();
        $product->incrementViewCount();
        

        return view("customers.market.product.product", compact("product", "relatedProducts"));
    }

    public function addComment(Product $product, Request $request)
    {
        $request->validate([
            'body' => 'required|max:2000'
        ]);

        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;

        Comment::create($inputs);

        return redirect()->route('customer.market.product', $product)->with('swal-success','کیرمون هم نیست چی گفتی و این کص گفتنا دایورت شد به تخمای حضرت آقا');


    }

    public function addToFavorite(Product $product)
    {
        if(Auth::check())
        {
         $product->user()->toggle([Auth::user()->id]);
         
         if($product->user->contains(Auth::user()->id)){
             return response()->json(['status' => 1]);
         }
         else{
             return response()->json(['status' => 2]);
         }
        }
        else{
         return response()->json(['status' => 3]);
        }
    }
}
