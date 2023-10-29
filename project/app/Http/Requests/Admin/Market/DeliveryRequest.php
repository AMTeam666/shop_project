<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
        return [
            'name' => 'required|max:200|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., ؟?]+$/u',
            'amount' => 'required|regex:/^[0-9.]+$/u',
            'delivery_time' => 'required|integer',
            'delivery_time_unit' => 'required|max:200|min:3|regex:/^[ا-یa-zA-Z0-9\ِ., ؟?]+$/u',
        ];
    }
}
