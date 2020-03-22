<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChallengelist extends FormRequest
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
            //タイトルの入力必須を設定
            'title' => 'required|max:100',
            //期日の設定
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'due_date' => '期限日',
        ];
    }

    //エラーメッセージの設定, due_dateのafter_or_equalルールに違反した場合は、指定されたメッセージを出力
    public function messages()
    {
        return [
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
