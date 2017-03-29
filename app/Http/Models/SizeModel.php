<?php namespace App\Http\Models;

use DB;

class SizeModel
{
    protected $table = 'M_SIZE';
    protected $connection = 'sqlsrv';
    protected $primaryId = 'ｻｲｽﾞCD';
    protected $statusUse = 'ｻｲｽﾞCD';
    protected $valueNotUse = 0;
    
    public function getAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, '!=', $this->valueNotUse)->get();
        return $db;
    }
    
    public function getByProduct($productId)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, '!=', $this->valueNotUse);
        
        if ( $productId != '' ) {
          $db = $db->where('商品CD', $productId);
        }
        
        $results = $db->get();
        return $results;
    }
    
    public function getByIdProduct($id, $productId)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, '!=', $this->valueNotUse);
        
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