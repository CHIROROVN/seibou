<?php namespace App\Http\Models;

use DB;

class WebOrderModel
{
    protected $table = 'D_WEB仮受注伝票';
    protected $connection = 'sqlsrv';
    protected $primaryId = '伝票No';
    //protected $statusUse = 'WEB用WEB使用区分';
    //protected $valueUse = 0;
    
    public function getAll()
    {
        $db = DB::connection($this->connection)->table($this->table)->get();
        return $db;
    }
    
    public function getById($id)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->primaryId, $id)->first();
        return $db;
    }
    
    public function checkIdForInsert($id)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->primaryId, $id)->first();
        
        if ( empty($db) ) {
            return $id;
        }
        
        $tmpId = $id;
        $tmpId++;
        return $this->checkIdForInsert($tmpId);
    }
    
    public function getByCustomerId($customer_id, $where = array())
    {
        $db = DB::connection($this->connection)->table($this->table);
        
        if ( $customer_id != '' ) {
          $db = $db->where('得意先CD', $customer_id);
        }
        //date from
        if ( isset($where['from_year']) && $where['from_year'] != '' ) {
            $db = $db->whereYear('受注日', '>=', $where['from_year']);
        }
        if ( isset($where['from_month']) && $where['from_month'] != '' ) {
            $db = $db->whereMonth('受注日', '>=', $where['from_month']);
        }
        if ( isset($where['from_day']) && $where['from_day'] != '' ) {
            $db = $db->whereDay('受注日', '>=', $where['from_day']);
        }
        //date to
        if ( isset($where['to_year']) && $where['to_year'] != '' ) {
            $db = $db->whereYear('受注日', '<=', $where['to_year']);
        }
        if ( isset($where['to_month']) && $where['to_month'] != '' ) {
            $db = $db->whereMonth('受注日', '<=', $where['to_month']);
        }
        if ( isset($where['to_day']) && $where['to_day'] != '' ) {
            $db = $db->whereDay('受注日', '<=', $where['to_day']);
        }
        //id
        if ( isset($where['web_order_id']) && $where['web_order_id'] != '' ) {
            $db = $db->where('伝票No', 'LIKE', '%' . $where['web_order_id'] . '%');
        }
        //status
        if ( isset($where['status']) && $where['status'] != '' ) {
            $db = $db->where('出荷区分', $where['status']);
        }
        
        $results = $db->orderBy('商品CD', 'asc')->get();
        return $results;
    }
    
    public function insert($data)
    {
        return DB::connection($this->connection)->table($this->table)->insert($data);
    }
    
    public function deleteTest($webOrderId)
    {
        return DB::connection($this->connection)->table($this->table)->where('伝票No', $webOrderId)->delete();
    }
}