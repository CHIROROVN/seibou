<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Auth;
use Input;
use Session;
use Html;
use Form;

class MenuController extends BackendController
{

    /*
    |-----------------------------------
    | get view menu
    |-----------------------------------
    */
    public function index() {
        $data['title']             = '倉敷製帽 WEB受注システム 管理画面';
        $data['page']              = 'menu';
        return view('manage.menu.index', $data);
    }


}