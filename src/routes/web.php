<?php

//アプリ使用時にログイン認証を求める処理のための実装
Route::group(['middleware' => 'auth'], function() {

  //ホーム画面の表示
  Route::get('/home', 'HomeController@index')->name('home');
  //分類フォルダ新規作成ページの表示
  Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
  //分類フォルダ新規作成処理の実行
  Route::post('/folders/create', 'FolderController@create');
  //期限当日のチャレンジリスト項目を一覧表示
  Route::get('/challengelist/deadline', 'ChallengeListController@deadline')->name('challengelist.deadline');


//ポリシーが、ユーザーの持つ権限にしたがって特定の処理を許可するか判断するためにミドルウェアを適用
//canミドルウェアの引数（view,folder）は、カンマの左側が認可処理の種類、右側がポリシーに渡すルートパラメーター（URLの変数部分）
Route::group(['middleware' => 'can:view,folder'], function() {

  //分類フォルダとチャレンジリストの同時画面表示
  Route::get('/folders/{folder}/challengelist', 'ChallengeListController@index')->name('challengelist.index');

  //チャレンジリスト新規作成ページの表示
  Route::get('/folders/{folder}/challengelist/create', 'ChallengeListController@showCreateForm')->name('challengelist.create');
  //チャレンジリスト新規作成処理の実行
  Route::post('/folders/{folder}/challengelist/create', 'ChallengeListController@create');

  //チャレンジリスト編集ページの表示
  Route::get('/folders/{folder}/challengelist/{challengelist}/edit', 'ChallengelistController@showEditForm')->name('challengelist.edit');
  //チャレンジリスト編集処理の実行
  Route::post('/folders/{folder}/challengelist/{challengelist}/edit', 'ChallengelistController@edit');
  });
});

Auth::routes();