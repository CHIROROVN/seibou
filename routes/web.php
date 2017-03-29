<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/test', 'TestController@index');

//frontend
Route::group(['prefix' => 'front', 'namespace' => 'Frontend'], function () 
{
    Route::get('/', function(){
        return redirect()->route('front.home');
    });

    // home
    Route::get('/home', ['as' => 'front.home', 'uses' => 'HomeController@index']);
    
    //products
    Route::get('/products/search', ['as' => 'front.products.search', 'uses' => 'ProductController@getSearch']);
    Route::get('/products/list', ['as' => 'front.products.list', 'uses' => 'ProductController@getList']);
    Route::get('/products/detail/{id}', ['as' => 'front.products.detail', 'uses' => 'ProductController@getDetail']);
    Route::any('/products/cart/{id}', ['as' => 'front.products.cart', 'uses' => 'ProductController@postCart']);
    Route::get('/products/cart/delete/{id}', ['as' => 'front.products.cart.delete', 'uses' => 'ProductController@getDeleteCart']);
    
    //orders
    Route::get('/orders', ['as' => 'front.orders.index', 'uses' => 'OrderController@index']);
    Route::post('/orders', ['as' => 'front.orders.index', 'uses' => 'OrderController@postIndex']);
    Route::get('/orders/end', ['as' => 'front.orders.end', 'uses' => 'OrderController@getEndIndex']);
    Route::get('/orders/get-delivery', ['as' => 'front.orders.get.delivery', 'uses' => 'OrderController@getDelivery']);
    
    //history
    Route::get('/history', ['as' => 'front.history.index', 'uses' => 'HistoryController@index']);
    Route::get('/history/detail/{id}', ['as' => 'front.history.detail', 'uses' => 'HistoryController@getDetail']);

    //Delivery
    Route::get('/delivery', ['as' => 'front.delivery.index', 'uses' => 'DeliveryController@index']);

    Route::get('/delivery/regist', ['as' => 'front.delivery.regist', 'uses' => 'DeliveryController@regist']);
    Route::post('/delivery/regist', ['as' => 'front.delivery.regist', 'uses' => 'DeliveryController@postRegist']);
    Route::get('/delivery/regist/confirm', ['as' => 'front.delivery.regist_confirm', 'uses' => 'DeliveryController@registConfirm']);
    Route::get('/delivery/regist/save', ['as' => 'front.delivery.regist_save', 'uses' => 'DeliveryController@postRegistConfirm']);
    Route::get('/delivery/change/{id}', ['as' => 'front.delivery.change', 'uses' => 'DeliveryController@change']);
    Route::post('/delivery/change/{id}', ['as' => 'front.delivery.change', 'uses' => 'DeliveryController@postChange']);
    Route::get('/delivery/change/confirm/{id}', ['as' => 'front.delivery.change_confirm', 'uses' => 'DeliveryController@changeConfirm']);
    Route::get('/delivery/change/save/{id}', ['as' => 'front.delivery.change_save', 'uses' => 'DeliveryController@postChangeConfirm']);
    Route::get('/delivery/detail/{id}', ['as' => 'front.delivery.detail', 'uses' => 'DeliveryController@detail']);
    Route::get('/delivery/delete/confirm/{id}', ['as' => 'front.delivery.delete_confirm', 'uses' => 'DeliveryController@delete']);
    Route::get('/delivery/delete/{id}', ['as' => 'front.delivery.delete', 'uses' => 'DeliveryController@postDelete']);

    
    //orders
    Route::get('/orders', ['as' => 'front.orders.index', 'uses' => 'OrderController@index']);
    
    //login
    Route::get('/login', ['as' => 'front.login', 'uses' => 'LoginController@getLogin']);
    Route::post('/login', ['as' => 'front.login', 'uses' => 'LoginController@postLogin']);
    Route::get('/logout', ['as' => 'front.logout', 'uses' => 'LoginController@getLogout']);
});

