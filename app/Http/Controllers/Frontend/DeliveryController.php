<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Models\DeliveryModel;
use App\Http\Models\ConstantModel;
use Input;
use Illuminate\Http\Request;
use Session;
use Validator;
use Html;
use Cookie;

class DeliveryController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
    |-----------------------------------
    | get view delivery
    |-----------------------------------
    */
    public function index(Request $request)
    {
        //Customer login

        
        if ($request->session()->has('delivery')) $request->session()->forget('delivery');
        $data['breadcrumb']      = 'Web受発注システム　＞　納入先リストの一覧';
        $clsDelivery                   = new DeliveryModel();
        $data['deliveries']            = $clsDelivery->getAll( Cookie::get('userLogin')['user_id'] );

        return view('frontends.delivery.index', $data);
    }

    /*
    |-----------------------------------
    | get view delivery regist
    |-----------------------------------
    */
    public function regist(Request $request)
    {
        $clsConstant                = new ConstantModel();
        $data['constant']           = $clsConstant->getWEBMKB();
        if ($request->session()->has('delivery')) $request->session()->forget('delivery');
        $data['breadcrumb']      = 'Web受発注システム　＞　納入先リストの新規登録';
        return view('frontends.delivery.regist', $data);
    }

    /*
    |-----------------------------------
    | post delivery regist
    |-----------------------------------
    */
    public function postRegist(Request $request)
    {
        $clsDelivery            = new DeliveryModel();
        $rules                  = $clsDelivery->Rules();
        if(empty($request->input('delivery_fax'))) unset($rules['delivery_fax']);
        $validator = Validator::make(Input::all(), $rules, $clsDelivery->Messages());

        if ($validator->fails()) {
            return redirect()->route('front.delivery.regist')->withErrors($validator)->withInput();
        }

        $data['delivery_name']              = $request->input('delivery_name');
        $data['customer_id']                = Cookie::get('userLogin')['user_id'];
        $data['delivery_division']          = $request->input('delivery_division');
        $data['delivery_member']            = $request->input('delivery_member');
        $data['delivery_zip3']              = $request->input('delivery_zip3');
        $data['delivery_zip4']              = $request->input('delivery_zip4');
        $data['delivery_address1']          = $request->input('delivery_address1');
        $data['delivery_address2']          = $request->input('delivery_address2');
        $data['delivery_tel']               = $request->input('delivery_tel');
        $data['delivery_fax']               = $request->input('delivery_fax');
        $data['delivery_free1']             = $request->input('delivery_satisfy');

        $data['last_kind']                  = INSERT;
        $data['last_date']                  = date('Y-m-d H:i:s');
        $data['last_ipadrs']                = CLIENT_IP_ADRS;
        $data['last_user']                  = Cookie::get('userLogin')['user_id'];

        $request->session()->put('delivery', $data);
        return redirect()->route('front.delivery.regist_confirm');
    }

    /*
    |-----------------------------------
    | get delivery regist confirm
    |-----------------------------------
    */
    public function registConfirm(Request $request)
    {
        if (!$request->session()->has('delivery')) return redirect()->route('front.delivery.regist');
        $data['breadcrumb']      = 'Web受発注システム　＞　納入先リストの新規登録　＞　確認';
        if ($request->session()->has('delivery')) {
            $data['delivery']           = (Object) $request->session()->get('delivery');
        }
        return view('frontends.delivery.regist_confirm', $data);
    }

    /*
    |-----------------------------------
    | post delivery regist confirm
    |-----------------------------------
    */
    public function postRegistConfirm(Request $request)
    {
        $clsDelivery            = new DeliveryModel();
       if ($request->session()->has('delivery')) {
            $data               =  $request->session()->get('delivery');
            if ( $clsDelivery->insert($data) ) {
                $request->session()->forget('delivery');
                return redirect()->route('front.delivery.index');
            } else {
                return redirect()->route('front.delivery.regist_confirm');
            }
        }else{
            return redirect()->route('front.delivery.regist');
        }
    }

    /*
    |-----------------------------------
    | get view delivery change
    |-----------------------------------
    */
    public function change(Request $request, $id)
    {
        $data['breadcrumb']      = 'Web受発注システム　＞　登録済み納入先リストの変更';
        $clsDelivery             = new DeliveryModel();
        $data['delivery']        = $clsDelivery->get_by_id($id);
        return view('frontends.delivery.change', $data);
    }

    /*
    |-----------------------------------
    | post delivery change
    |-----------------------------------
    */
    public function postChange(Request $request, $id)
    {
        $clsDelivery            = new DeliveryModel();
        $rules                  = $clsDelivery->Rules();
        if(empty($request->input('delivery_fax'))) unset($rules['delivery_fax']);
        $validator = Validator::make(Input::all(), $rules, $clsDelivery->Messages());

        if ($validator->fails()) {
            return redirect()->route('front.delivery.change')->withErrors($validator)->withInput();
        }
        $data['delivery_id']                = $id;
        $data['delivery_name']              = $request->input('delivery_name');
        $data['customer_id']                = Cookie::get('userLogin')['user_id'];
        $data['delivery_division']          = $request->input('delivery_division');
        $data['delivery_member']            = $request->input('delivery_member');
        $data['delivery_zip3']              = $request->input('delivery_zip3');
        $data['delivery_zip4']              = $request->input('delivery_zip4');
        $data['delivery_address1']          = $request->input('delivery_address1');
        $data['delivery_address2']          = $request->input('delivery_address2');
        $data['delivery_tel']               = $request->input('delivery_tel');
        $data['delivery_fax']               = $request->input('delivery_fax');
        $data['delivery_free1']             = $request->input('delivery_satisfy');

        $data['last_kind']                  = UPDATE;
        $data['last_date']                  = date('Y-m-d H:i:s');
        $data['last_ipadrs']                = CLIENT_IP_ADRS;
        $data['last_user']                  = Cookie::get('userLogin')['user_id'];

        $request->session()->put('delivery', $data);
        return redirect()->route('front.delivery.change_confirm',$id);
    }

    /*
    |-----------------------------------
    | get delivery change confirm
    |-----------------------------------
    */
    public function changeConfirm(Request $request, $id)
    {
        if (!$request->session()->has('delivery')) return redirect()->route('front.delivery.regist');
        $data['breadcrumb']      = 'Web受発注システム　＞　登録済み納入先リストの変更　＞　確認';
        if ($request->session()->has('delivery')) {
            $data['delivery']           = (Object) $request->session()->get('delivery');
        }
        $data['delivery_id']            = $id;
        return view('frontends.delivery.change_confirm', $data);
    }

    /*
    |-----------------------------------
    | post delivery change confirm
    |-----------------------------------
    */
    public function postChangeConfirm(Request $request, $id)
    {
        $clsDelivery            = new DeliveryModel();
       if ($request->session()->has('delivery')) {
            $data               =  $request->session()->get('delivery');
            unset($data['delivery_id']);
            if ( $clsDelivery->update($id, $data) ) {
                $request->session()->forget('delivery');
                return redirect()->route('front.delivery.index');
            } else {
                return redirect()->route('front.delivery.change_confirm',$id);
            }
        }else{
            return redirect()->route('front.delivery.change',$id);
        }
    }

    /*
    |-----------------------------------
    | get view delivery detail
    |-----------------------------------
    */
    public function detail(Request $request, $id)
    {
        $data['breadcrumb']      = 'Web受発注システム　＞　登録済み納入先リストの詳細';
        $clsDelivery             = new DeliveryModel();
        $data['delivery']        = $clsDelivery->get_by_id($id);
        return view('frontends.delivery.detail', $data);
    }

    /*
    |-----------------------------------
    | get view delivery delete confirm
    |-----------------------------------
    */
    public function delete(Request $request, $id)
    {
        $data['breadcrumb']      = 'Web受発注システム　＞　登録済み納入先リストの削除（確認）　＞　確認';
        $clsDelivery             = new DeliveryModel();
        $data['delivery']        = $clsDelivery->get_by_id($id);
        return view('frontends.delivery.delete_confirm', $data);
    }

    /*
    |-----------------------------------
    | post delivery delete
    |-----------------------------------
    */
    public function postDelete(Request $request, $id)
    {
        $data['last_kind']       = DELETE;
        $data['last_date']       = date('Y-m-d H:i:s');
        $data['last_ipadrs']     = CLIENT_IP_ADRS;
        $data['last_user']       = Cookie::get('userLogin')['user_id'];
        $clsDelivery             = new DeliveryModel();
        if ( $clsDelivery->update($id, $data) ) {
                return redirect()->route('front.delivery.index');
            } else {
                return redirect()->route('front.delivery.detail',$id);
            }
    }

}