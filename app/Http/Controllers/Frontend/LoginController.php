<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Models\CustomerModel;

use Input;
use Session;
use Form;
use Validator;
use Illuminate\Http\Response;
use Cookie;

class LoginController extends FrontendController
{
    public function __construct()
    {
        //parent::__construct();
        
    }
    
    public function getLogin()
    {
        if ( Cookie::get('userLogin') ) {
            return redirect()->route('front.home');
        }
        
        //$clsCustomer = new CustomerModel();
        $data['breadcrumb'] = 'Web受発注システム　＞　ログイン';
        return view('frontends.login.login', $data);
    }
    
    public function postLogin()
    {
        $inputs = Input::all();
        $clsCustomer = new CustomerModel();
        
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );
        $messages = array(
            'username.required' => trans('validation.error_username_required'),//trans('validation.error_username_required')
            'password.required' => trans('validation.error_password_required')
        );
        $validator = Validator::make($inputs, $rules, $messages);
        if ( $validator->fails() ) {
            return redirect()->route('front.login')->withErrors($validator)->withInput();
        }
        $user = $clsCustomer->getLogin($inputs['username'], $inputs['password']);
        if ( empty($user) ) {
            //login error
            Session::flash('danger', trans('common.message_login_danger'));
            return redirect()->route('front.login');
        }
        
        //login success
        $userLogin = array(
            'user_id' => $user->得意先CD,
            'username' => $user->WEB用ﾛｸﾞｲﾝID,
            'company_name' => $user->得意先名,
            'user_email' => $user->WEB用Email
        );
        
        $cookie = cookie('userLogin', $userLogin, 3600);
        
        return redirect()->route('front.home')->cookie($cookie);
    }
    
    public function getLogout()
    {
        Cookie::queue(Cookie::forget('userLogin'));
        
        $data['breadcrumb'] = 'Web受発注システム　＞　ログアウト';
        return view('frontends.login.logout', $data);
    }
}