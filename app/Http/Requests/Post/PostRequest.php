<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $on_image_update = $this->method() == 'PUT' ? '' : 'required|';
        return [
            'title' => 'required|max:210',
            'excerpt' => 'required|max:16777215',
            'content' => 'max:4294967295',
            'category_id' => 'required|numeric',
            'status' => 'required|in:publish,draft',
            'feature_image' => $on_image_update.'image'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Nhập tiêu đề bài viết',
            'title.max' => 'Tiêu đề bài viết không quá :max',
            'excerpt.required' => 'Nhập đoạn trích bài viết',
            'excerpt.max' => 'Đoạn trích không quá :max',
            'content.max' => 'Nội dung bài viết không quá :max',
            'category_id.required' => 'Nhập thể loại bài viết',
            'category_id.numeric' => 'Thể loại bài viết không hợp lệ',
            'status.required' => 'Nhập trạng thái bài viết',
            'status.in' => 'Trạng thái bài viết không hợp lệ',
            'feature_image.required' => 'Chọn ảnh đại diện bài viết',
            'feature_image.image' => 'Ảnh đại diện phải có định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)'
        ];
    }
}
