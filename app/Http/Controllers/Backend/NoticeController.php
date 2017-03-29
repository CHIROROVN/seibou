<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Models\NewsModel;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Input;
use Session;
use Html;


class NoticeController extends BackendController
{

    /*
    |-----------------------------------
    | get view notice
    |-----------------------------------
    */
    public function index() {
        $clsNews                = new NewsModel();
        $data['news']           = $clsNews->getAll();
        return view('manage.notice.index', $data);
    }

    /*
    |-----------------------------------
    | get view notice regist
    |-----------------------------------
    */
    public function regist() {
        $data['curr_year']          = date('Y');
        $data['next_year']          = (int) date('Y') + 1;
        $data['next_year_next']     = (int) date('Y') + 2;
        return view('manage.notice.regist', $data);
    }

    /*
    |-----------------------------------
    | post notice regist
    |-----------------------------------
    */
    public function postRegist(Request $request) {
        $clsNews                = new NewsModel();
        $Rules                  = $clsNews->Rules();
        if( !empty($request->get('year')) && !empty($request->get('month')) && !empty($request->get('day')) ){
            unset($Rules['year']);
            unset($Rules['month']);
            unset($Rules['day']);
        }else{
            unset($Rules['month']);
            unset($Rules['day']);
        }

        $validator = Validator::make(Input::all(), $Rules, $clsNews->Messages());
        if ($validator->fails()) {
            return redirect()->route('manage.notice.regist')->withErrors($validator)->withInput();
        }

        $data['news_title']                 = $request->get('news_title');
        $data['news_date']                  = !empty($request->get('year')) ? $request->get('year').'-'.$request->get('month').'-'.$request->get('day') : '';
        $data['news_contents']              = $request->get('news_contents');
        $data['news_startday']              = !empty($request->get('year_start')) ? $request->get('year_start').'-'.$request->get('month_start').'-'.$request->get('day_start') : '';
        $data['news_endday']                = !empty( $request->get('year_end') ) ? $request->get('year_end').'-'.$request->get('month_end').'-'.$request->get('day_end') : '';

        $data['news_display']               = ($request->get('news_display') != null) ? '1' : null;
        $data['last_kind']                  = INSERT;
        $data['last_date']                  = date('Y-m-d H:i:s');
        $data['last_ipadrs']                = CLIENT_IP_ADRS;
        $data['last_user']                  = Auth::user()->u_id;

        $request->session()->put('notice', $data);
        return redirect()->route('manage.notice.regist_cnf');

    }

    /*
    |-----------------------------------
    | get notice regist confirm
    |-----------------------------------
    */
    public function registCnf(Request $request) {
        if (!$request->session()->has('notice')) return redirect()->route('manage.notice.regist');
        
        if ($request->session()->has('notice')) {
            $data['news']           = (Object) $request->session()->get('notice');
        }
        return view('manage.notice.regist_cnf', $data);
    }

    /*
    |-----------------------------------
    | post notice regist confirm
    |-----------------------------------
    */
    public function postRegistCnf(Request $request)
    {
        $clsNews                = new NewsModel();
        if ($request->session()->has('notice')) {
            $data               =  $request->session()->get('notice');
            if ( $clsNews->insert($data) ) {
                $request->session()->forget('notice');
                return redirect()->route('manage.notice.index');
            } else {
                return redirect()->route('manage.notice.regist_cnf');
            }
        }else{
            return redirect()->route('manage.notice.regist');
        }
    }

    /*
    |-----------------------------------
    | get view notice change
    |-----------------------------------
    */
    public function change($id, Request $request) {

        $clsNews                   = new NewsModel();
        $data['notice']            = $clsNews->get_by_id($id);
        $data['last_year']          = (int) date('Y') - 1;
        return view('manage.notice.change', $data);
    }

    /*
    |-----------------------------------
    | post notice change
    |-----------------------------------
    */
    public function postChange($id, Request $request) {

        $clsNews                = new NewsModel();
        $Rules                  = $clsNews->Rules();
        if( !empty($request->get('year')) && !empty($request->get('month')) && !empty($request->get('day')) ){
            unset($Rules['year']);
            unset($Rules['month']);
            unset($Rules['day']);
        }else{
            unset($Rules['month']);
            unset($Rules['day']);
        }

        $validator = Validator::make(Input::all(), $Rules, $clsNews->Messages());
        if ($validator->fails()) {
            return redirect()->route('manage.notice.regist')->withErrors($validator)->withInput();
        }
        $data['news_id']                    = $id;
        $data['news_title']                 = $request->get('news_title');
        $data['news_date']                  = !empty($request->get('year')) ? $request->get('year').'-'.$request->get('month').'-'.$request->get('day') : '';
        $data['news_contents']              = $request->get('news_contents');
        $data['news_startday']              = !empty($request->get('year_start')) ? $request->get('year_start').'-'.$request->get('month_start').'-'.$request->get('day_start') : '';
        $data['news_endday']                = !empty( $request->get('year_end') ) ? $request->get('year_end').'-'.$request->get('month_end').'-'.$request->get('day_end') : '';

        $data['news_display']               = ($request->get('news_display') != null) ? '1' : null;
        $data['last_kind']                  = UPDATE;
        $data['last_date']                  = date('Y-m-d H:i:s');
        $data['last_ipadrs']                = CLIENT_IP_ADRS;
        $data['last_user']                  = Auth::user()->u_id;

        $request->session()->put('notice', $data);

        return redirect()->route('manage.notice.change_cnf', $id);
    }

    /*
    |-----------------------------------
    | get view notice change confirm
    |-----------------------------------
    */
    public function changeCnf($id, Request $request) {
        if (!$request->session()->has('notice')) return redirect()->route('manage.notice.change', $id);
        
        if ($request->session()->has('notice')) {
            $data['news']           = (Object) $request->session()->get('notice');
        }
        return view('manage.notice.change_cnf', $data);
    }

    /*
    |-----------------------------------
    | post notice change confirm
    |-----------------------------------
    */
    public function postChangeCnf($id, Request $request) {
        $clsNews                = new NewsModel();
        if ($request->session()->has('notice')) {
            $data               =  $request->session()->get('notice');
            unset($data['news_id']);
            if ( $clsNews->update($id, $data) ) {
                $request->session()->forget('notice');
                return redirect()->route('manage.notice.index');
            } else {
                return redirect()->route('manage.notice.change_cnf',$id);
            }
        }else{
            return redirect()->route('manage.notice.change',$id);
        }
    }

    /*
    |-----------------------------------
    | get view notice detail
    |-----------------------------------
    */
    public function detail($id) {
        $clsNews                   = new NewsModel();
        $data['notice']            = $clsNews->get_by_id($id);
        return view('manage.notice.detail', $data);
    }

    /*
    |-----------------------------------
    | get view notice delete
    |-----------------------------------
    */
    public function deleteCnf($id) {
        $clsNews                   = new NewsModel();
        $data['notice']            = $clsNews->get_by_id($id);
        return view('manage.notice.delete_cnf', $data);
    }

    /*
    |-----------------------------------
    | notice delete
    |-----------------------------------
    */
    public function delete($id) {
        $data['last_kind']       = DELETE;
        $data['last_date']       = date('Y-m-d H:i:s');
        $data['last_ipadrs']     = CLIENT_IP_ADRS;
        $data['last_user']       = Auth::user()->u_id;
        $clsNews                   = new NewsModel();
        if ( $clsNews->update($id, $data) ) {
            return redirect()->route('manage.notice.index');
        } else {
            return redirect()->route('manage.notice.detail',$id);
        }
    }


}