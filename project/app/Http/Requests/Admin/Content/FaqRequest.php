<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
                'question' => 'required|max:200|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., ؟?]+$/u',
                'answer' => 'required|max:1000|min:5|regex:/^[ا-یa-zA-Z0-9\ِ., ?؟]+$/u',
                'tags' => 'required|max:1000|min:5|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'status' => 'required|numeric|in:0,1',
            ];
        }else{
            return [
                'question' => 'required|max:200|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., ?؟]+$/u',
                'answer' => 'required|max:1000|min:5|regex:/^[ا-یa-zA-Z0-9\ِ., ؟?]+$/u',
                'tags' => 'required|max:1000|min:5|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'status' => 'required|numeric|in:0,1',
            ];
        }
    }
}
