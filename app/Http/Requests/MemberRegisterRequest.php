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
            // 'local_store' => ['required', 'string'],
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
            'member_id.required' => '멤버 ID가 필요합니다.',
            'member_id.string' => '멤버 ID는 유효한 문자열이어야 합니다.',
            'member_id.max' => '멤버 ID는 255자를 초과할 수 없습니다.',
            'member_id.unique' => '이 멤버 ID는 이미 사용 중입니다.',
            
            'password.required' => '비밀번호가 필요합니다.',
            'password.string' => '비밀번호는 유효한 문자열이어야 합니다.',
            'password.min' => '비밀번호는 최소 8자 이상이어야 합니다.',
            'password.confirmed' => '비밀번호 확인이 일치하지 않습니다.',
            
            'name.required' => '이름이 필요합니다.',
            'name.string' => '이름은 유효한 문자열이어야 합니다.',
            'name.max' => '이름은 255자를 초과할 수 없습니다.',
            
            'phone.required' => '전화번호가 필요합니다.',
            'phone.string' => '전화번호는 유효한 문자열이어야 합니다.',
            'phone.max' => '전화번호는 20자를 초과할 수 없습니다.',
            
            'email.required' => '이메일 주소가 필요합니다.',
            'email.string' => '이메일 주소는 유효한 문자열이어야 합니다.',
            'email.email' => '이메일 주소는 유효한 이메일이어야 합니다.',
            'email.max' => '이메일 주소는 255자를 초과할 수 없습니다.',
            'email.unique' => '이 이메일 주소는 이미 등록되어 있습니다.',
            
            'local_store.required' => '로컬 스토어 정보가 필요합니다.',
            'local_store.string' => '로컬 스토어 정보는 유효한 문자열이어야 합니다.',
            
            'recommend_seq.required' => '모집자 순서가 필요합니다.',
            'recommend_seq.integer' => '모집자 시퀀스는 정수여야 합니다.',
            
            'zipcode.required' => 'zipcode가 필요합니다.',
            'zipcode.string' => 'zipcode는 유효한 문자열이어야 합니다.',
            'zipcode.max' => '우편번호는 10자를 초과할 수 없습니다.',
            
            'address.required' => '주소가 필요합니다.',
            'address.string' => '주소는 유효한 문자열이어야 합니다.',
            
            'address_detail.required' => '주소 세부 정보가 필요합니다.',
            'address_detail.string' => '주소 세부 정보는 유효한 문자열이어야 합니다.',
            
            'nation.required' => '국가 정보가 필요합니다.',
            'nation.string' => '국가 정보는 유효한 문자열이어야 합니다.',
        ];
    }
}
