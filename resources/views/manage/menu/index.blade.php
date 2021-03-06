@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
    <section id="page">
      <div class="container">
        <div class="row content content--menu">
          <h3 style="text-align:center;">メニュー</h3>
          @if(Auth::user()->u_power1 == 1)
          <div class="col-md-4">
            <h2>お知らせ</h2>
            <ul>
              <li><a href="{{route('manage.notice.index')}}"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>「お知らせ」の登録／一覧／変更／削除</a></li>
            </ul>
          </div>
          @endif
          @if(Auth::user()->u_power2 == 1)
          <div class="col-md-4">
            <h2>営業日カレンダー</h2>
            <ul>
              <li><a href="{{route('manage.calendar.index')}}"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>営業日カレンダーの一覧／編集</a></li>
            </ul>
          </div>
          @endif
          @if(Auth::user()->u_power3 == 1)
          <div class="col-md-4">
            <h2>ユーザー管理</h2>
            <ul>
              <li><a href="{{route('manage.users.index')}}"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>ユーザーの登録／一覧／変更／削除</a></li>
            </ul>
          </div>
          @endif
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection