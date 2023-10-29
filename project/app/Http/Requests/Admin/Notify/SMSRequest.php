<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class SMSRequest extends FormRequest
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
                'title' => 'required|max:120|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'body' => 'required|max:1000|min:2',
                'status' => 'required|numeric|in:0,1',
            ];
        }else{
            return [
                'title' => 'required|max:120|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
                'body' => 'required|max:1000|min:2',
                'status' => 'required|numeric|in:0,1',
            ];
        }
    }
}
