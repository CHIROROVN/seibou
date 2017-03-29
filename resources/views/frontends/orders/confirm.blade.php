@extends('frontends.main')

@section('content')

  <div class="chui" style="clear:both; font-size: 1.6em;" align="left">
  刺繍、名入れ等の加工品、別注品は、本Webシステムから発注できません。
  </div>
  <div style="font-size:1.2em;" align="center">別途弊社までお問い合わせください。</div>
  <div class="col-md-9 content-right" style="width: 750px;float: left;"><br><span style="font-size:20px; font-weight: bold; border-bottom: solid 2px #14578b; color: #14578b; ">発注最終確認</span><br>
<p style="color: red;font-size:1.1em;"><b>発注処理はまだ完了していません。</b></p>
            <h1>発注内容<span class="small_text">（こちらの内容は納品書に印字されます）</span></h1>
    <p>
      現在の発注リストの中身は、以下の通りです。<br /><br />
      <span class="text-orange">★印の商品は、在庫がない場合にのみ表示されます。</span><br>
      <span class="text-orange">＊摘要は注文番号やご担当者名が必要な場合に入力ください。必須項目ではありません。</span><br>
    </p>
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
      
      @if ( Session::has('cartConfirm') && count(Session::get('cartConfirm')['cart']) > 0 )
        @foreach ( Session::get('cartConfirm')['cart'] as $cart )
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
          <td class="col-title" width="328px">得意先担当者名　　　　　　　</td>
          <td>
            {{ Session::get('cartConfirm')['order_inputs']['order_name'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">備考</td>
          <td>
            {!! nl2br(Session::get('cartConfirm')['order_inputs']['order_content']) !!}
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
            {!! nl2br(Session::get('cartConfirm')['order_inputs']['order_content_2']) !!}
          </td>
        </tr>

        <tr><td class="col-title">出荷方法</td>
          <td>
            @foreach ( $webmkb as $item )
              @if ( $item->ｺｰﾄﾞ == Session::get('cartConfirm')['order_inputs']['order_shipping'] )
                {{ $item->名称 }}
              @endif
            @endforeach
          </td></tr>
        <tr>
          <td class="col-title">便出荷</td>
          <td>
            @if ( Session::get('cartConfirm')['order_inputs']['order_ship_fly'] == 1 )
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
          <td class="col-title">納入先：</td>
          <td>
            {{ Session::get('cartConfirm')['order']['order_name'] }} {{ Session::get('cartConfirm')['order']['order_address1'] }} {{ Session::get('cartConfirm')['order']['order_address2'] }}
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered table-regist">
      <tbody>
        <tr>
          <td class="col-title">納入先名</td>
          <td>
          {{ Session::get('cartConfirm')['order']['order_name'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">部署名</td>
          <td>{{ Session::get('cartConfirm')['order']['order_division'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">ご担当者名</td>
          <td>{{ Session::get('cartConfirm')['order']['order_member'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">郵便番号</td>
          <td>{{ Session::get('cartConfirm')['order']['order_zip3'] }}-{{ Session::get('cartConfirm')['order']['order_zip4'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">住所</td>
          <td>
            {{ Session::get('cartConfirm')['order']['order_address1'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">住所（ビル名等）</td>
          <td>
            {{ Session::get('cartConfirm')['order']['order_address2'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">電話番号</td>
          <td>
            {{ Session::get('cartConfirm')['order']['order_tel'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">FAX番号</td>
          <td>
            {{ Session::get('cartConfirm')['order']['order_fax'] }}
          </td>
        </tr>
        <tr>
          <td class="col-title">納品書同送</td>
          <td>
            @foreach ( $webdkb as $item )
              @if ( Session::get('cartConfirm')['order']['order_invoice'] == $item->ｺｰﾄﾞ )
              {{ $item->名称 }}
              @endif
            @endforeach
          </td>
        </tr>
      </tbody>
    </table>
    
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="history.back()" value="前の画面に戻る" type="button" class="btn btn-sm btn-primary" style="margin-bottom: 12px;"><br>
        <button onclick="location.href='{{ route('front.orders.end') }}'" value="" type="button" class="btn btn-sm btn-primary mar-left40" style="font-size: 1.2em; background-color: #FF9326; margin-left:0; border:solid 1px #D96C00;">発注する<br>(注文が確定されます)</button>
      </div>
    </div>
  </div>
		  
@stop