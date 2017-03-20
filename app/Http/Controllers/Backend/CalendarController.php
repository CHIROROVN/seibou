<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Input;
use Session;
use Html;

class CalendarController extends BackendController
{
    /*
    |-----------------------------------
    | get view calendar
    |-----------------------------------
    */
    public function index() {
        $data['title']             = 'Calendar List';
        return view('manage.calendar.index', $data);
    }

    /*
    |-----------------------------------
    | get view calendar regist
    |-----------------------------------
    */
    public function regist() {
        $data['title']             = 'Calendar Regist';
        return view('manage.calendar.regist', $data);
    }

    /*
    |-----------------------------------
    | post calendar regist
    |-----------------------------------
    */
    public function postRegist() {

    }

}