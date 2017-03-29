@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
  <div class="container">
    <div class="row content mar-bottom30">
      <h4 class="text-center mar-bottom30">ログアウト</h4>
      <p class="text-center">正常にログアウトしました。</p>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('manage.users.login')}}'" value="ログイン画面" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
</section>
<!--END PAGE CONTENT -->
@endsection