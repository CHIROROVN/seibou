@extends('frontends.main')

@section('content')

<?php $value = '' ?>

  <div class="col-md-9 content-right product-search">
    <h1>品番からの検索</h1>
    
    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
        <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px">　{{ $error }}</div>
      @endforeach
    @endif
    
    <p>品番を入力し、「検索開始」ボタンをクリックしてください。<br />
    複数の品番を入力した場合は、入力した品番を含む商品を全て表示します。<br />
    品番の一部でも検索することができます。</p><br>
    <span style="color: #F00">※半角英数字で入力お願いします。</span><br>
    <span style="color: #F00">※Fから始まる注文番号を入力する場合は、F-******と（-）ハイフンを入力してください。</span>
    {!! Form::open(array('route' => ['front.products.list'], 'method' => 'get', 'enctype'=>'multipart/form-data')) !!}
    <table class="table table-bordered table-regist" style="margin-top: 5px">
      <tbody>
        <tr>
          <td class="col-title">品番（１） <span class="red">（必須）</span></td>
          <td>
            <?php
            if ( isset(Session::get('dataSearch')['item_code_1']) ) {
              $value = Session::get('dataSearch')['item_code_1'];
            } else {
              $value = old('item_code_1');
            }
            ?>
            <input name="item_code_1" value="{{ $value }}" type="text" class="form-control form-control--default">
            @if ($errors->first('item_code_1'))
            <div class="caution"><img src="{{ asset('') }}public/frontend/common/image/caution.gif" width="18px"> {{ $errors->first('item_code_1') }}</div>
            @endif
          </td>
        </tr>
        <tr>
          <td class="col-title">品番（２）</td>
          <td>
            <?php
            if ( isset(Session::get('dataSearch')['item_code_2']) ) {
              $value = Session::get('dataSearch')['item_code_2'];
            } else {
              $value = old('item_code_2');
            }
            ?>
            <input name="item_code_2" value="{{ $value }}" type="text" class="form-control form-control--default">
          </td>
        </tr>
        <tr>
          <td class="col-title">品番（３）</td>
          <td>
            <?php
            if ( isset(Session::get('dataSearch')['item_code_3']) ) {
              $value = Session::get('dataSearch')['item_code_3'];
            } else {
              $value = old('item_code_3');
            }
            ?>
            <input name="item_code_3" value="{{ $value }}" type="text" class="form-control form-control--default">
          </td>
        </tr>
      </tbody>
    </table>
    <div class="row mar-bottom30">
      <div class="col-md-12 text-center">
        <input name="" value="検索開始" type="submit" class="btn btn-sm btn-primary">
      </div>
    </div>
    </form>
  </div>
		  
@stop