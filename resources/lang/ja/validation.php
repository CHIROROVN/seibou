<?php

return [

    /*
    |--------------------------------------------------------------------------
    |Frontend Validation
    |--------------------------------------------------------------------------
    |
    */
    
    //login in frontend
    'error_username_required'                   => 'ログインIDを入力してください。',
    'error_password_required'                   => 'パスワードを入力してください。',
    
    //orders
    'error_order_order_name_required'           => '納入先を入力してください',
    'error_order_order_zip3_required'           => '郵便番号を入力してください',
    'error_order_order_zip4_required'           => '郵便番号を入力してください',
    'error_order_order_order_zip3_zip4_required' => '郵便番号を入力してください',
    'error_order_order_address1_required'       => '住所を入力してください',
    'error_order_order_tel_required'            => '電話番号を入力してください',
    'error_order_shipping_required'             => '出荷方法を選択してください',
    'error_order_invoice_required'              => '納品書同送の可否を選択してください',
    
    //Delivery
    'error_delivery_name_required'              => '納入先名を入力してください。',
    'error_delivery_zip3_required'              => '郵便番号を入力してください。',
    'error_delivery_zip3_numeric'               => '郵便番号は数字でなければなりません。',
    //'error_delivery_zip4_required'              => '郵便番号2を入力してください。',
    //'error_delivery_zip4_numeric'               => '郵便番号2は数字でなければなりません。',
    'error_delivery_address1_required'          => '住所を入力してください。',
    'error_delivery_tel_required'               => '電話番号を入力してください。',
    'error_delivery_tel_regex'                  => '電話番号は数字でなければなりません。',
    'error_delivery_fax_regex'                  => 'FAX番号は数字でなければなりません。',
    'error_delivery_satisfy_required'           => '納品書同送を選択してください。',
        
    //product search
    'error_item_code_1_required'                => '品番を入力してください',

    /*
    |--------------------------------------------------------------------------
    | Backend Validation
    |--------------------------------------------------------------------------
    |
    */
    //Users
    'error_u_login_required'                    => 'ログインIDを入力してください。',
    'error_u_passwd_required'                   => 'パスワードを入力してください。',
    'error_u_login_unique'                      => 'ログインIDが存在しました。',
    'error_u_name_required'                     => 'あなたの名前を入力してください。',
    'error_u_passwd_min'                        => 'パスワードは5文字以上でなければなりません。',

    //Change password
    'error_old_pwd_required'                    => '現在のパスワードを入力してください。',
    'error_new_pwd_required'                    => '新しいパスワードを入力してください。',
    'check_hashed_pass'                         => '現在のパスワードが正しくありません。',
    'error_conf_new_pwd_same'                   => '新しいパスワードと確認の新しいパスワードが同じでなければなりません。',
    'error_new_pwd_min'                         => 'パスワードは5文字以上でなければなりません。',

    //News
    'error_news_title_required'                 => 'タイトルを入力してください。',
    'error_news_year_required'                  => '年を選んでください。',
    'error_news_month_required'                 => '月を選択してください。',
    'error_news_day_required'                   => '日を選択してください。',
    'error_news_contents_required'              => '詳細を入力してください。',


    ];