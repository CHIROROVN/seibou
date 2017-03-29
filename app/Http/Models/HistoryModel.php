<?php namespace App\Http\Models;

use DB;

class HistoryModel
{
    protected $table = 'M_色';
    protected $connection = 'sqlsrv';
    protected $primaryId = '色CD';
    protected $statusUse = 'WEB用WEB使用区分';
    protected $valueUse = 0;
    
    public function getAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, $this->valueUse)->get();
        return $db;
    }
    
    public function getByProduct($productId)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, $this->valueUse);
        
        if ( $productId != '' ) {
          $db = $db->where('商品CD', $productId);
        }
        
        $results = $db->get();
        return $results;
    }
    
    public function getByIdProduct($id, $productId)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, $this->valueUse);
        
        if ( $id != '' ) {
          $db = $db->where($this->primaryId, $id);
        }
        if ( $productId != '' ) {
          $db = $db->where('商品CD', $productId);
        }
        
        $results = $db->first();
        return $results;
    }
}