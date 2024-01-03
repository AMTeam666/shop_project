<?php

namespace App\Http\Requests\Auth\Seller;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'national_code' => ['sometimes', 'required', 'unique:users,national_code', new NationalCode()],
            'store_name' => 'required|min:4|regex:/^[ا-یa-zA-Z0-9\ِ., ]+$/u',
            'accepted_photo_path' => 'required|image|mimes:png,jpg,jpeg',
        ];
    }
}
