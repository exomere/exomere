<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberAccountInformationRequest extends FormRequest
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
            'bank_code' => 'required|string|max:255',
            'account_number' => ['required', 'numeric', 'digits_between:1,20'],
            'account_name' => 'required|string|max:255'
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'bank_code.required' => 'The bank code is required.',
            'bank_code.string' => 'The bank code must be a valid string.',
            'bank_code.max' => 'The bank code cannot exceed 255 characters.',

            'account_number.required' => 'The account number is required.',
            'account_number.numeric' => 'The account number must be a valid number.',
            'account_number.digits_between' => 'The account number must be between :min and :max digits.',

            'account_name.required' => 'The account name is required.',
            'account_name.string' => 'The account name must be a valid string.',
            'account_name.max' => 'The account name cannot exceed 255 characters.'
        ];
    }
}
