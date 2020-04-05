<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//「ジャンル新規作成時に入力された値」のバリデーションテストに関するルール定義をおこなうファイル
class CreateFolder extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;//追加,リクエストを受け付ける
    }

    // ジャンル新規作成時の入力された値のバリデーション
    /**
     * @return array
     */
    //ruleメソッドで、入力欄ごとに入力された値のバリデーションチェックするルールを定義
    public function rules()
    {
        return [
            'title' => 'required|max:20',//ジャンルの文字数入力上限は20文字
        ];
    }

    //エラーメッセージを「titleは入力必須です」→「タイトルは入力必須です」となるよう修正
    public function attributes()
    {
      return [
        'title' => 'ジャンル',//タイトルの入力必須を設定
      ];
    }
}
