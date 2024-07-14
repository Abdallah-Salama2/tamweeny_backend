<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminCardRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_cards,email',
            'gender' => ['required', Rule::in(['male', 'female','ذكر','انثى'])],
            'phoneNumber' => 'required|string|max:20',
            'nationalId' => 'required|string|max:255|',
            'socialStatus' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'nationalIdCardAndBirthCertificate.*' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'followersNationalIdCardsAndBirthCertificates.*' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ];
    }
}
