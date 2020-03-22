<?php

namespace App\Http\Controllers;//追加

use App\Folder;//追加
use App\ChallengeList;//追加
use App\Http\Requests\CreateChallengelist;//追加
use Illuminate\Http\Request;

class ChallengeListController extends Controller
{

  //フォルダ新規作成に関するメソッド
  public function index(int $id)
  {
      // すべてのフォルダを取得する
      $folders = Folder::all();
      // 選ばれたフォルダを取得する
      $current_folder = Folder::find($id);
      // 選ばれたフォルダに紐づくチャレンジリストを取得する
      $challengelist = $current_folder->challengelist()->get();
      //URLの変数部分'/folders/{id}/challendelist'の{id}の値をControllerで受け取ってindex.blade.phpに渡す。{id}の値に合致する場合だけHTMLクラスを出力。
      return view('challengelist/index', 
      [ 'folders' => $folders,
        'current_folder_id' => $current_folder->id,
        'challengelist' => $challengelist,
      ]);
  }

  //チャレンジリスト新規作成に関するメソッド
  public function showCreateForm(int $id)
  {
      //チャレンジリスト作成ページのURL'/folders/{id}/challendelist/create'の{id}の値をControllerで受け取ってcreate.blade.phpに渡す。
      return view('challengelist/create', [
        'folder_id' => $id
      ]);
  }

  //新規チャレンジリスト保存に関するメソッド
  public function create(int $id, CreateChallengelist $request)
  {
    $current_folder = Folder::find($id);

    $challengelist = new Challengelist();
    $challengelist->title = $request->title;
    $challengelist->due_date = $request->due_date;

    $current_folder->challengelist()->save($challengelist);

    return redirect()->route('challengelist.index', [
        'id' => $current_folder->id,
    ]);
  }
}
