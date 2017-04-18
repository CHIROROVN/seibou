@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
    <section id="page">
      <div class="container">

      {!! Form::open(array('route' => ['manage.calendar.edit', $year], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
        <div class="row content">
          <h3>「営業日カレンダー」管理　＞　登録済み「営業日カレンダー」の編集</h3>
          <h4 class="text-orange text-center">{{@$year}}年</h4>

          @if($message = Session::get('danger'))
              <div id="error" class="message">
                  <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
                  <span>{{$message}}</span>
              </div>
          @elseif($message = Session::get('success'))
              <div id="success" class="message">
                  <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
                  <span>{{$message}}</span>
              </div>
          @endif

          <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title" colspan="16" align="center">日曜日を除く休日</td>
              </tr>
              <tr>
                <td class="col-title cal-col">1月</td>
                 <td>
                 <?php $m1OfDays = holidayOfMonth($year, '01');?>
                 @foreach($m1OfDays as $m1)
                    <input name="days[{{$m1->calendar_id}}_01]{{$m1->calendar_id}}_01" value="{{dayFromDate($m1->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">2月</td>
                 <td>
                  <?php $m2OfDays = holidayOfMonth($year, '02');?>
                 @foreach($m2OfDays as $m2)
                    <input name="days[{{$m2->calendar_id}}_02]{{$m2->calendar_id}}_02" value="{{dayFromDate($m2->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">3月</td>
                 <td>
                  <?php $m3OfDays = holidayOfMonth($year, '03');?>
                 @foreach($m3OfDays as $m3)
                    <input name="days[{{$m3->calendar_id}}_03]{{$m3->calendar_id}}_03" value="{{dayFromDate($m3->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">4月</td>
                 <td>
                  <?php $m4OfDays = holidayOfMonth($year, '04'); ?>
                 @foreach($m4OfDays as $m4)
                    <input name="days[{{$m4->calendar_id}}_04]{{$m4->calendar_id}}_04" value="{{dayFromDate($m4->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">5月</td>
                 <td>
                  <?php $m5OfDays = holidayOfMonth($year, '05');?>
                 @foreach($m5OfDays as $m5)
                    <input name="days[{{$m5->calendar_id}}_05]{{$m5->calendar_id}}_05" value="{{dayFromDate($m5->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">6月</td>
                 <td>
                  <?php $m6OfDays = holidayOfMonth($year, '06');?>
                 @foreach($m6OfDays as $m6)
                    <input name="days[{{$m6->calendar_id}}_06]{{$m6->calendar_id}}_06" value="{{dayFromDate($m6->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">7月</td>
                 <td>
                  <?php $m7OfDays = holidayOfMonth($year, '07');?>
                 @foreach($m7OfDays as $m7)
                    <input name="days[{{$m7->calendar_id}}_07]{{$m7->calendar_id}}_07" value="{{dayFromDate($m7->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">8月</td>
                 <td>
                  <?php $m8OfDays = holidayOfMonth($year, '08');?>
                 @foreach($m8OfDays as $m8)
                    <input name="days[{{$m8->calendar_id}}_08]{{$m8->calendar_id}}_08" value="{{dayFromDate($m8->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">9月</td>
                 <td>
                  <?php $m9OfDays = holidayOfMonth($year, '09');?>
                 @foreach($m9OfDays as $m9)
                    <input name="days[{{$m9->calendar_id}}_09]{{$m9->calendar_id}}_09" value="{{dayFromDate($m9->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">10月</td>
                 <td>
                  <?php $m10OfDays = holidayOfMonth($year, '10');?>
                 @foreach($m10OfDays as $m10)
                    <input name="days[{{$m10->calendar_id}}_10]{{$m10->calendar_id}}_10" value="{{dayFromDate($m10->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">11月</td>
                 <td>
                  <?php $m11OfDays = holidayOfMonth($year, '11');?>
                 @foreach($m11OfDays as $m11)
                    <input name="days[{{$m11->calendar_id}}_11]{{$m11->calendar_id}}_11" value="{{dayFromDate($m11->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
              <tr>
                <td class="col-title cal-col">12月</td>
                 <td>
                  <?php $m12OfDays = holidayOfMonth($year, '12');?>
                 @foreach($m12OfDays as $m12)
                    <input name="days[{{$m12->calendar_id}}_12]{{$m12->calendar_id}}_12" value="{{dayFromDate($m12->calendar_date)}}" type="text" class="form-control form-control--small-xs">
                 @endforeach
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mar-bottom30">
          <div class="col-md-12 text-center">
            <input  type="submit" value="保存する" class="btn btn-sm btn-primary">
          </div>
        </div>
        {!! Form::close() !!}
        <div class="row">
          <div class="col-md-12 text-center">
            <input onclick="location.href='{{route('manage.calendar.index')}}'" value="「年」一覧画面に戻る" type="button" class="btn btn-sm btn-primary">
          </div>
        </div>
      </div>
    </section><br>
<!--END PAGE CONTENT -->
@endsection