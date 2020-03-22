
@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">分類フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              新規フォルダを追加
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a
                  href="{{ route('challengelist.index', ['id' => $folder->id]) }}"
                  class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
                {{ $folder->title }}
              </a>
              <!-- 閲覧されているフォルダのIDとID値が合致する場合のみactiveというHTMLクラスを出力 -->
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-6">
      <!-- 下記にチャレンジリストが表示される -->
        <div class="panel panel-default">
          <div class="panel-heading">新規チャレンジ項目</div>
          <div class="panel-body">
            <div class="text-right">
            <a href="{{ route('challengelist.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
                新規チャレンジ項目の追加
              </a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>実行ステータス</th>
              <th>期限</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($challengelist as $challengelist)
              <tr>
                <td>{{ $challengelist->title }}</td>
                <td>
                  <span class="label {{ $challengelist->status_class }}">{{ $challengelist->status_label }}</span>
                </td>
                <td>{{ $challengelist->formatted_due_date }}</td>
                <td><a href="{{ route('challengelist.edit', ['id' => $challengelist->folder_id, 'challengelist_id' => $challengelist->id]) }}">編集</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- 上記にチャレンジリストが表示される -->
      </div>
    </div>
  </div>
@endsection