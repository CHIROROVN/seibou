@extends('frontends.main')

@section('content')

  <div class="col-md-9 content-right content--list ">
    <h1 class="mar-bottom30">納入先リストの一覧</h1>
    <div class="row text-right">
      <div class="col-md-12">
        <input onclick="location.href='{{route('front.delivery.regist')}}'"  value="新規登録" type="button" class="btn btn-xs btn-primary">
      </div>
    </div>
    <table class="table table-bordered table-striped clearfix">
      <tr>
        <td class="col-title" align="center">名称</td>
        <td class="col-title" align="center">住所</td>
        <td class="col-title" align="center">納入先設定</td>
        <td class="col-title" align="center">詳細・変更・削除</td>
      </tr>
      @if(count($deliveries) > 0)
	      @foreach($deliveries as $delivery)
		      <tr>
		        <td>@if($delivery->delivery_free2 == '1')<span style="color:#f00;font-size: 1.2em;">★ </span>@endif {{$delivery->delivery_name}}</td>
		        <td>{{$delivery->delivery_address1}}</td>
		        <td align="center">
		        <input onclick="location.href='{{route('front.delivery.addrs_default',$delivery->delivery_id)}}'" value="設定" type="button" class="btn btn-xs btn-primary">
		        </td>
		        <td align="center">
		          <input onclick="location.href='{{route('front.delivery.detail',$delivery->delivery_id)}}'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
		        </td>
		      </tr>
	      @endforeach
      @else
      <tr><td colspan="3" style="text-align: center;">該当するデータがありません。</td></tr>

      @endif

    </table>
    <span style="color:#f00;font-size: 1.2em;">★ </span>は通常使う納入先です。
  </div>

@stop