<?php

namespace App\Http\Controllers;
use App\Folder;//追加
use Illuminate\Http\Request;

class ChallengeListController extends Controller
{
  public function index()//追加
  {
      $folders = Folder::all();

      return view('tasks/index', 
      [ 'folders' => $folders,
        'current_folder_id' => $id,//URLの変数部分'/folders/{id}/challendelist' の {id} の値をControllerで受け取ってindex.blade.phpに渡す。 {id} の値に合致する場合だけHTMLクラスを出力。
      ]);
  }
}
