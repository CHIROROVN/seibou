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

		$dt 		= DateTime::createFromFormat("Y-m-d", $date);
	 	return $dt->format("d");
    }

    function showYear($date){

        $dt         = DateTime::createFromFormat("Y-m-d", $date);
        return $dt->format("Y");
    }

    function showMonth($date){

        $dt         = DateTime::createFromFormat("Y-m-d", $date);
        return $dt->format("m");
    }

    function showDay($date){

        $dt         = DateTime::createFromFormat("Y-m-d", $date);
        return $dt->format("d");
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

