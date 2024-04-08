<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'reservation_date' => 'required|after_or_equal:today',
            'reservation_time' => 'required',
            'number_of_people' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '※予約日を入力してください。',
            'reservation_date.after_or_equal' => '※予約日には今日以降の日付を入力してください。',
            'reservation_time.required' => '※予約時刻を入力してください。',
            'number_of_people.required' => '※予約人数を入力してください。',
        ];
    }
}
