<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>倉敷製帽 WEB受注システム 管理画面</title>
    <link href="{{ asset('') }}public/backend/common/css/import.css" rel="stylesheet">
    <script src="{{ asset('') }}public/backend/common/js/jquery.min.js"></script>
    <script src="{{ asset('') }}public/backend/common/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}public/tinymce/js/tinymce/tinymce.min.js"></script>
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <h1 class="fl-left">倉敷製帽 WEB受注システム 管理画面</h1>
          </div>

          @if( Auth::check() )
          <div class="col-md-8">
            @if(isset($page) && $page == 'menu')
              <div class="fl-right mar-left40">
                <input type="button" class="btn btn-sm btn-info" name="button" value="ログアウト" onclick="location.href='{{route('manage.users.logout')}}'"/>
              </div>
            @else
            <div class="fl-right mar-left40">
              <input type="button" class="btn btn-sm btn-info" name="button" value="ログアウト" onclick="location.href='{{route('manage.users.logout')}}'"/>
              <div class="dropdown">
                <button class="btn btn-sm btn-info  btn-mar-right dropdown-toggle" type="button" data-toggle="dropdown">メニューへ
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  @if(Auth::user()->u_power1 == 1)
                  <li><a href="{{route('manage.notice.index')}}">「お知らせ」管理</a></li>
                  @endif
                  @if(Auth::user()->u_power2 == 1)
                  <li><a href="{{route('manage.calendar.index')}}">「営業日カレンダー」管理</a></li>
                  @endif
                  @if(Auth::user()->u_power3 == 1)
                  <li><a href="{{route('manage.users.index')}}">ユーザー管理</a></li>
                  @endif
                </ul>
              </div>

            </div>
            @endif
            <div class="fl-right mar-top5">ようこそ、{{Auth::user()->u_name}}さん（<a href="{{route('manage.users.change_pwd')}}" class="text-orange">パスワード変更</a>）</div>
          </div>
          @endif
        </div>
      </div>
    </header>
    <!-- End Header -->