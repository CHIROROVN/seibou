<?php namespace App\Http\Models;

use DB;

class CustomerModel
{
    protected $table = 'M_得意先';
    protected $connection = 'sqlsrv';
    protected $primaryId = '得意先CD';
    //protected $statusUse = 'WEB用WEB使用区分';
    //protected $valueUse = 0;
    
    public function getAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->get();
        return $db;
    }
    
    public function getLogin($username, $password)
    {
        $db = DB::connection($this->connection)->table($this->table)
                                                ->where('WEB用ログインID', $username)
                                                ->where('WEB用パスワード', $password)
                                                ->first();
        return $db;
    }
    
    public function getById($id)
    {
        $db = DB::connection($this->connection)->table($this->table)
                                                ->where('得意先CD', $id)
                                                ->first();
        return $db;
    }
}