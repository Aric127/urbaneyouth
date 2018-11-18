<?php

$server = 'localhost';
$username = 'root';
$password = '';
$connection = mysql_connect($server, $username, $password);
$db = mysql_select_db('recharge_db', $connection)or die(mysql_error());
//define(p_img_url,'theviolet.in/admin/uploads/product/');
date_default_timezone_set("Asia/Calcutta");
 $path = 'http://'.$_SERVER['HTTP_HOST'].'/upload/';
if (!defined('WEBSITE'))
            define('WEBSITE', "http://" . $_SERVER['SERVER_NAME'] . "/admin/");
define('SITE_URL',"http://" . $_SERVER['SERVER_NAME'] . "/index.php/");
$path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/contacts/';
define('contact_img_url', $path);
$path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/operator/';
define('operator_img_url', $path);
$path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/self_img/';
define('self_img_url', $path);
$path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/biller_category_logo/';
define('biller_category_logo', $path);
$path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/biller_company_logo/';
define('biller_company_logo', $path);
$country_code="+234";
define('country_code', $country_code);
$path = 'http://'.$_SERVER['HTTP_HOST'].'/webassets/images/logo.png';
define('mail_logo', $path);
$path = 'http://'.$_SERVER['HTTP_HOST'].'/wassets/images/logo.png';
define('maillogo', $path);
$offer_logo = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/coupon_img/';
define('coupon_img', $offer_logo);
$church_image = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/biller_company_logo/';
define('church_image', $church_image);
$mail_image = 'http://'.$_SERVER['HTTP_HOST'].'/webassets/images/';
define('mail_image', $mail_image);
$offer_coupon_logo = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/coupon_img/';
define('offer_coupon_img', $offer_coupon_logo);
$faild_recharge_logo = 'http://'.$_SERVER['HTTP_HOST'].'/webassets/images/unnamed_cancel.png';
define('failed_recharge_logo', $faild_recharge_logo);
$event_image = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/event/';
define('event_image', $event_image);
$church_image = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/church_image/';
define('church_area_img',$church_image);
$oyapad_products_images = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/oyapad/';
define('oyapad_products_img',$oyapad_products_images);
define('base_url_moneywave','http://moneywave.herokuapp.com');
//Abhishek sir api key
 // define('api_key_moneywave','ts_C7F0RYM2C16J6Z5PS6XT');
 // define('secret_key_moneywave','ts_47VVPE1T31O24IQ3Y7GJLLOGDG8J4Z');

//live
define('api_key_moneywave','lv_OK474IQ075CH8V35XB6H');
 define('secret_key_moneywave',' lv_VMRVV9HFLYIXDMG2Z3H3FG43RJ2ZBM');

// Mahesh sir api key
// define('api_key_moneywave','ts_QX23CAR1NNL3A88MTRXP');
// define('secret_key_moneywave','ts_07UKW5RC9GEX0ZICXX7RSSA2LKL8SI');
define('sender_bank','044');
define('sender_account_number','0690000005');
define('recipient_bank','044');
define('recipient_account_number','0690000005');
// define('redirecturl','https://moneywave.herokuapp.com/success');
// define('save_card_url','https://moneywave.herokuapp.com/v1/transfer/charge/tokenize/card');
// define('wallet_bank_url','https://moneywave.herokuapp.com/v1/disburse');
// define('wallet_balence_url','https://moneywave.herokuapp.com/v1/wallet');
// define('validate_account_number','https://moneywave.herokuapp.com/v1/resolve/account');
// define('wallet_pass','123456');




define('redirecturl','https://live.moneywaveapi.co/success');
define('save_card_url','https://live.moneywaveapi.co/v1/transfer/charge/tokenize/card');
define('wallet_bank_url','https://live.moneywaveapi.co/v1/disburse');
define('wallet_balence_url','https://live.moneywaveapi.co/v1/wallet');
define('validate_account_number','https://live.moneywaveapi.co/v1/resolve/account');
define('wallet_pass','Effi@12#');



define('transfer_charge','100');
define('min_amnt','5000');
define('currency','NGN');
define('sms_user_name', 'abhishek.kumar@efficiencie.com');
define('sms_password', 'oyacharge_@1india2017');

define('BASE_URL', 'http://www.urbaneyouth.com');
?>
