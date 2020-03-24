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
      //foldersディレクトリ直下のcreate.blade.phpに値を返す
      return view('folders/create');
  }

  //分類フォルダの新規作成処理
  //入力値の取得などの Request クラスの機能はそのままに、バリデーションチェックを追加するために、CreateFolderクラスをインポートして、createメソッドの引数の型名をCreateFolderに変更
  //コントローラーメソッドが呼び出される時に、Laravelがリクエストの情報をRequestクラスのインスタンス$requestに含めて引数として渡す,その中にフォームの入力値も含まれる
  public function create(CreateFolder $request)
{
    // Folderモデルのインスタンスを作成
    $folder = new Folder();
    // 入力された値をタイトルへ代入
    $folder->title = $request->title;
    // インスタンスの状態をデータベースに保存・書き込み, モデルクラスのプロパティに代入した値が各カラムに書き込まる
    $folder->save();

    //challengelistフォルダ直下のindex.blade.phpに、第二引数のデータを渡す, redirectメソッドを使用して、フォルダの新規作成が終わったら、そのフォルダに対応するチャレンジリスト一覧画面に移動
    return redirect()->route('challengelist.index', [
        'id' => $folder->id,
    ]);
}
}
