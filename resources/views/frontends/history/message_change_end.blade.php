@extends('frontends.main')

@section('content')


<div class="col-md-9 content-right">
<h1 class="text-orange">以下のメッセージ及び発送方法・発送日時指定を変更しました。</h1>

  
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title" width="328px">メッセージ<br>
          <span style="font-size: 0.8em;">＊発送方法等でご要望がある際にお使いください。</span></td>
        <td>
          {!! nl2br($messageChange['order_content_2_change']) !!}
        </td>
      </tr>

      <tr><td class="col-title">出荷方法</td>
        <td>
          @foreach ( $webmkb as $item )
            @if ( $item->ｺｰﾄﾞ == $messageChange['order_shipping_change'] )
            {{ $item->名称 }}
            @endif
          @endforeach
        </td></tr>
      <tr>
        <td class="col-title">便出荷</td>
        <td>
          @if ( $messageChange['order_ship_fly_change'] == 1 )
          便を希望する
          @else
          便の希望なし
          @endif
        </td>
      </tr>
       <tr>
      </tr>
    </tbody>
  </table>
  
  <div class="row mar-bottom30">
    <div class="col-md-12 text-center">
     <input onclick="location.href='{{ route('front.history.detail', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="発注詳細にもどる" type="button" class="btn btn-sm btn-primary">
    </div>
  </div>
</div>


@stop