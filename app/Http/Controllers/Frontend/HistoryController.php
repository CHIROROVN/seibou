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

use Mail;
use Input;
use Session;
use Form;
use Cookie;
use Validator;

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
        
        $this->data['historys']         = array();
        if ( Input::get('search') ) {
            $this->data['historys']         = $clsWebOrder->getByCustomerId(trim(Cookie::get('userLogin')['user_id']), $where);
        }
        
        //$clsWebOrder->deleteTest(17030001);
        //echo '<pre>';print_r($clsWebOrder->getAll());print_r(Cookie::get('userLogin'));echo '</pre>';die;
        Session::put('historyWhere', $where);
        
        $this->data['webskb']           = $clsConstant->getWEBSKB();
        $this->data['where']            = $where;
        
        return view('frontends.history.index', $this->data);
    }
    
    public function getDetail()
    {
        $id                            = Input::get('id');
        $id1                           = Input::get('id1');
        if ( $id <= 0 || $id1 <= 0 ) {
            return redirect()->route('front.history.index');
        }
        $clsWebOrder                   = new WebOrderModel();
        $clsProduct                    = new ProductModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsDelivery                   = new DeliveryModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注履歴参照';
        $this->data['history']         = $clsWebOrder->getByHistoryIdId1($id, $id1);
        
        $this->data['historyProducts'] = $clsWebOrder->getByHistoryId($this->data['history']->伝票No);
        $this->data['delivery']        = $clsDelivery->getByCustomerIdFirst(Cookie::get('userLogin')['user_id']);
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        $this->data['webmkb']          = $clsConstant->getWEBMKB();
        $tmpProduct = array();
        $tmpColor = array();
        $tmpSize = array();
        foreach ( $this->data['historyProducts'] as $item ) {
            $tmpProduct[] = $clsProduct->getById($item->商品CD);
            $tmpColor[] = $clsColor->getByIdProduct($item->色CD, $item->商品CD);
            $tmpSize[] = $clsSize->getByIdProduct($item->ｻｲｽﾞCD, $item->商品CD);
        }
        $this->data['products']         = $tmpProduct;
        $this->data['colors']         = $tmpColor;
        $this->data['sizes']         = $tmpSize;
        
        $where                         = Input::all();
        Session::put('historyWhere', $where);
        Session::put('historyDetail', $this->data['history']);
        $this->data['historys']         = $clsWebOrder->getByCustomerId(trim(Cookie::get('userLogin')['user_id']), $where);
        $this->data['where'] = $where;
        
        return view('frontends.history.detail', $this->data);
    }
    
    public function getCancel()
    {
        $this->data['id'] = Input::get('id');
        $this->data['id1'] = Input::get('id1');
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsProduct                    = new ProductModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　キャンセル内容確認';
        $this->data['history']         = $clsWebOrder->getById($this->data['id']);
        $this->data['webOrders']       = $clsWebOrder->getByHistoryId($this->data['id']);
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        
        $tmpCancel = array();
        foreach ( $this->data['webOrders'] as $item ) {
            $product = $clsProduct->getById($item->商品CD);
            $color = $clsColor->getByIdProduct($item->色CD, $item->商品CD);
            $size = $clsSize->getByIdProduct($item->ｻｲｽﾞCD, $item->商品CD);
            
            $tmp['product_id'] = $item->商品CD;
            $tmp['product_name'] = $product->商品名;
            $tmp['quantity'] = $item->数量;
            $tmp['statusStar'] = $item->納期連絡区分;
            $tmp['color_name'] = $color->色名;
            $tmp['size_name'] = $size->ｻｲｽﾞ名;
            $tmp['productIdByCustomer'] = $item->注文番号;
            $tmpCancel[] = $tmp;
        }
        
        Session::put('cancel', $tmpCancel);
        Session::put('id', $this->data['id']);
        Session::put('id1', $this->data['id1']);
        $this->data['cancel'] = $tmpCancel;
        
        return view('frontends.history.cancel', $this->data);
    }
    
    public function getCancelEnd()
    {
        if ( !Session::has('cancel') ) {
            return redirect()->route('front.history.index');
        }
        $this->data['id'] = Session::get('id');
        $this->data['id1'] = Session::get('id1');
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsProduct                    = new ProductModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注履歴参照';
        $this->data['history']         = $clsWebOrder->getByHistoryIdId1($this->data['id'], $this->data['id1']);
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        
        //delete history = cancel = update status to 31
        $status = $clsWebOrder->deleteHistory($this->data['id']);
        
        //send email to guest
        $tmpEmail['cancel'] = Session::get('cancel');
        $tmpEmail['login'] = Cookie::get('userLogin');
        $tmpEmail['history'] = $this->data['history'];
        $send = Mail::send(['html' => 'frontends.history.cancel_guest'], array('tmpEmail' => $tmpEmail), function($message) use ($tmpEmail){
            $message->from(FROM_EMAIL, FROM_NAME);
            $message->to($tmpEmail['login']['user_email'])->subject(TITLE_CANCEL_GUEST);
        });
        
        $this->data['cancel'] = Session::get('cancel');
        Session::forget('cancel');
        Session::forget('id');
        Session::forget('id1');
        
        return view('frontends.history.cancel_end', $this->data);
    }
    
    public function getCancelDetail()
    {
        $id                            = Input::get('id');
        $id1                           = Input::get('id1');
        if ( $id <= 0 || $id1 <= 0 ) {
            return redirect()->route('front.history.index');
        }
        $clsWebOrder                   = new WebOrderModel();
        $clsProduct                    = new ProductModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsDelivery                   = new DeliveryModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注履歴参照';
        $this->data['history']         = $clsWebOrder->getByHistoryIdId1($id, $id1);
        
        $this->data['historyProducts'] = $clsWebOrder->getByHistoryId($this->data['history']->伝票No);
        $this->data['delivery']        = $clsDelivery->getByCustomerIdFirst(Cookie::get('userLogin')['user_id']);
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        $this->data['webmkb']          = $clsConstant->getWEBMKB();
        $tmpProduct = array();
        $tmpColor = array();
        $tmpSize = array();
        foreach ( $this->data['historyProducts'] as $item ) {
            $tmpProduct[] = $clsProduct->getById($item->商品CD);
            $tmpColor[] = $clsColor->getByIdProduct($item->色CD, $item->商品CD);
            $tmpSize[] = $clsSize->getByIdProduct($item->ｻｲｽﾞCD, $item->商品CD);
        }
        $this->data['products']         = $tmpProduct;
        $this->data['colors']         = $tmpColor;
        $this->data['sizes']         = $tmpSize;
        $where                         = Input::all();

        $where = Session::get('historyWhere');
        
        $this->data['historys']        = $clsWebOrder->getByCustomerId(Cookie::get('userLogin')['user_id'], $where);
        $this->data['where']            = $where;
        
        return view('frontends.history.cancel_detail', $this->data);
    }
    
    public function getCartChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsProduct                    = new ProductModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsDelivery                   = new DeliveryModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注内容変更';
        $this->data['history']         = Session::get('historyDetail');
        $this->data['historyProducts'] = $clsWebOrder->getByHistoryId($this->data['history']->伝票No);
        $this->data['delivery']        = $clsDelivery->getByCustomerIdFirst(Cookie::get('userLogin')['user_id']);
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        $tmpProduct = array();
        $tmpColor = array();
        $tmpSize = array();
        foreach ( $this->data['historyProducts'] as $item ) {
            $tmpProduct[] = $clsProduct->getById($item->商品CD);
            $tmpColor[] = $clsColor->getByIdProduct($item->色CD, $item->商品CD);
            $tmpSize[] = $clsSize->getByIdProduct($item->ｻｲｽﾞCD, $item->商品CD);
        }
        $this->data['products']         = $tmpProduct;
        $this->data['colors']         = $tmpColor;
        $this->data['sizes']         = $tmpSize;
        
        return view('frontends.history.cart_change', $this->data);
    }
    
    public function postCartChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $inputs = Input::all();
        unset($inputs['_token']);
        $clsWebOrder                   = new WebOrderModel();
        $clsProduct                    = new ProductModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsConstant                   = new ConstantModel();
        
        $tmpGroup = array();
        foreach ( $inputs as $k => $v ) {
            $tmp = explode("_", $k);
            $historyId = $tmp[1];
            $historyId1 = $tmp[2];
            if ( !in_array($historyId.'_'.$historyId1, $tmpGroup) ) {
              $tmpGroup[] = $historyId.'_'.$historyId1;
            }
            
        }
        
        $setInputs = array();
        foreach ( $tmpGroup as $group ) {
            $setInputs[$group] = array();
            foreach ( $inputs as $k => $v ) {
                $tmp = explode("_", $k);
                $historyId = $tmp[1];
                $historyId1 = $tmp[2];
                
                if ( $group === $historyId.'_'.$historyId1 ) {
                    if ( $tmp[0] === 'quantityChange' ) {
                        $setInputs[$group]['quantityChange'] = $v;
                    } else {
                        $setInputs[$group]['itemCodeByCustomerChange'] = $v;
                    }
                }
            }
        }
        
        $tmpSetInputs = array();
        foreach ( $setInputs as $k => $v ) {
            $tmp = explode('_', $k);
            $historyId = $tmp[0];
            $historyId1 = $tmp[1];
            
            $history = $clsWebOrder->getByHistoryIdId1($historyId, $historyId1);
            $product = $clsProduct->getById($history->商品CD);
            $color = $clsColor->getByIdProduct($history->色CD, $history->商品CD);
            $size = $clsSize->getByIdProduct($history->ｻｲｽﾞCD, $history->商品CD);
            
            $tmp = array();
            $tmp['product_id'] = $history->商品CD;
            $tmp['product_name'] = $product->商品名;
            $tmp['color_name'] = $color->色名;
            $tmp['size_name'] = $size->ｻｲｽﾞ名;
            $tmp['quantity'] = $history->数量;
            $tmp['statusStart'] = $history->納期連絡区分;
            $tmp['itemCodeByCustomer'] = $history->注文番号;
            $tmp['quantityChange'] = $v['quantityChange'];
            $tmp['itemCodeByCustomerChange'] = $v['itemCodeByCustomerChange'];
            $tmpSetInputs[$historyId.'_'.$historyId1] = $tmp;
        }
        
        Session::put('cartChange', $tmpSetInputs);
        $this->data['history'] = Session::get('historyDetail');
        $this->data['cartChange'] = $tmpSetInputs;
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　変更後発注内容';
        return view('frontends.history.cart_change_confirm', $this->data);
    }
    
    public function getCartChangeEnd()
    {
        if ( !Session::has('cartChange') || !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注内容変更';
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['cartChange'] = Session::get('cartChange');
        $this->data['webskb']          = $clsConstant->getWEBSKB();

        //1: update history
        foreach ( Session::get('cartChange') as $k => $v ) {
            $explode                  = explode('_', $k);
            $id                       = $explode[0];
            $id1                      = $explode[1];
            
            $dataUpdate               = array(
                '数量'                => ($v['quantityChange'] == '') ? $v['quantity'] : $v['quantityChange'],
                '注文番号'            => ($v['itemCodeByCustomerChange'] == '') ? $v['itemCodeByCustomer'] : $v['itemCodeByCustomerChange'],
                
                '最終更新日'           => date('Ymd'),
                '最終更新時間'         => date('H:i:s'),
                '最終更新接続元'       => CLIENT_IP_ADRS
            );
            
            $status = $clsWebOrder->updateHistory($id, $dataUpdate);
        }

        //2: send email to guest
        $tmpEmail['cart'] = Session::get('cartChange');
        $tmpEmail['login'] = Cookie::get('userLogin');
        $tmpEmail['history'] = $history;
        $send = Mail::send(['html' => 'frontends.history.cart_change_guest'], array('tmpEmail' => $tmpEmail), function($message) use ($tmpEmail){
            $message->from(FROM_EMAIL, FROM_NAME);
            $message->to($tmpEmail['login']['user_email'])->subject(TITLE_CART_CHANGE_GUEST);
        });


        //delete session
        //Session::forget('historyDetail');
        Session::forget('cartChange');
        
        return view('frontends.history.cart_change_end', $this->data);
    }
    
    public function getStaffChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        return view('frontends.history.staff_change', $this->data);
    }
    
    public function postStaffChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $inputs = Input::all();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['staffChange'] = $inputs;
        Session::put('staffChange', $inputs);
        return view('frontends.history.staff_change_confirm', $this->data);
    }
    
    public function getStaffChangeEnd()
    {
        if ( !Session::has('historyDetail') || !Session::has('staffChange') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['staffChange'] = Session::get('staffChange');

        //1: update
        $dataUpdate               = array(
            '得意先担当者名'       => (empty($this->data['staffChange']['order_name_change'])) ? '' : $this->data['staffChange']['order_name_change'],
            '備考'                => (empty($this->data['staffChange']['order_content_change'])) ? '' : $this->data['staffChange']['order_content_change'],
            
            '最終更新日'           => date('Ymd'),
            '最終更新時間'         => date('H:i:s'),
            '最終更新接続元'       => CLIENT_IP_ADRS
        );
        
        $status = $clsWebOrder->updateHistory($history->伝票No, $dataUpdate);
        
        //2: send email
        $tmpEmail['login'] = Cookie::get('userLogin');
        $tmpEmail['history'] = $history;
        $tmpEmail['staffChange'] = $this->data['staffChange'];
        
        $send = Mail::send(['html' => 'frontends.history.staff_change_guest'], array('tmpEmail' => $tmpEmail), function($message) use ($tmpEmail){
            $message->from(FROM_EMAIL, FROM_NAME);
            $message->to($tmpEmail['login']['user_email'])->subject(TITLE_STAFF_CHANGE_GUEST);
        });
        
        Session::forget('staffChange');
            
        return view('frontends.history.staff_change_end', $this->data);
    }
    
    public function getMessageChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['webmkb']          = $clsConstant->getWEBMKB();
        return view('frontends.history.message_change', $this->data);
    }
    
    public function postMessageChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $inputs = Input::all();
        $rules = array(
            'order_shipping_change'          => 'required',
        );
        $messages = array(
            'order_shipping_change.required' => trans('validation.error_order_shipping_required'),
        );
        $validator = Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('front.history.message_change')->withErrors($validator)->withInput();
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $inputs['order_ship_fly_change'] = (isset($inputs['order_ship_fly_change'])) ? $inputs['order_ship_fly_change'] : '';
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $this->data['webmkb']          = $clsConstant->getWEBMKB();
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['messageChange'] = $inputs;
        Session::put('messageChange', $inputs);
        return view('frontends.history.message_change_confirm', $this->data);
    }
    
    public function getMessageChangeEnd()
    {
        if ( !Session::has('historyDetail') || !Session::has('messageChange') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['messageChange'] = Session::get('messageChange');
        $this->data['webmkb']          = $clsConstant->getWEBMKB();

        //1: update
        $dataUpdate               = array(
            '自由欄'              => (empty($this->data['messageChange']['order_content_2_change'])) ? '' : $this->data['messageChange']['order_content_2_change'],
            '出荷まとめ区分'        => (empty($this->data['messageChange']['order_shipping_change'])) ? '' : $this->data['messageChange']['order_shipping_change'],
            '便出荷区分'           => (empty($this->data['messageChange']['order_ship_fly_change'])) ? '' : $this->data['messageChange']['order_ship_fly_change'],
            
            '最終更新日'           => date('Ymd'),
            '最終更新時間'         => date('H:i:s'),
            '最終更新接続元'       => CLIENT_IP_ADRS
        );
        
        $status = $clsWebOrder->updateHistory($history->伝票No, $dataUpdate);
        
        //2: send email
        $tmpEmail['login'] = Cookie::get('userLogin');
        $tmpEmail['history'] = $history;
        $tmpEmail['messageChange'] = $this->data['messageChange'];
        $tmpEmail['webmkb'] = $clsConstant->getWEBMKB();
        
        $send = Mail::send(['html' => 'frontends.history.message_change_guest'], array('tmpEmail' => $tmpEmail), function($message) use ($tmpEmail){
            $message->from(FROM_EMAIL, FROM_NAME);
            $message->to($tmpEmail['login']['user_email'])->subject(TITLE_MESSAGE_CHANGE_GUEST);
        });
        
        Session::forget('messageChange');
            
        return view('frontends.history.message_change_end', $this->data);
    }
    
    public function getOrderChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $clsDelivery                   = new DeliveryModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $history                       = Session::get('historyDetail');
        $this->data['history']         = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['webmkb']          = $clsConstant->getWEBMKB();
        $this->data['webdkb']          = $clsConstant->getWEBDKB();
        $this->data['deliveries']      = $clsDelivery->getByCustomerId(Cookie::get('userLogin')['user_id']);
        return view('frontends.history.order_change', $this->data);
    }
    
    public function postOrderChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $inputs = Input::all();

        $rules = array(
            'order_name'          => 'required',
            'order_zip3'          => 'required',
            'order_zip4'          => 'required',
            'order_address1'      => 'required',
            'order_tel'           => 'required',
            'order_invoice'       => 'required',
        );
        $messages = array(
            'order_name.required'           => trans('validation.error_order_order_name_required'),
            'order_zip3.required'           => trans('validation.error_order_order_zip3_required'),
            'order_zip4.required'           => trans('validation.error_order_order_zip4_required'),
            'order_address1.required'       => trans('validation.error_order_order_address1_required'),
            'order_tel.required'            => trans('validation.error_order_order_tel_required'),
            'order_invoice.required'        => trans('validation.error_order_invoice_required'),
        );
        $validator = Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('front.history.order_change')->withErrors($validator)->withInput();
        }

        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $this->data['webmkb']          = $clsConstant->getWEBMKB();
        $this->data['webdkb']           = $clsConstant->getWEBDKB();
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['orderChange'] = $inputs;
        Session::put('orderChange', $inputs);
        return view('frontends.history.order_change_confirm', $this->data);
    }
    
    public function getOrderChangeEnd()
    {
        if ( !Session::has('historyDetail') || !Session::has('orderChange') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　在庫照会・発注　＞　納入先の指定';
        $history                       = Session::get('historyDetail');
        $this->data['history']         = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['orderChange']     = Session::get('orderChange');
        $this->data['webmkb']          = $clsConstant->getWEBMKB();

        //1: update
        $dataUpdate               = array(
            'WEB納入先名'          => empty($this->data['orderChange']['order_name']) ? '' : $this->data['orderChange']['order_name'],
            'WEB納入先郵便番号'    => $this->data['orderChange']['order_zip3'] . '-' . $this->data['orderChange']['order_zip4'],
            'WEB納入先住所1'       => empty($this->data['orderChange']['order_address1']) ? '' : $this->data['orderChange']['order_address1'],
            'WEB納入先住所2'       => empty($this->data['orderChange']['order_address2']) ? '' : $this->data['orderChange']['order_address2'],
            'WEB納入先電話番号'     => empty($this->data['orderChange']['order_tel']) ? '' : $this->data['orderChange']['order_tel'],
            'WEB納入先FAX_番号'     => empty($this->data['orderChange']['order_fax']) ? '' : $this->data['orderChange']['order_fax'],
            'WEB納入先部署名'      => empty($this->data['orderChange']['order_division']) ? '' : $this->data['orderChange']['order_division'],
            'WEB納入先担当者名'    => empty($this->data['orderChange']['order_member']) ? '' : $this->data['orderChange']['order_member'],//22
            'WEB納入先納品書同封区分' => empty($this->data['orderChange']['order_invoice']) ? '' : $this->data['orderChange']['order_invoice'],
            
            '最終更新日'           => date('Ymd'),
            '最終更新時間'         => date('H:i:s'),
            '最終更新接続元'       => CLIENT_IP_ADRS
        );
        
        $status = $clsWebOrder->updateHistory($history->伝票No, $dataUpdate);
        
        //2: send email
        $tmpEmail['login'] = Cookie::get('userLogin');
        $tmpEmail['history'] = $history;
        $tmpEmail['orderChange'] = $this->data['orderChange'];
        $tmpEmail['webmkb'] = $clsConstant->getWEBMKB();
        $tmpEmail['webdkb'] = $clsConstant->getWEBDKB();
        $this->data['webdkb']           = $clsConstant->getWEBDKB();
        
        $send = Mail::send(['html' => 'frontends.history.order_change_guest'], array('tmpEmail' => $tmpEmail), function($message) use ($tmpEmail){
            $message->from(FROM_EMAIL, FROM_NAME);
            $message->to($tmpEmail['login']['user_email'])->subject(TITLE_ORDER_CHANGE_GUEST);
        });
        
        Session::forget('orderChange');
            
        return view('frontends.history.order_change_end', $this->data);
    }
    
    public function getCancelCartChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsProduct                    = new ProductModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsDelivery                   = new DeliveryModel();
        $clsConstant                   = new ConstantModel();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注内容変更';
        $this->data['history']         = Session::get('historyDetail');
        $this->data['historyProducts'] = $clsWebOrder->getByHistoryId($this->data['history']->伝票No);
        $this->data['delivery']        = $clsDelivery->getByCustomerIdFirst(Cookie::get('userLogin')['user_id']);
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        $tmpProduct = array();
        $tmpColor = array();
        $tmpSize = array();
        foreach ( $this->data['historyProducts'] as $item ) {
            $tmpProduct[] = $clsProduct->getById($item->商品CD);
            $tmpColor[] = $clsColor->getByIdProduct($item->色CD, $item->商品CD);
            $tmpSize[] = $clsSize->getByIdProduct($item->ｻｲｽﾞCD, $item->商品CD);
        }
        $this->data['products']         = $tmpProduct;
        $this->data['colors']         = $tmpColor;
        $this->data['sizes']         = $tmpSize;
        
        return view('frontends.history.cancel_cart_change', $this->data);
    }
    
    public function postCancelCartChange()
    {
        if ( !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $inputs = Input::all();
        unset($inputs['_token']);
        $clsWebOrder                   = new WebOrderModel();
        $clsProduct                    = new ProductModel();
        $clsColor                      = new ColorModel();
        $clsSize                       = new SizeModel();
        $clsConstant                   = new ConstantModel();
        
        $tmpGroup = array();
        foreach ( $inputs as $k => $v ) {
            $tmp = explode("_", $k);
            $historyId = $tmp[1];
            $historyId1 = $tmp[2];
            if ( !in_array($historyId.'_'.$historyId1, $tmpGroup) ) {
              $tmpGroup[] = $historyId.'_'.$historyId1;
            }
            
        }
        
        $setInputs = array();
        foreach ( $tmpGroup as $group ) {
            $setInputs[$group] = array();
            foreach ( $inputs as $k => $v ) {
                $tmp = explode("_", $k);
                $historyId = $tmp[1];
                $historyId1 = $tmp[2];
                
                if ( $group === $historyId.'_'.$historyId1 ) {
                    if ( $tmp[0] === 'quantityChange' ) {
                        $setInputs[$group]['quantityChange'] = $v;
                    } else {
                        $setInputs[$group]['itemCodeByCustomerChange'] = $v;
                    }
                }
            }
        }
        
        $tmpSetInputs = array();
        foreach ( $setInputs as $k => $v ) {
            $tmp = explode('_', $k);
            $historyId = $tmp[0];
            $historyId1 = $tmp[1];
            
            $history = $clsWebOrder->getByHistoryIdId1($historyId, $historyId1);
            $product = $clsProduct->getById($history->商品CD);
            $color = $clsColor->getByIdProduct($history->色CD, $history->商品CD);
            $size = $clsSize->getByIdProduct($history->ｻｲｽﾞCD, $history->商品CD);
            
            $tmp = array();
            $tmp['product_id'] = $history->商品CD;
            $tmp['product_name'] = $product->商品名;
            $tmp['color_name'] = $color->色名;
            $tmp['size_name'] = $size->ｻｲｽﾞ名;
            $tmp['quantity'] = $history->数量;
            $tmp['statusStart'] = $history->納期連絡区分;
            $tmp['itemCodeByCustomer'] = $history->注文番号;
            $tmp['quantityChange'] = $v['quantityChange'];
            $tmp['itemCodeByCustomerChange'] = $v['itemCodeByCustomerChange'];
            $tmpSetInputs[$historyId.'_'.$historyId1] = $tmp;
        }
        
        Session::put('cartChange', $tmpSetInputs);
        $this->data['history'] = Session::get('historyDetail');
        $this->data['cartChange'] = $tmpSetInputs;
        $this->data['webskb']          = $clsConstant->getWEBSKB();
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注内容変更';
        return view('frontends.history.cancel_cart_change_confirm', $this->data);
    }
    
    public function getCancelCartChangeEnd()
    {
        if ( !Session::has('cartChange') || !Session::has('historyDetail') ) {
            return redirect()->route('front.history.index');
        }
        
        $clsWebOrder                   = new WebOrderModel();
        $clsConstant                   = new ConstantModel();
        
        $this->data['breadcrumb']      = 'Web受発注システム　＞　発注内容変更';
        $history = Session::get('historyDetail');
        $this->data['history'] = $clsWebOrder->getByHistoryIdId1($history->伝票No, $history->伝票行No);
        $this->data['cartChange'] = Session::get('cartChange');
        $this->data['webskb']          = $clsConstant->getWEBSKB();

        //1: update history
        foreach ( Session::get('cartChange') as $k => $v ) {
            $explode                  = explode('_', $k);
            $id                       = $explode[0];
            $id1                      = $explode[1];
            
            $dataUpdate               = array(
                '数量'                => ($v['quantityChange'] == '') ? $v['quantity'] : $v['quantityChange'],
                '注文番号'            => ($v['itemCodeByCustomerChange'] == '') ? $v['itemCodeByCustomer'] : $v['itemCodeByCustomerChange'],
                
                '最終更新日'           => date('Ymd'),
                '最終更新時間'         => date('H:i:s'),
                '最終更新接続元'       => CLIENT_IP_ADRS
            );
            
            $status = $clsWebOrder->updateHistory($id, $dataUpdate);
        }

        //2: send email to guest
        $tmpEmail['cart'] = Session::get('cartChange');
        $tmpEmail['login'] = Cookie::get('userLogin');
        $tmpEmail['history'] = $history;
        $send = Mail::send(['html' => 'frontends.history.cancel_cart_change_guest'], array('tmpEmail' => $tmpEmail), function($message) use ($tmpEmail){
            $message->from(FROM_EMAIL, FROM_NAME);
            $message->to($tmpEmail['login']['user_email'])->subject(TITLE_CANCEL_CART_CHANGE_GUEST);
        });


        //delete session
        //Session::forget('historyDetail');
        Session::forget('cartChange');
        
        return view('frontends.history.cancel_cart_change_end', $this->data);
    }
    
}