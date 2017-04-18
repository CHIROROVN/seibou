@extends('frontends.main')

@section('content')


<div class="col-md-9 content-right">
  <h1 class="text-orange">以下の納入先情報を変更しました。</h1>
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
        <td>
          　{{ $orderChange['order_division'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">ご担当者名</td>
        <td>
          {{ $orderChange['order_member'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">郵便番号</td>
        <td>
          {{ $orderChange['order_zip3'] }}-{{ $orderChange['order_zip4'] }}
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
    <div class="col-md-12 text-center">
      <input onclick="location.href='{{ route('front.history.detail', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="発注詳細にもどる" type="button" class="btn btn-sm btn-primary">
    </div>
  </div>
</div>


@stop