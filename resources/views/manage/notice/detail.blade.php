@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content">
          <h3>「お知らせ」管理　＞　登録済み「お知らせ」の詳細</h3>
          <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title">タイトル</td>
                <td>年末年始の休日について</td>
              </tr>
              
              <tr>
                <td class="col-title">情報登録日</td>
                <td>2016年12月01日</td>
              </tr>
              <tr>
                <td class="col-title">詳細</td>
                <td>
                  2016年12月29日～2017年1月4日まで休業です。出荷は12月28日の午前までです。お問い合わせについても28日午前までです。<br />
                  休み中のご注文は受付いたします。出荷は1月5日以降になります。<br />
                  よろしくお願いたします。
                </td>
              </tr>
              <tr>
                <td class="col-title">タイマー</td>
                <td>
                    表示開始日： （指定なし） から <br />
                    表示終了日： 2017年01月05日 まで
                </td>
              </tr>
              <tr>
                <td class="col-title">表示／非表示</td>
                <td>表示する</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mar-bottom30">
          <div class="col-md-12 text-center">
            <input onclick="location.href='notice_change.html'" value="変更する" type="button" class="btn btn-sm btn-primary">
            <input onclick="location.href='notice_delete_cnf.html'" value="削除する" type="button" class="btn btn-sm btn-primary mar-left40">
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