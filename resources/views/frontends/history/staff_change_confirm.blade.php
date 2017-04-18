@extends('frontends.main')

@section('content')


<div class="col-md-9 content-right"><span style="font-size:20px; font-weight: bold; border-bottom: solid 2px #14578b; color: #14578b; ">変更最終確認</span><p style="color: red;font-size:1.1em;"><b>変更処理はまだ完了していません。</b></p>
  <h1>得意先担当者情報の変更</h1>
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title" style="width: 346px;">得意先担当者名　　　　　　　</td>
        <td>
        {{ $staffChange['order_name_change'] }}
        </td>
      </tr>
      <tr>
        <td class="col-title">備考</td>
        <td>
          {!! nl2br($staffChange['order_content_change']) !!}
        </td>
      </tr>
    </tbody>
  </table>            
  
  <div class="row mar-bottom30">
    <div class="col-md-12 text-center">
      <input onclick="history.back()" value="もどる" type="button" class="btn btn-sm btn-primary">
   <br>
     <button onclick="location.href='{{ route('front.history.staff_change.end') }}'" value="" type="button" class="btn btn-sm btn-primary mar-left40" style="font-size: 1.2em; background-color: #FF9326; margin-left:0; border:solid 1px #D96C00; margin-top: 10px;">変更する</button>
    </div>
  </div>
</div>


@stop