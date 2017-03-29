@extends('frontends.main')

@section('content')

  <div class="chui" style="clear:both; font-size: 1.6em;" align="left">
  刺繍、名入れ等の加工品、別注品は、本Webシステムから発注できません。
  </div>
  <div style="font-size:1.2em;" align="center">別途弊社までお問い合わせください。</div>
  <div style="clear:both;"></div>
  <div class="col-md-9 content-right" style="width: 750px;float: left;">
    <h1>発注リストの中身</h1>
    
    <p style="padding-bottom:0;">
      現在の発注リストの中身は、以下の通りです。<br /><br />
      <span class="text-orange">★印の商品は、在庫がない場合にのみ表示されます。</span>
    </p>
    <table class="table table-bordered table-striped clearfix">
      <tr>
        <td class="col-title" align="center">削除</td>
        <td class="col-title" align="center">品番</td>
        <td class="col-title" align="center">商品名</td>
        <td class="col-title" align="center">カラー</td>
        <td class="col-title" align="center">サイズ</td>
        <td class="col-title" align="center">数量</td>
        <td class="col-title" align="center">備考</td>
      </tr>
      
      @if ( Session::get('cart') && count(Session::get('cart')) > 0 )
        @foreach ( Session::get('cart') as $cart )
        <tr>
          <td align="center">
            <a href="{{ route('front.products.cart.delete', $cart['cart_id']) }}" class="btn btn-xs btn-primary">削除</a>
          </td>
          <td>{{ $cart['product_id'] }}</td>
          <td>{{ $cart['product_name'] }}</td>
          <td>{{ $cart['color_name'] }}</td>
          <td>{{ $cart['size_name'] }}</td>
          <td align="right">{{ $cart['quantity'] }}</td>
          <td class="text-orange">
            @if ( $cart['quantityStockMeisai'] == 0 )
              ★
            @endif
          </td>
        </tr>
        @endforeach
      @endif
    </table>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="history.back()" value="前の画面に戻る" type="button" class="btn btn-sm btn-primary">
        <input onclick="location.href='{{ route('front.orders.index') }}'" value="発注画面へ" type="button" class="btn btn-sm btn-primary mar-left40">
      </div>
    </div>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <?php
        $item_code_1 = '';$item_code_2 = '';$item_code_3 = '';
        if ( Session::has('dataSearch') ) {
            $item_code_1 = empty(Session::get('dataSearch')['item_code_1']) ? '' : Session::get('dataSearch')['item_code_1'];
            $item_code_2 = empty(Session::get('dataSearch')['item_code_2']) ? '' : Session::get('dataSearch')['item_code_2'];
            $item_code_3 = empty(Session::get('dataSearch')['item_code_3']) ? '' : Session::get('dataSearch')['item_code_3'];
        }
        ?>
        <input onclick="location.href='{{ route('front.products.list', [
            'item_code_1' => $item_code_1,
            'item_code_2' => $item_code_2,
            'item_code_3' => $item_code_3
            ]) }}'" value="検索結果一覧に戻る" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{ route('front.products.search') }}'" value="条件を変えて再検索" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
		  
@stop