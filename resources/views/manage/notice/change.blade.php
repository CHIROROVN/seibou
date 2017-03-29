@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content">
          <h3>「お知らせ」管理　＞　登録済み「お知らせ」の変更</h3>
           {!! Form::open(array('route' => ['manage.notice.change', $notice->news_id], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
          <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title">タイトル</td>
                <td>
                  <input name="news_title" id="news_title" value="@if(old('news_title')){{old('news_title')}}@elseif($notice->news_title){{$notice->news_title}}@endif" type="text" class="form-control form-control--large">
                  @if ($errors->first('news_title'))
                  <div class="help-block with-errors">
                  <ul class="list-unstyled"><li>{!! $errors->first('news_title') !!}</li></ul></div>
                  @endif
                </td>
              </tr> 
              <tr>
                <td class="col-title">情報登録日</td>
                <td>
                  <select name="year" id="year" class="form-control form-control--small-xs form-control--mar-right">
                    <option value="" @if(old('year') == '') selected="" @elseif(showYear($notice->news_date)) selected="" @endif>--年</option>
                    @for( $y = $last_year; $y <= $last_year + 4; $y++ )
                      <option value="{{$y}}"  @if(old('year') == $y) selected="" @elseif(showYear($notice->news_date) == $y) selected="" @endif>{{$y}}年</option>
                    @endfor
                  </select>
                  <select name="month" id="month" class="form-control form-control--small-xs form-control--mar-right">
                    <option value="" @if(old('month') == '') selected="" @elseif( showMonth($notice->news_date) == '' ) selected="" @endif >--月</option>
                    @for( $m=1; $m<=12; $m++ )
                    <option value="{{sprintf('%02d',$m)}}" @if(old('month') == sprintf('%02d',$m)) selected="" @elseif( showMonth($notice->news_date) == $m ) selected="" @endif >{{sprintf('%02d',$m)}}月</option>
                    @endfor
                  </select>
                  <select name="day" id="day" class="form-control form-control--small-xs">
                    <option value="" @if(old('day') == '') selected="" @elseif( showDay($notice->news_date) == '' ) selected="" @endif >--日</option>
                    @for( $d=1; $d<=31; $d++ )
                    <option value="{{sprintf('%02d',$d)}}" @if(old('day') == sprintf('%02d',$d)) selected="" @elseif( showDay($notice->news_date) == $d ) selected="" @endif >{{sprintf('%02d',$d)}}日</option>
                    @endfor
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
                <td class="col-title">詳細</td>
                <td>
                <textarea name="news_contents" id="news_contents" style="height: 320px; width: 100%;">{{$notice->news_contents}}</textarea>
                </td>
              </tr>
              <tr>
                <td class="col-title">タイマー</td>
                <td>
                  <div class="col-md-12 mar-bottom">
                    表示開始日：
                    <select name="year_start" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" @if(old('year_start') == '') selected="" @elseif(showYear($notice->news_startday)) selected="" @endif>--年</option>
                    @for( $yt = $last_year; $yt <= $last_year + 4; $yt++ )
                      <option value="{{$yt}}" @if(old('year_start') == $yt) selected="" @elseif(showYear($notice->news_startday) == $yt) selected="" @endif>{{$yt}}年</option>
                    @endfor
                    </select>
                    <select name="month_start" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" @if(old('month_start') == '') selected="" @elseif( showMonth($notice->news_startday) == '' ) selected="" @endif >--月</option>
                    @for( $mt=1; $mt<=12; $mt++ )
                    <option value="{{sprintf('%02d',$mt)}}" @if(old('month_start') == sprintf('%02d',$mt)) selected="" @elseif( showMonth($notice->news_startday) == $mt ) selected="" @endif >{{sprintf('%02d',$mt)}}月</option>
                    @endfor
                    </select>
                    <select name="day_start" class="form-control form-control--small-xs">
                      <option value="" @if(old('day_start') == '') selected="" @elseif( showDay($notice->news_startday) == '' ) selected="" @endif >--日</option>
                    @for( $ds=1; $ds<=31; $ds++ )
                    <option value="{{sprintf('%02d',$ds)}}" @if(old('day_start') == sprintf('%02d',$ds)) selected="" @elseif( showDay($notice->news_startday) == $ds ) selected="" @endif >{{sprintf('%02d',$ds)}}日</option>
                    @endfor
                    </select>
                     から
                  </div>
                  <div class="col-md-12">
                    表示終了日：
                    <select name="year_end" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" @if(old('year_end') == '') selected="" @elseif(showYear($notice->news_startday)) selected="" @endif>--年</option>
                    @for( $ye = $last_year; $ye <= $last_year + 4; $ye++ )
                      <option value="{{$ye}}"  @if(old('year_end') == $ye) selected="" @elseif(showYear($notice->news_endday) == $ye) selected="" @endif>{{$ye}}年</option>
                    @endfor
                    </select>
                    <select name="month_end" class="form-control form-control--small-xs form-control--mar-right">
                      <option value="" @if(old('month_end') == '') selected="" @elseif( showMonth($notice->news_startday) == '' ) selected="" @endif >--月</option>
                    @for( $me=1; $me<=12; $me++ )
                    <option value="{{sprintf('%02d',$me)}}" @if(old('month_end') == sprintf('%02d',$me)) selected="" @elseif( showMonth($notice->news_endday) == $me ) selected="" @endif >{{sprintf('%02d',$me)}}月</option>
                    @endfor
                    </select>
                    <select name="day_end" class="form-control form-control--small-xs">
                      <option value="" @if(old('day_end') == '') selected="" @elseif( showDay($notice->news_endday) == '' ) selected="" @endif >--日</option>
                    @for( $de=1; $de<=31; $de++ )
                    <option value="{{sprintf('%02d',$de)}}" @if(old('day_end') == sprintf('%02d',$de)) selected="" @elseif( showDay($notice->news_endday) == $de ) selected="" @endif >{{sprintf('%02d',$de)}}日</option>
                    @endfor
                    </select>
                     まで
                  </div>
                </td>
              </tr>
              <tr>
                <td class="col-title">表示／非表示</td>
                <td>
                  <input name="news_display" value="1" type="checkbox" @if(old('news_display') == '1') checked="" @elseif($notice->news_display == '1') checked="" @endif> 一時的にこの「お知らせ」を掲載しない
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