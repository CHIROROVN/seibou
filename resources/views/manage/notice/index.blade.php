@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--list">
          <h3>「お知らせ」管理　＞　登録済み「お知らせ」の一覧</h3>
          <div class="row fl-right mar-bottom">
            <div class="col-md-12">
              <input onclick="location.href='notice_regist.html'" value="「お知らせ」の新規登録" type="button" class="btn btn-sm btn-primary"/>
            </div>
          </div>
          <table class="table table-bordered table-striped clearfix">
            <tr>
              <td class="col-title" align="center">詳細・変更・削除</td>
              <td class="col-title" align="center">表示</td>
              <td class="col-title" align="center">タイトル</td>
              <td class="col-title" align="center">情報登録日</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='notice_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>新商品について</td>
              <td>2017/01/20</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='notice_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>新商品について</td>
              <td>2017/01/19</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='notice_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>新商品について</td>
              <td>2017/01/18</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='notice_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>新商品について</td>
              <td>2017/01/01</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='notice_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>新商品について</td>
              <td>2016/12/24</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='notice_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center">○</td>
              <td>運送便の遅れについて</td>
              <td>2016/12/20</td>
            </tr>
            <tr>
              <td align="center">
                <input onclick="location.href='notice_detail.html'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
              </td>
              <td align="center" class="text-orange">×</td>
              <td>年末年始の営業について</td>
              <td>2016/12/01</td>
            </tr>
          </table>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection