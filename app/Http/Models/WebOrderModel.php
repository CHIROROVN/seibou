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
    
    public function getByHistoryIdId1($historyId, $historyId1)
    {
        $db = DB::connection($this->connection)->table($this->table)
                                              ->where($this->primaryId, $historyId)
                                              ->where('伝票行No', $historyId1)
                                              ->first();
        return $db;
    }
    
    public function getByHistoryId($historyId)
    {
        $db = DB::connection($this->connection)->table($this->table)
                                              //->leftJoin('M_SIZE', 'D_WEB仮受注伝票.ｻｲｽﾞCD', '=', 'M_SIZE.ｻｲｽﾞCD')
                                              //->leftJoin('M_色', 'D_WEB仮受注伝票.色CD', '=', 'M_色.色CD')
                                              //->select('D_WEB仮受注伝票.*')
                                              ->where($this->primaryId, $historyId)
                                              ->get();
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
            $db = $db->where($this->primaryId, 'LIKE', '%' . $where['web_order_id'] . '%');
        }
        //status
        if ( isset($where['status']) && $where['status'] != '' ) {
            $db = $db->where('出荷区分', $where['status']);
        }
        
        $results = $db->orderBy('出荷区分', 'asc')->orderBy($this->primaryId, 'asc')->get()->unique($this->primaryId);
        return $results;
    }
    
    public function updateHistory($id, $data)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->primaryId, $id)->update($data);
        return $db;
    }
    
    //maybe some record in group order
    public function deleteHistory($historyId)
    {
        $db = DB::connection($this->connection)->table($this->table)->where($this->primaryId, $historyId)->update(['出荷区分' => 31]);
        return $db;
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