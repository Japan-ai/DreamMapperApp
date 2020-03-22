<?php

namespace App\Http\Requests;

use App\ChallengeList;//追加
use Illuminate\Validation\Rule;//追加

class EditChallengelist extends FormRequest
{
    public function rules()
    {
        $rule = parent::rules();
        
        //Rule::inメソッドを使用して、実行ステータス欄で入力値が許可リストに含まれているか検証, 許可リストはarray_keys(ChallengeList::STATUS) で配列として取得できるので、Ruleクラスのinメソッドを使ってルールの文字列を作成
        $status_rule = Rule::in(array_keys(ChallengeList::STATUS));
        // 出力されるルールは、親クラスCreateChallengelistのrulesメソッドの結果+'status'=>'required|in(1, 2, 3)',
        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        //親クラスCreateChallengelistのattributesメソッドと合体した属性名リスト
        return $attributes + [
            'status' => '実行ステータス',
        ];
    }

    //Challengelist::STATUSからstatus.inルールのメッセージを作成,
    public function messages()
    {
        $messages = parent::messages();
        //Challengelist::STATUS の各要素からlabelキーの値のみ取り出して作った配列
        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Challengelist::STATUS);
        
        $status_labels = implode('、', $status_labels);

        //「実行ステータスには 未着手、作業中、完了のいずれかを指定してください。」というメッセージの作成
        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}