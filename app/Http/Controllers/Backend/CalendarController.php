<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Models\CalendarModel;
use Input;
use Session;
use Html;
use DB;
use Auth;

class CalendarController extends BackendController
{
    /*
    |-----------------------------------
    | get view calendar
    |-----------------------------------
    */
    public function index() {
        if(Session::has('user')){
            $data['u_name']        = Session::get('user')->u_name;
        }else{
            $data['u_name']        = '';
        }
        $data['title']             = '「営業日カレンダー」管理　＞　登録済み「営業日カレンダー」の一覧';
        $data['year']              = (int) date('Y');
        $data['next_year']         = (int) date('Y') + 1;
        $data['next_year_next']     = (int) date('Y') + 2;
        $data['last_year']         = (int) date('Y') - 1;
        return view('manage.calendar.index', $data);
    }

    /*
    |-----------------------------------
    | get view calendar regist
    |-----------------------------------
    */
    public function regist($year) {
        $data['year']             = $year;
        if(Session::has('user')){
            $data['u_name']        = Session::get('user')->u_name;
        }else{
            $data['u_name']        = '';
        }
        $data['title']             = '「営業日カレンダー」管理　＞　登録済み「営業日カレンダー」の編集';
        return view('manage.calendar.regist', $data);
    }

    /*
    |-----------------------------------
    | post calendar regist
    |-----------------------------------
    */
    public function postRegist($year) {
        $clsCal           = new CalendarModel();
        $input            = Input::all();
        $holidays         = $input['holiday'];
        $flag             = false;

       foreach ($holidays as $k => $day) {
           $m = explode("_", $k);
           $month = $m[2];

           $data['calendar_year']               = $year;
           $data['calendar_free1']              = sprintf('%02d', $month);
           if(empty($day)){
            $data['calendar_date']              = NULL;
           }else{
            $data['calendar_date']              = createDate($year.'-'.$month.'-'.$day);
           }
           $data['last_date']                   = date('Y-m-d H:i:s');
           $data['last_kind']                   = INSERT;
           $data['last_ipadrs']                 = CLIENT_IP_ADRS;
           $data['last_user']                   = Auth::user()->u_id ? Auth::user()->u_id : 0;

           if ( $clsCal->insert($data) ) {
                $flag = true;
            } else {
                $flag = false;
            }
       }
       if($flag){
            Session::flash('success', trans('common.msg_calendar_add_success'));
            return redirect()->route('manage.calendar.index');
       }else{
            Session::flash('danger', trans('common.msg_calendar_add_danger'));
            return redirect()->route('manage.calendar.regist',$year);
       }

    }

    /*
    |-----------------------------------
    | get calendar edit
    |-----------------------------------
    */
    public function edit($year){
        $clsCal           = new CalendarModel();
        $data['year']             = $year;
        if(Session::has('user')){
            $data['u_name']        = Session::get('user')->u_name;
        }else{
            $data['u_name']        = '';
        }
        $data['calendars']          = $clsCal->calendarByYear($year);

        return view('manage.calendar.edit', $data);
    }

    /*
    |-----------------------------------
    | post calendar edit
    |-----------------------------------
    */
    public function postEdit($year){
        $clsCal           = new CalendarModel();
        $input            = Input::all();
        $days             = $input['days'];
        $flag             = false;

        foreach ($days as $k => $day) {
           $m = explode("_", $k);
           $calendar_id  = $m[0];
           $month = $m[1];
           echo $m[1];

           $data['calendar_year']               = $year;
           if(empty($day)){
              $data['calendar_date']            = NULL;
           }else{
              $data['calendar_date']            = createDate($year.'-'.$month.'-'.$day);
           }

           $data['last_date']                   = date('Y-m-d H:i:s');
           $data['last_kind']                   = UPDATE;
           $data['last_ipadrs']                 = CLIENT_IP_ADRS;
           $data['last_user']                   = Auth::user()->u_id ? Auth::user()->u_id : 0;

           if( $clsCal->editCalendar($calendar_id, $data) ){
              $flag = true;
           }else{
              $flag = false;
           }
        }

       if($flag){
            Session::flash('success', trans('common.msg_calendar_edit_success'));
            return redirect()->route('manage.calendar.index');
       }else{
            Session::flash('danger', trans('common.msg_calendar_edit_danger'));
            return redirect()->route('manage.calendar.edit', $year);
       }
    }

    /*
    |-----------------------------------
    | check calendar status
    |-----------------------------------
    */
    static function chkAction($year){
        $clsCalendar           = new CalendarModel();
        $data                  = $clsCalendar->getCalByYear($year);
        if(empty($data)){
            return 'regist';
        }else{
            return 'edit';
        }

    }


    /*
    |-----------------------------------
    | get calendar by year month
    |-----------------------------------
    */
    static function getCalByYearMonth($year, $month){
        $clsCalendar           = new CalendarModel();

        return $clsCalendar->calByYearMonth($year, $month);

    }

     /*
    |-----------------------------------
    | get calendar by year month
    |-----------------------------------
    */
    static function listCalByYearMonth($year, $month){
        $clsCalendar           = new CalendarModel();

        return $clsCalendar->listCalByYearMonth($year, $month);

    }

}