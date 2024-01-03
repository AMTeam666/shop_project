<?php

namespace App\Http\Controllers\Customer;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Content\Banner;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        //banners query
        $slideShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position', 3)->where('status', 1)->first();

        //brands query
        $brands = Brand::all();

        //product categories
        $categories = ProductCategory::all();

        //products query
        $mostVisitedProducts = Product::latest()->take(10)->get();
        $OfferProducts = Product::latest()->take(10)->get();
        Auth::loginUsingId(2);
        return view('customers.home', compact('slideShowImages', 'topBanners', 'middleBanners', 'bottomBanner', 'brands', 'mostVisitedProducts', 'OfferProducts', 'categories'));
    }

    public function search(Request $request)
    {
        //get brands
        $brands = Brand::all();
        //switch for set sort for filtering
        switch ($request->sort) {
            case "1":
                $column = "created_at";
                $direction = "DESC";
                break;
            case "2":
                $column = "price";
                $direction = "DESC";
                break;
            case "3":
                $column = "price";
                $direction = "ASC";
                break;
            case "4":
                $column = "view";
                $direction = "DESC";
                break;
            case "5":
                $column = "sold_number";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "ASC";
        }
        if ($request->search) {
            $query = Product::where('name', 'LIKE', "%" . $request->search . "%")->orderBy($column, $direction);
        } else {
            $query = Product::orderBy($column, $direction);
        }
        $products = $request->max_price && $request->min_price ? $query->whereBetween('price', [$request->min_price, $request->max_price]) :
            $query->when($request->min_price, function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price)->get();
            })->when($request->max_price, function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price)->get();
            })->when(!($request->min_price && $request->max_price), function ($query) {
                $query->get();
            });
        $products = $products->when($request->brands, function () use ($request, $products) {
            $products->whereIn('brand_id', $request->brands);
        });
        $products = $products->when($request->age_range, function () use ($request, $products) {
            if($request->age_range == 6){
                $products = $products->get();
            }
            $products->where('age_range', $request->age_range);
        });
        $products = $products->when($request->gender, function () use ($request, $products) {
            if($request->gender == 3){
                $products = $products->get();
            }
            $products->where('gender', $request->gender);
        });

        $products = $products->get();
        return view('customers.search-show', compact('products', 'brands'));
    }
}
