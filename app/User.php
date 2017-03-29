<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'm_user';
    protected $primaryKey = 'u_id';
    public $timestamps  = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function getAuthUsername() {
    //     return $this->u_login;
    // }

    // public function setUsername($u_passwd)
    // {
    //     $this->u_login = Hash::make($u_login);
    // }

    public function getPasswordAttribute(){
        return $this->u_passwd;
    } 

    public function setPasswordAttribute($value){
        $this->u_passwd = $value;
    }

    public function getRememberToken()
     {
       return null; // not supported
     }

     public function setRememberToken($value)
     {
       // not supported
     }
}
