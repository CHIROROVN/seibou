@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
  <div class="container">
    <div class="row content">
      <h3>ユーザー管理　＞　登録済みユーザーの変更　＞　確認</h3>
      <table class="table table-bordered table-regist">
            <tbody>
              <tr>
                <td class="col-title min-width-td">氏名</td>
                <td>
                  {{$user->u_name}}
                </td>
              </tr>
              <tr>
                <td class="col-title min-width-td">ログインID</td>
                <td>
                  {{$user->u_login}}
                </td>
              </tr>
              <tr>
                <td class="col-title min-width-td">パスワード</td>
                <td>
                  {{@$user->u_passwd_original}}
                </td>
              </tr>
              <tr>
                <td class="col-title min-width-td">操作権限</td>
                <td>
                @if($user->u_power1 != null)
                  ・「お知らせ」管理 <br>
                  @endif
                  @if($user->u_power2 != null)
                  ・「営業日カレンダー」管理 <br>
                  @endif
                  @if($user->u_power3 != null)
                  ・ユーザー管理
                  @endif
                </td>
              </tr>
              <tr>
                <td class="col-title min-width-td">有効／無効</td>
                <td>
                  @if($user->u_free1 != null)
                  有効
                  @else
                  無効
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('manage.users.change_save', $user->u_id)}}'" value="変更する" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('manage.users.change', $user->u_id)}}'" value="戻る" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
</section>
<!--END PAGE CONTENT -->
@endsection