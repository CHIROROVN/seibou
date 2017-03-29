<?php namespace App\Http\Models;

use DB;

class NewsModel
{
    protected $table = 't_news';
    protected $primaryId = 'news_id';
    public $timestamps  = false;


    public function Rules()
    {
        return array(
            
        );
    }

    public function Messages()
    {
        return array(
            
        );
    }

    public function getAll()
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('last_date', 'desc')->get();
    }

    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    public function get_by_id($id)
    {
        return DB::table($this->table)->where($this->primaryId, $id)->first();
    }

    public function update($id, $data)
    {
        return DB::table($this->table)->where($this->primaryId, $id)->update($data);
    }
}