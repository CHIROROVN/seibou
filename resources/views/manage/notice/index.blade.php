@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--list">
          <h3>「お知らせ」管理　＞　登録済み「お知らせ」の一覧</h3>

          @if($message = Session::get('danger'))
              <div id="error" class="message">
                  <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
                  <span>{{$message}}</span>
              </div>
          @elseif($message = Session::get('success'))
              <div id="success" class="message">
                  <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
                  <span>{{$message}}</span>
              </div>
          @endif
          
          <div class="row fl-right mar-bottom">
            <div class="col-md-12">
              <input onclick="location.href='{{route('manage.notice.regist')}}'" value="「お知らせ」の新規登録" type="button" class="btn btn-sm btn-primary"/>
            </div>
          </div>
          <table class="table table-bordered table-striped clearfix">
            <tr>
              <td class="col-title" align="center" style="width: 130px;">詳細・変更・削除</td>
              <td class="col-title" align="center" style="width: 48px;">表示</td>
              <td class="col-title" align="center">タイトル</td>
              <td class="col-title" align="center" style="width: 76px;">情報登録日</td>
            </tr>
            @if(count($news) > 0)
              @foreach($news as $notice)
                <tr>
                  <td align="center">
                    <input onclick="location.href='{{route('manage.notice.detail', $notice->news_id)}}'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
                  </td>
                  @if($notice->news_display == '1')
                    <td align="center" class="text-orange">×</td>
                  @else
                    <td align="center">○</td>
                  @endif
                  <td><?php echo nl2br($notice->news_contents); ?></td>
                  <td>{{formatDate($notice->news_startday, '/')}}</td>
              </tr>
              @endforeach
            @else
              <tr><td colspan="4" style="text-align: center;">該当するデータがありません。</td></tr>
            @endif
            
          </table>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection