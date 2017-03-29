@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
    <section id="page">
      <div class="container">

      {!! Form::open(array('route' => ['manage.calendar.edit',$year], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
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
              @for($m=1; $m<=12; $m++)
              <tr>
                <td class="col-title">{{$m}}月</td>
                 <td>
                 <?php $jump = 1; ?>
                 @for($i=1; $i<=16; $i++)

                    <?php $dh =  holidayOfMonth($year, $m);
                        $countH = count($dh);
                        
                        if($countH > 0){
                            foreach ($dh as $key => $val) {
                                $day = dayFromDate($val->calendar_date);
                                if($i <= $countH && $jump <= $countH){ ?>
                                    <input name="holiday[cell_{{$jump}}_{{$m}}]" value="{{$day}}" maxlength="2" type="text" class="form-control form-control--small-xs">
                        <?php       }else if($jump <= 16){ ?>
                                    <input name="holiday[cell_{{$jump}}_{{$m}}]" maxlength="2" type="text" class="form-control form-control--small-xs">
                        <?php       }
                        $jump += 1;
                            }
                        }else{ ?>
                            <input name="holiday[cell_{{$i}}_{{$m}}]"  type="text" maxlength="2" class="form-control form-control--small-xs">
                <?php       }
                     ?> 

                 @endfor

                </td>
              </tr>
              @endfor
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