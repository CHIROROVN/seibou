@extends('frontends.main')

@section('content')

  <div class="col-md-9 content-right">
    <h1>検索結果一覧</h1>
    <?php
      $search1 = '';
      $search2 = '';
      $search3 = '';
      if ( Session::get('dataSearch') && Session::get('dataSearch')['item_code_1'] != '' ) {
        $search1 = '"' . Session::get('dataSearch')['item_code_1'] . '"';
      }
      if ( Session::get('dataSearch') && Session::get('dataSearch')['item_code_2'] != '' ) {
        $search2 = '"' . Session::get('dataSearch')['item_code_2'] . '"';
      }
      if ( Session::get('dataSearch') && Session::get('dataSearch')['item_code_3'] != '' ) {
        $search3 = '"' . Session::get('dataSearch')['item_code_3'] . '"';
      }
    ?>
    <p>品番 {{ $search1.$search2.$search3 }} で検索の結果、{{ count($products) }}件が該当しました。</p>
    <table class="table table-bordered table-striped clearfix">
      <tbody><tr>
        <td class="col-title" align="center">品番</td>
        <td class="col-title" align="center">商品名</td>
        <td class="col-title" align="center">色</td>
        <td class="col-title" align="center">サイズ</td>
        <td class="col-title" align="center">詳細を表示</td>
      </tr>
      
      @if ( count($products) > 0 )
        @foreach ( $products as $product )
        <tr>
          <td>{{ $product->商品CD }}</td>
          <td>
            {{ $product->商品名 }}
            @if ( $product->WEB用廃番区分 ==  1 )
            <span style="color:red;">※廃番</span>
            @endif
          </td>
          <td>
            @if ( is_array($product->colors) && count($product->colors) > 0 )
              @foreach ( $product->colors as $color )
              {{ $color }}<br/>
              @endforeach
            @endif
          </td>
          <td>
            @if ( is_array($product->sizes) && count($product->sizes) > 0 )
              @foreach ( $product->sizes as $size )
              {{ $size }}<br/>
              @endforeach
            @endif
          </td>
          <td align="center">
            <input onclick="location.href='{{ route('front.products.detail', trim($product->商品CD)) }}'" value="詳細を表示" type="button" class="btn btn-xs btn-primary">
          </td>
        </tr>
        @endforeach
      @endif
      
    </tbody></table>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <a href="{{ route('front.products.search', ['back' => 'back']) }}" class="btn btn-sm btn-primary">条件を変えて再検索</a>
      </div>
    </div>
  </div>
		  
@stop