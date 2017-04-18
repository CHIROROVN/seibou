@extends('frontends.main')

@section('content')

{!! Form::open(array('route' => ['front.orders.index'], 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
  <div class="chui" style="clear:both; font-size: 1.6em;" align="left"> 刺繍、名入れ等の加工品、別注品は、本Webシステムから発注できません。 </div>
    <div style="font-size:1.2em;" align="center">別途弊社までお問い合わせください。</div>
    <div style="clear:both;"></div>
    <div class="col-md-9 content-right" style="width: 750px;float: left;">
      <h1>発注内容<span class="small_text">（こちらの内容は納品書に印字されます）</span></h1>
      
      @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
          <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $error }}</div>
        @endforeach
      @endif
      
      <p>
        現在の発注リストの中身は、以下の通りです。<br><br>
        <span style=" font-size: 1.2em; color:#f00;">★印の商品は、在庫がない場合にのみ表示されます。<br>＊注文番号はお客様にて必要な際に入力してください。必須ではありません。</span><br>
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
        
        @if ( Session::get('cart') && count(Session::get('cart')) > 0 )
          @foreach ( Session::get('cart') as $cart )
          <tr>
            <td>{{ $cart['product_id'] }}</td>
            <td>{{ $cart['product_name'] }}</td>
            <td>{{ $cart['color_name'] }}</td>
            <td>{{ $cart['size_name'] }}</td>
            <td align="right">{{ $cart['quantity'] }}</td>
            <td><input type="text" size="5" name="productIdByCustomer_{{ $cart['cart_id'] }}" value="{{ old('productIdByCustomer_' . $cart['cart_id']) }}"></td>
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
            <td class="col-title">得意先担当者名　　　　</td>
            <td><input name="order_name" value="{{ old('order_name') }}" type="text" class="form-control form-control--default"></td>
          </tr>
          <tr>
            <td class="col-title">備考<br>
              <span style="font-size: 0.8em;">＊納入先が営業所留めで<br>
              納品書が不要な場合等にご使用ください。</span></td>
            <td><textarea name="order_content" rows="2" cols="32" style="border:solid 1px #ccc;">{{ old('order_content') }}</textarea></td>
          </tr>
          <tr> </tr>
        </tbody>
      </table>
      
      <h1>メッセージ及び発送方法・発送日時指定<span class="small_text">（こちらの内容は納品書に印字されません）</span></h1>
      <table class="table table-bordered table-regist">
        <tbody>
          <tr>
            <td class="col-title" width="328px">メッセージ<br>
<span style="font-size: 0.8em;">＊発送方法等でご要望がある際にお使いください。</span></td>
            <td><textarea name="order_content_2" type="text" class="form-control form-control--default" rows="3" style="width: 370px;">{{ old('order_content_2') }}</textarea></td>
          </tr>
          <tr>
            <td class="col-title">出荷方法<span class="red">（必須）</span></td>
            <td>
              @foreach ( $webmkb as $item )
              <input name="order_shipping" type="radio" value="{{ $item->ｺｰﾄﾞ }}" @if(old('order_shipping') == $item->ｺｰﾄﾞ) checked @endif>{{ $item->名称 }}<br>
              @endforeach
              
              <span style="color:red;">
                ※一括出荷は出荷までにお時間がかかることがございます</span>
              @if ($errors->first('order_shipping'))
              <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_shipping') }}</div>
              @endif
            </td>
          </tr>
          <tr>
            <td class="col-title">便出荷</td>
            <td><input name="order_ship_fly" type="checkbox" value="1" @if(old('order_ship_fly')==1) checked @endif>
              便出荷を希望する </td>
          </tr>
          <tr> </tr>
        </tbody>
      </table>
      
      <h1>納入先<span class="small_text">（こちらの内容は納品書に印字されません）</span></h1>
      <div style="clear:both;"></div>
      <p style="padding-bottom: 8px;">納入先を選択、または入力してください。</p>
      <table class="table table-bordered table-regist" style="margin-top:4px;">
        <tbody>
          <tr>
            <td class="col-title">納入先：</td>
            <td>
              <select name="delivery_id" id="delivery_id" class="form-control form-control--default">
            
                @if ( count($deliveries) > 0 )
                  @foreach ( $deliveries as $delivery )
                  <option value="{{ $delivery->delivery_id }}" @if(old('delivery_id') == $delivery->delivery_id) selected @endif>{{ $delivery->delivery_name }}</option>
                  @endforeach
                @endif
                
              </select>
              <span class="mar-right">→</span>
              <input name="button" id="get-delivery" value="反映" type="button" class="btn btn-sm btn-primary mar-left40">
              <input name="button" id="get-delivery-server" value="既存登録情報より差し込み" type="button" class="btn btn-sm btn-primary mar-left40"></td>
          </tr>
        </tbody>
      </table>
      
      <table class="table table-bordered table-regist" style="margin-top: 8px;">
        <tbody>
          <tr>
            <td class="col-title">納入先名<span class="red">（必須）</span></td>
            <td>
              <input name="order_name" value="{{ old('order_name') }}" id="order_name" type="text" class="form-control form-control--default">
              @if ($errors->first('order_name'))
              <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_name') }}</div>
              @endif
            </td>
          </tr>
          <tr>
            <td class="col-title">部署名</td>
            <td>
              <input name="order_division" value="{{ old('order_division') }}" id="order_division" type="text" class="form-control form-control--default">
            </td>
          </tr>
          <tr>
            <td class="col-title">ご担当者名</td>
            <td><input name="order_member" value="{{ old('order_member') }}" id="order_member" type="text" class="form-control form-control--default"></td>
          </tr>
          <tr>
            <td class="col-title">郵便番号<span class="red">（必須）</span></td>
            <td>
              <input name="order_zip3" value="{{ old('order_zip3') }}" id="order_zip3" type="text" class="form-control form-control--small-xs"> - <input name="order_zip4" value="{{ old('order_zip4') }}" id="order_zip4" type="text" class="form-control form-control--small-xs" >
              @if ($errors->first('order_zip3'))
              <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_zip3') }}</div>
              @endif
              @if ($errors->first('order_zip4'))
              <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_zip4') }}</div>
              @endif
            </td>
          </tr>
          <tr>
            <td class="col-title">住所<span class="red">（必須）</span></td>
            <td>
              <input name="order_address1" value="{{ old('order_address1') }}" id="order_address1" type="text" class="form-control form-control--default">
              @if ($errors->first('order_address1'))
              <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_address1') }}</div>
              @endif
            </td>
          </tr>
          <tr>
            <td class="col-title">住所（ビル名等）</td>
            <td><input name="order_address2" value="{{ old('order_address2') }}" id="order_address2" type="text" class="form-control form-control--default"></td>
          </tr>
          <tr>
            <td class="col-title">電話番号<span class="red">（必須）</span></td>
            <td>
              <input name="order_tel" value="{{ old('order_tel') }}" id="order_tel" type="text" class="form-control form-control--small" >
              @if ($errors->first('order_tel'))
              <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_tel') }}</div>
              @endif
            </td>
          </tr>
          <tr>
            <td class="col-title">FAX番号</td>
            <td>
              <input name="order_fax" value="{{ old('order_fax') }}" id="order_fax" type="text" class="form-control form-control--small">
            </td>
          </tr>
          <tr>
            <td class="col-title">納品書同送<span class="red">（必須）</span></td>
            <td>
              @foreach ( $webdkb as $item )
              <?php $selected = '' ?>
              @if ( old('order_invoice') == $item->ｺｰﾄﾞ )
              <?php $selected = 'checked' ?>
              @endif
              <input name="order_invoice" id="order_invoice_{{ $item->ｺｰﾄﾞ }}" class="order_invoice" type="radio" value="{{ $item->ｺｰﾄﾞ }}" {{ $selected }}>
              {{ $item->名称 }}　
              @endforeach
              
              @if ($errors->first('order_invoice'))
              <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_invoice') }}</div>
              @endif
            </td>
          </tr>
        </tbody>
      </table>
      <div class="row mar-bottom30">
        <div class="col-md-12 text-center">
          <input onclick="history.back()" value="前の画面に戻る" type="button" class="btn btn-sm btn-primary">
          <input value="確認する" type="submit" class="btn btn-sm btn-primary mar-left40">
        </div>
      </div>
    </div>
</form>
    
    <script>
      $(document).ready(function(){
        //click get delivery
        $("#get-delivery, #get-delivery-server").click(function(){
          var delivery_id = 0;
          var get_from_server = $(this).attr('id');
          delivery_id = $('#delivery_id').val();
          $.ajax({
            url: "{{ route('front.orders.get.delivery') }}",
            type: 'get',
            dataType: 'json',
            data: { 
              delivery_id: delivery_id,
              get_from_server: get_from_server
            },
            success: function(result){
              console.log(result);
              
              
              if ( result.from === 'sqlserver' ) {
                var zip = result.customer.郵便番号.split('-');
                $('#order_name').val(result.customer.得意先名);
                $('#order_zip3').val(zip[0]);
                $('#order_zip4').val(zip[1]);
                $('#order_address1').val(result.customer.住所1);
                $('#order_address2').val(result.customer.住所2);
                $('#order_tel').val(result.customer.電話番号);
                $('#order_fax').val(result.customer.FAX_番号);
                $('.order_invoice').prop('checked', false);
                
                $('#order_name').attr('value', result.customer.得意先名);
                $('#order_zip3').attr('value', zip[0]);
                $('#order_zip4').attr('value', zip[1]);
                $('#order_address1').attr('value', result.customer.住所1);
                $('#order_address2').attr('value', result.customer.住所2);
                $('#order_tel').attr('value', result.customer.電話番号);
                $('#order_fax').attr('value', result.customer.FAX_番号);
                if ( result.customer.WEB納入先納品書同封区分 == 1 ) {
                  $('#order_invoice_1').prop('checked', true);
                } else if ( result.customer.WEB納入先納品書同封区分 == 2 ) {
                  $('#order_invoice_2').prop('checked', true);
                }
              } else {
                $('#order_name').val(result.customer.delivery_name);
                $('#order_division').val(result.customer.delivery_division);
                $('#order_member').val(result.customer.delivery_member);
                $('#order_zip3').val(result.customer.delivery_zip3);
                $('#order_zip4').val(result.customer.delivery_zip4);
                $('#order_address1').val(result.customer.delivery_address1);
                $('#order_address2').val(result.customer.delivery_address2);
                $('#order_tel').val(result.customer.delivery_tel);
                $('#order_fax').val(result.customer.delivery_fax);
                $('.order_invoice').prop('checked', false);
              
                $('#order_name').attr('value', result.customer.delivery_name);
                $('#order_division').attr('value', result.customer.delivery_division);
                $('#order_member').attr('value', result.customer.delivery_member);
                $('#order_zip3').attr('value', result.customer.delivery_zip3);
                $('#order_zip4').attr('value', result.customer.delivery_zip4);
                $('#order_address1').attr('value', result.customer.delivery_address1);
                $('#order_address2').attr('value', result.customer.delivery_address2);
                $('#order_tel').attr('value', result.customer.delivery_tel);
                $('#order_fax').attr('value', result.customer.delivery_fax);
                if ( result.customer.delivery_free1 == '1' ) {
                  $('#order_invoice_1').prop('checked', true);
                } else if ( result.customer.delivery_free1 == '2' ) {
                  $('#order_invoice_2').prop('checked', true);
                }
              }
            }
          });
        });
        //end click get delivery
      });
    </script>
		  
@stop