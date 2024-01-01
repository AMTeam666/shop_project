<?php

namespace App\Http\Requests\Profile;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
               
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'national_code' => ['sometimes', 'required', new NationalCode(), Rule::unique('users')->ignore($this->user()->national_code, 'national_code')],
        ];
    }
}
