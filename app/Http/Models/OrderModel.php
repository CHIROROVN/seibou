<?php namespace App\Http\Models;

use DB;

class OrderModel
{
    protected $table = 'D_WEB仮受注伝票';
    protected $connection = 'sqlsrv';
    protected $primaryId = '伝票No';
    //protected $statusUse = 'WEB用WEB使用区分';
    //protected $valueUse = 0;
    
    public function getAll($where = array())
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, $this->valueUse);
        
        if ( isset($where['item_code_1']) && $where['item_code_1'] != '' ) {
          $db = $db->where($this->primaryId, 'LIKE', '%' . $where['item_code_1'] . '%');
        }
        if ( isset($where['item_code_2']) && $where['item_code_2'] != '' ) {
          $db = $db->where($this->primaryId, 'LIKE', '%' . $where['item_code_2'] . '%');
        }
        if ( isset($where['item_code_3']) && $where['item_code_3'] != '' ) {
          $db = $db->where($this->primaryId, 'LIKE', '%' . $where['item_code_3'] . '%');
        }
        
        $results = $db->get();
        return $results;
    }
    
    public function getById($productId)
    {
        $db = DB::connection($this->connection)->table($this->table)
                                              ->where($this->statusUse, $this->valueUse)
                                              ->where($this->primaryId, $productId)
                                              ->first();
        return $db;
    }
    
    public function countAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->statusUse, $this->valueUse)->count();
        return $db;
    }
}