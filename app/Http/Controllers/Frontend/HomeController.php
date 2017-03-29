<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Models\CustomerModel;
use App\Http\Models\NewsModel;

use Session;
use Illuminate\Http\Request;
use Cookie;

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
}