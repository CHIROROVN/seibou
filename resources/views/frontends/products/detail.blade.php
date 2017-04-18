@extends('frontends.main')

@section('content')

  <div class="col-md-9 content-right">
    <h1>商品詳細</h1>
    {!! Form::open(array('route' => ['front.products.cart', trim($product->商品CD)], 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
    <table class="table table-bordered table-striped clearfix">
      <tbody><tr>
        <td class="col-title" align="center">品番</td>
        <td>{{ trim($product->商品CD) }}</td>
      </tr>
      <tr>
        <td class="col-title" align="center">商品名</td>
        <td>{{ $product->商品名 }}</td>
      </tr>
    </tbody></table>
    <h1>在庫表示</h1>
    <table class="table table-bordered table-striped clearfix custom-table-static">
      <tbody>
      <tr>
        <td class="col-title custom-first-col" align="center">↓色／サイズ→</td>
        
        @if ( count($sizes) > 0 )
          @foreach ( $sizes as $size )
          <td class="col-title col-title-custom" align="center">{{ $size->ｻｲｽﾞ名 }}</td>
          @endforeach
        @endif
        
      </tr>
      
      @if ( count($colors) > 0 )
        @foreach ( $colors as $color )
        <tr>
          <td>
            {{ $color->色名 }}
            @if ( $color->WEB用廃番区分 == 1 )
            <span style="color:red;">※廃色</span>
            @endif
          </td>
          @if ( count($sizes) > 0 )
            @foreach ( $sizes as $size )
              <?php
              $quantity = 0;
              if ( isset($quantityStockMeisai[trim($product->商品CD) . '-' . $color->色CD . '-' . $size->ｻｲｽﾞCD]) ) {
                $quantity = $quantityStockMeisai[trim($product->商品CD) . '-' . $color->色CD . '-' . $size->ｻｲｽﾞCD];
              }
              ?>
            <td align="center">{{ $quantity }}<br><input type="text" size="2" name="quantity_{{trim($product->商品CD)}}_{{$color->色CD}}_{{$size->ｻｲｽﾞCD}}"></td>
            @endforeach
          @endif
        </tr>
        @endforeach
      @endif
      
    </tbody></table>
    
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input value="発注リストに入れる" type="submit" class="btn btn-sm btn-primary" name="">
      </div>
    </div>
    </form>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{ route('front.products.search', ['back' => 'back']) }}'" value="条件を変えて再検索" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
		  
@stop