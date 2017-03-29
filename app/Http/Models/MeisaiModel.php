<?php namespace App\Http\Models;

use DB;

class MeisaiModel
{
    protected $table = 'D_受注明細';
    protected $connection = 'sqlsrv';
    protected $primaryId = '得意先CD';
    //protected $statusUse = 'WEB用WEB使用区分';
    //protected $valueUse = 0;
    
    public function getAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->limit(50)->get();
        return $db;
    }
    
    public function getByProductColorSizeDate($productId, $colorId, $sizeId, $dateFrom, $dateTo)
    {
        $db = DB::connection($this->connection)->table($this->table)
                                                ->where('売上残管理', 1)
                                                ->where('売上残ﾌﾗｸﾞ', 1)
                                                ->where('強制残F更新', 0);
                                                
        
        if ( $productId != '' ) {
            $db = $db->where('商品CD', $productId);
        }
        if ( $colorId != '' ) {
            $db = $db->where('色CD', $colorId);
        }
        if ( $sizeId != '' ) {
            $db = $db->where('ｻｲｽﾞCD', $sizeId);
        }
        if ( $dateFrom != '' && $dateTo != '' ) {
            $db = $db->where('受注日', '>=', $dateFrom)->where('受注日', '<=', $dateTo);
        }
        
        $results = $db->get();
        return $results;
    }
}