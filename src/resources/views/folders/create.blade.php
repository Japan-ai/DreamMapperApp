@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">ジャンルの追加</div>
          <div class="panel-body">
            <!-- エラーメッセージの表示 -->
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('folders.create') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="title">ジャンル</label>
                <!-- value属性 - 入力エラーでフォーム画面に戻ってきたときに入力欄の値を復元 -->
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">登録</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection