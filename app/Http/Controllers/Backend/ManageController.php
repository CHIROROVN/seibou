<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Input;
use Session;
use Html;

class ManageController extends BackendController
{
    /*
    |-----------------------------------
    | get view list
    |-----------------------------------
    */
    public function index() {
        $data['title']             = 'Users Management';
        return view('manage.users.index', $data);
    }

    /*
    |-----------------------------------
    | get view users regist
    |-----------------------------------
    */
    public function regist() {
        $data['title']             = 'Users Regist';
        return view('manage.users.regist', $data);
    }

    /*
    |-----------------------------------
    | post users regist
    |-----------------------------------
    */
    public function postRegist() {
        
    }

    /*
    |-----------------------------------
    | get view users change
    |-----------------------------------
    */
    public function change() {
        $data['title']             = 'Users Change';
        return view('manage.users.change', $data);
    }

    /*
    |-----------------------------------
    | post users change
    |-----------------------------------
    */
    public function postChange() {
        
    }

    /*
    |-----------------------------------
    | get view login
    |-----------------------------------
    */
    public function login() {
        $data['title']             = 'Users Login';
        return view('manage.users.login', $data);
    }

    /*
    |-----------------------------------
    | post login
    |-----------------------------------
    */
    public function postLogin() {

    }

    /*
    |-----------------------------------
    | get view change password
    |-----------------------------------
    */
    public function changePass() {
        $data['title']             = 'Change Paasword';
        return view('manage.users.change_pass', $data);
    }

}