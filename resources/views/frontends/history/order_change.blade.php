@extends('frontends.main')

@section('content')

<div class="col-md-9 content-right">
  <h1>納入先の変更</h1><div style="clear:both;"></div>
  <p style="padding-bottom: 8px;">納入先を選択してください。または、納入先を入力してください。</p>
  
  {!! Form::open(array('route' => ['front.history.order_change'], 'enctype'=>'multipart/form-data')) !!}
  <table class="table table-bordered table-regist" style="margin-top:4px;">
    <tbody>
      <tr>
        <td class="col-title">納入先：</td>
        <td>
          <select name="delivery_id" id="delivery_id" class="form-control form-control--default">
          
            @if ( count($deliveries) > 0 )
              @foreach ( $deliveries as $delivery )
              <option value="{{ $delivery->delivery_id }}" @if(old('delivery_id') == $delivery->delivery_id) selected @endif >{{ $delivery->delivery_name }}</option>
              @endforeach
            @endif
                
          </select>
          <span class="mar-right">→</span>
          <input name="button" id="get-delivery" value="反映" type="button" class="btn btn-sm btn-primary mar-left40">
          <input name="button" id="get-delivery-server" value="既存登録情報より差し込み" type="button" class="btn btn-sm btn-primary mar-left40">
        </td>
      </tr>
    </tbody>
  </table>
  <span class="red">(＊)は必須項目です。</span>
  <table class="table table-bordered table-regist" style="margin-top: 8px;">
    <tbody>
      <tr>
        <td class="col-title">納入先名<span class="red">(＊)</span></td>
        <td>
          <input name="order_name" id="order_name" type="text" class="form-control form-control--default" value="{{ old('order_name') }}">
          @if ($errors->first('order_name'))
          <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_name') }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td class="col-title">部署名</td>
        <td>
          <input name="order_division" id="order_division" value="{{ old('order_division') }}" type="text" class="form-control form-control--default">
        </td>
      </tr>
      <tr>
        <td class="col-title">ご担当者名</td>
        <td>
          <input name="order_member" value="{{ old('order_member') }}" id="order_member" type="text" class="form-control form-control--default" value="摸利　裕樹　様">
        </td>
      </tr>
      <tr>
        <td class="col-title">郵便番号<span class="red">(＊)</span></td>
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
        <td class="col-title">住所<span class="red">(＊)</span></td>
        <td>
          <input name="order_address1" value="{{ old('order_address1') }}" id="order_address1" type="text" class="form-control form-control--default">
          @if ($errors->first('order_address1'))
          <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_address1') }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td class="col-title">住所（ビル名等）</td>
        <td>
          <input name="order_address2" value="{{ old('order_address2') }}" id="order_address2" type="text" class="form-control form-control--default">
        </td>
      </tr>
      <tr>
        <td class="col-title">電話番号<span class="red">(＊)</span></td>
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
        <td class="col-title">納品書同送<span class="red">(＊)</span></td>
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
    <div class="col-md-12 text-center"></div>
    <span class="col-md-12 text-center">
      <input onclick="history.back()" value="もどる" type="button" class="btn btn-sm btn-primary">
      <input value="変更内容を確認する" type="submit" class="btn btn-sm btn-primary mar-left40">
    </span>            
  </div>
  </form>
  
</div>

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
              $('#order_name').val(result.customer.得意先名);
              $('#order_zip3').val(result.customer.郵便番号);
              $('#order_zip4').val(result.customer.住所2);
              $('#order_address1').val(result.customer.住所1);
              $('#order_address2').val(result.customer.住所2);
              $('#order_tel').val(result.customer.電話番号);
              $('#order_fax').val(result.customer.FAX_番号);
              $('.order_invoice').prop('checked', false);
              
              $('#order_name').attr('value', result.customer.得意先名);
              $('#order_zip3').attr('value', result.customer.郵便番号);
              $('#order_zip4').attr('value', result.customer.住所2);
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