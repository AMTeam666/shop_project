<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::paginate(15);

        return view('admin.market.category.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('parent_id', null)->get();

        return view('admin.market.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('image'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result === false)
            {
                return redirect()->route('admin.market.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;

        }

        $productCategory = ProductCategory::create($inputs);
        return redirect()->route('admin.market.category.index')->with('swal-success','دسته بندی جدید شما با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {

        $parent_categories = ProductCategory::where('parent_id', null)->get();
        return view('admin.market.category.edit', compact('productCategory', 'parent_categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryRequest $request, ProductCategory $category, ImageService $imageService)
    {
        $inputs = $request->all();
        if($request->hasFile('image'))
        {
            if (!empty($postCategory->image))
            {
                $imageService->deleteDirectoryAndFiles($category->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.market.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;

        }else{
            if(isset($inputs['currentImage']) && !empty($category->image)){
                $image = $category->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }


        $category->update($inputs);
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $category)
    {
        $result = $category->delete();
        return redirect()->route('admin.market.category.index')->with('swal-success', 'دسته بندی شما با موفقیت حذف شد');
    }

    public function status(ProductCategory $category){

        $category->status = $category->status == 0 ? 1 : 0;
        $result = $category->save();
        if($result){
            if($category->status == 0){
                return response()->json(['status' => true, 'checked' => false]);
            }
            else{
                return response()->json(['status' => true, 'checked' => true]);
            }
        }
        else{
            return response()->json(['status' => false]);
        }

    }

    public function showMenu(ProductCategory $category)
    {

        $category->show_in_menu = $category->show_in_menu == 0 ? 1 : 0;
        $result = $category->save();
        if ($result) {
            if ($category->commentable == 0) {
                return response()->json(['show_in_menu' => true, 'checked' => false]);
            } else {
                return response()->json(['show_in_menu' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['show_in_menu' => false]);
        }
    }

}
