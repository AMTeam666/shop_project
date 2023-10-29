<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
                'name' => 'required|max:120|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., -]+$/u',
                'description' => 'required|max:1000|min:5',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ِ., -]+$/u',
                'parent_id' => 'nullable|min:1|max:100000000|regex:/^[0-9]+$/u|exists:product_categories,id',

            ];
        }else{
            return [
                'name' => 'required|max:120|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., -]+$/u',
                'description' => 'required|max:1000|min:5',
                'image' => 'image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ِ., -]+$/u',
                'parent_id' => 'nullable|min:1|max:100000000|regex:/^[0-9]+$/u|exists:product_categories,id',

            ];
        }
    }
}
