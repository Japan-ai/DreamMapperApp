<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//追加

class HomeController extends Controller
{
    public function index()
    {
        // ログインしたユーザーを取得
        $user = Auth::user();

        // ログインしたユーザーに紐づくフォルダを一つ取得する
        $folder = $user->folders()->first();

        // フォルダが未作成であれば、ホームページへ
        if (is_null($folder)) {
            return view('home');
        }

        // フォルダがあれば、そのフォルダのチャレンジリスト一覧にリダイレクト
        return redirect()->route('challengelist.index', [
            'folder' => $folder->id,
        ]);
    }
}
