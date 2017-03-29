@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="login">
      <div class="container">
        <div class="content-login">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <h1>ログイン</h1>
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
            {!! Form::open(array('route' => ['manage.users.login'], 'class' => 'form-horizontal form-login', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
              <div class="form-group">
                <label class="col-xs-12 col-md-4 control-label" for="u_login">ログインID</label>
                <div class="col-xs-12 col-md-6">
                  <input type="text" class="form-control" id="u_login" name="u_login" >
                  @if ($errors->first('u_login'))
                    <div class="help-block with-errors">
                    <ul class="list-unstyled"><li>{!! $errors->first('u_login') !!}</li></ul></div>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-12 col-md-4 control-label" for="u_passwd" >パスワード</label>
                <div class="col-xs-12 col-md-6">
                  <input type="password" class="form-control" id="u_passwd" name="u_passwd">
                  @if ($errors->first('u_passwd'))
                    <div class="help-block with-errors">
                    <ul class="list-unstyled"><li>{!! $errors->first('u_passwd') !!}</li></ul></div>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4"></div>
                <div class="col-xs-12 col-md-6">
                  <button type="submit" class="btn btn-blue">ログイン</button>
                </div>
              </div>

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection