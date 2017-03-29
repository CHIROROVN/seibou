@extends('frontends.main')

@section('content')

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
                  @if ( $history->出荷区分 == 1 )
                  1
                  @elseif ( $history->出荷区分 == 11 )
                  11
                  @elseif ( $history->出荷区分 == 31 )
                  31
                  @elseif ( $history->出荷区分 == 51 )
                  51
                  @endif
                </td>
              </tr>
            </table>

            <h1>発注内容<span style="float:right;"><input onclick="location.href='history_detail_2.html'" value="発注内容の変更" type="button" class="btn btn-sm btn-primary" style="border-radius:0px;text-decoration:underline;"></span></h1>
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
                    @if ( $product && $product->商品CD == $historyProduct->商品CD )
                    {{ $product->商品名 }}
                    @endif
                  </td>
                  <td>
                    @if ( $color && $color->色CD == $historyProduct->色CD )
                    {{ $color->色名 }}
                    @endif
                  </td>
                  <td>
                    @if ( $size && $size->ｻｲｽﾞCD == $historyProduct->ｻｲｽﾞCD )
                    {{ $size->ｻｲｽﾞ名 }}
                    @endif
                  </td>
                  <td align="right">{{ $historyProduct->数量 }}</td>
                  <td></td>
                </tr>
                @endforeach
              @endif
              
            </table>
            <br>
            
                       <h1>得意先担当者情報<span style="float:right;"><input onclick="location.href='staff_change.html'" value="得意先担当者の変更" type="button" class="btn btn-sm btn-primary mar-left40" style="border-radius:0px;text-decoration:underline;">
</span></h1>
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
            
            <h1>納入先<span style="float:right;"><input onclick="location.href='order_change.html'" value="納入先の変更" type="button" class="btn btn-sm btn-primary mar-left40" style="border-radius:0px;text-decoration:underline;">
</span></h1>
            <table class="table table-bordered table-regist">
              <tbody>
                <tr>
                  <td class="col-title">納入先：</td>
                  <td>
                    {{ $delivery->delivery_name }} {{ $delivery->delivery_address1 }} {{ $delivery->delivery_address2 }}
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table table-bordered table-regist">
              <tbody>
                <tr>
                  <td class="col-title">納入先名</td>
                  <td>{{ $delivery->delivery_name }}</td>
                </tr>
                <tr>
                  <td class="col-title">部署名</td>
                  <td>{{ $delivery->delivery_division }}</td>
                </tr>
                <tr>
                  <td class="col-title">ご担当者名</td>
                  <td>{{ $delivery->delivery_member }}</td>
                </tr>
                <tr>
                  <td class="col-title">郵便番号</td>
                  <td>{{ $delivery->delivery_zip3 }}-{{ $delivery->delivery_zip4 }}</td>
                </tr>
                <tr>
                  <td class="col-title">住所</td>
                  <td>{{ $delivery->delivery_address1 }}</td>
                </tr>
                <tr>
                  <td class="col-title">住所（ビル名等）</td>
                  <td>{{ $delivery->delivery_address2 }}</td>
                </tr>
                <tr>
                  <td class="col-title">電話番号</td>
                  <td>{{ $delivery->delivery_tel }}</td>
                </tr>
                <tr>
                  <td class="col-title">FAX番号</td>
                  <td>{{ $delivery->delivery_fax }}</td>
                </tr>
              </tbody>
            </table>
            <h1>発注履歴参照</h1>
      
      {!! Form::open(array('route' => ['front.history.index'], 'method' => 'get', 'enctype'=>'multipart/form-data')) !!}
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
                if ( isset(Session::get('historyWhere')['from_year']) && Session::get('historyWhere')['from_year'] == $i ) {
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
                if ( isset(Session::get('historyWhere')['from_month']) && Session::get('historyWhere')['from_month'] == $i ) {
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
                if ( isset(Session::get('historyWhere')['from_day']) && Session::get('historyWhere')['from_day'] == $i ) {
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
                if ( isset(Session::get('historyWhere')['to_year']) && Session::get('historyWhere')['to_year'] == $i ) {
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
                if ( isset(Session::get('historyWhere')['to_month']) && Session::get('historyWhere')['to_month'] == $i ) {
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
                if ( isset(Session::get('historyWhere')['to_day']) && Session::get('historyWhere')['to_day'] == $i ) {
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
              if ( isset(Session::get('historyWhere')['web_order_id']) ) {
                $value = Session::get('historyWhere')['web_order_id'];
              }
              ?>
              <input name="web_order_id" value="{{ $value }}" type="text" class="form-control form-control--default">
              を含む </td>
          </tr>
          <tr>
            <td>出荷区分</td>
            <td>
              <select name="status" id="status" class="form-control form-control--small">
                <option value="1" <?php echo (isset(Session::get('historyWhere')['status']) && Session::get('historyWhere')['status'] == 1) ? 'selected' : '' ?> >仮発注</option>
                <option value="11" <?php echo (isset(Session::get('historyWhere')['status']) && Session::get('historyWhere')['status'] == 11) ? 'selected' : '' ?> >発注済</option>
                <option value="31" <?php echo (isset(Session::get('historyWhere')['status']) && Session::get('historyWhere')['status'] == 31) ? 'selected' : '' ?> >出荷済</option>
                <option value="51" <?php echo (isset(Session::get('historyWhere')['status']) && Session::get('historyWhere')['status'] == 51) ? 'selected' : '' ?> >51</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
      </form>
      <table class="table table-bordered table-striped clearfix">
        <tr>
          <td class="col-title" align="center">伝票No</td>
          <td class="col-title" align="center">発注日</td>
          <td class="col-title" align="center">区分</td>
          <td class="col-title" align="center" width="70px">詳細</td>
          <td class="col-title" align="center" width="70px">発注キャンセル</td>
          <td class="col-title" align="center" width="70px">発注内容変更</td>
        </tr>
        
        @foreach ( $historys as $history )
        <tr>
          <td>{{ $history->商品CD }}</td>
          <td>{{ formatDate($history->受注日) }}</td>
          <td>
            @if ( $history->出荷区分 == 1 )
            仮発注
            @elseif ( $history->出荷区分 == 11 )
            発注済
            @elseif ( $history->出荷区分 == 31 )
            出荷済
            @elseif ( $history->出荷区分 == 51 )
            51
            @endif
          </td>
          <td align="center"><input onclick="location.href='{{ route('front.history.detail', $history->伝票No) }}'" value="詳細" type="button" class="btn btn-xs btn-primary"></td>
          <td align="center"><input onclick="location.href='history_cancel.html'" value="キャンセル" type="button" class="btn btn-xs btn-primary" @if($history->出荷区分 != 1) disable @endif></td>
          <td align="center"><input onclick="location.href='history_detail_2.html'" value="変更" type="button" class="btn btn-xs btn-primary" @if($history->出荷区分 != 1) disable @endif></td>
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