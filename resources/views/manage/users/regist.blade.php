@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content">
          <h3>ユーザー管理　＞　ユーザーの新規登録</h3>
          {!! Form::open( ['id' => 'frmUserRegist', 'class' => 'form-horizontal','method' => 'post', 'route' => 'manage.users.regist', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8']) !!}
          <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title">氏名 <span class="red">(＊)</span></td>
                <td>
                  <input name="u_name" type="text" class="form-control form-control--default">
                   @if ($errors->first('u_name')) 
                  <div class="help-block with-errors"><ul class="list-unstyled"><li>{!! $errors->first('u_name') !!}</li></ul></div>
                  @endif
                </td>
              </tr>
              <tr>
                <td class="col-title">ログインID <span class="red">(＊)</span></td>
                <td>
                  <input name="u_login" type="text" class="form-control form-control--default"> ※英数字3文字以上、<span class="text-orange">重複不可</span>
                   @if ($errors->first('u_login')) 
                  <div class="help-block with-errors"><ul class="list-unstyled"><li>{!! $errors->first('u_login') !!}</li></ul></div>
                  @endif
                </td>
              </tr>
              <tr>
                <td class="col-title">パスワード <span class="red">(＊)</span></td>
                <td>
                  <input name="u_passwd" type="text" class="form-control form-control--default"> ※英数字5文字以上
                   @if ($errors->first('u_passwd')) 
                  <div class="help-block with-errors"><ul class="list-unstyled"><li>{!! $errors->first('u_passwd') !!}</li></ul></div>
                  @endif
                </td>
              </tr>
              <tr>
                <td class="col-title">操作権限</td>
                <td>
                  <div class="col-md-12 mar-bottom">
                    <input name="u_power1" value="1" type="checkbox" @if(old('u_power1') == '1') checked="" @endif> 「お知らせ」管理
                  </div>
                  <div class="col-md-12 mar-bottom">
                    <input name="u_power2" value="1" type="checkbox" @if(old('u_power2') == '1') checked="" @endif> 「営業日カレンダー」管理
                  </div>
                  <div class="col-md-12">
                    <input name="u_power3" value="1" type="checkbox" @if(old('u_power3') == '1') checked="" @endif> ユーザー管理
                  </div>
                </td>
              </tr>
              <tr>
                <td class="col-title">有効／無効</td>
                <td>
                  <div class="col-md-12 mar-bottom">
                    <input name="u_free1" value="checkbox" type="checkbox" @if(old('u_free1') == '1') checked="" @endif> 一時的に無効とする（ログインできなくする）
                  </div>
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
            <input onclick="location.href='{{route('manage.users.index')}}'" value="登録済みユーザー一覧に戻る" type="button" class="btn btn-sm btn-primary">
          </div>
        </div>

        {!! Form::close() !!}
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection