<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Models\UserModel;
use Illuminate\Http\Request;
use Input;
use Session;
use Validator;
use Html;
use Hash;
use Illuminate\Support\Facades\Auth;

class ManageController extends BackendController
{
     public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /*
    |-----------------------------------
    | get view list
    |-----------------------------------
    */
    public function index() {
        $clsUser                   = new UserModel();
        $data['users']             = $clsUser->getAllUser();
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
    | get view users detail
    |-----------------------------------
    */
    public function detail($id) {
        $data['title']             = 'Users Change';
        $clsUser                   = new UserModel();
        $data['user']              = $clsUser->get_by_id($id);
        return view('manage.users.detail', $data);
    }

    /*
    |-----------------------------------
    | get view change password
    |-----------------------------------
    */
    public function changePwd() {
        $clsUser                   = new UserModel();
        $data['u_login']           = Auth::user()->u_login;
        return view('manage.users.change_pwd', $data);
    }

    /*
    |-----------------------------------
    | post view change password
    |-----------------------------------
    */
    public function postChangePwd(Request $request) {
        $clsUser                   = new UserModel();
        $validator = Validator::make(Input::all(), $clsUser->RulesChangePwd(), $clsUser->MessagesChangePwd());
        if ($validator->fails()) {
            return redirect()->route('manage.users.change_pwd')->withErrors($validator)->withInput();
        }

        $data['u_passwd']               = Hash::make(Input::get('new_pwd'));
        $data['last_ipadrs']            = CLIENT_IP_ADRS;
        $data['last_date']              = date('y-m-d H:i:s');
        $data['last_user']              = Auth::user()->u_id;
        $data['last_kind']              = UPDATE;

       if ( $clsUser->update(Auth::user()->u_id, $data) ) {
            Session::flash('success', trans('common.msg_change_pwd_success'));
        } else {
            Session::flash('danger', trans('common.msg_change_pwd_danger'));
        }
        return redirect()->route('manage.users.change_pwd');
    }

}