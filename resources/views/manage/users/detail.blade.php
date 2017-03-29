@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
  <div class="container">
    <div class="row content">
      <h3>ユーザー管理　＞　登録済みユーザーの詳細</h3>
      <table class="table table-bordered table-regist">
        <tbody>
          <tr>
            <td class="col-title">氏名</td>
            <td>山田　花子</td>
          </tr>
          <tr>
            <td class="col-title">ログインID</td>
            <td>yamada1</td>
          </tr>
          <tr>
            <td class="col-title">パスワード</td>
            <td>yamada1</td>
          </tr>
          <tr>
            <td class="col-title">操作権限</td>
            <td>
              「お知らせ」管理<br />
              「営業日カレンダー」管理<br />
              ユーザー管理
            </td>
          </tr>
          <tr>
            <td class="col-title">有効／無効</td>
            <td>有効</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="location.href='manager_change.html'" value="変更する" type="button" class="btn btn-sm btn-primary">
        <input onclick="location.href='manager_delete_cnf.html'" value="削除する" type="button" class="btn btn-sm btn-primary mar-left40">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="location.href='manager_list.html'" value="登録済みユーザー一覧に戻る" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
</section>
<!--END PAGE CONTENT -->
@endsection