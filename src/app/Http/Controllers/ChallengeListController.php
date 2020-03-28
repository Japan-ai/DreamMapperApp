<?php

namespace App\Http\Controllers;//追加

use App\Folder;
use App\Http\Requests\CreateChallengelist;//追加
use App\Http\Requests\EditChallengelist;//追加
use App\ChallengeList;//追加
use Illuminate\Support\Facades\Auth;//追加
use Illuminate\Http\Request;

class ChallengeListController extends Controller
{

  //チャレンジリストの画面表示に関するメソッド
  /**
  * @param Folder $folder
  * @return \Illuminate\View\View
  */
  public function index(Folder $folder)
  {
      // Authモデルのuserクラスメソッドで、ログインしたユーザーが持つすべてのフォルダデータをデータベースから取得
      $folders = Auth::user()->folders()->get();
      // 選択されたフォルダに紐付くチャレンジリストを取得する
      //ルーティング定義のURLの中括弧で囲まれたキーワード{folder}とコントローラーメソッドの仮引数名$folderが一致、かつ引数が型指定Folderされているので、自動的に引数の型のモデルクラスインスタンスを作成。ルートとモデルを結びつけるバインディングで、URLエラー時はレスポンスステータスコードを表示
      $challengelist = $folder->challengelist()->get();

      //選択されたフォルダのみ背景画面を変えるための処理, URLの変数部分'/folders/{id}/challendelist'の{id}の値をControllerで受け取ってindex.blade.phpに渡す。{id}の値に合致する場合だけHTMLクラスを出力。
      //第一引数は、値の渡し先である'challengelistディレクトリ直下のindex.blade.php'を示す
      //第二引数は、テンプレート(=index.blade.php)に渡すデータ(キーがテンプレート側で参照する際の変数名)
      return view('challengelist/index', 
      [ 'folders' => $folders,
        'current_folder_id' => $folder->id,
        'challengelist' => $challengelist,
      ]);
  }

  //チャレンジリストの新規作成画面表示に関するメソッド
  /**
  * @param Folder $folder
  * @return \Illuminate\View\View
  */
  public function showCreateForm(Folder $folder)
  {
      //ルーティング定義のURLの中括弧で囲まれたキーワード{folder}とコントローラーメソッドの仮引数名$folderが一致、かつ引数が型指定Folderされているので、自動的に引数の型のモデルクラスインスタンスを作成。ルートとモデルを結びつけるバインディングで、URLエラー時はレスポンスステータスコードを表示
      //チャレンジリスト作成ページのURL'/folders/{id}/challendelist/create'の{id}の値をControllerで受け取ってchallengelistフォルダ直下のcreate.blade.phpに渡す。
      return view('challengelist/create', [
        'folder_id' => $folder->id,
      ]);
  }

  //チャレンジリストの新規作成処理・保存に関するメソッド
  /**
  * @param Folder $folder
  * @param CreateChallengelist $request
  * @return \Illuminate\Http\RedirectResponse
  */
  public function create(Folder $folder, CreateChallengelist $request)
  {
    //チャレンジリストモデルのインスタンスを作成
    $challengelist = new Challengelist();
    // 入力された値をタイトルへ代入
    $challengelist->title = $request->title;
    // 入力された値を期限へ代入
    $challengelist->due_date = $request->due_date;
    //選択されたフォルダに紐づくチャレンジリストを保存・書き込み
    $folder->challengelist()->save($challengelist);
    //ルーティング定義のURLの中括弧で囲まれたキーワード{folder}とコントローラーメソッドの仮引数名$folderが一致、かつ引数が型指定Folderされているので、自動的に引数の型のモデルクラスインスタンスを作成。ルートとモデルを結びつけるバインディングで、URLエラー時はレスポンスステータスコードを表示
    //challengelistフォルダ直下のindex.blade.phpに、第二引数のデータを渡す, redirectメソッドを使用して、チャレンジリストの新規作成が終わったら、そのフォルダに対応するチャレンジリスト一覧画面に移動
    return redirect()->route('challengelist.index', [
        'folder' => $folder->id,
    ]);
  }

  //チャレンジリストの編集画面表示に関するメソッド
  /**
   * @param Folder $folder
   * @param Challengelist $challengelist
   * @return \Illuminate\View\View
   */
  public function showEditForm(Folder $folder, Challengelist $challengelist)
  {
    //他者がチャレンジリストIDを編集できない設定にするため、フォルダとチャレンジリストの紐づきを確認
    $this->checkRelation($folder, $challengelist);
    //ルーティング定義のURLの中括弧で囲まれたキーワード{folder}とコントローラーメソッドの仮引数名$folderが一致、かつ引数が型指定Folderされているので、自動的に引数の型のモデルクラスインスタンスを作成。ルートとモデルを結びつけるバインディングで、URLエラー時はレスポンスステータスコードを表示
    //challengelistディレクトリの直下のedit.blade.phpへ第二引数の処理を返す
    return view('challengelist/edit', [
        'challengelist' => $challengelist,
    ]);
}

  //チャレンジリストの編集処理に関するメソッド
  //リクエストされたIDでchallengelistデータを取得＝編集対象を取得
  //ルーティング定義のURLの中括弧で囲まれたキーワード{folder}とコントローラーメソッドの仮引数名$folderが一致、かつ引数が型指定Folderされているので、自動的に引数の型のモデルクラスインスタンスを作成。ルートとモデルを結びつけるバインディングで、URLエラー時はレスポンスステータスコードを表示
     /**
     * @param Folder $folder
     * @param Challengelist $challengelist
     * @param EditChallengelist $request
     * @return \Illuminate\Http\RedirectResponse
     */
  public function edit(Folder $folder, Challengelist $challengelist, EditChallengelist $request)
{
    
    //他者がチャレンジリストIDを編集できない設定にするため、フォルダとチャレンジリストの紐づきを確認
    $this->checkRelation($folder, $challengelist);

    // 編集対象のchallengelistデータに入力値を代入して保存
    $challengelist->title = $request->title;
    $challengelist->status = $request->status;
    $challengelist->due_date = $request->due_date;
    $challengelist->save();

    // 編集後は、編集対象のchallengelistが属するリスト一覧画面へリダイレクト
    return redirect()->route('challengelist.index', [
        'folder' => $challengelist->folder_id,
    ]);
  }

  // フォルダとタスクの関連性があるか調べ、リレーションが存在しない場合の404エラー表示のための実装
  /**
  * @param Folder $folder
  * @param Challengelist $challengelist
  */
  private function checkRelation(Folder $folder, Challengelist $challengelist)
{
    if ($folder->id !== $challengelist->folder_id) {
        abort(404);
    }
}
}