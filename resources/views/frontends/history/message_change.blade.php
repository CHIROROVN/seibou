@extends('frontends.main')

@section('content')


<div class="col-md-9 content-right">
  <h1>メッセージ及び発送方法・発送日時指定の変更</h1>
  
  {!! Form::open(array('route' => ['front.history.message_change'], 'enctype'=>'multipart/form-data')) !!}
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title" width="328px">メッセージ<br>
          <span style="font-size: 0.8em;">＊発送方法等でご要望がある際にお使いください。</span></td>
        <td><textarea type="text" name="order_content_2_change" class="form-control form-control--default" rows="3" style="width: 370px;">{{ trim($history->自由欄) }}</textarea></td>
      </tr>
      <tr>
        <td class="col-title">出荷方法<span class="red">(＊)</span></td>
        <td>
          @foreach ( $webmkb as $item )
            <input name="order_shipping_change" type="radio" value="{{ $item->ｺｰﾄﾞ }}" @if($history->出荷まとめ区分 == $item->ｺｰﾄﾞ) checked @endif>{{ $item->名称 }}<br>
          @endforeach
          <span style="color:red;">
          ※出荷までにお時間がかかることがございます。</span>
          @if ($errors->first('order_shipping_change'))
          <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $errors->first('order_shipping_change') }}</div>
          @endif
        </td>
      </tr>
      <tr>
        <td class="col-title">便出荷</td>
        <td>
          <input name="order_ship_fly_change" type="checkbox" value="1" @if($history->便出荷区分 == 1) checked @endif>
          便出荷を希望する 
        </td>
      </tr>
       <tr> </tr>
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


@stop