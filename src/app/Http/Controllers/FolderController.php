<?php

namespace App\Http\Controllers;//追加

use App\Folder;//追加
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;//追加

class FolderController extends Controller
{
  //分類フォルダの新規作成ページの表示
  public function showCreateForm()
  {
      return view('folders/create');
  }

  //分類フォルダの新規作成処理
  public function create(CreateFolder $request)
{
    // Folderモデルのインスタンスを作成
    $folder = new Folder();
    // 入力された値をタイトルへ代入
    $folder->title = $request->title;
    // インスタンスの状態をデータベースに保存・書き込み
    $folder->save();

    return redirect()->route('challengelist.index', [
        'id' => $folder->id,
    ]);
}
}
