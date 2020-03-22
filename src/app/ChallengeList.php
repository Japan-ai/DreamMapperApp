<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;//追加

class ChallengeList extends Model
{
    use SoftDeletes;

    /**
    * 実行ステータスの定義
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
      $status = $this->attributes['status'];

      // 定義されていなければ空文字を返す
      if (!isset(self::STATUS[$status])) {
          return '';
      }

      return self::STATUS[$status]['class'];
  }
  /**
    * 期日の表示方法の修正
    * @return string
    */
  public function getFormattedDueDateAttribute()
  {
      return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }
}
