@extends('frontends.main')

@section('content')
  <div class="col-md-9 content-right">
    @if ( $historys && count($historys) > 0 )
    <div class="chui" style="clear:both; font-size: 1.6em;" align="left">
    刺繍、名入れ等の加工品、別注品は、本Webシステムから発注できません。
    </div>
    <div style="font-size:1.2em;" align="center">別途弊社までお問い合わせください。</div>
    <div style="clear:both;"></div>
    @endif
    
    <h1>発注履歴参照</h1>
    {!! Form::open(array('route' => ['front.history.index'], 'method' => 'get', 'enctype'=>'multipart/form-data')) !!}
    <table class="table table-bordered table-regist">
      <tbody>
        <tr>
          <td class="col-title" rowspan="3">絞込検索</td>
          <td>発注日</td>
          <td><select name="from_year" class="form-control form-control--small-xs form-control--mar-right dropdown-year">
              <option value="">--年</option>
              @for ( $i = 2016; $i <= date('Y') + 1; $i++ )
              <?php
              $value = '';
              if ( isset(Session::get('historyWhere')['from_year']) && Session::get('historyWhere')['from_year'] == $i ) {
                $value = 'selected';
              }
              ?>
              <option value="{{ $i }}" {{ $value }} >{{ $i }}年</option>
              @endfor
            </select>
            <select name="from_month" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
              <option value="">--月</option>
              @for ( $i = 1; $i <= 12; $i++ )
              <?php
              $value = '';
              if ( isset(Session::get('historyWhere')['from_month']) && Session::get('historyWhere')['from_month'] == $i ) {
                $value = 'selected';
              }
              ?>
              <option value="{{ $i }}" {{ $value }} >{{ $i }}月</option>  
              @endfor
            </select>
            <select name="from_day" class="form-control form-control--small-xs dropdown-date">
              <option value="">--日</option>
              @for ( $i = 1; $i <= 31; $i++ )
              <?php
              $value = '';
              if ( isset(Session::get('historyWhere')['from_day']) && Session::get('historyWhere')['from_day'] == $i ) {
                $value = 'selected';
              }
              ?>
              <option value="{{ $i }}" {{ $value }} >{{ $i }}日</option>  
              @endfor
            </select>
            ～
            <select name="to_year" class="form-control form-control--small-xs form-control--mar-right dropdown-year">
              <option value="">--年</option>
              @for ( $i = 2016; $i <= date('Y') + 1; $i++ )
              <?php
              $value = '';
              if ( isset(Session::get('historyWhere')['to_year']) && Session::get('historyWhere')['to_year'] == $i ) {
                $value = 'selected';
              }
              ?>
              <option value="{{ $i }}" {{ $value }} >{{ $i }}年</option>
              @endfor
            </select>
            <select name="to_month" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
              <option value="">--月</option>
              @for ( $i = 1; $i <= 12; $i++ )
              <?php
              $value = '';
              if ( isset(Session::get('historyWhere')['to_month']) && Session::get('historyWhere')['to_month'] == $i ) {
                $value = 'selected';
              }
              ?>
              <option value="{{ $i }}" {{ $value }} >{{ $i }}月</option>  
              @endfor
            </select>
            <select name="to_day" class="form-control form-control--small-xs dropdown-date">
              <option value="">--日</option>
              @for ( $i = 1; $i <= 31; $i++ )
              <?php
              $value = '';
              if ( isset(Session::get('historyWhere')['to_day']) && Session::get('historyWhere')['to_day'] == $i ) {
                $value = 'selected';
              }
              ?>
              <option value="{{ $i }}" {{ $value }} >{{ $i }}日</option>  
              @endfor
            </select></td>
          <td rowspan="3"><input name="search" value="絞り込み" type="submit" class="btn btn-sm btn-primary"></td>
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
            
              @foreach ( $webskb as $item )
              <option value="{{ trim($item->ｺｰﾄﾞ) }}" <?php echo (isset(Session::get('historyWhere')['status']) && Session::get('historyWhere')['status'] == $item->ｺｰﾄﾞ) ? 'selected' : '' ?> >{{ trim($item->名称) }}</option>
              @endforeach
              
            </select></td>
        </tr>
      </tbody>
    </table>
    </form>
    
    @if ( $historys && count($historys) > 0 )
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
    @endif
    
	</div>
  
@stop