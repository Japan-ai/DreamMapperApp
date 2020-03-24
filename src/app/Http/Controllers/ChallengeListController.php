<?php

namespace App\Http\Controllers;//追加

use App\Folder;//追加
use App\ChallengeList;//追加
use App\Http\Requests\CreateChallengelist;//追加
use Illuminate\Http\Request;

class ChallengeListController extends Controller
{

  //チャレンジリストの画面表示に関するメソッド
  public function index(int $id)
  {
      // Folderモデルのallクラスメソッドで、すべてのフォルダデータをデータベースから取得
      $folders = Folder::all();
      // 選択されたidのフォルダを取得する
      $current_folder = Folder::find($id);
      // リレーションを活用して、選択されたフォルダに紐づくチャレンジリストを取得する
      $challengelist= $current_folder->challengelist()->get();

      //選択されたフォルダのみ背景画面を変えるための処理, URLの変数部分'/folders/{id}/challendelist'の{id}の値をControllerで受け取ってindex.blade.phpに渡す。{id}の値に合致する場合だけHTMLクラスを出力。
      //第一引数は、値の渡し先である'challengelistディレクトリ直下のindex.blade.php'を示す
      //第二引数は、テンプレート(=index.blade.php)に渡すデータ(キーがテンプレート側で参照する際の変数名)
      return view('challengelist/index', 
      [ 'folders' => $folders,
        'current_folder_id' => $current_folder->id,
        'challengelist' => $challengelist,
      ]);
  }

  //チャレンジリストの新規作成画面表示に関するメソッド
  public function showCreateForm(int $id)
  {
      //チャレンジリスト作成ページのURL'/folders/{id}/challendelist/create'の{id}の値をControllerで受け取ってchallengelistフォルダ直下のcreate.blade.phpに渡す。
      return view('challengelist/create', [
        'folder_id' => $id
      ]);
  }

  //チャレンジリストの新規作成処理・保存に関するメソッド
  public function create(int $id, CreateChallengelist $request)
  {
    // 選択されたidのフォルダを取得する
    $current_folder = Folder::find($id);

    //チャレンジリストモデルのインスタンスを作成
    $challengelist = new Challengelist();
    // 入力された値をタイトルへ代入
    $challengelist->title = $request->title;
    // 入力された値を期限へ代入
    $challengelist->due_date = $request->due_date;
    //$current_folderに紐づくチャレンジリストを保存・書き込み
    $current_folder->challengelist()->save($challengelist);
    //challengelistフォルダ直下のindex.blade.phpに、第二引数のデータを渡す, redirectメソッドを使用して、チャレンジリストの新規作成が終わったら、そのフォルダに対応するチャレンジリスト一覧画面に移動
    return redirect()->route('challengelist.index', [
        'id' => $current_folder->id,
    ]);
  }

  //チャレンジリストの編集画面表示に関するメソッド
  public function showEditForm(int $id, int $challengelist_id)
{
    $challengelist = Challengelist::find($challengelist_id);

    //challengelistディレクトリの直下のedit.blade.phpへ第二引数の処理を返す
    return view('challengelist/edit', [
        'challengelist' => $challengelist,
    ]);
}

  //チャレンジリストの編集処理に関するメソッド
  public function edit(int $id, int $challengelist_id, EditChallengelist $request)
{
    // 1 リクエストされたIDでchallengelistデータを取得＝編集対象を取得
    $challengelist = Challengelist::find($challengelist_id);

    // 2 編集対象のchallengelistデータに入力値を代入して保存
    $challengelist->title = $request->title;
    $challengelist->status = $request->status;
    $challengelist->due_date = $request->due_date;
    $challengelist->save();

    // 3 編集後は、編集対象のchallengelistが属するリスト一覧画面へリダイレクト
    return redirect()->route('challengelist.index', [
        'id' => $challengelist->folder_id,
    ]);
}
}