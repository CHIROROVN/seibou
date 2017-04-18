@extends('frontends.main')

@section('content')


  <div class="col-md-9 content-right">
    <h1 class="text-orange">以下の発注を変更しました。</h1>
    <h1>発注詳細</h1>
    <table class="table table-bordered table-striped clearfix">
      <tbody><tr>
        <td class="col-title" align="center">WebNo</td>
        <td class="col-title" align="center">発注日</td>
        <td class="col-title" align="center">区分</td>
      </tr>
      <tr>
        <td>{{ $history->伝票No }}</td>
        <td>{{ formatDate($history->受注日) }}</td>
        <td>
          @foreach ( $webskb as $item )
            @if ( $item->ｺｰﾄﾞ == $history->出荷区分 )
            {{ $item->名称 }}
            <?php break; ?>
            @endif
          @endforeach
        </td>
      </tr>
    </tbody></table>
    <h1>発注内容変更</h1>
    <p class="text-orange" style="padding-bottom:0;">★印の商品は、在庫がない場合にのみ表示されます。</p>
    <table class="table table-bordered table-striped clearfix">
      <tbody><tr>
        <td width="5%" align="center" class="col-title">品番</td>
        <td width="23%" align="center" class="col-title">商品名</td>
        <td width="19%" align="center" class="col-title">カラー</td>
        <td width="11%" align="center" class="col-title">サイズ</td>
        <td width="4%" align="center" class="col-title">数量</td>
        <td width="4%" align="center" class="col-title">摘要</td>
        <td width="12%" align="center" class="col-title">備考</td>
      </tr>
      
      @if ( $cartChange && count($cartChange) )
        @foreach ( $cartChange as $item )
        <tr>
          <td>{{ $item['product_id'] }}</td>
          <td>{{ $item['product_name'] }}</td>
          <td>{{ $item['color_name'] }}</td>
          <td>{{ $item['size_name'] }}</td>
          <td align="right">
            @if ( $item['quantityChange'] == '' )
            {{ $item['quantity'] }}
            @else
            {{ $item['quantityChange'] }}
            @endif
          </td>
          <td align="right">
            @if ( $item['itemCodeByCustomerChange'] == '' )
            {{ $item['itemCodeByCustomer'] }}
            @else
            {{ $item['itemCodeByCustomerChange'] }}
            @endif
          </td>
          <?php $cls = '' ?>
          @if ( $item['statusStart'] == 2 )
          <?php $cls = 'text-orange' ?>
          @endif
          <td class="{{ $cls }}">
            @if ( $item['statusStart'] == 2 )
            ★
            @endif
          </td>
        </tr>
        @endforeach
      @endif
      
    </tbody></table>
    
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{ route('front.history.detail', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="発注詳細にもどる" type="button" class="btn btn-sm btn-primary mar-left40">
      </div>
    </div>
  </div>

@stop