@extends('frontends.main')

@section('content')
  <div class="col-md-9 content-right">
    <h1>納入先リストの新規登録（確認）</h1>
    <table class="table table-bordered table-regist">
      <tbody>
        <tr>
          <td class="col-title">納入先名</td>
          <td>
            {{$delivery->delivery_name}}
          </td>
        </tr>
        <tr>
          <td class="col-title">部署名</td>
          <td>
            {{$delivery->delivery_division}}　
          </td>
        </tr>
        <tr>
          <td class="col-title">ご担当者名</td>
          <td>
            {{$delivery->delivery_member}}
          </td>
        </tr>
        <tr>
          <td class="col-title">郵便番号</td>
          <td>
            {{$delivery->delivery_zip3}}-{{$delivery->delivery_zip4}}
          </td>
        </tr>
        <tr>
          <td class="col-title">住所</td>
          <td>
            {{$delivery->delivery_address1}}
          </td>
        </tr>
        <tr>
          <td class="col-title">住所（ビル名等）</td>
          <td>
            {{$delivery->delivery_address2}}
          </td>
        </tr>
        <tr>
          <td class="col-title">電話番号</td>
          <td>
            {{$delivery->delivery_tel}}
          </td>
        </tr>
        <tr>
          <td class="col-title">FAX番号</td>
          <td>
            {{$delivery->delivery_fax}}
          </td>
        </tr>
        <tr>
          <td class="col-title">納品書同送</td>
          <td>
            @foreach ( $webdkb as $item )
            	@if($delivery->delivery_free1 == $item->ｺｰﾄﾞ) {{ $item->名称 }} @endif
            @endforeach
          </td>
        </tr>
      </tbody>
    </table>
    
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('front.delivery.regist_save')}}'" value="登録する" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="window.history.back();" value="戻る" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
@stop