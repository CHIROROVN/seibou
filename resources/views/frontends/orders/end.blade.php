@extends('frontends.main')

@section('content')

<div class="col-md-9 content-right product-search">
<p style="margin-top:15px; color:red; font-size: 16px;"><span style="font-size:20px; font-weight: bold;">発注完了</span><br><b>ご発注いただきありがとうございました。発注処理が完了しました。</b></p>
<h1>発注内容<span class="small_text">（こちらの内容は納品書に印字されます）</span></h1>
<p><span class="text-orange">★印の商品は、在庫がない場合にのみ表示されます。</span><br>
<span style="color:red; font-size:1.1em;">★印の商品の納期については、別途弊社よりご連絡いたします。</span></p>
<table class="table table-bordered table-striped clearfix">
  <tr>
    <td class="col-title" align="center">品番</td>
    <td class="col-title" align="center">商品名</td>
    <td class="col-title" align="center">カラー</td>
    <td class="col-title" align="center">サイズ</td>
    <td class="col-title" align="center">数量</td>
    <td class="col-title" align="center">摘要</td>
    <td class="col-title" align="center">備考</td>
  </tr>
  
  @if ( $cartConfirm && count($cartConfirm['cart']) > 0 )
    @foreach ( $cartConfirm['cart'] as $cart )
    <tr>
      <td>{{ $cart['product_id'] }}</td>
      <td>{{ $cart['product_name'] }}</td>
      <td>{{ $cart['color_name'] }}</td>
      <td>{{ $cart['size_name'] }}</td>
      <td align="right">{{ $cart['quantity'] }}</td>
      <td align="right">{{ $cart['productIdByCustomer'] }}</td>
      <td class="text-orange">
        @if ( $cart['quantityStockMeisai'] == 0 )
          ★
        @endif
      </td>
    </tr>
    @endforeach
  @endif
  
</table>

<h1>得意先担当者情報<span class="small_text">（こちらの内容は納品書に印字されます）</span></h1>
<table class="table table-bordered table-regist">
  <tbody>
    <tr>
      <td class="col-title">得意先担当者名　　　　　　　　</td>
      <td>
        {{ $cartConfirm['order_inputs']['order_name'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">備考</td>
      <td>
        {!! nl2br($cartConfirm['order_inputs']['order_content']) !!}
      </td>
    </tr>
  </tbody>
</table>

<h1>メッセージ及び発送方法・発送日時指定<span class="small_text">（こちらの内容は納品書に印字されません）</span></h1>
<table class="table table-bordered table-regist">
  <tbody>
    <tr>
      <td class="col-title" width="328px">メッセージ<br>
<span style="font-size: 0.8em;">＊発送方法等でご要望がある際にお使いください。</span></td>
      <td>
        {!! nl2br($cartConfirm['order_inputs']['order_content_2']) !!}
      </td>
    </tr>

    <tr><td class="col-title">出荷方法</td>
      <td>
        @foreach ( $webmkb as $item )
          @if ( $item->ｺｰﾄﾞ == $cartConfirm['order_inputs']['order_shipping'] )
            {{ $item->名称 }}
          @endif
        @endforeach
      </td></tr>
    <tr>
      <td class="col-title">便出荷</td>
      <td>
        @if ( $cartConfirm['order_inputs']['order_ship_fly'] == 1 )
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


<h1>納入先<span class="small_text">（こちらの内容は納品書に印字されません）</span></h1>
<table class="table table-bordered table-regist">
  <tbody>
    <tr>
      <td class="col-title">納入先名</td>
      <td>
      {{ $cartConfirm['order']['order_name'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">部署名</td>
      <td>{{ trim($cartConfirm['order']['order_division']) }}
      </td>
    </tr>
    <tr>
      <td class="col-title">ご担当者名</td>
      <td>{{ $cartConfirm['order']['order_member'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">郵便番号</td>
      <td>{{ $cartConfirm['order']['order_zip3'] }}-{{ $cartConfirm['order']['order_zip4'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">住所</td>
      <td>
        {{ $cartConfirm['order']['order_address1'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">住所（ビル名等）</td>
      <td>
        {{ $cartConfirm['order']['order_address2'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">電話番号</td>
      <td>
        {{ $cartConfirm['order']['order_tel'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">FAX番号</td>
      <td>
        {{ $cartConfirm['order']['order_fax'] }}
      </td>
    </tr>
    <tr>
      <td class="col-title">納品書同送</td>
      <td>
        @foreach ( $webdkb as $item )
          @if ( $cartConfirm['order']['order_invoice'] == $item->ｺｰﾄﾞ )
          {{ $item->名称 }}
          @endif
        @endforeach
      </td>
    </tr>
  </tbody>
</table>

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
        ]) }}'" value="検索結果一覧に戻る" type="button" class="btn btn-sm btn-primary" style="margin-right: 10px;"><input onclick="location.href='{{ route('front.products.search') }}'" value="条件を変えて再検索" type="button" class="btn btn-sm btn-primary">
  </div>
</div>
            
<div class="row mar-bottom30">
  <div class="col-md-12 text-center">
    <input onclick="location.href='{{ route('front.home') }}'" value="ホーム" type="button" class="btn btn-sm btn-primary">
  </div>
</div>
</div>

@stop