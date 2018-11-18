<?php
//txn_ref + product_id + pay_item_id + amount + site_redirect_url + mackey

$txn_ref = 'YpsiPayment'.rand(1000, 9999);

$product_id = '4980';

$pay_item_id = '101';

$amount = '5000';

$site_redirect_url = 'http://expertteam.in/Recharge/sample_pay_resp.php';

$mackey = 'C8C24E816BD825584AB4B7CEAD1763E11B997EE0C8BEB6E9D0E7C40A6C95680CC1C49E8C9658195A53AF3A1B9AE2B11E1745E1D46854E6338851427E07C581A5';

$data = $txn_ref.$product_id.$pay_item_id.$amount.$site_redirect_url.$mackey;

$hashed = hash('sha512', $data);
?>
<form name="form1" action= "https://stageserv.interswitchng.com/test_paydirect/pay" method="post">
    <input name="product_id" type="hidden" value="4980" />
    <input name="amount" type="hidden" value="5000" />
    <input name="currency" type="hidden" value="566" />
    <input name="payment_params" type="hidden" value="" />
    <input name="site_redirect_url" type="hidden" value="http://expertteam.in/Recharge/sample_pay_resp.php"/>
    <input name="site_name" type="hidden" value="http://expertteam.in/Recharge/" />
    <input name="cust_id" type="hidden" value="10" />
    <input name="cust_id_desc" type="hidden" value="Value Name" />
    <input name="txn_ref" type="hidden" value="<?php echo $txn_ref; ?>" />
    <input name="pay_item_id" type="hidden" value="101" />
    <input name="pay_item_name" type="hidden" value="Payment Name" />
    <input name="xml_data" type="hidden" value='<payment_item_detail><item_details detail_ref="REF1004" institution="ABC"><item_detail item_id="1" item_name="Butter" item_amt="2500" /><item_detail item_id="2" item_name="Juice" item_amt="2500" /></item_details></payment_item_detail>' />
    <input name="cust_name" type="hidden" value="Customer Name" />
    <input name="cust_name_desc" type="hidden" value="Full name" />
    <input name="hash" type="hidden" value="<?php echo $hashed; ?>" />
    <input type="submit">
</form>


