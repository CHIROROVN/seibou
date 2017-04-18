@extends('frontends.main')

@section('content')
  <div class="col-md-9 content-right">
  <h1 class="text-orange">以下の発注をキャンセルしました。</h1>
  <br>
  
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
    <h1>キャンセル内容</h1>
    <p class="text-orange" style="padding-bottom:0;">★印の商品は、在庫がない場合にのみ表示されます。</p>
    <table class="table table-bordered table-striped clearfix">
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
    
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{ route('front.history.cancel_detail', $history->伝票No) }}'" value="もどる" type="button" class="btn btn-sm btn-primary mar-left40">
      </div>
    </div>
  
@stop