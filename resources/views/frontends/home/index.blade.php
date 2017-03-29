@extends('frontends.main')

@section('content')

  <div class="chui" style="clear:both; font-size: 1.3em;" align="center">
  刺繍、名入れ等の加工品、別注品は、本Webシステムから発注できません。<br>別途弊社までお問い合わせください。
  </div>
  <div style="clear:both;"></div>
  <div class="col-md-9 content-right home" style="width: 750px;float: left;">
    <h1>お知らせ</h1>
    
    @if ( count($news) > 0 )
      @foreach ( $news as $new )
      <h4>{{ $new->news_title }} [{{ formatDate($new->news_date) }}]</h4>
      <p>{!! $new->news_contents !!}</p>
      @endforeach
    @endif
    
  </div>
		  
@stop