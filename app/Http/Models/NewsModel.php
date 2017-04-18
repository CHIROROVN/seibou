<?php namespace App\Http\Models;
use Carbon\Carbon;
use DB;

class NewsModel
{
    protected $table = 't_news';
    protected $primaryId = 'news_id';
    public $timestamps  = false;


    public function Rules()
    {
        return array(
            'news_title'                                    => 'required',
            'year'                                          => 'required',
            'month'                                         => 'required',
            'day'                                           => 'required',
            'news_contents'                                 => 'required',
        );
    }

    public function Messages()
    {
        return array(
            'news_title.required'                           => trans('validation.error_news_title_required'),
            'year.required'                                 => trans('validation.error_news_year_required'),
            'month.required'                                => trans('validation.error_news_month_required'),
            'day.required'                                  => trans('validation.error_news_day_required'),
            'news_contents.required'                        => trans('validation.error_news_contents_required'),
        );
    }

    public function getAll()
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('last_date', 'desc')->get();
    }
    
    //Show frontend news  
    public function getAllNews()
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)
                                    ->whereNull('news_display')
                                    ->where('news_startday', '<=', Carbon::today()->toDateString())
                                    ->where('news_endday', '>=', Carbon::today()->toDateString())
                                    ->orderBy('news_date', 'desc')->get();
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