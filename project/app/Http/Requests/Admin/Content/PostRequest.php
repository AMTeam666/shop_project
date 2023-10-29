<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'summary' => 'required|max:400|min:5',
                'body' => 'required|max:400|min:5',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'published_at' => 'required|numeric',
            ];
        }else{
            return [
                'title' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'summary' => 'required|max:400|min:5',
                'body' => 'required|max:400|min:5',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image' => 'image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'published_at' => 'numeric',
            ];
        }
    }
}
