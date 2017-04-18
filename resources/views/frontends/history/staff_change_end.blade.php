@extends('frontends.main')

@section('content')


<div class="col-md-9 content-right">
<h1 class="text-orange">以下の担当者情報を変更しました。</h1>

  
 <h1>得意先担当者情報</h1>
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title">得意先担当者名　　　　　　　</td>
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
     <input onclick="location.href='{{ route('front.history.detail', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="発注詳細にもどる" type="button" class="btn btn-sm btn-primary">
    </div>
  </div>
</div>


@stop