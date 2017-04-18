@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->

<section id="page">
  <div class="container">
    <div class="row content">
      <h3>「お知らせ」管理　＞　「お知らせ」の新規登録</h3>
      {!! Form::open(array('route' => ['manage.notice.regist'], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
      <table class="table table-bordered table-regist">
        <tbody>
          <tr>
            <td class="col-title min-width-td">タイトル <span class="red">(＊)</span></td>
            <td>
              <input name="news_title" id="news_title" value="{{old('news_title')}}" type="text" class="form-control form-control--large">
              @if ($errors->first('news_title'))
              <div class="help-block with-errors">
              <ul class="list-unstyled"><li>{!! $errors->first('news_title') !!}</li></ul></div>
              @endif
            </td>
          </tr>
          
          <tr>
            <td class="col-title min-width-td">情報登録日 <span class="red">(＊)</span></td>
            <td>
              <select name="year" id="year" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
                <option value="" @if( old('year') == '' ) selected="" @endif >--年</option>
                <option value="{{$curr_year}}" @if( old('year') == $curr_year ) selected="" @endif>{{$curr_year}}年</option>
                <option value="{{$next_year}}" @if( old('year') == $next_year ) selected="" @endif>{{$next_year}}年</option>
                <option value="{{$next_year_next}}" @if( old('year') == $next_year_next ) selected="" @endif>{{$next_year_next}}年</option>
              </select>
              <select name="month" id="month" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
                <option value="" @if(old('month') == '') selected="" @endif >--月</option>
                <option value="01" @if(old('month') == '01') selected="" @endif >01月</option>
                <option value="02" @if(old('month') == '02') selected="" @endif >02月</option>
                <option value="03" @if(old('month') == '03') selected="" @endif >03月</option>
                <option value="04" @if(old('month') == '04') selected="" @endif >04月</option>
                <option value="05" @if(old('month') == '05') selected="" @endif >05月</option>
                <option value="06" @if(old('month') == '06') selected="" @endif >06月</option>
                <option value="07" @if(old('month') == '07') selected="" @endif >07月</option>
                <option value="08" @if(old('month') == '08') selected="" @endif >08月</option>
                <option value="09" @if(old('month') == '09') selected="" @endif >09月</option>
                <option value="10" @if(old('month') == '10') selected="" @endif >10月</option>
                <option value="11" @if(old('month') == '11') selected="" @endif >11月</option>
                <option value="12" @if(old('month') == '12') selected="" @endif >12月</option>
              </select>
              <select name="day" id="day" class="form-control form-control--small-xs dropdown-date">
                <option value="" selected="selected">--日</option>
              </select>
              @if ($errors->first('year'))
              <div class="help-block with-errors">
              <ul class="list-unstyled"><li>{!! $errors->first('year') !!}</li></ul></div>
              @endif
              @if ($errors->first('month'))
              <div class="help-block with-errors">
              <ul class="list-unstyled"><li>{!! $errors->first('month') !!}</li></ul></div>
              @endif
              @if ($errors->first('day'))
              <div class="help-block with-errors">
              <ul class="list-unstyled"><li>{!! $errors->first('day') !!}</li></ul></div>
              @endif
            </td>
          </tr>
          <tr>
            <td class="col-title">詳細 <span class="red">(＊)</span></td>
            <td>
              <textarea name="news_contents" id="news_contents" style="height: 320px; width: 100%;"></textarea>
               @if ($errors->first('news_contents'))
              <div class="help-block with-errors">
              <ul class="list-unstyled"><li>{!! $errors->first('news_contents') !!}</li></ul></div>
              @endif
            </td>

          </tr>

          <tr>
            <td class="col-title min-width-td">タイマー</td>
            <td>
              <div class="col-md-12 mar-bottom">
                表示開始日：
                <select name="year_start" id="year_start" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
                <option value="" @if( old('year_start') =='') selected="" @endif>--年</option>
                <option value="{{$curr_year}}" @if( old('year_start') == $curr_year ) selected="" @endif >{{$curr_year}}年</option>
                <option value="{{$next_year}}"  @if( old('year_start') == $next_year ) selected="" @endif >{{$next_year}}年</option>
                <option value="{{$next_year_next}}"  @if( old('year_start') == $next_year_next ) selected="" @endif >{{$next_year_next}}年</option>
                </select>
                <select name="month_start" id="month_start" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
                    <option value="" @if(old('month_start') == '') selected="" @endif >--月</option>
                    @for($ms=1; $ms<=12; $ms++)
                    <option value="{{sprintf('%02d', $ms)}}" @if(old('month_end') == sprintf('%02d', $ms)) selected="" @endif >{{sprintf('%02d', $ms)}}月</option>
                    @endfor
                </select>
                <select name="day_start" id="day_start" class="form-control form-control--small-xs dropdown-date">
                  <option value="" @if(old('day_start') == '') selected="" @endif>--日</option>
                  @for($i=1; $i<=31; $i++)
                    <option value="{{sprintf('%02d',$i)}}" @if(old('day_start') == sprintf('%02d',$i)) selected="" @endif>{{sprintf('%02d',$i)}}日</option>
                  @endfor
                </select>
                 から
              </div>
              <div class="col-md-12">
                表示終了日：
                <select name="year_end" id="year_end" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
                    <option value="" @if( old('year_end') == '' ) selected="" @endif>--年</option>
                    <option value="{{$curr_year}}" @if( old('year_end') == $curr_year ) selected="" @endif >{{$curr_year}}年</option>
                    <option value="{{$next_year}}" @if( old('year_end') == $next_year ) selected="" @endif >{{$next_year}}年</option>
                    <option value="{{$next_year_next}}" @if( old('year_end') == $next_year_next ) selected="" @endif >{{$next_year_next}}年</option>
                </select>
                <select name="month_end" id="month_end" class="form-control form-control--small-xs form-control--mar-right dropdown-date">
                    <option value="" @if(old('month_end') == '') selected="" @endif >--月</option>
                    @for($me=1; $me<=12; $me++)
                    <option value="{{sprintf('%02d', $me)}}" @if(old('month_end') == sprintf('%02d', $me)) selected="" @endif >{{sprintf('%02d', $me)}}月</option>
                    @endfor
                </select>
                <select name="day_end" id="day_end" class="form-control form-control--small-xs dropdown-date">
                  <option value="" @if( old('day_end') == '') selected="" @endif>--日</option>
                  @for($y=1; $y<=31; $y++)
                    <option value="{{sprintf('%02d', $y)}}" @if(old('day_end') == sprintf('%02d',$y)) selected="" @endif>{{sprintf('%02d',$y)}}日</option>
                  @endfor
                </select>
                 まで
              </div>
              @if ($errors->first('news_endday'))
              <div class="help-block with-errors">
              <ul class="list-unstyled"><li>{!! $errors->first('news_endday') !!}</li></ul></div>
              @endif
            </td>
          </tr>
          <tr>
            <td class="col-title min-width-td">表示／非表示</td>
            <td>
              <input name="news_display" value="1" type="checkbox" @if(old('news_display') == '1') checked="" @endif> 一時的にこの「お知らせ」を掲載しない
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input value="確認する" type="submit" class="btn btn-sm btn-primary">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('manage.notice.index')}}'" value="登録済み「お知らせ」一覧に戻る" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</section>

<script>
  $(document).ready(function(){
    var date = new Date();
    var year = date.getFullYear();
    var month    = date.getMonth()+1;
    var day = format2Digit(date.getDate());

    var oldYear = "{{old('year')}}";
    var oldMonth = "{{old('month')}}";
    var oldDay = "{{old('day')}}";

    var oldTotalDays = new Date(oldYear,oldMonth,1,-1).getDate();
    var opthtml = "<option value=''>--日</option>";

    for(var i=1; i<=oldTotalDays; i++){
      opthtml += '<option value="' + format2Digit(i) + '">'+ format2Digit(i) +'日</option>';
    }
    $('#day').html(opthtml);
    $('#day option[value="' + oldDay + '"]').prop('selected',true);

});


$('#year').click(function(event) {
  var date = new Date();
  var year = date.getFullYear();
  var month    = format2Digit(date.getMonth()+1);
  var day = format2Digit(date.getDate());
  var totaldays = new Date(year,month,1,-1).getDate();
  var opthtml = "<option value=''>--日</option>";

  for(var i=1; i<=totaldays; i++){
    opthtml += '<option value="' + format2Digit(i) + '">'+ format2Digit(i) +'日</option>';
  }
  $('#day').html(opthtml);

  if( $(this).val() == '' ){
    $('#month option[value=""]').prop('selected',true);
    $('#day option[value=""]').prop('selected',true);
  }else{
    $('#month option[value="' + month + '"]').prop('selected',true);
    $('#day option[value="' + day + '"]').prop('selected',true);
  }

  $('#month').click(function(event) {
    var cyear = $('#year').val();
    var cmonth = $(this).val();
    var totaldays = new Date(cyear,cmonth,1,-1).getDate();

    var opthtml = "<option value=''>--日</option>";

    for(var i=1; i<=totaldays; i++){
      opthtml += '<option value="' + format2Digit(i) + '">'+ format2Digit(i) +'日</option>';
    }
    $('#day').html(opthtml);

    if( $(this).val() == '' ){
      $('#day option[value=""]').prop('selected',true);
    }else{
      $('#day option[value="' + day + '"]').prop('selected',true);
    }

  });

});

</script>

<script>
  var tdate = new Date();
  var tyear = tdate.getFullYear();
  var tmonth    = format2Digit(tdate.getMonth()+1);
  var tday = format2Digit(tdate.getDate());

  $('#year_start').click(function(event) {
    if( $(this).val() == '' ){
      $('#month_start option[value=""]').prop('selected',true);
      $('#day_start option[value=""]').prop('selected',true);
    }else{
      $('#month_start option[value="' + tmonth + '"]').prop('selected',true);
      $('#day_start option[value="' + tday + '"]').prop('selected',true);
    }
  });

  $('#year_end').click(function(event) {
    if( $(this).val() == '' ){
      $('#month_end option[value=""]').prop('selected',true);
      $('#day_end option[value=""]').prop('selected',true);
    }else{
      $('#month_end option[value="' + tmonth + '"]').prop('selected',true);
      $('#day_end option[value="' + tday + '"]').prop('selected',true);
    }
  });

    $('#month_start').click(function(event) {
    if( $(this).val() == '' ){
      $('#day_start option[value=""]').prop('selected',true);
    }else{
      $('#day_start option[value="' + tday + '"]').prop('selected',true);
    }
  });

  $('#month_end').click(function(event) {
    if( $(this).val() == '' ){
      $('#day_end option[value=""]').prop('selected',true);
    }else{
      $('#day_end option[value="' + tday + '"]').prop('selected',true);
    }
  });

  function format2Digit(num)
  {
    if(num < 10) { return '0'+num }
    else return num;
  }

</script>

<script>
  tinymce.init({
    selector: '#news_contents',
    language: 'ja',
    height: 320,
    menubar: false,
    forced_root_block : "", 
    force_br_newlines : true,
    force_p_newlines : false,
    plugins: [
      'textcolor',
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | link image | insert',
//        content_css: '//www.tinymce.com/css/codepen.min.css',
    textcolor_cols: "5",
    textcolor_map: [
        "FFFFFF", "White",
        "000000", "Black",
        "993300", "Burnt orange",
        "333300", "Dark olive",
        "003300", "Dark green",
        "003366", "Dark azure",
        "000080", "Navy Blue",
        "333399", "Indigo",
        "333333", "Very dark gray",
        "800000", "Maroon",
        "FF6600", "Orange",
        "808000", "Olive",
        "008000", "Green",
        "008080", "Teal",
        "0000FF", "Blue",
        "666699", "Grayish blue",
        "808080", "Gray",
        "FF0000", "Red",
        "FF9900", "Amber",
        "99CC00", "Yellow green",
        "339966", "Sea green",
        "33CCCC", "Turquoise",
        "3366FF", "Royal blue",
        "800080", "Purple",
        "999999", "Medium gray",
        "FF00FF", "Magenta",
        "FFCC00", "Gold",
        "FFFF00", "Yellow",
        "00FF00", "Lime",
        "00FFFF", "Aqua",
        "00CCFF", "Sky blue",
        "993366", "Red violet",
        "FFFFFF", "White",
        "FF99CC", "Pink",
        "FFCC99", "Peach",
        "FFFF99", "Light yellow",
        "CCFFCC", "Pale green",
        "CCFFFF", "Pale cyan",
        "99CCFF", "Light sky blue",
        "CC99FF", "Plum"
      ]
  });
</script>

<!--END PAGE CONTENT -->
@endsection