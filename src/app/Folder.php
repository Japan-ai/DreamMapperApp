<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
  //hasManyメソッドを使用して、Folderモデル(テーブル)とChallengeListモデル(テーブル)の1対多のリレーションを定義
  //FolderテーブルとChallengeListテーブルの関連性をたどって、Folderクラスのインスタンスから紐づくChallengeListクラスのリストを取得
  //第一引数が関連するモデル名、第二引数が関連するテーブルが持つ外部キーカラム名、第三引数はモデルにhasManyが定義されている側のテーブル(Folderテーブル)が持つ、外部キーに紐づけられたカラムの名前
  public function challengelist()
  {
    return $this->hasMany('App\ChallengeList', 'folder_id', 'id');
  }
}