//Backend
Route::group(['prefix' => 'manage', 'namespace' => 'Backend'], function () {
    /*
    |--------------------------------------------------------------------------
    | Manage home page
    |--------------------------------------------------------------------------
    */

    Route::get('/menu', ['as' => 'manage.menu.index', 'uses' => 'MenuController@index']);

    Route::get('/login', ['as' => 'manage.users.login', 'uses' => 'LoginController@login']);
    Route::post('/login', ['as' => 'manage.users.login', 'uses' => 'LoginController@postLogin']);
    Route::get('/logout', ['as' => 'manage.users.logout', 'uses' => 'LoginController@logout']);
	
	Route::get('/users', ['as' => 'manage.users.index', 'uses' => 'ManageController@index']);
    Route::get('/users/regist', ['as' => 'manage.users.regist', 'uses' => 'ManageController@regist']);
    Route::post('/users/regist', ['as' => 'manage.users.regist', 'uses' => 'ManageController@postRegist']);
    Route::get('/users/change/{id}', ['as' => 'manage.users.change', 'uses' => 'ManageController@change']);
    Route::post('/users/change/{id}', ['as' => 'manage.users.change', 'uses' => 'ManageController@postChange']);
    Route::get('/users/del/{id}', ['as' => 'manage.users.del', 'uses' => 'ManageController@del']);
    Route::get('/users/detail/{id}', ['as' => 'manage.users.detail', 'uses' => 'ManageController@detail']);

    Route::get('users/change_pwd', ['as' => 'manage.users.change_pwd', 'uses' => 'ManageController@changePwd']);
    Route::post('users/change_pwd', ['as' => 'manage.users.change_pwd', 'uses' => 'ManageController@postchangePwd']);

    Route::get('/calendar', ['as' => 'manage.calendar.index', 'uses' => 'CalendarController@index']);
    Route::get('/calendar/regist/{year}', ['as' => 'manage.calendar.regist', 'uses' => 'CalendarController@regist']);
    Route::post('/calendar/regist/{year}', ['as' => 'manage.calendar.regist', 'uses' => 'CalendarController@postRegist']);
    Route::get('/calendar/edit/{year}', ['as' => 'manage.calendar.edit', 'uses' => 'CalendarController@edit']);
    Route::post('/calendar/edit/{year}', ['as' => 'manage.calendar.edit', 'uses' => 'CalendarController@postEdit']);

    Route::get('/notice', ['as' => 'manage.notice.index', 'uses' => 'NoticeController@index']);
    Route::get('/notice/regist', ['as' => 'manage.notice.regist', 'uses' => 'NoticeController@regist']);
    Route::post('/notice/regist', ['as' => 'manage.notice.regist', 'uses' => 'NoticeController@postRegist']);
    Route::get('/notice/regist_cnf', ['as' => 'manage.notice.regist_cnf', 'uses' => 'NoticeController@registCnf']);
    Route::get('/notice/regist_save', ['as' => 'manage.notice.regist_save', 'uses' => 'NoticeController@postRegistCnf']);
    Route::get('/notice/change/{id}', ['as' => 'manage.notice.change', 'uses' => 'NoticeController@change']);
    Route::post('/notice/change/{id}', ['as' => 'manage.notice.change', 'uses' => 'NoticeController@postChange']);
    Route::get('/notice/change_cnf/{id}', ['as' => 'manage.notice.change_cnf', 'uses' => 'NoticeController@changeCnf']);
    Route::get('/notice/change_save/{id}', ['as' => 'manage.notice.change_save', 'uses' => 'NoticeController@postChangeCnf']);
    Route::get('/notice/detail/{id}', ['as' => 'manage.notice.detail', 'uses' => 'NoticeController@detail']);
    Route::get('/notice/delete_cnf/{id}', ['as' => 'manage.notice.delete_cnf', 'uses' => 'NoticeController@deleteCnf']);
    Route::get('/notice/del/{id}', ['as' => 'manage.notice.delete', 'uses' => 'NoticeController@delete']);

});

    Route::get('manage', function () {
        if(Auth::check() == false){
            return redirect()->route('manage.users.login');
        }else{
            return redirect()->route('manage.menu.index');
        }
    });

    Route::get('manage/users/login', function () {
        return redirect()->route('manage.users.login');
    });