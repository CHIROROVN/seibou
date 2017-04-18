@extends('frontends.main')

@section('content')
  <div class="col-md-9 content-right">
  <div class="chui" style="clear:both; font-size: 1.3em;" align="center">
  以下の商品はキャンセル済みです。
  </div>
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

  <h1>発注内容（こちらの内容は納品書に印字されます）</h1>
  <p class="text-orange" style="padding-bottom:0;">★印の商品は、在庫がない場合にのみ表示されます。</p>
  <table class="table table-bordered table-striped clearfix" style="margin-bottom: 10px;">
    <tr>
      <td class="col-title" align="center">品番</td>
      <td class="col-title" align="center">商品名</td>
      <td class="col-title" align="center">カラー</td>
      <td class="col-title" align="center">サイズ</td>
      <td class="col-title" align="center">数量</td>
      <td class="col-title" align="center">備考</td>
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
  
  <h1>得意先担当者情報（こちらの内容は納品書に印字されます）</h1>
  <table class="table table-bordered table-regist">
    <tbody>
      <tr>
        <td class="col-title" style="width: 345px;">得意先担当者名　　　　　　　</td>
        <td>
        {{ $historyProduct->得意先担当者名 }}
        </td>
      </tr>
      <tr>
        <td class="col-title">備考</td>
        <td>
          {!! nl2br($historyProduct->備考) !!}
        </td>
      </tr>
    </tbody>
  </table>
  
  <h1>メッセージ及び発送方法・発送日時指定（こちらの内容は納品書に印字されません）</h1>
  </span></h1>
    <table class="table table-bordered table-regist">
      <tbody>
        <tr>
          <td class="col-title">納入先：</td>
          <td>
            {{ $history->得意先担当者名 }} {{ $history->WEB納入先住所1 }} {{ $history->WEB納入先住所2 }}
          </td>
        </tr>
      </tbody>
    </table>

    <table class="table table-bordered table-regist">
      <tbody>
        <tr>
          <td class="col-title">納入先名</td>
          <td>{{ $history->得意先担当者名 }}</td>
        </tr>
        <tr>
          <td class="col-title">部署名</td>
          <td>{{ $history->WEB納入先部署名 }}</td>
        </tr>
        <tr>
          <td class="col-title">ご担当者名</td>
          <td>{{ $history->WEB納入先担当者名 }}</td>
        </tr>
        <tr>
          <td class="col-title">郵便番号</td>
          <td>{{ $history->WEB納入先郵便番号 }}</td>
        </tr>
        <tr>
          <td class="col-title">住所</td>
          <td>{{ $history->WEB納入先住所1 }}</td>
        </tr>
        <tr>
          <td class="col-title">住所（ビル名等）</td>
          <td>{{ $history->WEB納入先住所2 }}</td>
        </tr>
        <tr>
          <td class="col-title">電話番号</td>
          <td>{{ $history->WEB納入先電話番号 }}</td>
        </tr>
        <tr>
          <td class="col-title">FAX番号</td>
          <td>{{ $history->WEB納入先FAX_番号 }}</td>
        </tr>
      </tbody>
    </table>
  <h1>発注履歴参照</h1>

  {!! Form::open(array('route' => ['front.history.cancel_detail'], 'method' => 'get', 'enctype'=>'multipart/form-data')) !!}
  <input type="hidden" name="id" value="{{ $history->伝票No }}" />
  <input type="hidden" name="id1" value="{{ $history->伝票行No }}" />
  
  <table class="table table-bordered table-regist">
    <tbody>
    <tr>
      <td class="col-title" rowspan="3">絞込検索</td>
      <td>発注日</td>
      <td><select name="from_year" class="form-control form-control--small-xs form-control--mar-right">
          <option value="">--年</option>
          @for ( $i = 2016; $i <= date('Y') + 1; $i++ )
          <?php
          $value = '';
          if ( isset($where['from_year']) && $where['from_year'] == $i ) {
            $value = 'selected';
          }
          ?>
          <option value="{{ $i }}" {{ $value }} >{{ $i }}</option>
          @endfor
        </select>
        <select name="from_month" class="form-control form-control--small-xs form-control--mar-right">
          <option value="">--月</option>
          @for ( $i = 1; $i <= 12; $i++ )
          <?php
          $value = '';
          if ( isset($where['from_month']) && $where['from_month'] == $i ) {
            $value = 'selected';
          }
          ?>
          <option value="{{ $i }}" {{ $value }} >{{ $i }}</option>  
          @endfor
        </select>
        <select name="from_day" class="form-control form-control--small-xs">
          <option value="">--日</option>
          @for ( $i = 1; $i <= 31; $i++ )
          <?php
          $value = '';
          if ( isset($where['from_day']) && $where['from_day'] == $i ) {
            $value = 'selected';
          }
          ?>
          <option value="{{ $i }}" {{ $value }} >{{ $i }}</option>  
          @endfor
        </select>
        ～
        <select name="to_year" class="form-control form-control--small-xs form-control--mar-right">
          <option value="">--年</option>
          @for ( $i = 2016; $i <= date('Y') + 1; $i++ )
          <?php
          $value = '';
          if ( isset($where['to_year']) && $where['to_year'] == $i ) {
            $value = 'selected';
          }
          ?>
          <option value="{{ $i }}" {{ $value }} >{{ $i }}</option>
          @endfor
        </select>
        <select name="to_month" class="form-control form-control--small-xs form-control--mar-right">
          <option value="">--月</option>
          @for ( $i = 1; $i <= 12; $i++ )
          <?php
          $value = '';
          if ( isset($where['to_month']) && $where['to_month'] == $i ) {
            $value = 'selected';
          }
          ?>
          <option value="{{ $i }}" {{ $value }} >{{ $i }}</option>  
          @endfor
        </select>
        <select name="to_day" class="form-control form-control--small-xs">
          <option value="">--日</option>
          @for ( $i = 1; $i <= 31; $i++ )
          <?php
          $value = '';
          if ( isset($where['to_day']) && $where['to_day'] == $i ) {
            $value = 'selected';
          }
          ?>
          <option value="{{ $i }}" {{ $value }} >{{ $i }}</option>  
          @endfor
        </select>
      </td>
      <td rowspan="3"><input name="button" value="絞り込み" type="submit" class="btn btn-sm btn-primary"></td>
    </tr>
    <tr>
      <td>品番</td>
      <td>
        <?php
        $value = '';
        if ( isset($where['web_order_id']) ) {
          $value = $where['web_order_id'];
        }
        ?>
        <input name="web_order_id" value="{{ $value }}" type="text" class="form-control form-control--default">
        を含む </td>
    </tr>
    <tr>
      <td>出荷区分</td>
      <td>
        <select name="status" id="status" class="form-control form-control--small">
          
        @foreach ( $webskb as $item )
        <option value="{{ $item->ｺｰﾄﾞ }}" <?php echo (isset($where['status']) && $where['status'] == $item->ｺｰﾄﾞ) ? 'selected' : '' ?> >{{ $item->名称 }}</option>
        @endforeach
        
        </select>
      </td>
    </tr>
    </tbody>
    </table>
    </form>
    
    <table class="table table-bordered table-striped clearfix">
    <tr>
      <td class="col-title" align="center">WebNo</td>
      <td class="col-title" align="center">発注日</td>
      <td class="col-title" align="center">区分</td>
      <td class="col-title" align="center" width="70px">詳細</td>
      <td class="col-title" align="center" width="70px">発注キャンセル</td>
      <td class="col-title" align="center" width="70px">発注内容変更</td>
    </tr>

    @foreach ( $historys as $history )
    <tr>
      <td>{{ $history->伝票No }}</td>
      <td>{{ empty($history->受注日) ? '' : date('Y/m/d', strtotime($history->受注日)) }}</td>
      <td>
        @foreach ( $webskb as $item )
          @if ( $history->出荷区分 == $item->ｺｰﾄﾞ )
          {{ $item->名称 }}
          @endif
        @endforeach
      </td>
      <td align="center">
        <?php 
        $param = array(
            'id'              => $history->伝票No,
            'id1'             => $history->伝票行No,
            
            'from_year'       => (isset($where['from_year'])) ? $where['from_year'] : '',
            'from_month'      => (isset($where['from_month'])) ? $where['from_month'] : '',
            'from_day'        => (isset($where['from_day'])) ? $where['from_day'] : '',
            'to_year'         => (isset($where['to_year'])) ? $where['to_year'] : '',
            'to_month'        => (isset($where['to_month'])) ? $where['to_month'] : '',
            'to_day'          => (isset($where['to_day'])) ? $where['to_day'] : '',
            'web_order_id'    => (isset($where['web_order_id'])) ? $where['web_order_id'] : '',
            'status'          => (isset($where['status'])) ? $where['status'] : '',
        );
        ?>
        @if ( $history->出荷区分 == 31 )
        <input onclick="location.href='{{ route('front.history.cancel_detail', $param) }}'" value="詳細" type="button" class="btn btn-xs btn-primary">
        @else
        <input onclick="location.href='{{ route('front.history.detail', $param) }}'" value="詳細" type="button" class="btn btn-xs btn-primary">
        @endif
      </td>
      <td align="center">
        @if ( $history->出荷区分 == 1 ) 
        <input onclick="location.href='{{ route('front.history.cancel', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="キャンセル" type="button" class="btn btn-xs btn-primary">
        @elseif ( $history->出荷区分 == 11 || $history->出荷区分 == 21 )
        <input onclick="location.href='{{ route('front.history.cancel', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="キャンセル" type="button" class="btn btn-xs btn-primary" disable>
        else
        ''
        @endif
      </td>
      <td align="center">
        @if ( $history->出荷区分 == 1 ) 
        <input onclick="location.href='{{ route('front.history.cart_change', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="変更" type="button" class="btn btn-xs btn-primary" >
        @elseif ( $history->出荷区分 == 11 || $history->出荷区分 == 21 )
        <input onclick="location.href='{{ route('front.history.cart_change', ['id' => $history->伝票No, 'id1' => $history->伝票行No]) }}'" value="変更" type="button" class="btn btn-xs btn-primary" disable >
        else
        ''
        @endif
      </td>
    </tr>
    @endforeach

  </table>
  
  <div class="row mar-bottom30">
    <div class="col-md-12 text-center">
      <input onclick="location.href='{{ route('front.history.index') }}'" value="発注履歴一覧に戻る" type="button" class="btn btn-sm btn-primary">
    </div>
  </div>
</div>
		  
@stop