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
    <link href="{{ asset('') }}public/frontend/common/css/madd.css" rel="stylesheet">
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
        <!-- //////////////////  miyake add  ////////////////// -->
        <div class="username">ログインユーザー名 : {{ Cookie::get('userLogin')['company_name'] }}</div>
        <!-- ////////////////// /miyake add  //////////////////-->
        <div class="row">
          <div class="col-md-12">
            <div class="title-top">{{ $breadcrumb }}</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header -->
    <!-- content home -->
    <section id="page-fontend">
      <div class="container">
        <div class="row">
          <div class="col-md-3 menu-left">
            <div class="navi">
              <div class="title-navi">
                メニューへ
              </div>
              <ul>
                <li><a href="{{ route('front.home') }}">ホーム</a></li>
                <li><a href="{{ route('front.products.search') }}">在庫照会・発注</a></li>
                <?php
                $link = route('front.products.cart', [0]);
                if ( Session::has('cart') && Session::has('productDetail') ) {
                  $link = route('front.products.cart', [trim(Session::get('productDetail')->商品CD)]);
                }
                ?>
                <li><a href="{{ $link }}">発注リストの中身</a></li>
                <li><a href="{{ route('front.history.index') }}">発注履歴参照</a></li>
                <li><a href="{{ route('front.delivery.index') }}">納入先リスト編集</a></li>
                <li><a href="{{ route('front.logout') }}">ログアウト</a></li>
              </ul>
            </div>
            
            <div class="navi">
              <div class="title-navi">
                営業日カレンダー
              </div>
              <div class="calendar">
                <div class="frame">
                  <div>2017年2月</div>
                    <table>
                      <tbody>
                      <tr>
                        <th>日</th>
                        <th>月</th>
                        <th>火</th>
                        <th>水</th>
                        <th>木</th>
                        <th>金</th>
                        <th>土</th>
                      </tr>
                      <tr>
                        <td><span>1</span></td>
                        <td><span>2</span></td>
                        <td><span>3</span></td>
                        <td><span>4</span></td>
                        <td>5</td>
                        <td>6</td>
                        <td><span>7</span></td>
                      </tr>
                      <tr>
                        <td><span>8</span></td>
                        <td><span>9</span></td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td><span>14</span></td>
                      </tr>
                      <tr>
                        <td><span>15</span></td>
                        <td>16</td>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                      </tr>
                      <tr>
                        <td><span>22</span></td>
                        <td>23</td>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td><span>28</span></td>
                      </tr>
                      <tr>
                        <td><span>29</span></td>
                        <td>30</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </tbody></table>
                </div>
                <div class="frame">
                  <div>2017年2月</div>
                    <table>
                    <tbody>
                    <tr>
                      <th>日</th>
                      <th>月</th>
                      <th>火</th>
                      <th>水</th>
                      <th>木</th>
                      <th>金</th>
                      <th>土</th>
                    </tr>
                    <tr>
                      <td><span>1</span></td>
                      <td><span>2</span></td>
                      <td><span>3</span></td>
                      <td><span>4</span></td>
                      <td>5</td>
                      <td>6</td>
                      <td><span>7</span></td>
                    </tr>
                    <tr>
                      <td><span>8</span></td>
                      <td><span>9</span></td>
                      <td>10</td>
                      <td>11</td>
                      <td>12</td>
                      <td>13</td>
                      <td><span>14</span></td>
                    </tr>
                    <tr>
                      <td><span>15</span></td>
                      <td>16</td>
                      <td>17</td>
                      <td>18</td>
                      <td>19</td>
                      <td>20</td>
                      <td>21</td>
                    </tr>
                    <tr>
                      <td><span>22</span></td>
                      <td>23</td>
                      <td>24</td>
                      <td>25</td>
                      <td>26</td>
                      <td>27</td>
                      <td><span>28</span></td>
                    </tr>
                    <tr>
                      <td><span>29</span></td>
                      <td>30</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody></table>
                </div>
                <p>※赤字は定休日です</p>
              </div>
            </div>
          </div>
          
		  <!-- content -->
          @yield('content')
		  <!-- end content -->
          
        </div>
      </div>
    </section>
    <!-- End content home -->
    
    <!-- Footer -->
      <div class="footer">
        <div class="container">
          (c)2017- Kurashiki Seibou All Rights Reserved.
        </div>
      </div>
    <!-- End footer -->
    
  </body>
</html>