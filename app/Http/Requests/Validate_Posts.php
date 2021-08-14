<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Posts;

class Validate_Posts extends FormRequest
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

    public function getid() {
        $url = url()->current();
        $arr = explode('/',$url);
        $idget = $arr[count($arr)-1];
        $post = Posts::find($idget);
        if (count($arr) == 7) {
            return 0;
        } else {
            return $post->slug_id;
        }
        
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
            'slug' => 'required|max:300|unique:slug,slug,'.$this->getid(),
            'featured_image' => 'required',
            'contents' => 'required|min:500',
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'slug.required' => 'Vui lòng nhập đường dẫn',
            'featured_image.required' => 'Vui lòng chọn ảnh đại diện',
            'contents.required' => 'Vui lòng nhập nội dung',
            'category.required' => 'Vui lòng chọn danh mục',

            'title.min' => 'Tiêu đề quá ngắn vui lòng nhập đủ 10 kí tự',
            'contents.min' => 'Nội dung quá ngắn vui lòng nhập đủ 500 kí tự',

            'title.max' => 'Tiêu đề quá dài vui lòng nhập ít hơn 200 kí tự',
            'slug.max' => 'Đường dẫn quá dài vui lòng nhập ít hơn 300 kí tự',

            'slug.unique' => 'Đường dẫn đã tồn tại',
        ];
    }
}
