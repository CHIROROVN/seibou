@extends('manage.layout')

@section('content')
<!--PAGE CONTENT -->
<section id="page">
      <div class="container">
        <div class="row content content--list">
          <h3>ユーザー管理　＞　登録済みユーザーの一覧</h3>
          <div class="row fl-right mar-bottom">
            <div class="col-md-12">
              <input onclick="location.href='{{route('manage.users.regist')}}'" value="ユーザーの新規登録" type="button" class="btn btn-sm btn-primary"/>
            </div>
          </div>
          <table class="table table-bordered table-striped clearfix">
            <tr>
              <td class="col-title" align="center">詳細・変更・削除</td>
              <td class="col-title" align="center">有効</td>
              <td class="col-title" align="center">ユーザー名</td>
              <td class="col-title" align="center">ログインID</td>
              <td class="col-title" align="center">権限</td>
            </tr>

            @if( count($users) > 0 )
              @foreach ( $users as $user )
              <tr>
                <td align="center">
                <input onclick="location.href='{{route('manage.users.detail',$user->u_id)}}'" value="詳細・変更・削除" type="button" class="btn btn-xs btn-primary">
                </td>
                @if($user->u_free1 == 1)
                <td align="center" class="text-orange">×</td>
                @else
                <td align="center">○</td>
                @endif
                <td>{{$user->u_name}}</td>
                <td>{{$user->u_login}}</td>
                <td>
                @if( $user->u_power1 == 1 )
                 ・「お知らせ」管理<br>
                @endif
                @if ( $user->u_power2 == 1 )
                 ・「営業日カレンダー」管理<br>
                @endif
                @if ( $user->u_power3 == 1 )
                ・ユーザー管理 
                @endif
                </td>
              </tr>
              @endforeach
            @else
            <tr><td colspan="5" style="text-align: center;">該当するデータがありません。</td></tr>
            @endif

          </table>
        </div>
      </div>
    </section>
<!--END PAGE CONTENT -->
@endsection