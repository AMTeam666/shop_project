<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')){
            return [
                'name' => 'required|max:120|min:3',
                'introduction' => 'required|min:5',
                'price' => 'required|integer',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required',
                'marketable' => 'required|numeric|in:0,1',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at' => 'required|numeric',
                'age_range' => 'numeric|between:1,6',
                'gender' => 'numeric|between:1,3',


            ];
        }else{
            return [
                'name' => 'required|max:120|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., -]+$/u',
                'introduction' => 'required|max:1000|min:5',
                'price' => 'required',
                'image' => '2image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ِ., -]+$/u',
                'marketable' => 'required|numeric|in:0,1',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at' => 'required|numeric',
                'age_range' => 'numeric|between:1,6',
                'gender' => 'numeric|between:1,3',
            ];
        }
    }
}
