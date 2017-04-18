@extends('frontends.main')

@section('content')

{!! Form::open(array('route' => ['front.history.cart_change'], 'enctype'=>'multipart/form-data')) !!}
  <div class="col-md-9 content-right"><span style="font-size:20px; font-weight: bold; border-bottom: solid 2px #14578b; color: #14578b; ">変更最終確認</span><p style="color: red;font-size:1.1em;"><b>変更処理はまだ完了していません。</b></p>
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
        <input onclick="history.back()" value="もどる" type="button" class="btn btn-sm btn-primary"><br><button onclick="location.href='{{ route('front.history.cart_change.end') }}'" value="" type="button" class="btn btn-sm btn-primary " style="font-size: 1.2em; background-color: #FF9326; margin-top:10px; border:solid 1px #D96C00;">変更する</button>
      </div>
    </div>
  </div>
</form>
@stop