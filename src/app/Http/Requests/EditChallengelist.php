<?php

namespace App\Http\Requests;

use App\ChallengeList;//追加
use Illuminate\Validation\Rule;//追加

//「チャレンジリスト編集時に入力された値」のバリデーションをおこなうファイル
//タスクの作成と編集では状態欄の有無が異なるだけでタイトルと期限日は同一なので、EditChallengelistクラスは CreateChallengelistクラスを継承
class EditChallengelist extends Createchallengelist
{
    //「実行ステータス欄に入力された値」が指定された「許可リスト」の中の値に含まれているかどうかを検証
    public function rules()
    {
        //ruleメソッドで、入力欄ごとに入力された値のバリデーションチェックするルールを定義
        $rule = parent::rules();
        
        //Rule::inメソッドを使用して、実行ステータス欄で入力値が許可リストに含まれているか検証, 許可リストはarray_keys(ChallengeList::STATUS)で配列として取得できるので、Ruleクラスのinメソッドを使ってルールの文字列を作成=in(1, 2, 3)
        $status_rule = Rule::in(array_keys(ChallengeList::STATUS));
        // 'status' => 'required|in(1, 2, 3)',を出力している,親クラスCreateChallengelistのrulesメソッドの結果と合体したルールリストを返す
        return $rule + [
            'status' => "required|${status_rule},"
        ];
    }

    //親クラスCreateChallengelistのattributesメソッドの結果と合体した属性名リストを返す
    public function attributes()
    {
        $attributes = parent::attributes();

        //親クラスCreateChallengelistのattributesメソッドと合体した属性名リスト
        return $attributes + [
            'status' => '実行ステータス',
        ];
    }

    //Challengelist::STATUSからstatus.inルールのメッセージを作成
    public function messages()
    {
        $messages = parent::messages();
        //「Challengelist::STATUS の各要素からlabelキーの値のみ取り出して作った配列」を左辺の変数に代入
        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Challengelist::STATUS);
        
        $status_labels = implode('、', $status_labels);

        //「$messages + 実行ステータスには 未着手、作業中、完了のいずれかを指定してください。」というメッセージの作成
        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}