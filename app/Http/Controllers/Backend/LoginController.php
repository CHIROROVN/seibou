<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use App\Http\Models\UserModel;
use Request;
use Session;
use Validator;
use Illuminate\Support\Facades\Auth;
use Html;
use Illuminate\Support\Facades\Input;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BackendController
{
        use AuthenticatesUsers;
   
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
        $clsUser            = new UserModel();
        $validator = Validator::make(Input::all(), $clsUser->RulesLogin(), $clsUser->MessagesLogin());

        if ($validator->fails()) {
            return redirect()->route('manage.users.login')->withErrors($validator)->withInput();
        }

        $login0 = array(
            'u_login'           => Input::get('u_login'),
            'password'          => Input::get('u_passwd'),
            'last_kind'         => INSERT,
            'u_free1'           => ENABLE,
        );
        
        $login1 = array(
            'u_login'           => Input::get('u_login'),
            'password'          => Input::get('u_passwd'),
            'last_kind'         => UPDATE,
            'u_free1'           => ENABLE,
        );
        if (Auth::attempt($login0, false)) {
            return redirect()->route('manage.menu.index');
        } elseif (Auth::attempt($login1, false)) {
            return redirect()->route('manage.menu.index');
        } else {
            Session::flash('danger', trans('common.msg_manage_login_danger'));
            return redirect()->route('manage.users.login')->withErrors($validator)->withInput();
        }
    }

    /*
    |-----------------------------------
    | post logout
    |-----------------------------------
    */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return view('manage.users.logout');
    }

    /*
    |-----------------------------------
    | get view change password
    |-----------------------------------
    */

}