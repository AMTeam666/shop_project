<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\ProductMeta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Market\ProductCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::where('user_id', $user->id)->orderBy('created_at', 'desc')->simplePaginate(15);
        $age_range = Product::$age_range;
        $gender = Product::$gender;
        return view('admin.market.product.index', compact('products', 'age_range', 'gender'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productsCategories = ProductCategory::all();
        $brands = Brand::all();
        $age_range = Product::$age_range;
        $gender = Product::$gender;
        return view('admin.market.product.create', compact('productsCategories', 'brands', 'age_range', 'gender'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);


        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result === false)
            {
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;

        }
            $product = Product::create($inputs);

            $metas = array_combine($request->meta_key, $request->meta_value);
            foreach ($metas as $key => $value){

                $meta = ProductMeta::create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $product->id
                ]);

            }


        return redirect()->route('admin.market.product.index')->with('swal-success','دسته بندی جدید شما با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        $age_range = Product::$age_range;
        $gender = Product::$gender;
        return view('admin.market.product.edit', compact('productCategories', 'product', 'brands', 'age_range', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        if($request->hasFile('image'))
        {
            if (!empty($product->image))
            {
                $imageService->deleteDirectoryAndFiles($product->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;

        }else{
            if(isset($inputs['currentImage']) && !empty($product->image)){
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }


        $product->update($inputs);
        if($request->meta_key != null){
        $meta_keys = $request->meta_key;
        $meta_values = $request->meta_value;
        $meta_ids = array_keys($request->meta_key);

        $metas = array_map(function ($meta_id, $meta_key, $meta_value){
           return array_combine(
               ['meta_id', 'meta_key', 'meta_value'],
               [$meta_id, $meta_key, $meta_value]
           );
        }, $meta_ids, $meta_keys, $meta_values);

        foreach( $metas as $meta)
        {
            ProductMeta::where('id', $meta['meta_id'])->update([
               'meta_key' => $meta['meta_key'],
                'meta_value' => $meta['meta_value']
            ]);
        }
    }
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $result = $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول شما با موفقیت حذف شد');
    }
}
