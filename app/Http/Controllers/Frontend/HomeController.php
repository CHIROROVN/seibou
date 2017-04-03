<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Models\CustomerModel;
use App\Http\Models\NewsModel;
use App\Http\Models\CalendarModel;

use Session;
use Illuminate\Http\Request;
use Cookie;
use DateTime;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
	
    public function index()
    {

        $clsCustomer                    = new CustomerModel();
        $clsNews                        = new NewsModel();
        $this->data['breadcrumb']       = 'Web受発注システム　＞　ホーム';
        $this->data['news']             = $clsNews->getAll();
        return view('frontends.home.index', $this->data);
    }

    static function calOfMonth()
    {
        $clsCalendar    = new CalendarModel();
        $curr_year      = Date('Y');
        $curr_month     = Date('m');

        $holydays       = $clsCalendar->calByYearMonth($curr_year, sprintf('%02d', $curr_month));
        $hdArr          = array();
        foreach ($holydays as $key => $value) {
            $hdArr[dayFromDate($value->calendar_date)] = dayFromDate($value->calendar_date);
        }

        return draw_calendar($curr_month, $curr_year, $hdArr);
    }

    static function calOfNextMonth()
    {
        $clsCalendar    = new CalendarModel();
        $curr_year      = Date('Y');
        $next_month     = (int) Date('m') + 1;

        $holydays       = $clsCalendar->calByYearMonth($curr_year, sprintf('%02d', $next_month));
        $hdArr          = array();
        foreach ($holydays as $key => $value) {
            $hdArr[dayFromDate($value->calendar_date)] = dayFromDate($value->calendar_date);
        }

        return draw_calendar($next_month, $curr_year, $hdArr);
    }
}