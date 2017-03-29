<?php namespace App\Http\Models;

use DB;

class StockModel
{
    protected $table = 'D_商品月間色SIZE';
    protected $connection = 'sqlsrv';
    protected $primaryId = '倉庫CD';
    //protected $statusUse = 'WEB用WEB使用区分';
    //protected $valueUse = 0;
    
    public function getAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->get();
        return $db;
    }
    
    public function getByProductColorSize($productId, $colorId, $sizeId)
    {
        $db = DB::connection($this->connection)->table($this->table);
        
        if ( $productId != '' ) {
          $db = $db->where('商品CD', $productId);
        }
        if ( $colorId != '' ) {
          $db = $db->where('色CD', $colorId);
        }
        if ( $sizeId != '' ) {
          $db = $db->where('ｻｲｽﾞCD', $sizeId);
        }
        
        $results = $db->orderBy('年月度', 'desc')->first();
        return $results;
    }
}