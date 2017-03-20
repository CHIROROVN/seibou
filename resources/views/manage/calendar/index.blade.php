@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--list">
          <h3>「営業日カレンダー」管理　＞　登録済み「営業日カレンダー」の一覧</h3>
          <table class="table table-bordered table-striped clearfix">
            <tr>
              <td class="col-title" align="center" width="100px">登録・編集</td>
              <td class="col-title" align="center">年</td>
            </tr>
            <tr>
              <td>
                <input onclick="location.href='calendar_edit.html'" value="新規登録" type="button" class="btn btn-xs btn-primary">
              </td>
              <td>2018年</td>
            </tr>
            <tr>
              <td>
                <input onclick="location.href='calendar_edit.html'" value="編集" type="button" class="btn btn-xs btn-primary">
              </td>
              <td>2017年</td>
            </tr>
            <tr>
              <td>
                <input onclick="location.href='calendar_edit.html'" value="編集" type="button" class="btn btn-xs btn-primary">
              </td>
              <td>2016年</td>
            </tr>
          </table>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection