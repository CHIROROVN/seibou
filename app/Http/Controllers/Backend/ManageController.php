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
        return view('manage.users.index', $data);
    }

    /*
    |-----------------------------------
    | get view users regist
    |-----------------------------------
    */
    public function regist() {
        return view('manage.users.regist');
    }

    /*
    |-----------------------------------
    | post users regist
    |-----------------------------------
    */
    public function postRegist(Request $request) {
        $clsUser                   = new UserModel();
        $validator = Validator::make(Input::all(), $clsUser->Rules(), $clsUser->Messages());
        if ($validator->fails()) {
            return redirect()->route('manage.users.regist')->withErrors($validator)->withInput();
        }
        $data['u_name']                 = $request->get('u_name');
        $data['u_login']                = $request->get('u_login');
        $data['u_passwd']               = Hash::make($request->get('u_passwd'));
        $data['u_power1']               = ($request->get('u_power1')) ? $request->get('u_power1') : null;
        $data['u_power2']               = ($request->get('u_power2')) ? $request->get('u_power2') : null;
        $data['u_power3']               = ($request->get('u_power3')) ? $request->get('u_power3') : null;
        $data['u_free1']                = ($request->get('u_free1')) ? 1 : 2;
        $data['last_ipadrs']            = CLIENT_IP_ADRS;
        $data['last_date']              = date('y-m-d H:i:s');
        $data['last_user']              = Auth::user()->u_id;
        $data['last_kind']              = INSERT;
        $data['u_passwd_original']      = $request->get('u_passwd');

        $request->session()->put('users', $data);
        return redirect()->route('manage.users.regist_cnf');

    }

    /*
    |-----------------------------------
    | get users regist confirm
    |-----------------------------------
    */
    public function registCnf(Request $request) {
        if (!$request->session()->has('users')) return redirect()->route('manage.users.regist');
        if ($request->session()->has('users')) {
            $data['user']           = (Object) $request->session()->get('users');
        }

        return view('manage.users.regist_cnf', $data);
    }

    /*
    |-----------------------------------
    | post users regist confirm
    |-----------------------------------
    */
    public function postRegistCnf(Request $request)
    {
        $clsUser                   = new UserModel();
        if ($request->session()->has('users')) {
            $data               =  $request->session()->get('users');
            unset($data['u_passwd_original']);
            if ( $clsUser->insert($data) ) {
                $request->session()->forget('users');
                return redirect()->route('manage.users.index');
            } else {
                return redirect()->route('manage.users.regist_cnf');
            }
        }else{
            return redirect()->route('manage.users.regist');
        }
    }


    /*
    |-----------------------------------
    | get view users change
    |-----------------------------------
    */
    public function change($id) {
        $clsUser                   = new UserModel();
        $data['user']              = $clsUser->get_by_id($id);
        return view('manage.users.change', $data);
    }

    /*
    |-----------------------------------
    | post users change
    |-----------------------------------
    */
    public function postChange($id, Request $request) {
        $clsUser                   = new UserModel();
        $user                      = $clsUser->uLoginByID($id);
        $Rules                     = $clsUser->Rules();

        if(empty($request->get('u_passwd'))){
            unset($Rules['u_passwd']);
        }

        if( $request->get('u_login') == $user->u_login ){
            unset($Rules['u_login']);
        }

        $validator = Validator::make(Input::all(), $Rules, $clsUser->Messages());
        if ($validator->fails()) {
            return redirect()->route('manage.users.change',$id)->withErrors($validator)->withInput();
        }

        $data['u_id']                   = $id;
        $data['u_name']                 = $request->get('u_name');
        $data['u_login']                = $request->get('u_login');
        if(!empty($request->get('u_passwd'))){
            $data['u_passwd']               = Hash::make($request->get('u_passwd'));
            $data['u_passwd_original']      = $request->get('u_passwd');
        }
        $data['u_power1']               = ($request->get('u_power1')) ? $request->get('u_power1') : null;
        $data['u_power2']               = ($request->get('u_power2')) ? $request->get('u_power2') : null;
        $data['u_power3']               = ($request->get('u_power3')) ? $request->get('u_power3') : null;
        $data['u_free1']                = ($request->get('u_free1')) ? 1 : 2;
        $data['last_ipadrs']            = CLIENT_IP_ADRS;
        $data['last_date']              = date('y-m-d H:i:s');
        $data['last_user']              = Auth::user()->u_id;
        $data['last_kind']              = UPDATE;

        $request->session()->put('users', $data);
        return redirect()->route('manage.users.change_cnf', $id);
    }

        /*
    |-----------------------------------
    | get view users change confirm
    |-----------------------------------
    */
    public function changeCnf($id, Request $request) {
        if (!$request->session()->has('users')) return redirect()->route('manage.users.change', $id);
        
        if ($request->session()->has('users')) {
            $data['user']           = (Object) $request->session()->get('users');
        }
        return view('manage.users.change_cnf', $data);
    }

    /*
    |-----------------------------------
    | post users change confirm
    |-----------------------------------
    */
    public function postChangeCnf($id, Request $request) {
        $clsUser                   = new UserModel();
        if ($request->session()->has('users')) {
            $data               =  $request->session()->get('users');
            unset($data['u_id']);
            unset($data['u_passwd_original']);
            if ( $clsUser->update($id, $data) ) {
                $request->session()->forget('users');
                return redirect()->route('manage.users.index');
            } else {
                return redirect()->route('manage.users.change_cnf',$id);
            }
        }else{
            return redirect()->route('manage.users.change',$id);
        }
    }

    /*
    |-----------------------------------
    | get view users detail
    |-----------------------------------
    */
    public function detail($id) {
        $clsUser                   = new UserModel();
        $data['user']              = $clsUser->get_by_id($id);
        return view('manage.users.detail', $data);
    }

    /*
    |-----------------------------------
    | get view users delete confirm
    |-----------------------------------
    */
    public function deleteCnf($id) {
        $clsUser                   = new UserModel();
        $data['user']              = $clsUser->get_by_id($id);
        return view('manage.users.delete_cnf', $data);
    }

    /*
    |-----------------------------------
    | user delete
    |-----------------------------------
    */
    public function delete($id) {
        $data['last_kind']       = DELETE;
        $data['last_date']       = date('Y-m-d H:i:s');
        $data['last_ipadrs']     = CLIENT_IP_ADRS;
        $data['last_user']       = Auth::user()->u_id;
        $clsUser                   = new UserModel();
        if ( $clsUser->update($id, $data) ) {
            return redirect()->route('manage.users.index');
        } else {
            return redirect()->route('manage.users.detail',$id);
        }
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