<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Models\ProductModel;
use App\Http\Models\ColorModel;
use App\Http\Models\SizeModel;
use App\Http\Models\MeisaiModel;
use App\Http\Models\StockModel;
use App\Http\Models\CustomerModel;
use App\Http\Models\WebOrderModel;
use App\Http\Models\DeliveryModel;
use App\Http\Models\ConstantModel;

use Input;
use Session;
use Form;
use Cookie;

class HistoryController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注履歴参照';
        $where                         = Input::all();
        //if ( Session::has('historyWhere') ) {
        //    $where = Session::get('historyWhere');
        //}
        /*else {
            if ( empty($where) ) {
                $where = array(
                    'from_year' => '',
                    'from_month' => '',
                    'from_day' => '',
                    'to_year' => '',
                    'to_month' => '',
                    'to_day' => '',
                    'web_order_id' => '',
                    'status' => 1
                );
            }
        }*/
        //$clsWebOrder->deleteTest(2017030001);
        //echo '<pre>';print_r($clsWebOrder->getAll());print_r(Cookie::get('userLogin'));echo '</pre>';//die;
        Session::put('historyWhere', $where);
        $this->data['historys']         = $clsWebOrder->getByCustomerId(trim(Cookie::get('userLogin')['user_id']), $where);
        $this->data['webskb']           = $clsConstant->getWEBSKB();
        
        return view('frontends.history.index', $this->data);
    }
    
    public function getDetail($id)
    {
        $clsWebOrder                   = new WebOrderModel();
        $clsProduct                    = new ProductModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsDelivery                   = new DeliveryModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注履歴参照';
        $this->data['history']         = $clsWebOrder->getById($id);
        $this->data['historyProducts'] = $clsWebOrder->getByCustomerId($this->data['history']->得意先CD);
        $this->data['product']         = $clsProduct->getById($this->data['history']->商品CD);
        $this->data['color']           = $clsColor->getByIdProduct($this->data['history']->色CD, $this->data['history']->商品CD);
        $this->data['size']            = $clsSize->getByIdProduct($this->data['history']->ｻｲｽﾞCD, $this->data['history']->商品CD);
        $this->data['delivery']        = $clsDelivery->getByCustomerIdFirst(Cookie::get('userLogin')['user_id']);
        $where                         = Input::all();
        /*if ( empty($where) ) {
            if ( Session::has('historyWhere') ) {
                $where = Session::get('historyWhere');
            } {
                $where = array(
                  'from_year' => '',
                  'from_month' => '',
                  'from_day' => '',
                  'to_year' => '',
                  'to_month' => '',
                  'to_day' => '',
                  'web_order_id' => '',
                  'status' => 1
              );
            }
        }*/
        $where = Session::get('historyWhere');
        //echo '<pre>';print_r($where);echo '</pre>';
        $this->data['historys']        = $clsWebOrder->getByCustomerId(Cookie::get('userLogin')['user_id'], $where);
        
        return view('frontends.history.detail', $this->data);
    }
}