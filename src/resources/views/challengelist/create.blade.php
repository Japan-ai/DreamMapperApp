@extends('layout')

@section('styles')
    <!-- 共通部分 styles.blade.phpを呼び出し-->
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">新規チャレンジ項目の追加</div>
          <div class="panel-body">
            <!-- エラーがあるか確認し、エラーメッセージを列挙 -->
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('challengelist.create', ['folder' => $folder_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <!-- value属性は入力エラーでフォーム画面に戻ってきたときに入力欄の値を復元させる -->
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="form-group">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
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

@section('scripts')
  <!-- 共通部分 scripts.blade.phpを呼び出し-->
  @include('share.flatpickr.scripts')
@endsection