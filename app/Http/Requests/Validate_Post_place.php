<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validate_Post_place extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:10:max:200',
            'slug' => 'required|unique:places,slug|max:300',
            'featured_image' => 'required',
            'contents' => 'required|min:500',
            'place_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'slug.required' => 'Vui lòng nhập đường dẫn',
            'featured_image.required' => 'Vui lòng chọn ảnh đại diện',
            'contents.required' => 'Vui lòng nhập nội dung',
            'place_id.required' => 'Vui lòng chọn địa điểm',

            'title.min' => 'Tiêu đề quá ngắn vui lòng nhập đủ 10 kí tự',
            'contents.min' => 'Nội dung quá ngắn vui lòng nhập đủ 500 kí tự',

            'title.max' => 'Tiêu đề quá dài vui lòng nhập ít hơn 200 kí tự',
            'slug.max' => 'Đường dẫn quá dài vui lòng nhập ít hơn 300 kí tự',

            'slug.unique' => 'Đường dẫn đã tồn tại',
        ];
    }
}
