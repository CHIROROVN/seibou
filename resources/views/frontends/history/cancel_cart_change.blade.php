@extends('frontends.main')

@section('content')

{!! Form::open(array('route' => ['front.history.cancel.cart_change'], 'enctype'=>'multipart/form-data')) !!}
  
  <div class="col-md-9 content-right">
            <h1>発注詳細</h1>
            <table class="table table-bordered table-striped clearfix">
              <tr>
                <td class="col-title" align="center">伝票No</td>
                <td class="col-title" align="center">発注日</td>
                <td class="col-title" align="center">区分</td>
              </tr>
              <tr>
                <td>{{ $history->伝票No }}</td>
                <td>{{ formatDate($history->受注日) }}</td>
                <td>
                  @foreach ( $webskb as $item )
                    @if ( $item->ｺｰﾄﾞ == $history->出荷区分 )
                    {{ $item->名称 }}
                    <?php break; ?>
                    @endif
                  @endforeach
                </td>
              </tr>
            </table>

            <h1>発注内容変更</h1>
            <p class="text-orange" style="padding-bottom:0;">★印の商品は、在庫がない場合にのみ表示されます。</p>
            <table class="table table-bordered table-striped clearfix" style="margin-bottom: 10px;">
              <tr>
                <td width="8%" align="center" class="col-title">品番</td>
                <td width="18%" align="center" class="col-title">商品名</td>
                <td width="16%" align="center" class="col-title">カラー</td>
                <td width="15%" align="center" class="col-title">サイズ</td>
                <td width="10%" align="center" class="col-title">数量</td>
                <td width="17%" align="center" class="col-title"><p>変更後の数量</p></td>
                <td class="col-title" align="center">摘要</td>
                <td width="16%" align="center" class="col-title">備考</td>
              </tr>
              
              @if ( $historyProducts && count($historyProducts) > 0 )
                @foreach ( $historyProducts as $historyProduct )
                <tr>
                  <td>{{ $historyProduct->商品CD }}</td>
                  <td>
                    @if ( $products )
                      @foreach ( $products as $product )
                        @if ( $product->商品CD == $historyProduct->商品CD )
                        {{ $product->商品名 }}
                        <?php break ?>
                        @endif
                      @endforeach
                    @endif
                  </td>
                  <td>
                    @if ( $colors )
                      @foreach ( $colors as $color )
                        @if ( $color->商品CD == $historyProduct->商品CD && $color->色CD == $historyProduct->色CD )
                        {{ $color->色名 }}
                        <?php break ?>
                        @endif
                      @endforeach
                    @endif
                  </td>
                  <td>
                    @if ( $sizes )
                      @foreach ( $sizes as $size )
                        @if ( $size->商品CD == $historyProduct->商品CD && $size->ｻｲｽﾞCD == $historyProduct->ｻｲｽﾞCD )
                        {{ $size->ｻｲｽﾞ名 }}
                        <?php break ?>
                        @endif
                      @endforeach
                    @endif
                  </td>
                  <td align="right">{{ $historyProduct->数量 }}</td>
                  <td><div class="col-xs-10 col-xs-offset-1"><input name="quantityChange_{{$historyProduct->伝票No}}_{{$historyProduct->伝票行No}}" type="text" class="text-right col-sm-10" style="padding: 0"></div></td>
                  <td><input type="text" size="5" name="itemCodeByCustomerChange_{{$historyProduct->伝票No}}_{{$historyProduct->伝票行No}}"></td>
                  
                  <?php $cls = '' ?>
                  @if ( $historyProduct->納期連絡区分 == 2 )
                  <?php $cls = 'text-orange' ?>
                  @endif
                  <td class="{{ $cls }}">
                    @if ( $historyProduct->納期連絡区分 == 2 )
                    ★
                    @endif
                  </td>
                </tr>
                @endforeach
              @endif
              
            </table>
            <br>
        
      </table>
      
            <div class="row mar-bottom30">
              <div class="col-md-12 text-center"></div>
              <span class="col-md-12 text-center">
                <input onclick="history.back()" value="もどる" type="button" class="btn btn-sm btn-primary">
                <input value="変更内容を確認する" type="submit" class="btn btn-sm btn-primary mar-left40">
              </span>            
            </div>
            
          </div>
</form>
@stop