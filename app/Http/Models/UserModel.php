<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class UserModel
{
    protected $table = 'm_user';
    protected $primaryKey = 'u_id';
    public $timestamps  = false;

        public function Rules()
    {
        return array(
            'u_name'                      => 'required',
            'u_login'                     => 'required|unique:m_user',
            'u_passwd'                    => 'required|min:4',
        );
    }

    public function Messages()
    {
        return array(
            'u_name.required'             => trans('validation.error_u_name_required'),
            'u_login.required'            => trans('validation.error_u_login_required'),
            'u_login.unique'              => trans('validation.error_u_login_unique'),
            'u_passwd.required'           => trans('validation.error_u_passwd_required'),
            'u_passwd.min'                => trans('validation.error_u_passwd_min'),
        );
    }


    public function RulesLogin()
    {
        return array(
            'u_login'                     => 'required',
            'u_passwd'                    => 'required',
        );
    }

    public function MessagesLogin()
    {
        return array(
            'u_login.required'            => trans('validation.error_u_login_required'),
            'u_passwd.required'           => trans('validation.error_u_passwd_required'),
        );
    }

    public function RulesChangePwd()
    {
        Validator::extend('checkHashedPass', function($attribute, $value, $parameters)
        {
            if( ! Hash::check( $value , $parameters[0] ) )
            {
                return false;
            }
            return true;
        });

        return array(
                'old_pwd'                          => 'required|checkHashedPass:' . Auth::user()->u_passwd,
                'new_pwd'                          => 'required|min:4',
                'conf_new_pwd'                     => 'same:new_pwd'
                );
    }

    public function MessagesChangePwd()
    {
        return array(
                'old_pwd.required'                  => trans('validation.error_old_pwd_required'),
                'old_pwd.checkHashedPass'           => trans('validation.error_old_pwd_checkHashedPass'),
                'new_pwd.required'                  => trans('validation.error_new_pwd_required'),
                'new_pwd.min'                       => trans('validation.error_new_pwd_min'),
                'conf_new_pwd.same'                 => trans('validation.error_conf_new_pwd_same'),
                );
    }



    //Manage All Users
    public function getAllUser(){
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('u_name', 'asc')->get();
    }

    //users insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //users get by id
    public function get_by_id($id)
    {
        return DB::table($this->table)->where('u_id', $id)->first();
    }

    // get u_login by id
    public function uLoginByID($id)
    {
        return DB::table($this->table)->select('u_login')->where('u_id', $id)->first();
    }

    //users update
    public function update($id, $data)
    {
        return DB::table($this->table)->where('u_id', $id)->update($data);
    }


}