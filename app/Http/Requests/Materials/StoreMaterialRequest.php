<?php

namespace App\Http\Requests\Materials;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
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
            'name' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required|max:255',
            'start_of_description_for_several' => 'nullable|max:255',
            'end_of_description_for_several' => 'required_with:start_of_description_for_several|max:255',
            'new_unit_price' => 'required|integer|numeric|min:0',
            'new_workforce_price' => 'required|integer|numeric|min:0',
            'renovation_unit_price' => 'required|integer|numeric|min:0',
            'renovation_workforce_price' => 'required|integer|numeric|min:0'
        ];
    }
}
