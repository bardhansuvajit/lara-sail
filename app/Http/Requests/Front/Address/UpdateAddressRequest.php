<?php

namespace App\Http\Requests\Front\Address;;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|min:1',
            'address_type' => 'required|string|in:shipping,billing',
            'is_default' => 'nullable|integer|in:1',

            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'address_line_1' => 'required|string|min:2|max:200',
            'address_line_2' => 'nullable|string|min:1|max:200',
            'city' => 'required|string|min:1|max:50',
            'state' => 'required|string|min:1|max:50',
            'postal_code' => 'required|string|digits:'.COUNTRY['postalCodeDigits'],
            'country_code' => 'required|string|max:2|exists:countries,code',
            'phone_no' => 'required|integer|digits:'.COUNTRY['phoneNoDigits'],
            'email' => 'nullable|email|min:2|max:80',
            'landmark' => 'nullable|string|min:1|max:200',
            'additional_notes' => 'nullable|string|min:1|max:50',
            'alt_phone_no' => 'nullable|integer|digits:'.COUNTRY['phoneNoDigits'],
        ];
    }
}
