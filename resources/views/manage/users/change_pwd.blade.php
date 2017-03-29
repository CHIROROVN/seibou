@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--changepass">
          <div class="col-md-12">

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

          {!! Form::open( ['id' => 'frmChangePass', 'class' => 'form-horizontal','method' => 'post', 'route' => 'manage.users.change_pwd', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8']) !!}
              <div class="form-group">
                <label class="col-md-3 control-label" for="iput-username">ログインID</label>
                <div class="col-md-6"><label class="control-label"><b>{{@$u_login}}</b></label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="iput-oldpass">以前のパスワード <span class="red">(＊)</span></label>
                <div class="col-md-6">
                  <input type="password" name="old_pwd" class="form-control" id="iput-oldpass">
                   @if ($errors->first('old_pwd')) 
                  <div class="help-block with-errors"><ul class="list-unstyled"><li>{!! $errors->first('old_pwd') !!}</li></ul></div>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="iput-newpass">新しいパスワード <span class="red">(＊)</span></label>
                <div class="col-md-6">
                  <input type="password" name="new_pwd" class="form-control" id="iput-newpass">
                   @if ($errors->first('new_pwd')) 
                  <div class="help-block with-errors"><ul class="list-unstyled"><li>{!! $errors->first('new_pwd') !!}</li></ul></div>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="iput-newpass">新しいパスワード確認</label>
                <div class="col-md-6">
                  <input type="password" name="new_pwd_cnf" class="form-control" id="iput-newpass">
                  @if ($errors->first('new_pwd_cnf')) 
                  <div class="help-block with-errors"><ul class="list-unstyled"><li>{!! $errors->first('new_pwd_cnf') !!}</li></ul></div>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                  <button type="submit" class="btn btn-primary">変化する</button>
                  <button type="reset" class="btn btn-default">リセット</button>
                </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection