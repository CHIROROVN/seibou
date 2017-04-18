<?php namespace App\Http\Models;

use DB;

class DeliveryModel
{
    protected $table = 't_delivery';
    protected $primaryId = 'delivery_id';
    public $timestamps  = false;


    public function Rules()
    {
        return array(
            'delivery_name'                => 'required',
            'delivery_zip3'                => 'required|numeric',
            'delivery_zip4'                => 'required|numeric',
            'delivery_address1'            => 'required',
            'delivery_tel'                 => 'required|regex:/^\+?[^a-zA-Z]{1,}$/',
            'delivery_fax'                 => 'regex:/^\+?[^a-zA-Z]{1,}$/',
            'delivery_satisfy'             => 'required',
        );
    }

    public function Messages()
    {
        return array(
            'delivery_name.required'           => trans('validation.error_delivery_name_required'),
            'delivery_zip3.required'           => trans('validation.error_delivery_zip3_required'),
            'delivery_zip3.numeric'            => trans('validation.error_delivery_zip3_numeric'),
            'delivery_zip4.required'           => trans('validation.error_delivery_zip4_required'),
            'delivery_zip4.numeric'            => trans('validation.error_delivery_zip4_numeric'),
            'delivery_address1.required'       => trans('validation.error_delivery_address1_required'),
            'delivery_tel.required'            => trans('validation.error_delivery_tel_required'),
            'delivery_tel.regex'               => trans('validation.error_delivery_tel_regex'),
            'delivery_fax.regex'               => trans('validation.error_delivery_fax_regex'),
            'delivery_satisfy.required'        => trans('validation.error_delivery_satisfy_required'),
        );
    }

    //get all delivery
    public function getAll($customer_id=null)
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->where('customer_id', $customer_id)->orderBy('last_date', 'desc')->get();
    }
    
    public function getByCustomerId($customer_id)
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->where('customer_id', $customer_id)->orderBy('last_date', 'desc')->get();
    }
    
    public function getByCustomerIdFirst($customer_id)
    {
        $db = DB::table($this->table)->where('last_kind', '<>', DELETE)->where('customer_id', $customer_id)->orderBy('last_date', 'desc')->get();
        return $db[0];
    }
    
    public function getIsChange($customer_id, $data)
    {
        $db = DB::table($this->table)->where('last_kind', '<>', DELETE)->where('customer_id', $customer_id);
        
        if ( $data['delivery_name'] ) {
            $db = $db->where('delivery_name', $data['delivery_name']);
        }
        if ( $data['delivery_division'] ) {
            $db = $db->where('delivery_division', $data['delivery_division']);
        }
        if ( $data['delivery_member'] ) {
            $db = $db->where('delivery_member', $data['delivery_member']);
        }
        if ( $data['delivery_zip3'] ) {
            $db = $db->where('delivery_zip3', $data['delivery_zip3']);
        }
        if ( $data['delivery_zip4'] ) {
            $db = $db->where('delivery_zip4', $data['delivery_zip4']);
        }
        if ( $data['delivery_address1'] ) {
            $db = $db->where('delivery_address1', $data['delivery_address1']);
        }
        if ( $data['delivery_address2'] ) {
            $db = $db->where('delivery_address2', $data['delivery_address2']);
        }
        if ( $data['delivery_tel'] ) {
            $db = $db->where('delivery_tel', $data['delivery_tel']);
        }
        if ( $data['delivery_fax'] ) {
            $db = $db->where('delivery_fax', $data['delivery_fax']);
        }
        
        $result = $db->orderBy('last_date', 'desc')->first();
        return $result;
    }

    //delivery insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //delivery get by id
    public function get_by_id($id)
    {
        return DB::table($this->table)->where('delivery_id', $id)->first();
    }

    //delivery update
    public function update($id, $data)
    {
        return DB::table($this->table)->where('delivery_id', $id)->update($data);
    }
    
    //delivery address default update to NULL
    public function getAddrsDefault()
    {
        return DB::table($this->table)->select('delivery_id')->where('last_kind', '<>', DELETE)->where('delivery_free2', '1')->get();
    }
}