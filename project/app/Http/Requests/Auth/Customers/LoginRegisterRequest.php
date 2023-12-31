<?php

namespace App\Http\Requests\Auth\Customers;

use App\Models\Otp;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class LoginRegisterRequest extends FormRequest
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
                 'id' => 'required|min:11|max:64|regex:/^[a-zA-Z0-9_.@\+]*$/',
            ];

       
    }
}
