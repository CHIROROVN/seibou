<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Http\Models\ProductModel;
use App\Http\Models\ColorModel;
use App\Http\Models\SizeModel;
use App\Http\Models\MeisaiModel;
use App\Http\Models\StockModel;
use App\Http\Models\CustomerModel;

use Input;
use Session;
use Form;

class ProductController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
        
    }
	
    public function getSearch()
    {
        if ( !Input::get('back') ) {
            Session::forget('dataSearch');
        }
        $this->data['breadcrumb']       = 'Web受発注システム　＞　在庫照会・発注　＞　品番からの検索';
        return view('frontends.products.search', $this->data);
    }
    
    public function getList()
    {
        $clsProduct                     = new ProductModel();
        $clsColor                       = new ColorModel();
        $clsSize                        = new SizeModel();
        $this->data['breadcrumb']       = 'Web受発注システム　＞　在庫照会・発注　＞　検索結果一覧';
        $where                          = Input::all();
        Session::put('dataSearch', $where);
        $products                       = $clsProduct->getAll($where);
        
        $tmpProducts                    = array();
        foreach ( $products as $k => $product ) {
            $tmpProducts[$k] = $product;
            //set colors
            $colorProducts = $clsColor->getByProduct($product->商品CD);
            $tmpColor = array();
            foreach ( $colorProducts as $color ) {
                if ( !empty($color->色名) && $color->色名 != '' ) {
                    $tmpColor[] = $color->色名;
                }
            }
            $tmpProducts[$k]->colors = $tmpColor;
            
            //set size
            $sizeProducts = $clsSize->getByProduct($product->商品CD);
            $tmpSize = array();
            foreach ( $sizeProducts as $size ) {
                if ( !empty($size->ｻｲｽﾞ名) && $size->ｻｲｽﾞ名 != '' ) {
                    $tmpSize[] = $size->ｻｲｽﾞ名;
                }
            }
            $tmpProducts[$k]->sizes = $tmpSize;
        }
        
        $this->data['products'] = $tmpProducts;
        $this->data['countProducts'] = $clsProduct->countAll();
        return view('frontends.products.list', $this->data);
    }
    
    public function getDetail($id)
    {
        $clsProduct                     = new ProductModel();
        $clsColor                       = new ColorModel();
        $clsSize                        = new SizeModel();
        $clsStock                       = new StockModel();
        $clsMeisai                      = new MeisaiModel();
        $this->data['breadcrumb']       = 'Web受発注システム　＞　在庫照会・発注　＞　商品詳細';
        $this->data['product']          = $clsProduct->getById($id);
        Session::put('productDetail', $this->data['product']);
        $this->data['colors']           = $clsColor->getByProduct($id);
        $this->data['sizes']            = $clsSize->getByProduct($id);
        $dateNow                        = date('Y-m-d');
        $date183days                    = date('Y-m-d', strtotime('-183 days', strtotime($dateNow)));
        
        //$color = $clsColor->getByProduct($id);
        //echo '<pre>';print_r($this->data['product']);die;
        //$meisais = $clsMeisai->getAll();
        
        //echo '<pre>';print_r($meisais);die;
        
        //get stock
        $quantityStockMeisai = array();
        foreach ( $this->data['colors'] as $color ) {
            foreach ( $this->data['sizes'] as $size) {
                $stock = $clsStock->getByProductColorSize($id, $color->色CD, $size->ｻｲｽﾞCD);
                //quantity stock
                $quantityStock = 0;
                if ( !empty($stock) ) {
                    $quantityStock = $stock->当月在庫数;
                }
                //echo '<pre>';print_r($stock);die;
                //meisai
                $quantityMeisai = 0;
                $meisais = $clsMeisai->getByProductColorSizeDate($id, $color->色CD, $size->ｻｲｽﾞCD, $date183days, $dateNow);
                //echo '<pre>';print_r($meisais);
                if ( !empty($meisais) ) {
                    $totalMeisai = 0;
                    foreach ( $meisais as $item ) {
                        $sub = $item->数量 - $item->売上数量;
                        $totalMeisai += $sub;
                    }
                    $quantityMeisai = $totalMeisai;
                }
                $sub = $quantityStock - $quantityMeisai;
                $stockQuantityInColorTable = $clsColor->getByIdProduct($color->色CD, $id);
                $qt = 0;
                if ( $sub > $stockQuantityInColorTable->WEB用標準在庫数 ) {
                    $qt = $sub;
                }
                //echo $quantityMeisai;die;
                $quantityStockMeisai[$id . '-' . $color->色CD . '-' . $size->ｻｲｽﾞCD] = $qt;
                //if show = 0. set for check
                Session::put('quantityStockMeisai', $quantityStockMeisai);
            }
        }
        $this->data['quantityStockMeisai'] = $quantityStockMeisai;
        
        return view('frontends.products.detail', $this->data);
    }
    
    public function postCart($id)
    {
        $clsProduct                     = new ProductModel();
        $clsColor                       = new ColorModel();
        $clsSize                        = new SizeModel();
        $this->data['breadcrumb']       = 'Web受発注システム　＞　在庫照会・発注　＞　発注リストの中身';
        $inputs                         = Input::all();
        $product                        = $clsProduct->getById($id);
        $tmpCart = array();
        if ( !empty($inputs) ) {
            unset($inputs['_token']);
            //echo '<pre>';
            //print_r($inputs);die;
            foreach ( $inputs as $k => $v ) {
                if ( $v != '' ) {
                    $str = explode('_', $k);
                    $colorId = $str[2];
                    $sizeId = $str[3];
                    $color = $clsColor->getByIdProduct($colorId, $id);
                    $size = $clsSize->getByIdProduct($sizeId, $id);
                    
                    $tmp = array();
                    $tmp['cart_id'] = $k;
                    $tmp['product_id'] = $id;
                    $tmp['product_name'] = $product->商品名;
                    $tmp['color_id'] = $colorId;
                    $tmp['color_name'] = $color->色名;
                    $tmp['size_id'] = $sizeId;
                    $tmp['size_name'] = $size->ｻｲｽﾞ名;
                    $tmp['quantity'] = $v;
                    if ( isset(Session::get('quantityStockMeisai')[$id . '-' . $colorId . '-' . $sizeId]) ) {
                        $tmp['quantityStockMeisai'] = Session::get('quantityStockMeisai')[$id . '-' . $colorId . '-' . $sizeId];
                    }
                    $tmpCart[] = $tmp;
                }
            }
            Session::put('cart', $tmpCart);
        }
        
        
        //echo '<pre>';
        //$totalCartNow = count(Session::get('cart'));
        //$total = $totalCartNow + 1;
        //echo 'total'.$totalCartNow;
        //Session::push('cart.' . $total, 'developers 1');
        //print_r(Session::get('productDetail'));
        //print_r(Session::get('cart'));die;
        return view('frontends.products.cart', $this->data);
    }
    
    public function getDeleteCart($cart_id)
    {
        $cart = Session::get('cart');
        $product_id = 0;
        foreach ( $cart as $k => $v ) {
            $product_id = $v['product_id'];
            if ( $v['cart_id'] == $cart_id ) {
                unset($cart[$k]);
            }
        }
        Session::put('cart', $cart);
        return redirect()->route('front.products.cart', $product_id);
    }
}