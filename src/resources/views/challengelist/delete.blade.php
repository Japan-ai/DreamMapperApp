@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">チャレンジリストを削除してよろしいですか？</div>
          <div class="panel-body">
            <form
                action="{{ route('challengelist.delete', ['folder' => $challengelist->folder_id, 'challengelist' => $challengelist->id]) }}"
                method="POST">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <!-- ページを開いた時は、タスクを作成時のタイトルを入力欄へ表示。 -->
                <!-- value属性 - 直前の入力値をデフォルト値に設定,第二引数がデフォルト値 -->
                <input type="text" class="form-control" name="title" id="title"
                       value="{{ old('title', $challengelist->title) }}" />
              </div>
              <div class="form-group">
                <label for="status">状況</label>

                <select name="status" id="status" class="form-control">
                  @foreach(\App\ChallengeList::STATUS as $key => $val)
                    <!-- 「ループしたキー」と「直前の入力値またはデータベースに登録済の値」を比べて、一致する場合はoption要素のvalueに配列のキー（1, 2, 3）を出力、表示文字列にはlabelの値を出力 -->
                    <option
                        value="{{ $key }}"
                        {{ $key == old('status', $challengelist->status) ? 'selected' : '' }}>
                      {{ $val['label'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="due_date">期日</label>
                 <!-- value属性では、「ループしたキー」と「直前の入力値またはデータベースに登録済の値」を比べて、一致する場合は値を出力 -->
                <input type="text" class="form-control" name="due_date" id="due_date"
                value="{{ old('due_date', $challengelist->formatted_due_date) }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">削除</button>
                <button type="button" onclick="history.back()" class="btn btn-primary">キャンセル</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection