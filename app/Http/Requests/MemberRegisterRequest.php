<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MemberRegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'member_id' => ['required', 'string', 'max:255', 'unique:ex_members'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:ex_members'],
            'local_store' => ['required', 'string'],
            'recommend_seq' => ['required', 'integer'],
            'zipcode' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string'],
            'address_detail' => ['required', 'string'],
            'nation' => ['required', 'string'],
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'member_id.required' => 'The Member ID is required.',
            'member_id.string' => 'The Member ID must be a valid string.',
            'member_id.max' => 'The Member ID cannot exceed 255 characters.',
            'member_id.unique' => 'This Member ID is already in use.',

            'password.required' => 'The password is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',

            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name cannot exceed 255 characters.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a valid string.',
            'phone.max' => 'The phone number cannot exceed 20 characters.',

            'email.required' => 'The email address is required.',
            'email.string' => 'The email address must be a valid string.',
            'email.email' => 'The email address must be a valid email.',
            'email.max' => 'The email address cannot exceed 255 characters.',
            'email.unique' => 'This email address is already registered.',

            'local_store.required' => 'The local store information is required.',
            'local_store.string' => 'The local store information must be a valid string.',

            'recommend_seq.required' => 'The recruiter sequence is required.',
            'recommend_seq.integer' => 'The recruiter sequence must be an integer.',

            'zipcode.required' => 'The zipcode is required.',
            'zipcode.string' => 'The zipcode must be a valid string.',
            'zipcode.max' => 'The zipcode cannot exceed 10 characters.',

            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a valid string.',

            'address_detail.required' => 'The address detail is required.',
            'address_detail.string' => 'The address detail must be a valid string.',

            'nation.required' => 'The nation information is required.',
            'nation.string' => 'The nation information must be a valid string.',
        ];
    }
}
