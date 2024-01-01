<?php

namespace App\Http\Controllers;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;

class ShowCategories extends Controller
{
    public function show(ProductCategory $category, Request $request)
    {   
        switch($request->sort){
            case 1 : 
                $column = "created_at";
                $direction = "DESC";
                break;
            case 2 : 
                $column = "price";
                $direction = "DESC";
                break;
            case 3 : 
                $column = "price";
                $direction = "ASC";
                break;
            case 4 : 
                $column = "view";
                $direction = "DESC";
                break;
            case 5 : 
                $column = "sold_number";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "ASC";
        }
        $query = $category->products()->orderBy($column, $direction);
        $products = $request->min_price && $request->max_price ? $query->whereBetween('price', [$request->min_price, $request->max_price])->get() : 
        $query->when($request->min_price, function($query) use ($request){
            $query->where('price', '>=', $request->min_price)->get();
        })->when($request->max_price, function($query) use ($request){
            $query->where('price', '<=', $request->max_price)->get();
        })->when(!($request->min_price && $request->max_price), function($query){
            $query->get();
        });
        $products = $products->when($request->brands, function() use ($request, $products){
            $products->whereIn('brand_id', $request->brands);
        });
        $products = $products->get();
        $brands = Brand::all();
       return view("customers.category.categories-show", compact('category', 'products', 'brands'));
    }
 
}
