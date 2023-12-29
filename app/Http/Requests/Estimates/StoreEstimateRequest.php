<?php

namespace App\Http\Requests\Estimates;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstimateRequest extends FormRequest
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
            'checkbox_customer' => 'nullable',
            'customer_id' => 'required_without:checkbox_customer',
            'mode_of_work_id' => 'required',
            'lastname' => 'required_if_accepted:checkbox_customer|nullable|string|max:255',
            'firstname' => 'required_if_accepted:checkbox_customer|nullable|string|max:255',
            'email' => 'required_if_accepted:checkbox_customer|unique:App\Models\Customer,email',
            'phone' => 'required_if_accepted:checkbox_customer|nullable|numeric|min_digits:10|max_digits:10',
            'address' => 'required_if_accepted:checkbox_customer|nullable|string|max:255',
            'postal_code' => 'required_if_accepted:checkbox_customer|nullable|numeric|min_digits:5|max_digits:5',
            'city' => 'required_if_accepted:checkbox_customer|nullable|string|max:255',
            'big_construction' => 'nullable',
            'titled' => 'required|string|max:255'
        ];
    }
}
