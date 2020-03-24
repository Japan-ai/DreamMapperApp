
@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-5">
        <nav class="panel panel-default">
          <div class="panel-heading">分類フォルダ</div>
          <div class="panel-body">
          <!-- hrefにはrouteの設定を司るweb.phpでchallengelist.indexと名ずけられた項目のデータを関連付け -->
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              新規フォルダの追加
            </a>
          </div>
          <div class="list-group">

            @foreach($folders as $folder)
              <!-- heaf部分は、route関数でルーティングの設定からURLを作成, 第一引数はルート名でweb.phpのchallengelist.index、第二引数はルートURLのうち変数になっている部分{id}に値を入力 -->
              <!-- class部分は、ChallengeListControllerの$current_folder_id(=閲覧されているフォルダのID)とID値が合致する場合のみ 'active' というHTMLクラスを出力 -->
              <a
                  href="{{ route('challengelist.index', ['id' => $folder->id]) }}"
                  class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
                <!-- 変数の値の展開で、タイトルを表示 -->
                {{ $folder->title }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-7">
      <!-- 下記にチャレンジリストが表示される -->
        <div class="panel panel-default">
          <div class="panel-heading">新規チャレンジ項目</div>
          <div class="panel-body">
            <div class="text-right">
            <!-- href部分は、route関数でルーティングの設定からURLを作成, 第一引数はルート名でweb.phpのchallengelist.create、第二引数はルートURLのうち変数になっている部分{id}に値を入力 -->
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
                  <!-- Challengelist.phpに記述されたHTMLクラスが出力されて、実行ステージに応じた背景色が表示される -->
                  <span class="label {{ $challengelist->status_class }}">{{ $challengelist->status_label }}</span>
                </td>
                <!-- ChallengeList.phpに記述された値が表示方法で、期日を表示 -->
                <td>{{ $challengelist->formatted_due_date }}</td>
                <!-- href部分は、route関数でルーティングの設定からURLを作成, 第一引数はルート名でweb.phpのchallengelist.edit、第二引数はルートURLのうち変数になっている部分{id}に値を入力 -->
                <td><a href="{{ route('challengelist.edit', ['id' => $challengelist->folder_id, 'challengelist_id' => $challengelist->id]) }}">編集</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection