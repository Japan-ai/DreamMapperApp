<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//「フォルダ新規作成時に入力された値」のバリデーションをおこなうファイル
class CreateFolder extends FormRequest
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

    // フォルダ新規作成時の入力された値のバリデーション
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //ruleメソッドで、入力欄ごとに入力された値のバリデーションチェックするルールを定義
    public function rules()
    {
        return [
            'title' => 'フォルダ名', //タイトルの入力必須を設定
            'title' => 'required|max:20',//フォルダ名の文字数入力上限は20文字
        ];
    }

    //エラーメッセージを「titleは入力必須です」→「タイトルは入力必須です」となるよう修正
    public function attributes()
    {
      return [
        'title' => 'フォルダ名',
      ];
    }
}
