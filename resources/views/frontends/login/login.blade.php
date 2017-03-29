<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>倉敷製帽 WEB受注システム 管理画面</title>
    <link href="{{ asset('') }}public/frontend/common/css/import.css" rel="stylesheet">
    <script src="{{ asset('') }}public/frontend/common/js/jquery.min.js"></script>
    <script src="{{ asset('') }}public/frontend/common/js/bootstrap.min.js"></script>
  </head>
  <body>
    <!-- Header -->
    <div class="header-font-end">
      <div class="container">
        <div class="row">
          <div class="col-md-12 logo">
            <img src="{{ asset('') }}public/frontend/common/image/h_logo.gif" alt="" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="title-top">{{ $breadcrumb }}</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header -->
    <!-- content login -->
    {!! Form::open(array('route' => ['front.login'], 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
    <section id="page-fontend">
      <div class="container">
        <div class="row content-right login">
          <div class="col-md-12">
            <h1>ログイン</h1>
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-regist">
                  <tbody>
                    <tr>
                      <td class="col-title">ログインID</td>
                      <td>
                        <input name="username" value="{{ old('username') }}" type="text" class="form-control form-control--default">
                        <br>
                        @if ($errors->first('username'))
                        <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px"> {{ $errors->first('username') }}</div>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title">パスワード</td>
                      <td>
                        <input name="password" value="" type="password" class="form-control form-control--default">
                        @if ($errors->first('password'))
                        <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px"> {{ $errors->first('password') }}</div>
                        @endif
                        @if ($message = Session::get('danger'))
                        <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px"> {{ $message }}</div>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-3">
              </div>
            </div>
            <div class="row mar-bottom30">
              <div class="col-md-12 text-center">
                <input type="submit" class="btn btn-sm btn-primary" name="login" value="ログイン" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </form>
    <!-- End content login -->
    
    <!-- Footer -->
      <div class="footer footer-login">
        <div class="container">
          (c)2017- Kurashiki Seibou All Rights Reserved.
        </div>
      </div>
    <!-- End footer -->
    
  </body>
</html>