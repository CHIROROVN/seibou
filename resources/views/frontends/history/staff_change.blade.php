@extends('frontends.main')

@section('content')


<div class="col-md-9 content-right">
  <h1>得意先担当者情報の変更</h1>
  
  {!! Form::open(array('route' => ['front.history.staff_change'], 'enctype'=>'multipart/form-data')) !!}
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title">得意先担当者名　　　　</td>
        <td>
          <input name="order_name_change" type="text" class="form-control form-control--default" value="{{ $history->得意先担当者名 }}">
        </td>
      </tr>
      <tr>
        <td class="col-title">備考<br>
          <span style="font-size: 0.8em;">＊納入先が営業所留めで<br>
          納品書が不要な場合等にご使用ください。</span></td>
        <td>
          <textarea name="order_content_change" rows="2" cols="32" style="border:solid 1px #ccc;">{!! nl2br(trim($history->備考)) !!}</textarea>
        </td>
      </tr>
      <tr>
      </tr>
    </tbody>
  </table>
  
  
  <div class="row mar-bottom30">
    <div class="col-md-12 text-center"></div>
    <span class="col-md-12 text-center">
      <input onClick="location.href='history.back()" value="もどる" type="button" class="btn btn-sm btn-primary">
      <input value="変更内容を確認する" type="submit" class="btn btn-sm btn-primary mar-left40">
    </span> 
  </div>
  </form>
  
</div>


@stop