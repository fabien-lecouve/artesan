<?php

namespace App\Http\Requests\Profiles;

use App\Models\User;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => 'required|numeric|min_digits:10|max_digits:10',
            'address' => 'required|string|max:255',
            'complementary_address' => 'nullable|string|max:255',
            'postal_code' => 'required|numeric|min_digits:5|max_digits:5',
            'city' => 'required|string|max:255',
            'password' => 'confirmed',
            'company' => 'required|string|max:255',
            'rm_number' => 'required|string|max:255',
            'insurance_name' => 'required|string|max:255',
            'insurance_address' => 'required|string|max:255',
            'artisan_logo_path' => 'image',
            'qualifelec_logo_path' => 'image'
        ];
    }
}
