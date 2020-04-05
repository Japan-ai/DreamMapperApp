<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // ログインしたユーザーを取得
        $user = Auth::user();

        // ログインしたユーザーに紐づくジャンルを一つ取得する
        $folder = $user->folders()->first();

        // ジャンルが未作成であれば、ホームページへ
        if (is_null($folder)) {
            return view('home');
        }

        // ジャンルがあれば、そのジャンルのチャレンジリスト一覧にリダイレクト
        return redirect()->route('challengelist.index', [
            'folder' => $folder->id,
        ]);
    }
}
