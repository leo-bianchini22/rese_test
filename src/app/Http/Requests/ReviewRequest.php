<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rating' => 'required|min:1|max:5',
            'comment' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '※評価を入力してください。',
            'rating.min' => '※評価は1以上で指定してください。',
            'rating.max' => '※評価は5以下で指定してください。',
            'comment.required' => '※コメントを入力してください。',
            'comment.string' => '※コメントは文字列で指定してください。',
            'comment.max' => '※コメントは255文字以下で指定してください。',
        ];
    }
}
