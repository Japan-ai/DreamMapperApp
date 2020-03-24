<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;//追加,Carbonライブラリの読み込み

class ChallengeList extends Model
{
    //アクセサの追加
    /**
    * 実行ステータスの色分け
    */
    const STATUS = [
      1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
      2 => [ 'label' => '作業中', 'class' => 'label-info'],
      3 => [ 'label' => '完了', 'class' => '' ],
  ];

  /**
   * 実行ステータスを表すHTMLクラス
   * @return string
   */
  public function getStatusLabelAttribute()
  {
      // 実行ステータスの値
      $status = $this->status;

      //実行ステータスが定義されて入れば、ラベルの色を返す
      if (isset(self::STATUS[$status])) {
      
      return self::STATUS[$status]['class'];
      }
    }
    
  
    //アクセサの追加
    /**
    * 期日の表示方法の修正
    * @return string
    */
    //期限日の記述形式を変更して値を返す
  public function getFormattedDueDateAttribute()
  {
      return Carbon::createFromFormat('Y-m-d', $this->due_date)
            ->format('Y/m/d');
    }
}
