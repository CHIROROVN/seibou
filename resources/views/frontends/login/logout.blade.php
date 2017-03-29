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
            <div class="title-top">Web受発注システム　＞　ログアウト</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header -->
    <!-- content login -->
    <section id="page-fontend">
      <div class="container">
        <div class="row content-right login">
          <div class="col-md-12">
            <h1>ログアウト</h1>
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
                  <p class="text-center" style="margin-top:80px;">正常にログアウトしました。</p>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <input onclick="location.href='{{ route('front.login') }}'" value="ログイン画面" type="button" class="btn btn-sm btn-primary">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
