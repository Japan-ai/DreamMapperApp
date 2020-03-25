<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
            'id' => $folder->id,
        ]);
    }
}
