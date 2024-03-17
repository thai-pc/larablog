<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class AssignPermission extends FormRequest
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
            'permission' => 'required|array'
        ];
    }
    public function messages()
    {
        return [
            'permission.required' => 'Chọn tên quyền',
            'permission.array' => 'Tên quyền là mảng'
        ];
    }
}
