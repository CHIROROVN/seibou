<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Input;
use Session;
use Html;

class NoticeController extends BackendController
{
    /*
    |-----------------------------------
    | get view notice
    |-----------------------------------
    */
    public function index() {
        $data['title']             = 'notice List';
        return view('manage.notice.index', $data);
    }

    /*
    |-----------------------------------
    | get view notice regist
    |-----------------------------------
    */
    public function regist() {
        $data['title']             = 'notice Regist';
        return view('manage.notice.regist', $data);
    }

    /*
    |-----------------------------------
    | post notice regist
    |-----------------------------------
    */
    public function postRegist() {

    }

    /*
    |-----------------------------------
    | get view notice change
    |-----------------------------------
    */
    public function change() {
        $data['title']             = 'notice change';
        return view('manage.notice.change', $data);
    }

    /*
    |-----------------------------------
    | post notice change
    |-----------------------------------
    */
    public function postChange() {

    }

    /*
    |-----------------------------------
    | get view notice detail
    |-----------------------------------
    */
    public function detail() {
        $data['title']             = 'notice detail';
        return view('manage.notice.detail', $data);
    }

    /*
    |-----------------------------------
    | notice delete
    |-----------------------------------
    */
    public function del($id) {

    }


}