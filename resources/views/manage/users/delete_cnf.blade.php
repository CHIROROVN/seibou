@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
  <div class="container">
    <div class="row content">
      <h3>ユーザー管理　＞　登録済みユーザーの削除（確認）</h3>
          <p class="text-orange">
            以下のユーザーを削除しますが、よろしいですか？<br />※この操作は取り消すことができません。
          </p>
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
              @if($user->u_passwd) ****** @endif
            </td>
          </tr>
          <tr>
            <td class="col-title min-width-td">操作権限</td>
            <td>
            @if($user->u_power1 != null)
              ・「お知らせ」管理
              @endif
              @if($user->u_power2 != null)<br>
              ・「営業日カレンダー」管理
              @endif
              @if($user->u_power3 != null)<br>
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
        <input onclick="location.href='{{route('manage.users.delete',$user->u_id)}}'" value="削除する（確認済み）" type="button" class="btn btn-sm btn-primary">
        <input onclick="location.href='{{route('manage.users.detail', $user->u_id)}}'" value="やめる" type="button" class="btn btn-sm btn-primary mar-left40">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <input onclick="location.href='{{route('manage.users.index')}}'" value="登録済みユーザー一覧に戻る" type="button" class="btn btn-sm btn-primary">
      </div>
    </div>
  </div>
</section>
<!--END PAGE CONTENT -->
@endsection