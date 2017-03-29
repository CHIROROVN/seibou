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
            </select></td>
          <td rowspan="3"><input name="" value="絞り込み" type="submit" class="btn btn-sm btn-primary"></td>
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
              <option value="{{ $item->ｺｰﾄﾞ }}" <?php echo (isset(Session::get('historyWhere')['status']) && Session::get('historyWhere')['status'] == $item->ｺｰﾄﾞ) ? 'selected' : '' ?> >{{ $item->名称 }}</option>
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
        <td>{{ $history->商品CD }}</td>
        <td>{{ empty($history->受注日) ? '' : date('Y/m/d', strtotime($history->受注日)) }}</td>
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
    @endif
    
	</div>
  
@stop