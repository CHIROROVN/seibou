@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--list">
          <h3>ユーザー管理　＞　登録済みユーザーの一覧</h3>
          <div class="row fl-right mar-bottom">
            <div class="col-md-12">
              <input onclick="location.href='manager_regist.html'" value="ユーザーの新規登録" type="button" class="btn btn-sm btn-primary"/>
            </div>
          </div>
          <table class="table table-bordered table-striped clearfix">
            <tr>
              <td class="col-title" align="center">詳細・変更・削除</td>
              <td class="col-title" align="center">有効</td>
              <td class="col-title" align="center">ユーザー名</td>
              <td class="col-title" align="center">ログインID</td>
              <td class="col-title" align="center">権限</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='manager_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>山田　太郎</td>
              <td>yamada1</td>
              <td>・「お知らせ」管理<br>
                  ・「営業日カレンダー」管理
              </td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='manager_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>山田　花子</td>
              <td>yamada2</td>
              <td>・「お知らせ」管理<br>
                  ・「営業日カレンダー」管理
              </td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='manager_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>倉文　一郎</td>
              <td>kurabun3</td>
              <td>・ユーザー管理</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='manager_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>倉文　一郎</td>
              <td>kurabun4</td>
              <td>・「お知らせ」管理<br>
                  ・「営業日カレンダー」管理<br />
                  ・ユーザー管理
              </td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='manager_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center" class="text-orange">×</td>
              <td>倉文　一郎</td>
              <td>kurabun5</td>
              <td>・「お知らせ」管理<br />
                  ・「営業日カレンダー」管理
              </td>
            </tr>
          </table>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection