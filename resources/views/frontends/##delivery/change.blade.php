@extends('frontends.main')

@section('content')

<div class="col-md-9 content-right">
	<h1>納入先リストの変更</h1>
	<span class="red">(＊)は必須項目です。</span>
	    {!! Form::open(array('route' => ['front.delivery.change',$delivery->delivery_id], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
	<table class="table table-bordered table-regist">
      <tbody>
        <tr>
          <td class="col-title">納入先名<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_name" value="@if(old('delivery_name')){{old('delivery_name')}}@else{{$delivery->delivery_name}}@endif" type="text" class="form-control form-control--default">
			@if ($errors->first('delivery_name'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_name') !!}</li></ul></div>
			@endif
          </td>
        </tr>

        <tr>
          <td class="col-title">部署名</td>
          <td>
            <input name="delivery_division" value="@if(old('delivery_division')){{old('delivery_division')}}@else{{$delivery->delivery_division}}@endif" type="text" class="form-control form-control--default">
            @if ($errors->first('delivery_division'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_division') !!}</li></ul></div>
			@endif
          </td>
        </tr>

        <tr>
          <td class="col-title">ご担当者名</td>
          <td>
            <input name="delivery_member" type="text" value="@if(old('delivery_member')){{old('delivery_member')}}@else{{$delivery->delivery_member}}@endif" class="form-control form-control--default">
            @if ($errors->first('delivery_member'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_member') !!}</li></ul></div>
			@endif
          </td>
        </tr>

        <tr>
          <td class="col-title">郵便番号<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_zip3" type="text" value="@if(old('delivery_zip3')){{old('delivery_zip3')}}@else{{$delivery->delivery_zip3}}@endif" class="form-control form-control--small-xs"> - 
            <input name="delivery_zip4" type="text" value="@if(old('delivery_zip4')){{old('delivery_zip4')}}@else{{$delivery->delivery_zip4}}@endif" class="form-control form-control--small-xs" >
            <div class="help-block with-errors">
	            @if ($errors->first('delivery_zip3'))
				<ul class="list-unstyled"><li>{!! $errors->first('delivery_zip3') !!}</li></ul>
				@endif
				@if ($errors->first('delivery_zip4'))
				<ul class="list-unstyled"><li>{!! $errors->first('delivery_zip4') !!}</li></ul>
				@endif
			</div>
          </td>
        </tr>
        <tr>
          <td class="col-title">住所<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_address1" value="@if(old('delivery_address1')){{old('delivery_address1')}}@else{{$delivery->delivery_address1}}@endif" type="text" class="form-control form-control--default">
            @if ($errors->first('delivery_address1'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_address1') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">住所（ビル名等）</td>
          <td>
            <input name="delivery_address2" value="@if(old('delivery_address2')){{old('delivery_address2')}}@else{{$delivery->delivery_address2}}@endif" type="text" class="form-control form-control--default">
            @if ($errors->first('delivery_address2'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_address2') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">電話番号<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_tel" value="@if(old('delivery_tel')){{old('delivery_tel')}}@else{{$delivery->delivery_tel}}@endif" type="text" class="form-control form-control--small" >
            @if ($errors->first('delivery_tel'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_tel') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">FAX番号</td>
          <td>
            <input name="delivery_fax" value="@if(old('delivery_fax')){{old('delivery_fax')}}@else{{$delivery->delivery_fax}}@endif" type="text" class="form-control form-control--small">
            @if ($errors->first('delivery_fax'))
      			<div class="help-block with-errors">
      			<ul class="list-unstyled"><li>{!! $errors->first('delivery_fax') !!}</li></ul></div>
      			@endif
          </td>
        </tr>

        <tr>
          <td class="col-title">納品書同送<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_satisfy" value="2" type="radio" @if($delivery->delivery_free1 == '2') checked="" @elseif(old('delivery_satisfy') == '2') checked="" @endif >可　<input name="delivery_satisfy" value="1" @if($delivery->delivery_free1 == '1') checked="" @elseif(old('delivery_satisfy') == '1') checked="" @endif type="radio">否　
            @if ($errors->first('delivery_satisfy'))
            <div class="help-block with-errors">
            <ul class="list-unstyled"><li>{!! $errors->first('delivery_satisfy') !!}</li></ul></div>
            @endif
          </td>
        </tr>

      </tbody>
    </table>

	<div class="row mar-bottom30">
	<div class="col-md-12 text-center">
	<input value="確認する" type="submit" class="btn btn-sm btn-primary">
	</div>
	</div>
	<div class="row">
	<div class="col-md-12 text-center">
	<input onclick="location.href='{{route('front.delivery.index')}}'" value="納入先リスト一覧に戻る" type="button" class="btn btn-sm btn-primary">
	</div>
	</div>
	{!! Form::close() !!}
</div>
@stop