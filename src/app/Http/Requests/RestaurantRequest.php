<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'image_url' => 'max:2048',
            'detail' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'image_url.max' => '画像ファイルのサイズは2MB以下にしてください。',
            'detail.required' => '店舗詳細を入力してください。',
            'detail.string' => '店舗詳細は文字列で入力してください。',
            'detail.max' => '店舗詳細は255文字以下で入力してください。',
        ];
    }
}
