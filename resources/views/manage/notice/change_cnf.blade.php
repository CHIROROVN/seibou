@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
  <div class="container">
    <div class="row content">
      <h3>「お知らせ」管理　＞　登録済み「お知らせ」の詳細　＞　確認</h3>
          <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title">タイトル</td>
                <td>{{$news->news_title}}</td>
              </tr>
              
              <tr>
                <td class="col-title">情報登録日</td>
                <td>{{dateEn2Ja($news->news_date)}}</td>
              </tr>
              <tr>
                <td class="col-title">詳細</td>
                <td>
                  <?php echo nl2br($news->news_contents) ;?>
                </td>
              </tr>
              <tr>
                <td class="col-title">タイマー</td>
                <td>
                    表示開始日： 
                    @if(!empty($news->news_startday))
                    {{dateEn2Ja($news->news_startday)}}
                    @else
                    (指定なし)
                    @endif から <br />
                    表示終了日： 
                    @if(!empty($news->news_endday))
                    {{dateEn2Ja($news->news_endday)}}
                    @else
                    (指定なし)
                    @endif まで
                </td>
              </tr>
              <tr>
                <td class="col-title">表示／非表示</td>
                <td>@if($news->news_display == '1') なし @else 表示する @endif </td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('manage.notice.change_save', $news->news_id)}}'" value="変更する" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('manage.notice.change', $news->news_id)}}'" value="戻る" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
</section>
<!--END PAGE CONTENT -->
@endsection