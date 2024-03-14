<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $on_email_update = $this->method() == 'PUT' ? '' : '|unique:users,email';
        $on_password_update = $this->method() == 'PUT' ? '' : 'required|';
        $on_avatar_update = $this->method() == 'PUT' ? '' : 'required|';

        return [
            'name' => 'required|max:50',
            'email' => 'required|email'.$on_email_update,
            'password' => $on_password_update.'min:8',
            'role_id' => 'required|string',
            'avatar' => $on_avatar_update.'image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập tên người dùng',
            'name.max' => 'Tên không được lớn hơn 50 ký tự',
            'email.required' => 'Nhập email người dùng',
            'email.email' => 'Nhập đúng định dạng email',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Nhập mật khẩu người dùng',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
            'role_id.required' => 'Chọn vai trò người dùng',
            'role_id.string' => 'Vai trò phải là chuỗi',
            'avatar.required' => 'Chọn avatar người dùng',
            'avatar.image' => 'Avatar phải có định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)'
        ];
    }
}
