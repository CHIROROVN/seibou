@extends('frontends.main')

@section('content')

<div class="col-md-9 content-right"><span style="font-size:20px; font-weight: bold; border-bottom: solid 2px #14578b; color: #14578b; ">変更最終確認</span><p style="color: red;font-size:1.1em;"><b>変更処理はまだ完了していません。</b></p>
  <h1>納入先の変更</h1>
  
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title">納入先：</td>
        <td>
          {{ $orderChange['order_name'] }} {{ $orderChange['order_address1'] }} {{ $orderChange['order_address2'] }}
        </td>
      </tr>
    </tbody>
  </table>
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title">納入先名</td>
        <td>
        {{ $orderChange['order_name'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">部署名</td>
        <td>{{ $orderChange['order_division'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">ご担当者名</td>
        <td>{{ $orderChange['order_member'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">郵便番号</td>
        <td>{{ $orderChange['order_zip3'] }}-{{ $orderChange['order_zip4'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">住所</td>
        <td>
          {{ $orderChange['order_address1'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">住所（ビル名等）</td>
        <td>
          {{ $orderChange['order_address2'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">電話番号</td>
        <td>
          {{ $orderChange['order_tel'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">FAX番号</td>
        <td>
          {{ $orderChange['order_fax'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">納品書同送</td>
        <td>
          @foreach ( $webdkb as $item )
            @if ( $orderChange['order_invoice'] == $item->ｺｰﾄﾞ )
            {{ $item->名称 }}
            @endif
          @endforeach
        </td>
      </tr>
    </tbody>
  </table>

  
  <div class="row mar-bottom30">
    <div class="col-md-12 text-center"><input onclick="history.back()" value="もどる" type="button" class="btn btn-sm btn-primary">
   <br>
     <button onclick="location.href='{{ route('front.history.order_change.end') }}'" value="" type="button" class="btn btn-sm btn-primary mar-left40" style="font-size: 1.2em; background-color: #FF9326; margin-left:0; border:solid 1px #D96C00; margin-top: 10px;">変更する</button>
      
     
    </div>
  </div>
</div>


@stop