<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|unique:App\Models\Customer,email',
            'phone' => 'required|numeric|min_digits:10|max_digits:10',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|numeric|min_digits:5|max_digits:5',
            'city' => 'required|string|max:255',
        ];
    }
}
