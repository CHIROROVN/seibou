@extends('frontends.main')

@section('content')

  <div class="col-md-9 content-right">
    <h1>納入先リストの新規登録</h1>
    <span class="red">(＊)は必須項目です。</span>
    {!! Form::open(array('route' => ['front.delivery.regist', 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8'])) !!}
    <table class="table table-bordered table-regist">
      <tbody>
        <tr>
          <td class="col-title">納入先名<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_name" value="{{old('delivery_name')}}" type="text" class="form-control form-control--default">
			@if ($errors->first('delivery_name'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_name') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">部署名</td>
          <td>
            <input name="delivery_division" value="{{old('delivery_division')}}" type="text" class="form-control form-control--default">
            @if ($errors->first('delivery_division'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_division') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">ご担当者名</td>
          <td>
            <input name="delivery_member" type="text" value="{{old('delivery_member')}}" class="form-control form-control--default">
            @if ($errors->first('delivery_member'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_member') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">郵便番号<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_zip3" type="text" value="{{old('delivery_zip3')}}" class="form-control form-control--small-xs"> - 
            <input name="delivery_zip4" type="text" value="{{old('delivery_zip4')}}" class="form-control form-control--small-xs" >
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
            <input name="delivery_address1" value="{{old('delivery_address1')}}" type="text" class="form-control form-control--default">
            @if ($errors->first('delivery_address1'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_address1') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">住所（ビル名等）</td>
          <td>
            <input name="delivery_address2" value="{{old('delivery_address2')}}" type="text" class="form-control form-control--default">
            @if ($errors->first('delivery_address2'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_address2') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">電話番号<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_tel" value="{{old('delivery_tel')}}" type="text" class="form-control form-control--small" >
            @if ($errors->first('delivery_tel'))
			<div class="help-block with-errors">
			<ul class="list-unstyled"><li>{!! $errors->first('delivery_tel') !!}</li></ul></div>
			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">FAX番号</td>
          <td>
            <input name="delivery_fax" value="{{old('delivery_fax')}}" type="text" class="form-control form-control--small">
            @if ($errors->first('delivery_fax'))
      			<div class="help-block with-errors">
      			<ul class="list-unstyled"><li>{!! $errors->first('delivery_fax') !!}</li></ul></div>
      			@endif
          </td>
        </tr>
        <tr>
          <td class="col-title">納品書同送<span class="red">(＊)</span></td>
          <td>
            <input name="delivery_satisfy" value="2" type="radio" @if(old('delivery_satisfy') == '2') checked="" @endif >可　<input name="delivery_satisfy" value="1" @if(old('delivery_satisfy') == '1') checked="" @endif type="radio">否　
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
        <input type="submit" value="確認する" class="btn btn-sm btn-primary">
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