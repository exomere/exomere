<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'current_password.required' => '현재 비밀번호를 입력해 주세요.',
            'new_password.required' => '새 비밀번호를 입력해 주세요.',
            'new_password.min' => '새 비밀번호는 최소 8자 이상이어야 합니다.',
            'new_password.confirmed' => '새 비밀번호 확인이 일치하지 않습니다.',
        ];
    }
}
