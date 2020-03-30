@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">リマインダー</div>
          <div class="panel-body">
              <div class="form-group">
                <p>本日のチャレンジ項目</p>
                  <ul>
                  @foreach($challengelist->all() as $challenge)
                    <li>{{ $challenge->title }}
                    </li>
                  @endforeach
                  </ul>
              </div>
              <div class="text-right">
              <button type="button" onclick="history.back()" class="btn btn-primary">戻る</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection