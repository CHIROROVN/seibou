@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content">
          <h3>「お知らせ」管理　＞　「お知らせ」の新規登録</h3>
          <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title">タイトル</td>
                <td>
                  <input name="textbox" id="" type="text" class="form-control form-control--large">
                </td>
              </tr>
              
              <tr>
                <td class="col-title">情報登録日</td>
                <td>
                  <select name="txt" class="form-control form-control--small-xs form-control--mar-right">
                    <option value="" selected="selected">--年</option>
                  </select>
                  <select name="txt" class="form-control form-control--small-xs form-control--mar-right">
                    <option value="" selected="selected">--月</option>
                  </select>
                  <select name="txt" class="form-control form-control--small-xs">
                    <option value="" selected="selected">--日</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="col-title">詳細</td>
                <td><img src="common/image/WYSWIG.png" width="724" height="377"></td>
              </tr>
              <tr>
                <td class="col-title">タイマー</td>
                <td>
                  <div class="col-md-12 mar-bottom">
                    表示開始日：
                    <select name="txt" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" selected="selected">--年</option>
                    </select>
                    <select name="txt" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" selected="selected">--月</option>
                    </select>
                    <select name="txt" class="form-control form-control--small-xs">
                      <option value="" selected="selected">--日</option>
                    </select>
                     から
                  </div>
                  <div class="col-md-12">
                    表示終了日：
                    <select name="txt" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" selected="selected">--年</option>
                    </select>
                    <select name="txt" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" selected="selected">--月</option>
                    </select>
                    <select name="txt" class="form-control form-control--small-xs">
                      <option value="" selected="selected">--日</option>
                    </select>
                     まで
                  </div>
                </td>
              </tr>
              <tr>
                <td class="col-title">表示／非表示</td>
                <td>
                  <input name="checkbox" value="checkbox" type="checkbox"> 一時的にこの「お知らせ」を掲載しない
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mar-bottom30">
          <div class="col-md-12 text-center">
            <input onclick="location.href='notice_regist_cnf.html'" value="確認する" type="button" class="btn btn-sm btn-primary">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <input onclick="location.href='notice_list.html'" value="登録済み「お知らせ」一覧に戻る" type="button" class="btn btn-sm btn-primary">
          </div>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection