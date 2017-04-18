@extends('frontends.main')

@section('content')

  <div class="col-md-9 content-right"><span style="font-size:20px; font-weight: bold; border-bottom: solid 2px #14578b; color: #14578b; ">キャンセル最終確認</span><p style="color: red;font-size:1.1em;"><b>キャンセル処理はまだ完了していません。</b></p>
    <h1>発注詳細</h1>
    <table class="table table-bordered table-striped clearfix">
      <tr>
        <td class="col-title" align="center">WebNo</td>
        <td class="col-title" align="center">発注日</td>
        <td class="col-title" align="center">区分</td>
      </tr>
      <tr>
        <td>{{ $history->伝票No }}</td>
        <td>{{ date('Y/m/d', strtotime($history->受注日)) }}</td>
        <td>
          @foreach ( $webskb as $item )
            @if ( $item->ｺｰﾄﾞ == $history->出荷区分 )
            {{ $item->名称 }}
            @endif
          @endforeach
        </td>
      </tr>
    </table>
    <h1>キャンセル内容<span style="float:right;"><input onclick="location.href='{{ route('front.history.cancel.cart_change') }}'" value="発注内容の変更" type="button" class="btn btn-sm btn-primary" style="border-radius:0px;text-decoration:underline;"></span></h1>
    <p class="text-orange" style="padding-bottom:0;">★印の商品は、在庫がない場合にのみ表示されます。</p>
    <table class="table table-bordered table-striped clearfix" style="margin-bottom: 8px;">
      <tr>
        <td class="col-title" align="center">品番</td>
        <td class="col-title" align="center">商品名</td>
        <td class="col-title" align="center">カラー</td>
        <td class="col-title" align="center">サイズ</td>
        <td class="col-title" align="center">数量</td>
        <td class="col-title" align="center">備考</td>
      </tr>
      
      @if ( $cancel && count($cancel) > 0 )
        @foreach ( $cancel as $item )
        <tr>
          <td>
            {{ $item['product_id'] }}
          </td>
          <td>
            {{ $item['product_name'] }}
          </td>
          <td>
            {{ $item['color_name'] }}
          </td>
          <td>
            {{ $item['size_name'] }}
          </td>
          <td align="right">
            {{ $item['quantity'] }}
          </td>
          
          <?php $cls = '' ?>
          @if ( $item['statusStar'] == 2 )
            <?php $cls = 'text-orange' ?>
          @endif
          <td class="{{ $cls }}">
            @if ( $item['statusStar'] == 2 )
            ★
            @endif
          </td>
        </tr>
        @endforeach
      @endif
      
    </table>
    
    <br>こちらの発注をキャンセルしますか。

    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="history.back()" value="もどる" type="button" class="btn btn-sm btn-primary"><br><button onclick="location.href='{{ route('front.history.cancel.end', ['id' => $id, 'id1' => $id1]) }}'" value="" type="button" class="btn btn-sm btn-primary" style="font-size: 1.2em; background-color: #FF9326; margin-left:0; border:solid 1px #D96C00; margin-top: 10px;">キャンセルする</button>
      </div>
    </div>
    
  </div>
		  
@stop