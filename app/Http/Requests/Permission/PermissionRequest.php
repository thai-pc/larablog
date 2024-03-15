<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Nhâp tên quyền',
            'name.string' => 'Tên quyền phải là chuỗi',
            'name.max' => 'Tên quyền tối đa được :max ký tự'
        ];
    }
}
