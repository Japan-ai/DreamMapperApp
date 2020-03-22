<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
  public function challengelist()
  {
    return $this->hasMany('App\ChallengeList', 'folder_id', 'id');//FolderテーブルとChallengeListテーブルの関連性をたどって、Folderクラスのインスタンスから紐づくChallengeListクラスの一覧を取得
  }
}
