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

//Backend
Route::group(['prefix' => 'manage', 'namespace' => 'Backend'], function () {
    /*
    |--------------------------------------------------------------------------
    | Manage home page
    |--------------------------------------------------------------------------
    */

    Route::get('/menu', ['as' => 'manage.menu.index', 'uses' => 'MenuController@index']);

    Route::get('/users/login', ['as' => 'manage.users.login', 'uses' => 'ManageController@login']);
    Route::post('/users/login', ['as' => 'manage.users.login', 'uses' => 'ManageController@postLogin']);
    Route::get('/users/logout', ['as' => 'manage.users.logout', 'uses' => 'ManageController@logout']);

    Route::get('/users', ['as' => 'manage.users.index', 'uses' => 'ManageController@index']);


    Route::get('/users/regist', ['as' => 'manage.users.regist', 'uses' => 'ManageController@regist']);
    Route::post('/users/regist', ['as' => 'manage.users.regist', 'uses' => 'ManageController@postRegist']);
    Route::get('/users/change/{id}', ['as' => 'manage.users.change', 'uses' => 'ManageController@change']);
    Route::post('/users/change/{id}', ['as' => 'manage.users.change', 'uses' => 'ManageController@postChange']);
    Route::get('/users/change_pass', ['as' => 'manage.users.change_pass', 'uses' => 'ManageController@changePass']);
    Route::post('/users/change_pass', ['as' => 'manage.users.change_pass', 'uses' => 'ManageController@postchangePass']);
    Route::get('/users/del/{id}', ['as' => 'manage.users.del', 'uses' => 'ManageController@del']);

    Route::get('/calendar', ['as' => 'manage.calendar.index', 'uses' => 'CalendarController@index']);
    Route::get('/calendar/regist', ['as' => 'manage.calendar.regist', 'uses' => 'CalendarController@regist']);
    Route::post('/calendar/regist', ['as' => 'manage.calendar.regist', 'uses' => 'CalendarController@postRegist']);

    Route::get('/notice', ['as' => 'manage.notice.index', 'uses' => 'NoticeController@index']);
    Route::get('/notice/regist', ['as' => 'manage.notice.regist', 'uses' => 'NoticeController@regist']);
    Route::post('/notice/regist', ['as' => 'manage.notice.regist', 'uses' => 'NoticeController@postRegist']);
    Route::get('/notice/change/{id}', ['as' => 'manage.notice.change', 'uses' => 'NoticeController@change']);
    Route::post('/notice/change/{id}', ['as' => 'manage.notice.change', 'uses' => 'NoticeController@postChange']);
    Route::get('/notice/change_pass', ['as' => 'manage.notice.change_pass', 'uses' => 'NoticeController@changePass']);
    Route::post('/notice/change_pass', ['as' => 'manage.notice.change_pass', 'uses' => 'NoticeController@postchangePass']);
    Route::get('/notice/detail', ['as' => 'manage.notice.detail', 'uses' => 'NoticeController@detail']);
    Route::get('/notice/del/{id}', ['as' => 'manage.notice.del', 'uses' => 'NoticeController@del']);


});

//Frontend
Route::group(['prefix' => '', 'namespace' => 'Frontend'], function () {
    /*
    |--------------------------------------------------------------------------
    | Front home page
    |--------------------------------------------------------------------------
    */
//    Route::get('/', ['as' => 'frontend.home.index', 'uses' => 'HomeController@index']);



});

    Route::get('manage', function () {
        if(Auth::check()){
            return redirect()->route('backend.dashboard.index');
        }else{
            return redirect()->to('manage/login');
        }
    });

    Route::get('manage', function () {
        return redirect()->to('manage/login');
    });
