<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Input;
use Session;
use Html;

class MenuController extends BackendController
{
    /*
    |-----------------------------------
    | get view menu
    |-----------------------------------
    */
    public function index() {
        $data['title']             = 'Xanh Tuoi';
        return view('manage.menu.index', $data);
    }

}