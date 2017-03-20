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
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <h1 class="fl-left">倉敷製帽 WEB受注システム 管理画面</h1>
          </div>
          <div class="col-md-8">
            <div class="fl-right mar-left40">
              <input type="button" class="btn btn-sm btn-info" name="button" value="ログアウト" onclick="location.href='logout.html'"/>
              <div class="dropdown">
                <button class="btn btn-sm btn-info  btn-mar-right dropdown-toggle" type="button" data-toggle="dropdown">メニューへ
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="notice_list.html">「お知らせ」管理</a></li>
                  <li><a href="calendar_list.html">「営業日カレンダー」管理</a></li>
                  <li><a href="manager_list.html">ユーザー管理</a></li>
                </ul>
              </div>
            </div>
            <div class="fl-right mar-top5">ようこそ、山田花子さん（<a href="change_pass.html" class="text-orange">パスワード変更</a>）</div>
          </div>
        </div>
      </div>
    </header>
    <!-- End Header -->