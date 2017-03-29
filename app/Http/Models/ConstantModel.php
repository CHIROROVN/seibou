<?php namespace App\Http\Models;

use DB;

class ConstantModel
{
    protected $table = 'M_CONSTANT';
    protected $connection = 'sqlsrv';
    //protected $primaryId = '色CD';
    //protected $statusUse = 'WEB用WEB使用区分';
    //protected $valueUse = 1;
    
    public function getAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->get();
        return $db;
    }
    
    public function getWEBMKB()
    {
        $db = DB::connection($this->connection)->table($this->table)->where('識別ID', 'WEBMKB')->where('ﾚｺｰﾄﾞ区分', 2)->get();
        return $db;
    }
    
    public function getWEBDKB()
    {
        $db = DB::connection($this->connection)->table($this->table)->where('識別ID', 'WEBDKB')->where('ﾚｺｰﾄﾞ区分', 2)->get();
        return $db;
    }
    
    public function getWEBSKB()
    {
        $db = DB::connection($this->connection)->table($this->table)->where('識別ID', 'WEBSKB')->where('ﾚｺｰﾄﾞ区分', 2)->get();
        return $db;
    }
}