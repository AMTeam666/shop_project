<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index', compact('categoryAttribute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.create', compact('categoryAttribute'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryValueRequest $request, CategoryAttribute $categoryAttribute)
    {

        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value , 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $value = CategoryValue::create($inputs);
        return redirect()->route('admin.market.value.index',$categoryAttribute->id )->with('swal-success','مقدار فرم جدید شما با موفقیت ساخته شد');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {

       
        return view('admin.market.property.value.edit', compact('categoryAttribute', 'value'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryValueRequest $request, CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value , 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $value->update($inputs);
        return redirect()->route('admin.market.value.index',$categoryAttribute->id )->with('swal-success','مقدار فرم شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
       
        $result = $value->delete();
        return redirect()->route('admin.market.value.index', $categoryAttribute->id)->with('swal-success', 'فرم شما با موفقیت حذف شد');
    }
}
