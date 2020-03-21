<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dream Mapper App</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">Dream Mapper App</a>
  </nav>
</header>
<main>
  <div class="container">
    <div class="row">
      <div class="col col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">分類フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">フォルダを追加
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
            <a
              href="{{ route('tasks.index', ['id' => $folder->id]) }}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
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
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="#" class="btn btn-default btn-block">
        リストを追加
              </a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th>新規チェレンジ項目</th>
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
                  <span class="label {{ $challengelist->status_class }}">{{ $challengelist->status_label }}</span></span>
                  </td>
                  <td>{{ $challengelist->formatted_due_date }}</td>
                  <td><a href="#">編集する</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- 上記にチャレンジリストが表示される -->
      </div>
    </div>
  </div>
</main>
</body>
</html>