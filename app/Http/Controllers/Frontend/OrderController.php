<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Models\ProductModel;
use App\Http\Models\ColorModel;
use App\Http\Models\SizeModel;
use App\Http\Models\MeisaiModel;
use App\Http\Models\StockModel;
use App\Http\Models\CustomerModel;
use App\Http\Models\DeliveryModel;
use App\Http\Models\WebOrderModel;
use App\Http\Models\ConstantModel;

use Input;
use Session;
use Form;
use Cookie;
use Validator;
use Mail;

class OrderController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if ( !Session::has('cart') ) {
            return redirect()->route('front.products.search');
        }
        
        $clsDelivery                    = new DeliveryModel();
        $clsConstant                    = new ConstantModel();
        $this->data['deliveries']       = $clsDelivery->getByCustomerId(Cookie::get('userLogin')['user_id']);
        $this->data['breadcrumb']       = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $this->data['webmkb']           = $clsConstant->getWEBMKB();
        $this->data['webdkb']           = $clsConstant->getWEBDKB();
        
        return view('frontends.orders.index', $this->data);
    }
    
    public function postIndex()
    {
      
        if ( !Session::has('cart') ) {
            return redirect()->route('front.products.search');
        }
        
        $inputs = Input::all();
        $this->data['breadcrumb']       = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定　＞　確認';
        
        $rules = array(
            'order_name'          => 'required',
            'order_zip3'          => 'required',
            'order_zip4'          => 'required',
            'order_address1'      => 'required',
            'order_tel'           => 'required',
            'order_shipping'      => 'required',
            'order_invoice'       => 'required',
        );
        $messages = array(
            'order_name.required'           => trans('validation.error_order_order_name_required'),
            'order_zip3.required'           => trans('validation.error_order_order_zip3_required'),
            'order_zip4.required'           => trans('validation.error_order_order_zip4_required'),
            'order_address1.required'       => trans('validation.error_order_order_address1_required'),
            'order_tel.required'            => trans('validation.error_order_order_tel_required'),
            'order_shipping.required'       => trans('validation.error_order_shipping_required'),
            'order_invoice.required'        => trans('validation.error_order_invoice_required'),
        );
        $validator = Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('front.orders.index')->withErrors($validator)->withInput();
        }
        
        //first
        //insert new delivery if changed
        $clsDelivery = new DeliveryModel();
        $dataChange = array(
            'customer_id'                     => Cookie::get('userLogin')['user_id'],
            'delivery_name'                   => trim($inputs['order_name']),
            'delivery_division'               => trim($inputs['order_division']),
            'delivery_member'                 => trim($inputs['order_member']),
            'delivery_zip3'                   => trim($inputs['order_zip3']),
            'delivery_zip4'                   => trim($inputs['order_zip4']),
            'delivery_address1'               => trim($inputs['order_address1']),
            'delivery_address2'               => trim($inputs['order_address2']),
            'delivery_tel'                    => trim($inputs['order_tel']),
            'delivery_fax'                    => trim($inputs['order_fax']),
            
            'last_date'                       => date('Y-m-d H:i:s'),
            'last_kind'                       => 0,
            'last_ipadrs'                     => CLIENT_IP_ADRS,
            'last_user'                       => Cookie::get('userLogin')['user_id']
        );
        $changeDelivery = $clsDelivery->getIsChange(Cookie::get('userLogin')['user_id'], $dataChange);
        if ( empty($changeDelivery) ) {
            $clsDelivery->insert($dataChange);
        }
        
        //second
        //set cart
        
        $tmpCartConfirm = array();
        if ( Session::has('cart') ) {
            $tmp = array();
            foreach ( Session::get('cart') as $k => $v ) {
                foreach ( $inputs as $inputK => $inputV ) {
                    if ( 'productIdByCustomer_' . $v['cart_id'] === $inputK ) {
                        $tmp[$k] = $v;
                        $tmp[$k]['productIdByCustomer'] = $inputV;
                    }
                }
            }
            //cart
            $tmpCartConfirm['cart'] = $tmp;
            //order
            $tmpCartConfirm['order_inputs']['order_name'] = trim($inputs['order_name']);
            $tmpCartConfirm['order_inputs']['order_content'] = trim($inputs['order_content']);
            $tmpCartConfirm['order_inputs']['order_content_2'] = trim($inputs['order_content_2']);
            $tmpCartConfirm['order_inputs']['order_shipping'] = trim($inputs['order_shipping']);
            if ( !isset($inputs['order_ship_fly']) ) {
                $tmpCartConfirm['order_inputs']['order_ship_fly'] = '';
            } else {
                $tmpCartConfirm['order_inputs']['order_ship_fly'] = $inputs['order_ship_fly'];
            }
            //delivery
            $tmpCartConfirm['order']['delivery_id'] = trim($inputs['delivery_id']);
            $tmpCartConfirm['order']['order_name'] = trim($inputs['order_name']);
            $tmpCartConfirm['order']['order_division'] = trim($inputs['order_division']);
            $tmpCartConfirm['order']['order_member'] = trim($inputs['order_member']);
            $tmpCartConfirm['order']['order_zip3'] = trim($inputs['order_zip3']);
            $tmpCartConfirm['order']['order_zip4'] = trim($inputs['order_zip4']);
            $tmpCartConfirm['order']['order_address1'] = trim($inputs['order_address1']);
            $tmpCartConfirm['order']['order_address2'] = trim($inputs['order_address2']);
            $tmpCartConfirm['order']['order_tel'] = trim($inputs['order_tel']);
            $tmpCartConfirm['order']['order_fax'] = trim($inputs['order_fax']);
            $tmpCartConfirm['order']['order_invoice'] = trim($inputs['order_invoice']);
            
        }
        Session::put('cartConfirm', $tmpCartConfirm);
        
        //get for confirm
        $clsConstant = new ConstantModel();
        $this->data['webmkb']           = $clsConstant->getWEBMKB();
        $this->data['webdkb']           = $clsConstant->getWEBDKB();
        
        return view('frontends.orders.confirm', $this->data);
    }
    
    public function getEndIndex()
    {
        $clsWebOrder = new WebOrderModel();
        $clsProduct  = new ProductModel();
        
        //$clsWebOrder->deleteTest(2017030004);
        //$clsWebOrder->deleteTest(2017030003);
        //$clsWebOrder->deleteTest(2017030002);
        //$clsWebOrder->deleteTest(2017030001);
        //echo '<pre>';print_r($clsWebOrder->getAll());echo '</pre>';die;
        if ( !Session::has('cartConfirm') || !Session::has('productDetail') ) {
            return redirect()->route('front.products.search');
        }
        
        $clsWebOrder                    = new WebOrderModel();
        $this->data['breadcrumb']       = 'Web受発注システム　＞　在庫照会・発注　＞　　確認　＞　発注完了';
        $this->data['cartConfirm']      = Session::get('cartConfirm');
        $this->data['productDetail']    = Session::get('productDetail');
        $clsConstant = new ConstantModel();
        $webmkb                         = $clsConstant->getWEBMKB();
        $webdkb                         = $clsConstant->getWEBDKB();
        //insert to table "web order table"
        $i = 1;
        $tmpIdInsert = date('ym').sprintf("%04d", $i);
        $tmpIdInsert = (int)$clsWebOrder->checkIdForInsert($tmpIdInsert);
        foreach ( Session::get('cartConfirm')['cart'] as $item ) {
            $product = $clsProduct->getById($item['product_id']);
            $tmp3 = sprintf("%03d", $i);
            $dataInsert = array(
                '伝票No'                 => $tmpIdInsert,
                '伝票行No'               => (int)$tmp3,//(int)sprintf("%03d", $i),
                '得意先CD'               => Cookie::get('userLogin')['user_id'],
                '得意先担当者名'         => empty(Session::get('cartConfirm')['order_inputs']['order_name']) ? '' : Session::get('cartConfirm')['order_inputs']['order_name'],
                '受注日'                 => date('Ymd'),
                '商品CD'                 => $item['product_id'],
                '商品区分'               => (int)$product->商品区分,
                '色CD'                   => $item['color_id'],
                'ｻｲｽﾞCD'                 => $item['size_id'],
                '数量'                   => $item['quantity'],
                '納期連絡区分'            => 1, //after
                '出荷区分'                => 1,
                '注文番号'                => empty($item['productIdByCustomer']) ? '' : $item['productIdByCustomer'],
                'WEB納入先CD'            => empty(Session::get('cartConfirm')['order']['delivery_id']) ? '' : Session::get('cartConfirm')['order']['delivery_id'],//14
                'WEB納入先名'          => empty(Session::get('cartConfirm')['order']['order_name']) ? '' : Session::get('cartConfirm')['order']['order_name'],
                'WEB納入先郵便番号'    => Session::get('cartConfirm')['order']['order_zip3'] . '-' . Session::get('cartConfirm')['order']['order_zip4'],
                'WEB納入先住所1'       => empty(Session::get('cartConfirm')['order']['order_address1']) ? '' : Session::get('cartConfirm')['order']['order_address1'],
                'WEB納入先住所2'       => empty(Session::get('cartConfirm')['order']['order_address2']) ? '' : Session::get('cartConfirm')['order']['order_address2'],
                'WEB納入先電話番号'     => empty(Session::get('cartConfirm')['order']['order_tel']) ? '' : Session::get('cartConfirm')['order']['order_tel'],
                'WEB納入先FAX_番号'     => empty(Session::get('cartConfirm')['order']['order_fax']) ? '' : Session::get('cartConfirm')['order']['order_fax'],
                'WEB納入先部署名'      => empty(Session::get('cartConfirm')['order']['order_division']) ? '' : Session::get('cartConfirm')['order']['order_division'],
                'WEB納入先担当者名'    => empty(Session::get('cartConfirm')['order']['order_member']) ? '' : Session::get('cartConfirm')['order']['order_member'],//22
                'WEB納入先納品書同封区分' => empty(Session::get('cartConfirm')['order']['order_invoice']) ? '' : Session::get('cartConfirm')['order']['order_invoice'],
                '備考'                => empty(Session::get('cartConfirm')['order_inputs']['order_content']) ? '' : Session::get('cartConfirm')['order_inputs']['order_content'],
                '自由欄'               => empty(Session::get('cartConfirm')['order_inputs']['order_content_2']) ? '' : Session::get('cartConfirm')['order_inputs']['order_content_2'],
                '出荷まとめ区分'         => empty(Session::get('cartConfirm')['order_inputs']['order_shipping']) ? '' : Session::get('cartConfirm')['order_inputs']['order_shipping'],
                '便出荷区分'           => (Session::get('cartConfirm')['order_inputs']['order_ship_fly'] == 1) ? Session::get('cartConfirm')['order_inputs']['order_ship_fly'] : 0,
                
                '登録日'              => date('Ymd'),//29
                '最終更新接続元'       => CLIENT_IP_ADRS,//34*/
            );
            if ( $item['quantityStockMeisai'] < $item['quantity'] ) {
                $dataInsert['納期連絡区分'] = 2;
            }
            $insert = $clsWebOrder->insert($dataInsert);
            $i++;
            
            $dataInsert['color_name'] = $item['color_name'];
            $dataInsert['size_name'] = $item['size_name'];
            $dataInsert['prduct_name'] = $product->商品名;
            $tmpEmail['email'][] = $dataInsert;
            //die;
        }
        $tmpEmail['login'] = Cookie::get('userLogin');
        $tmpEmail['webmkb'] = $webmkb;
        $tmpEmail['webdkb'] = $webdkb;
        $this->data['webmkb'] = $webmkb;
        $this->data['webdkb'] = $webdkb;
        
        //$clsWebOrder->deleteTest(2);
        $webOrder = $clsWebOrder->getAll();
        //send 2 email
        //if send is ok -> delete session
        $send = Mail::send(['html' => 'frontends.orders.guest'], array('tmpEmail' => $tmpEmail), function($message) use ($tmpEmail){
            $message->from(FROM_EMAIL, FROM_NAME);
            $message->to($tmpEmail['login']['user_email'])->subject(TITLE_ORDER_GUEST);
        });
        //delete session cart
        Session::forget('productDetail');
        Session::forget('cartConfirm');
        Session::forget('cart');
        return view('frontends.orders.end', $this->data);
    }
    
    public function getDelivery()
    {
        $get_from_server = Input::get('get_from_server');
        $delivery_id = Input::get('delivery_id');
        
        if ( $get_from_server === 'get-delivery-server' ) {
            //get from sql server
            $clsCustomer = new CustomerModel();
            $customer = $clsCustomer->getById(Cookie::get('userLogin')['user_id']);
            $customer = array(
                'customer' => $customer,
                'from' => 'sqlserver'
            );
            echo json_encode($customer);
        } else {
            //get from mysql
            $clsDelivery = new DeliveryModel();
            $delivery = $clsDelivery->get_by_id($delivery_id);
            $delivery = array(
                'customer' => $delivery,
                'from' => 'mysql'
            );
            echo json_encode($delivery);
        }

        
    }
}