@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--changepass">
          <div class="col-md-12">
            <form class="form-horizontal">
              <div class="form-group">
                <label class="col-md-3 control-label" for="iput-username">ログインID</label>
                <div class="col-md-6">
                  <input type="text" name="txtusername" class="form-control" id="iput-username">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="iput-oldpass">以前のパスワード</label>
                <div class="col-md-6">
                  <input type="password" name="txtoldpass" class="form-control" id="iput-oldpass">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="iput-newpass">新しいパスワード</label>
                <div class="col-md-6">
                  <input type="password" name="txtnewpass" class="form-control" id="iput-newpass">
                  <div class="help-block with-errors"><ul class="list-unstyled"><li>このフィールドに記入してください。</li></ul></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                  <button type="submit" class="btn btn-primary">セーブ</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection