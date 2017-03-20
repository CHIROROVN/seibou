<?php
/**
 * Created by PhpStorm.
 * User: phu
 * Date: 3/20/2017
 * Time: 9:48 AM
 */

namespace App\Http\Controllers;

use DB;


class TestController extends Controller
{
    public function index()
    {
        $results = DB::connection('sqlsrv')->select('SELECT * FROM M_商品');

        echo '<pre>';
        print_r($results);
        die;
    }
}