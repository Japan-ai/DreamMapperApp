<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//「チャレンジリスト新規作成時に入力された値」のバリデーションをおこなうファイル
class CreateChallengelist extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//追加,リクエストを受け付ける
    }

    //ruleメソッドで、入力欄ごとに入力された値のバリデーションチェックするルールを定義
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //タイトルの入力必須を設定,タイトルの文字数入力上限は100文字
            'title' => 'required|max:100',
            //期日の設定,期限日は本日以降に制限
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    //エラーメッセージを「title」→「タイトル」,「due_date」→「期限日」となるよう修正
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'due_date' => '期限日',
        ];
    }

    //エラーメッセージの設定, due_dateのafter_or_equalルールに違反した場合は、指定されたメッセージを出力,
    public function messages()
    {
        return [
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
