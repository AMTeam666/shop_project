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
                'title' => 'required|max:120',
                'summary' => 'required|max:400',
                'body' => 'required|min:5',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required',
            ];
        }else{
            return [
                'title' => 'required|max:120',
                'summary' => 'required|max:400',
                'body' => 'required|min:5',
                'image' => 'image|mimes:png,jpg,jpeg',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required',
            ];
        }
    }
}
