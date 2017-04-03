<?php

    function chkCalendar($year){
       return App\Http\Controllers\Backend\CalendarController::chkAction($year);
    }
    
    function formatDate($date = null, $comma = null){
        $dates = date_create($date);
        if($comma == null){
            return date_format($dates,"Y/m/d");
        }else{
            return date_format($dates,"Y".$comma."m".$comma."d");
        }
    }

    function holidayOfMonth($year, $month){
       return App\Http\Controllers\Backend\CalendarController::getCalByYearMonth($year, $month);
    }

    function listCalByYearMonth($year, $month){
        return App\Http\Controllers\Backend\CalendarController::listCalByYearMonth($year, $month);
    }

    function dayFromDate($date){
        $dt         = DateTime::createFromFormat("Y-m-d", $date);
        if(!empty($dt)){
            return $dt->format("d");
         }else{
            return '';
         }
    }

    function showYear($date){

        $dt         = DateTime::createFromFormat("Y-m-d", $date);
        return $dt->format("Y");
    }

    function showMonth($date){

        $dt         = DateTime::createFromFormat("Y-m-d", $date);
        return $dt->format("m");
    }

    function createDate($str){
        if(!empty($str)){
            return date('Y-m-d', strtotime($str));
        }else{
            return "";
        }
    }

    function dateEn2Ja($date){
        if(!empty($date)){
            $d = explode('-', $date);
            return $d[0].'年'.$d[1].'月'.$d[2].'日';
        }else{
            return '';
        }
    }

    //get sundays in month
    function getSundays($y,$m){ 
        $date = "$y-$m-01";
        $first_day = date('N',strtotime($date));
        $first_day = 7 - $first_day + 1;
        $last_day =  date('t',strtotime($date));
        $days = array();
        for($i=$first_day; $i<=$last_day; $i=$i+7 ){
            $days[] = $i;
        }
        return  $days;
    }

    function getDays($year){
        $num_of_days = array();
        $total_month = 12;
        if($year == date('Y'))
            $total_month = date('m');
        else
            $total_month = 12;

        for($m=1; $m<=$total_month; $m++){
            $num_of_days[$m] = cal_days_in_month(CAL_GREGORIAN, $m, $year);
        }

        return $num_of_days;
    }

    function DayOfMonth($m, $year){
        return cal_days_in_month(CAL_GREGORIAN, $m, $year);
    }

    function calOfMonth(){
       $strHtml = App\Http\Controllers\Frontend\HomeController::calOfMonth();
       return $strHtml;
    }

    function calOfNextMonth(){
       $strHtml = App\Http\Controllers\Frontend\HomeController::calOfNextMonth();
       return $strHtml;
    }

    function draw_calendar($month, $year, $hdArr=null){
        $sundays    = getSundays($year, $month);

        if(!empty($hdArr)){
            $sundays = array_merge($sundays, $hdArr);
        }

        $holydayArr = array();
        foreach ($sundays as $key => $value) {
            $holidayArr[c2Digit($value)] = c2Digit($value);
        }

        /* draw table */
        $calendar = '<table>';

        /* table headings */
        $headings = array('日','月','火','水','木','金','土');
        $calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';

        /* days and weeks vars now ... */
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();
        $jum_day     = 0;
        /* row for week one */
        $calendar.= '<tr>';

        /* print "blank" days until the first of the current week */
        for($x = 0; $x < $running_day; $x++):
            $calendar.= '<td> </td>';
            $days_in_this_week++;
        endfor;

        /* keep going with days.... */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar.= '<td>';
                /* add in the day number */

            if(c2Digit($list_day) == @$holidayArr[c2Digit($list_day)]){
                $calendar.= '<span>'.$list_day;
                $calendar.= '</span></td>';
            }else {
                $calendar.= $list_day;
                $calendar.= '</td>';
            }

            if($jum_day <= 6){
                $jum_day = $jum_day + 1;
            }

                /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
                //$calendar.= str_repeat('<p> </p>',2);

            if($running_day == 6):
                $calendar.= '</tr>';
                if(($day_counter+1) != $days_in_month):
                    $calendar.= '<tr>';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;

        /* finish the rest of the days in the week */
        if($days_in_this_week < 8):
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar.= '<td> </td>';
            endfor;
        endif;

        /* final row */
        $calendar.= '</tr>';

        /* end the table */
        $calendar.= '</table>';
        
        /* all done, return result */
        return $calendar;
    }

    function c2Digit($str){
        return sprintf("%02d", $str);
    }


