@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content">
          <h3>ユーザー管理　＞　ユーザーの新規登録</h3>
          <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title">氏名</td>
                <td>
                  <input name="textbox" type="text" class="form-control form-control--default">
                </td>
              </tr>
              <tr>
                <td class="col-title">ログインID</td>
                <td>
                  <input name="textbox" type="text" class="form-control form-control--default"> ※英数字3文字以上、<span class="text-orange">重複不可</span>
                </td>
              </tr>
              <tr>
                <td class="col-title">パスワード</td>
                <td>
                  <input name="textbox" type="text" class="form-control form-control--default"> ※英数字5文字以上
                </td>
              </tr>
              <tr>
                <td class="col-title">操作権限</td>
                <td>
                  <div class="col-md-12 mar-bottom">
                    <input name="checkbox" value="checkbox" type="checkbox"> 「お知らせ」管理
                  </div>
                  <div class="col-md-12 mar-bottom">
                    <input name="checkbox" value="checkbox" type="checkbox"> 「営業日カレンダー」管理
                  </div>
                  <div class="col-md-12">
                    <input name="checkbox" value="checkbox" type="checkbox"> ユーザー管理
                  </div>
                </td>
              </tr>
              <tr>
                <td class="col-title">有効／無効</td>
                <td>
                  <div class="col-md-12 mar-bottom">
                    <input name="checkbox" value="checkbox" type="checkbox"> 一時的に無効とする（ログインできなくする）
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mar-bottom30">
          <div class="col-md-12 text-center">
            <input onclick="location.href='manager_regist_cnf.html'" value="確認する" type="button" class="btn btn-sm btn-primary">
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