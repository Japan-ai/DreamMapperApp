<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

//ホーム画面の表示
Route::get('/home', 'HomeController@index')->name('home');

//分類フォルダとチャレンジリストの同時画面表示
Route::get('/folders/{id}/challengelist', 'ChallengeListController@index')->name('challengelist.index');

//分類フォルダ新規作成ページの表示
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
//分類フォルダ新規作成処理の実行
Route::post('/folders/create', 'FolderController@create');

//チャレンジリスト新規作成ページの表示
Route::get('/folders/{id}/challengelist/create', 'ChallengeListController@showCreateForm')->name('challengelist.create');
//チャレンジリスト新規作成処理の実行
Route::post('/folders/{id}/challengelist/create', 'ChallengeListController@create');

//チャレンジリスト編集ページの表示
Route::get('/folders/{id}/challengelist/{challengelist_id}/edit', 'ChallengelistController@showEditForm')->name('challengelist.edit');
//チャレンジリスト編集処理の実行
Route::post('/folders/{id}/challengelist/{challengelist_id}/edit', 'ChallengelistController@edit');
