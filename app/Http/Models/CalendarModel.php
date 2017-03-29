<?php namespace App\Http\Models;

use DB;

class CalendarModel
{
    protected $table = 't_calendar';
    protected $primaryId = 'calendar_id';
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

    //get calendar by year
    public function getCalByYear($year=null)
    {
        return DB::table($this->table)->select('calendar_year')->where('last_kind', '<>', DELETE)->where('calendar_year', $year)->first();
    }

    //get all calendar by year
    public function calendarByYear($year=null)
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->where('calendar_year', $year)->get();
    }

    //get calendar by year-month
    public function calByYearMonth($year=null, $month=null)
    {
        return DB::table($this->table)->select('calendar_date')
                                    ->where('last_kind', '<>', DELETE)
                                    ->where('calendar_year', '=', $year)
                                    ->whereMonth('calendar_date',$month)
                                    ->get();
    }

    //get list calendar by year-month
    public function listCalByYearMonth($year=null, $month=null)
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)
                                    ->where('calendar_year', '=', $year)
                                    ->whereMonth('calendar_date',$month)
                                    ->lists('calendar_date','calendar_id');
    }


    //Calendar insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //Calendar get by id
    public function get_by_id($id)
    {
        return DB::table($this->table)->where('calendar_id', $id)->first();
    }


    //Calendar update
    public function editCalendar($year, $calendar_date, $data)
    {
        return DB::table($this->table)->where('calendar_year', '=', $year)->where('calendar_date', '=', $calendar_date)->update($data);
    }
}