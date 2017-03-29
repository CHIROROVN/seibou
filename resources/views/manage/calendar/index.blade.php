@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--list">
          <h3>「営業日カレンダー」管理　＞　登録済み「営業日カレンダー」の一覧</h3>

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
      
          <table class="table table-bordered table-striped clearfix">
            <tr>
              <td class="col-title" align="center" width="100px">登録・編集</td>
              <td class="col-title" align="center">年</td>
            </tr>

            <tr>
              <td>
              @if(chkCalendar($next_year_next) == 'regist')
                 <button onclick="location.href='{{route('manage.calendar.regist', $next_year_next)}}'" class="btn btn-xs btn-primary" name="next_year_next" value="{{$next_year_next}}">新規登録</button>
              @else
                <button onclick="location.href='{{route('manage.calendar.edit', $next_year_next)}}'" class="btn btn-xs btn-primary" name="next_year_next" value="{{$next_year_next}}">編集</button>
                @endif
              </td>
              <td>2019年</td>
            </tr>

            <tr>
              <td>
                @if(chkCalendar($next_year) == 'regist')
                  <button onclick="location.href='{{route('manage.calendar.regist', $next_year)}}'" class="btn btn-xs btn-primary" name="next_year" value="{{$next_year}}">新規登録</button>
                @else
                  <button onclick="location.href='{{route('manage.calendar.edit', $next_year)}}'" class="btn btn-xs btn-primary" name="next_year" value="{{$next_year}}">編集</button>
                @endif
              </td>
              <td>{{$next_year}}年</td>
            </tr>

            <tr>
              <td>
               @if(chkCalendar($year) === 'regist')
                <button onclick="location.href='{{route('manage.calendar.regist', $year)}}'" class="btn btn-xs btn-primary" name="year" value="{{$year}}">新規登録</button>
                @else
                <button onclick="location.href='{{route('manage.calendar.edit', $year)}}'" class="btn btn-xs btn-primary" name="year" value="{{$year}}">編集</button>
                @endif
              </td>
              </td>
              <td>{{$year}}年</td>
            </tr>

            <tr>
              <td>
                @if(chkCalendar($last_year) == 'regist')
                <button onclick="location.href='{{route('manage.calendar.regist', $last_year)}}'" class="btn btn-xs btn-primary" name="last_year" value="{{$last_year}}">新規登録</button>
                @else
                <button onclick="location.href='{{route('manage.calendar.edit', $last_year)}}'" class="btn btn-xs btn-primary" name="last_year" value="{{$last_year}}">編集</button>
                @endif
              </td>
              <td>{{$last_year}}年</td>
            </tr>

          </table>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection