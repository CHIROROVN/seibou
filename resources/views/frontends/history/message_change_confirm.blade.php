@extends('frontends.main')

@section('content')

<div class="col-md-9 content-right"><span style="font-size:20px; font-weight: bold; border-bottom: solid 2px #14578b; color: #14578b; ">変更最終確認</span><p style="color: red;font-size:1.1em;"><b>変更処理はまだ完了していません。</b></p>
  <h1>メッセージ及び発送方法・発送日時指定の変更</h1>
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
      <input onclick="history.back()" value="もどる" type="button" class="btn btn-sm btn-primary"><br>
     <button onclick="location.href='{{ route('front.history.message_change.end') }}'" value="" type="button" class="btn btn-sm btn-primary mar-left40" style="font-size: 1.2em; background-color: #FF9326; margin-left:0; border:solid 1px #D96C00; margin-top: 10px;">変更する</button>
    </div>
  </div>
</div>


@stop