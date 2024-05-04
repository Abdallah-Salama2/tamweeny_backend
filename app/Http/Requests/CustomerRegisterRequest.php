<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
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
            'nationalId' => 'required|string|max:255|unique:users,national_id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'min:8'],
            'phoneNumber' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'cardName' => 'required|string|max:255',
            'cardNumber' => 'required|string|max:255|unique:cards,card_number',
            'cardNationalId' => 'required|string|max:255|unique:cards,card_national_id',
            'cardPassword' => 'required|string|max:255',
        ];
    }
}
