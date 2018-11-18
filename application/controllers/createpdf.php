<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Createpdf extends CI_Controller {
  function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
		    $this->load->library('pdf_genrator/mpdf');
       define('company_logo', base_url('uploads/biller_company_logo/'));
       $path = 'http://'.$_SERVER['HTTP_HOST'].'/wassets/images/logo.png';
       define('maillogo', $path);
       define('event_image', 'http://'.$_SERVER['HTTP_HOST'].'/uploads/event/');
       define('company_logo', base_url('uploads/biller_company_logo/'));
       define('bill_invoice_paid', base_url('uploads/bill_invoice_paid/'));
    }
  function sendElasticEmail($to, $subject, $body_text, $body_html, $from, $fromName,$attachments)
	{ 
    $res = "";

    $data = "username=".urlencode("care@oyacharge.com");
    $data .= "&api_key=".urlencode("9baa5dc0-e443-4f06-ac91-e547d3845151");
    $data .= "&from=".urlencode($from);
    $data .= "&from_name=".urlencode($fromName);
    $data .= "&to=".urlencode($to);
    $data .= "&subject=".urlencode($subject);
    if($body_html)
      $data .= "&body_html=".urlencode($body_html);
    if($body_text)
      $data .= "&body_text=".urlencode($body_text);
	if($attachments)
      $data .= "&attachments=".urlencode($attachments);
    $header = "POST /mailer/send HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($data) . "\r\n\r\n";
    $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30);

    if(!$fp)
      return "ERROR. Could not open connection";
    else {
      fputs ($fp, $header.$data);
      while (!feof($fp)) {
        $res .= fread ($fp, 1024);
      }
      fclose($fp);
    }
    return $res;                  
}
  		
function create_new_pdfold($bill_no,$biller_id,$type)
{
		
	if($type=='1')
  {
      $where=array('bill_invoice_no'=>$bill_no);
      $data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
      $invoice_date=$data[0]->bill_invoice_date;
      $title='Bill Invoice';
  }else if($type==2)
  {
        $data= $this->login_model->get_simple_query('select * from biller_user join bill_recharge on bill_recharge.bill_invoice_no=biller_user.bill_invoice_no join biller_details on biller_details.biller_id=biller_user.biller_id where biller_user.bill_invoice_no="'.$bill_no.'"');
        $invoice_date=$data[0]->bill_paid_date;
        $title='Bill Paid Invoice';
  }
$html = '
<!DOCTYPE html>
<html>
   <head>
      <title></title>
   </head>
   <body>
      <div class="container">
         <div style="font-family:&quot;Trebuchet MS&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.6em;background-color:#fff;text-align:center">
            <table cellspacing="0" cellpadding="0" bgcolor="#fff" align="center" style="border-spacing:0;border-collapse:collapse;padding:20px;width:100%">
               <tbody>
                  <tr>
                     <td bgcolor="#fff" style="border:1px solid #f0f0f0">
                        <div style="display:block;margin:0 auto;max-width:100%"><table style="width:100%;border-spacing:0;border-collapse:collapse">
                              <tbody>
                                 <tr>
                                    <td style="text-align:center">
                                       <table style="width:100%;border-spacing:0;border-collapse:collapse;padding:15px 10px">
                                          <tbody>
                                             <tr>
                                                <td align="left" colspan="2" style="padding:10px 35px;background-color:#192a3b">
                                                   <a>
                                                   <img src="https://oyacharge.com/wassets/images/logo.png" style="padding:10px;" width="130px" class=""/>
                                                   </a>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="text-align:center;background-color:#57A9A0;text-transform:uppercase;padding:10px;color:#fff">
                                       '.$title.'
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                      <table style="width: 100%;padding: 15px;color: gray">
                                          <tbody>
                                          <tr>
                                             <td style="text-align: left; font-size: 15px;">
                                               Biller:<br>
                                                '.$data[0]->biller_company_name.'<br>
                                                Service -'.$data[0]->biller_category_name.'<br>
                                              
                                                Email:- '.$data[0]->biller_email .'<br>
                                                Phone:- '.$data[0]->biller_contact_no  .'<br>
                                                  Consumer No:- '.$data[0]->biller_customer_id_no.'<br>
                                             </td>
                                             <td style="text-align: right;">
                                                <img src="'.company_logo."/".$data[0]->biller_company_logo.'" style="padding:10px;" width="120px" class="">
                                             </td>
                                          </tr>

                                          <tr style="border-top: 2px solid #bbb;">
                                             <td style="text-align: left;width: 50%;padding: 20px 0px">
                                                Bill To,<br>
                                                 '.$data[0]->biller_user_name.'<br>
                                                  Email:- '.$data[0]->biller_user_email  .'<br>
                                                  Phone:- '.$data[0]->biller_user_contact_no  .'<br>
                                             </td>
                                             <td style="text-align: right;padding: 20px 0px;text-align: right;padding: 20px 0px;font-size: 12px">
                                                <strong>Date:-'.$invoice_date.'</strong><br>
                                                Invoice No:- '.$data[0]->bill_invoice_no.'<br>
                                                Transaction  No:- '.$data[0]->bill_transaction_id.'<br>
                                             </td>
                                          </tr>
                                       </tbody>
                                       </table>
                                       <br><br><br><br><br><br>
                                       <table border="1px solid" style="border:1px solid #ccc;width: 98%; border-collapse: collapse;margin: auto;border-color: #ccc;">
                                            <tr style="text-align: left;font-weight: 300;min-height: 100px;border:1px solid #ccc; ">
                                             <td style="width: 70%; padding: 5px;border-color: #ccc; border:1px solid #ccc;color:#CCC;font-weight:300 ">
                                                Product Name
                                             </td>
                                             <td style="width: 70%; padding: 5px;border-color: #ccc; border:1px solid #ccc;color:#CCC;font-weight:300 ">
                                                Price per Unit
                                             </td>
                                             <td style="width: 30%;padding: 5px;border-color: #ccc;text-align: right;border:1px solid #ccc;COLOR:#CCC">
                                                Product Qty
                                             </td>
                                               <td style="width: 30%;padding: 5px;border-color: #ccc;text-align: right;border:1px solid #ccc;COLOR:#CCC">
                                               Total Price 
                                             </td>
                                          </tr>';
    if(!empty($data[0]->bill_product_id))
    {
        for($i=0;$i<count($data[0]->bill_product_id); $i++)
		    {
			
			$where12=array('biller_invoice_no'=>$data[0]->bill_invoice_no,'biller_invoice_product_id'=>$data[0]->bill_product_id);
			
			$biller_product = $this->login_model->get_data_where_condition('biller_invoice_products', $where12);
			$total=0;
			foreach ($biller_product as  $value) {
			$total+=($value->biller_invoice_product_price*$value->biller_invoice_product_qty);
		
		                         $html .= '<tr style="text-align: left;font-weight: 300;color: #bbb!important;min-height: 100px; ">
                                             <td style="width: 70%;padding: 5px; border-color: #ccc;color:#bbb;border:1px solid;font-size:14px  ">
                                                <p>'.$value->biller_invoice_product_name.'.<p>

                                             </td>
                                             <td style="width: 30%;padding: 5px; border-color: #ccc;text-align: right;color:#bbb;border:1px solid;   ">
                                               
<strong><p>'.$value->biller_invoice_product_price.'/-<p></strong>
                                             </td>
                                               <td style="width: 30%;padding: 5px; border-color: #ccc;text-align: right;color:#bbb;border:1px solid;   ">
                                               
<p>'.$value->biller_invoice_product_qty.'<p>
                                             </td>
                                              <td style="width: 30%;padding: 5px; border-color: #ccc;text-align: right;color:#bbb;border:1px solid;   ">
                                               
<p>'.$value->biller_invoice_product_price*$value->biller_invoice_product_qty.'/-<p>
                                             </td>
                                          </tr>';
		}
                                           
         	}                                    
}else{
   $total=$data[0]->bill_amount;
}
                                        $html .='<tr style="text-align: left;font-weight: 300;color: #bbb;min-height: 100px; ">
                                             <td style="width: 50%;padding: 5px; border-color: #ccc;color:#333;  ">
                                               <strong> Total<strong>
                                             </td>
                                             <td></td>
                                             <td></td>
                                             <td style="width: 50%;padding: 5px; border-color: #ccc;text-align: right;color:#333;   ">
                                               <strong>  '.$total.'<img  style="position:relative;top:8px;left:2px;" width="13px" src="http://image.flaticon.com/icons/svg/32/32974.svg"/></strong>
                                               
                                             </td>
                                          </tr>
                                         
                                         
                                       </table>
                                       <table border="1px solid" style="border:1px solid #ccc;width: 98%; border-collapse: collapse;margin: auto;border-color: #ccc;">
                                        <tr>
                                          <td>
						                                  <p>Description: '.$data[0]->bill_description.'</p>
                                         </td></tr> 
                                       </table>
                                       <table style="width: 100%;background-color: #eee;margin-top: 20px;">
                                           <tr style="text-align: left;font-weight: 300;color: #bbb;min-height: 100px; ">
                                             <td style="width: 50%;padding: 10px; border-color: #ccc; color: #57A9A0 ">
                                                Bill Consumer No.: '.$data[0]->biller_customer_id_no.' <br>
                                                via OyaCharge
                                             </td>
                                             <td style="width: 50%;padding: 10px; border-color: #ccc;text-align: right;color: #57A9A0   ">
                                               OyaCharge<br>
                                              '.$data[0]->biller_company_name.'<br>
                                               ('.$data[0]->biller_name.')
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>

                                 <tr>
                                 
                                    <td style="background-color:#eee;padding:30px 15px 15px 10px">
                                       <table align="center" style="border-spacing:0;border-collapse:collapse">
                                          <tbody>
                                            
                                             <tr>
                                                <td style="padding:10px">
                                                   
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                  
                                 <tr>
                                    <td style="background-color:#1E1E1E;font-size:12px;color:#fff;text-align:center;padding:10px">
                                       <br>
                                       Address: 8B, Lalupon close, Ikoyi Lagos
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </td>
                     <td>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </body>
</html>';
$mpdf = new mPDF();
$mpdf->WriteHTML($html);
//$mpdf->Output();die;

if($type=='1')
{

$mpdf->Output('uploads/bill_invoice/'.$bill_no.'.pdf','F');
  $bill='././uploads/bill_invoice/'.$bill_no.'.pdf';
}else if($type=='2')
{

$mpdf->Output('uploads/invoice/'.$bill_no.'.pdf','F');
   $bill='././uploads/invoice/'.$bill_no.'.pdf';
}

return $bill;
}

// create new pdf design and html view 28 Dec 2017
function create_new_pdf($bill_no,$biller_id,$type)
{
		
	if($type=='1')
  {
      $where=array('bill_invoice_no'=>$bill_no);
      $data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
      $invoice_date=$data[0]->bill_due_date;
      $title='Bill Invoice';
  }else if($type==2)
  {
        $data= $this->login_model->get_simple_query('select * from biller_user join bill_recharge on bill_recharge.bill_invoice_no=biller_user.bill_invoice_no join biller_details on biller_details.biller_id=biller_user.biller_id where biller_user.bill_invoice_no="'.$bill_no.'"');
        $invoice_date=$data[0]->bill_paid_date;
        $title='Bill Paid Invoice';
  }
    $mpdf = new mPDF('utf-8', 'A4', 0, '', -5, -5, -5, -5, 0, 0);

   if($data[0]->bill_pay_status==2){ 
    $date_type=  "Due";  }else 
    if($data[0]->bill_pay_status==1){ $date_type= "Paid";  
  }
  if($data[0]->bill_pay_status==2){ 
  	$invoicetype= "Draft";  }
  	else if($data[0]->bill_pay_status==1){ 
  		$invoicetype=  "Paid";  }
   $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> </title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="" style="background-color: #eee;font-family: sans-serif!important;">
  <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  
    <tr>

      <td align="center" valign="top" width="100%" class="background">
        <center>
          <table cellpadding="0" cellspacing="0" width="750px" style="box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);margin-top: 10px;background-color: #fff;padding: 40px">

            <tr style="width: 100%">
              <td valign="top" class="wrap-cell" style="width: 40%;text-align: left;">
              
                <span style="background-color: #43a047;display: block;padding: 20px 0;
    border: 1px dotted #ddd;"><img  style="padding: 10px;width: 100px" src="'.company_logo."/".$data[0]->biller_company_logo.'"> 
              </td>
              <td style="width: 10%"></td>
              <td style="width: 50%;padding-left: 20px;text-align:left;">
                <h5 style="color: #43a047;display: block; padding: 5px 0;font-size: 14px;text-align:left;">'.$data[0]->biller_company_name.'</h5></br>
                <h6 style="color: #333;display: block;padding: 5px 0;font-size: 14px;font-weight:normal;">Name: '.$data[0]->biller_name .'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 5px 0;font-size: 14px;"><i class="fa fa-phone" aria-hidden="true"></i> Mob.:  '.$data[0]->biller_contact_no  .'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 5px 0;font-size: 14px;">Email:  '.$data[0]->biller_email .'</h6>
              </td>
            </tr>
             <tr><td colspan="3">&nbsp;</td></tr>
            <tr style="width: 100%;padding: 10px 0;">
              <td style="width: 45%;padding:20px 0;text-align:left;">
                <span style="color: #000;display: block;font-weight: bold;padding-bottom:10px;">Consumer</span>
                <h5 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Customer: #'.$data[0]->biller_customer_id_no.'</h5>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Name: '.$data[0]->biller_user_name.'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Mob.:  '.$data[0]->biller_user_contact_no.'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Email: '.$data[0]->biller_user_email.'</h6>
              </td>
              <td style="width: 10%;padding:20px 0;"></td>
              <td valign="top"  style="width: 50%;padding:10px 0;padding-top:20px; background-color: #2b2b2b;">
                <span style="display: table;background-color: #2b2b2b;padding:5px 0;">
                  <span style="color:#fff;display: block;text-align: center;padding:5px;font-size: 21px;">Invoice : #'.$data[0]->bill_invoice_no.'</span>
                <table style="width: 100%">
                  <tr style="text-align: center;">
                    <td style="width:35%;font-weight: bold;color: #fff;font-size: 12px;padding-top:10px;">Invoice Date</td>
                    <td style="width:30%;font-weight: bold;color: #fff;font-size: 12px;">'.$date_type.' Date</td>
                    <td style="width:25%;font-weight: bold;color: #fff;font-size: 12px;">Status</td>
                  </tr>
                   <tr style="text-align: center;">
                    <td style="width:30%;font-weight: lighter;color: #fff;font-size: 12px;padding: 5px 0">'.$data[0]->bill_invoice_date.'</td>
                    <td style="width:35%;font-weight: lighter;color: #fff;font-size: 12px;">'.$invoice_date.'</td>
                    <td style="width:25%;font-weight: lighter;color: #fff;font-size: 12px;">'.$invoicetype.'</td>
                  </tr>
                </table>
                </span>
              </td>
            </tr>
             <tr><td colspan="3">&nbsp;</td></tr>
             <tr><td colspan="3">&nbsp;</td></tr>
             <tr><td colspan="3">&nbsp;</td></tr>
            <tr>
              <td colspan="3" >
                <span style="background-color: #2b2b2b;padding: 5px;display: block;">
                <table style="width:100%">
                
                  <tr style="text-align: center;background-color: #2b2b2b;" cellpadding="0">
                    <td style="padding:5px;background-color: #2b2b2b;width:5%;font-weight: bold;color: #fff;font-size: 12px;">ID</td>
                    <td style="background-color: #2b2b2b;width:10%;font-weight: bold;color: #fff;font-size: 12px;">Item</td>
                   <td style="background-color: #2b2b2b;width:15%;font-weight: bold;color: #fff;font-size: 12px;">Quantity</td>
                    <td style="background-color: #2b2b2b;width:25%;font-weight: bold;color: #fff;font-size: 12px;">Unit Price</td>
                    <td style="background-color: #2b2b2b;width:25%;font-weight: bold;color: #fff;font-size: 12px;">Total</td>
                  </tr>   
                
                </table></span>
                <table style="width:100%">';
   if(!empty($data[0]->bill_product_id))
    {
    	$k=1;
        for($i=0;$i<count($data[0]->bill_product_id); $i++)
        {
      
      $where12=array('biller_invoice_no'=>$data[0]->bill_invoice_no,'find_in_set(biller_invoice_product_id, "'.$data[0]->bill_product_id.'") '=>NULL);
      
      $biller_product = $this->login_model->get_data_where_condition('biller_invoice_products', $where12);
      $total=0;
      foreach ($biller_product as  $value) {
      $total+=($value->biller_invoice_product_price*$value->biller_invoice_product_qty);
      $subtotal = $value->biller_invoice_product_price*$value->biller_invoice_product_qty;
               $html .='
                  <tr style="text-align: center;border-bottom: 1px solid #eee;">
                    <td style="width:5%;font-weight: lighter;color: #000;font-size: 12px;padding:10px 0;border-bottom: 1px solid #eee;">'.$k.'</td>
                    <td style="width:10%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">'.$value->biller_invoice_product_name.'</td>
                   
                    <td style="width:15%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">'.$value->biller_invoice_product_qty.'</td>
                    <td style="width:25%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">&#8358;'.$value->biller_invoice_product_price.'</td>
                    <td style="width:25%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;"> &#8358; '.$subtotal.'</td>
                  </tr>';
         $k++;    }
                                           
          }                                    
}else{
   $total=$data[0]->bill_amount;
}

                $html .='</table>
                <table style="width: 100%;">
 <tr><td colspan="2">&nbsp;</td></tr>
                  <tr style="width:100%;">
                    <td style="width: 50%;"></td>
                    <td style="marginwidth: 50%;padding: 10px 0;background-color: #ddd;line-height:20px;">
                      <span style="background-color: #ddd;display: block;padding: 10px;">
                        Total Amount:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &#8358;'.$total.' 
                      </span>
                    </td>
                  </tr>
                  <tr><td colspan="2">&nbsp;</td></tr>
                  <tr>

                  <td colspan="2"> <p style="font-size:12px;color:gray;">'.$data[0]->bill_description.'</p></td>
                  </tr>
                </table>
              </td>
            </tr>
          
            



          </table>
        </center>
      </td>
    </tr>
  </table>

</body>
</html>';
 $mpdf->SetHTMLHeader($html);
 $mpdf->SetHTMLFooter('
<table cellpadding="0" cellspacing="0" border="0" width="794" align="center">
            <tr>
               <td  style="font-size: 12px;background-color: #43a047;padding: 10px;text-align: center;color: #fff;"> 

     Note:Please,check bill detail before proceeding for the payment, OyaCharge will not be responsible in any kind of discrepancies of biller,bills or amount payment.
           </tr>
           <tr>
             <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;""> 
           
                  <img src= "https://oyacharge.com/wassets/images/footerby.png" style="padding:8px;" width="170px" class="">
              </td>

           </tr>
           <tr>
            <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;"">  
         Powered by <img src="http://www.urbaneyouth.com/biller_assets/img/logo_1.png" style="width: 79px;margin-left: 3px;">
              </td> </td> 
              </td> </td> 
           </tr>

         </table>');
//  ==================End Lokesh Code==================

//$mpdf->Output();


if($type==1)
{

  $mpdf->Output('uploads/bill_invoice/'.$bill_no.'.pdf','F');
 // $bill='././uploads/bill_invoice/'.$bill_no.'.pdf';
  $bill= $_SERVER["DOCUMENT_ROOT"].'/uploads/bill_invoice/'.$bill_no.'.pdf';

}
else if($type==2)
{

   $mpdf->Output('uploads/bill_invoice/'.$bill_no.'.pdf','F');
  // $bill='././uploads/bill_invoice/'.$bill_no.'.pdf';
    $bill= $_SERVER["DOCUMENT_ROOT"].'/uploads/bill_invoice/'.$bill_no.'.pdf';
}

return $bill;
}



function testPDF()
{
  $this->create_new_pdf('3689263132','24',1);


}
	function pdf() 
  {
		   $invoice_no    = $this->uri->segment(3);
       $biller_id     = $this->uri->segment(4);
	     $where         = array('biller_user.bill_invoice_no'=>$invoice_no,'biller_user.biller_id'=>$biller_id);
	     $data          = $this->login_model->get_data_join_four_tabel_where_group('biller_details','biller_user','biller_category','bill_recharge','biller_id','biller_id','biller_category_id','biller_category_id','biller_id','biller_id','',$where,'','biller_user.bill_invoice_no');

       $email         =   $data[0]->biller_user_email;
       $data['image'] =   company_logo; 
		   $biller_name   =   $data[0]->biller_company_name;
       $amt           =   $data[0]->bill_amount;
			 $bill          =   $this->create_new_pdf($invoice_no,$biller_id,2);
      
			 $data12['bill_paid_invoice_no']=$invoice_no;
			 $data12['bill_paid_invoice']=$invoice_no.'.pdf';
			 $this->login_model->update_data('biller_user', $data12, $where);

			 $message='Your Invoice INV#'.$consumer_no.' '.'of amount Naira'.' '.$amt.' '.' is generated by.'.' '.$biller_name.' '. ',Bill Paid Successfully';


        $attach = $this->uploadAttachment($bill, "Invoice.pdf");
     
        $this->sendElasticEmail($data[0]->biller_user_email, 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
       
        $this->sendElasticEmail($data[0]->biller_email, 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
      
        $this->sendElasticEmail('care@oyacharge.com', 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);




			// $this->sendElasticEmail($this->input->post("biller_user_email"), 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$bill);

			                  // $this->load->library('email');
                     //    $this->email->from('care@oyacharge.com', 'OyaCharge');
                     //    $this->email->to($email); // $cc_admin_email
                     //    $this->email->subject('Paid Bill Reciept of '.$invoice_no);
                     //    $this->email->message($message);
                     //    $this->email->attach($bill);
                     //    $this->email->send();
			                  return $invoice_no;
	}

  function uploadAttachment($filepath, $filename) {

 //global $username, $apikey;

 $username=urlencode("care@oyacharge.com");
  $apikey=urlencode("9baa5dc0-e443-4f06-ac91-e547d3845151");

 $data = http_build_query(array('username' => $username,'api_key' => $apikey,'file' => $filename));
 $file = file_get_contents($filepath);
 $result = ''; 

 $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30); 

 if ($fp){
 fputs($fp, "PUT /attachments/upload?".$data." HTTP/1.1\r\n");
 fputs($fp, "Host: api.elasticemail.com\r\n");
 fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
 fputs($fp, "Content-length: ". strlen($file) ."\r\n");
 fputs($fp, "Connection: close\r\n\r\n");
 fputs($fp, $file);
 while(!feof($fp)) {
 $result .= fgets($fp, 128);
 }
 } else { 
 return array(
 'status'=>false,
 'error'=>$errstr.'('.$errno.')',
 'result'=>$result);
 }
 fclose($fp);
 $result = explode("\r\n\r\n", $result, 2); 
 return array(
 'status' => true,
 'attachId' => isset($result[1]) ? $result[1] : ''
 );
}



function create_pdf() {
   $invoice_no = $this->uri->segment(3);

		$where=array('bill_invoice_no'=>$invoice_no);
		$data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
   
		$data['image']=company_logo;
      
		$bill=$this->create_new_pdf($invoice_no,$data[0]->biller_id,1); 
		$amt=$this->input->post("bill_amount");
		$invoice_no=$data[0]->bill_invoice_no;
		$to_email=$data[0]->biller_user_email;
    $data12['bill_invoice']=$invoice_no.'.pdf';
		$biller_name=$data[0]->biller_company_name;
		$message='Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amt.' '.' is generated by.'.' '.$biller_name.',Kindly make a payment via OyaCharge';
	//	$this->sendElasticEmail($this->input->post("biller_user_email"), 'Bill Invoice of '.$consumer_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$bill);

       // $list = array(''.$to_email.'', ''.$data[0]->biller_email.'','care@oyacharge.com');

        $attach = $this->uploadAttachment($bill, "Invoice.pdf");

        $this->sendElasticEmail($to_email, 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
       
        $this->sendElasticEmail($data[0]->biller_email, 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
      
        $this->sendElasticEmail('care@oyacharge.com', 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);


		                    // $this->load->library('email');
                      //   $this->email->from('care@oyacharge.com', 'OyaCharge');
                      //   $this->email->to($list); // $cc_admin_email
                      //   $this->email->subject('Pay Bill');
                      //   $this->email->message($message);
                      //   $this->email->attach($bill);
                      //   $this->email->send();
			
	}


  function event_ticket_pdf()
  {
    
    $booking_ticket_id    = $this->uri->segment(3);
    $biller_email         = $this->uri->segment(4);
    $where=array('booking_event_tickets_id'=>$booking_ticket_id);
   // $ticket_records = $this -> login_model -> get_join_three_table_where('event_list','booking_event_tickets','user','booking_event_id','event_id','user_id','booking_user_id',$where);
      $ticket_records = $this -> login_model -> get_join_three_table_where('booking_event_tickets','user','event_list','user_id','booking_user_id','event_id','booking_event_id',$where);

$booking_event_tickets_id =   $ticket_records[0]->booking_event_tickets_id;
$booking_ticket_price     =   $ticket_records[0]->booking_ticket_price;
$ids                      =   $ticket_records[0]->booking_ticket_id;
$event_id                 =   $ticket_records[0]->booking_event_id;
$event_name               =   $ticket_records[0]->event_name;

$event_date               =   $ticket_records[0]->event_date;
$event_end_date           =   $ticket_records[0]->event_end_date;
$event_date               =   $ticket_records[0]->event_date;
$event_starttime          =   $ticket_records[0]->event_time;
$event_end_time           =   $ticket_records[0]->event_end_time;
$event_place              =   $ticket_records[0]->event_place;
$event_image              =   event_image.$ticket_records[0]->event_image;
$event_contact_no         =   $ticket_records[0]->event_contact_no;
$user_name                =   $ticket_records[0]->user_name;
$user_email               =   $ticket_records[0]->user_email;
if(empty($user_email))
{
  $user_email             =   $ticket_records[0]->user_contact_no;
}
$user_contact_no          =   $ticket_records[0]->user_contact_no;
$id_ticket                =   explode(",", $ids);
$trans_id                 =   rand('1111111','999999');
 $sql            =   'SELECT * FROM `booking_event_tickets`  inner join  `booking_ticket_status` on `booking_ticket_status`.`booking_id`=`booking_event_tickets`.`booking_event_tickets_id` inner  join `event_ticket_record` on `event_ticket_record`.`event_ticket_id`=`booking_ticket_status`.`booking_ticket_id` inner join `events_tickets`on `events_tickets`.`events_tickets_id`=`booking_ticket_status`.`booking_ticket_id` where  `booking_ticket_status`.`booking_id`="'.$booking_event_tickets_id.'" GROUP BY `booking_ticket_status`.`booking_ticket_id`';
//  $response=mysql_query($sql);
     $response=$this->login_model->get_simple_query($sql);
$message='';
$message .= '<!DOCTYPE html PUBLIC " ">
<html xmlns=" ">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>oya charge </title>
  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Lato:400);

    /* Take care of image borders and formatting */

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      text-decoration: none;
      border: 0;
      outline: none;
    }

    a img {
      border: none;
    }

    /* General styling */

    td, h1, h2, h3  {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }

     table {
      border-collapse: collapse !important;
    }


    h1, h2, h3 {
      padding: 0;
      margin: 0;
      color: #ffffff;
      font-weight: 400;
    }

    h3 {
      color: #21c5ba;
      font-size: 24px;
    }

    .important-font {
      color: #21BEB4;
      font-weight: bold;
    }

    .hide {
      display: none !important;
    }

    .force-full-width {
      width: 100% !important;
    }
  </style>

  <style type="text/css" media="screen">
    @media screen {
       /* Thanks Outlook 2013! http://goo.gl/XLxpyl*/
      td, h1, h2, h3 {
        font-family: "Lato", "Helvetica Neue", "Arial", "sans-serif" !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 320px !important;
      }

      table[class="w300"] {
        width: 300px !important;
      }

      table[class="w290"] {
        width: 290px !important;
      }

      td[class="w320"] {
        width: 320px !important;
      }

      td[class="mobile-center"] {
        text-align: center !important;
      }

      td[class="mobile-padding"] {
        padding-left: 20px !important;
        padding-right: 20px !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-block"] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-border"] {
        border: 0 !important;
      }

      td[class*="reveal"] {
        display: block !important;
      }
    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="40%" height="100%" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td style="border-bottom: 3px solid #3bcdc3;" width="100%">
          <center>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td valign="top" style="padding:10px 0; text-align:left;" class="mobile-center">
                  <img width="200" height="62" src="'.maillogo.'">
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td background="1.jpg" bgcolor="#8b8284" valign="top" style="background: url('.$event_image.') no-repeat center; background-color: #8b8284; background-position: center;>
          <!--[if gte mso 9]>
          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:303px;">
            <v:fill type="tile" src="https://www.filepicker.io/api/file/kmlo6MonRpWsVuuM47EG" color="#8b8284" />
            <v:textbox inset="0,0,0,0">
          <![endif]-->
          <div>
            <center>
              <table cellspacing="0" cellpadding="0" width="530" height="303" class="w320">
                <tr>
                  <td valign="middle" style="vertical-align:middle; padding-right: 15px; padding-left: 15px; text-align:left;" height="303">

                    <table cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                        <td>
                          <h1>THANK YOU FOR YOUR TICKET BOOKING </h1><br>
                          <h2>Please review your email below .</h2>
                          <br>
                        </td>
                      </tr>
                    </table>

                    <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                    <td class="hide reveal">
                      &nbsp;
                    </td>
                      <td style="width:150px; height:33px; background-color: #3bcdc3;" >
                        <div>
                          <a href="#" style="background-color:#3bcdc3;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;"></a>
                          </div>
                      </td>
                      <td>
                        &nbsp;
                      </td>
                    </tr>
                  </table>
                  </td>
                </tr>
              </table>
            </center>
          </div>
          <!--[if gte mso 9]>
            </v:textbox>
          </v:rect>
          <![endif]-->
        </td>
      </tr>
      <tr>
        <td valign="top">

          <center>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td valign="top" style="border-bottom:1px solid #a1a1a1;">


                <table cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                    <td style="padding: 30px 0;" class="mobile-padding">

                    <table class="force-full-width" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="text-align: left;">
                          <span class="important-font">
                           Dear,'.$user_name.'  <br>
                          </span>
                          '.$user_email.' <br>
                          '.$user_contact_no.' <br>
                          
                        </td>
                        <td style="text-align: right; vertical-align:top;">
                          <span class="important-font">
                           Event Venue<br>
                          </span>
                          '.$event_name.' <br>
                         '.$event_place.' <br>
                          '.$event_date.' '.'-'.' '.$event_end_date.' <br>
                          '.$event_contact_no.'

                        </td>
                      </tr>
                    </table>

                    </td>
                  </tr>
                  <tr>
                    <td style="padding-bottom: 30px;" class="mobile-padding">

                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>

                          <td class="mobile-block" width="33%">
                                  <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #3bcdc3; color: #ffffff; padding: 5px; border-right: 3px solid #ffffff;">
                                  Ticket Name
                                </td>
                                 <td class="mobile-border" style="background-color: #3bcdc3; color: #ffffff; padding: 5px; border-right: 3px solid #ffffff;">
                                  Ticket ID
                                </td>
                                 <td style="background-color: #3bcdc3; color: #ffffff; padding: 5px;">
                                  Quantity
                                </td>
                                  <td style="background-color: #3bcdc3; color: #ffffff; padding: 5px;">
                                  Amount
                                </td>
                              </tr>';
             foreach ($response as  $row) {
            
           
                if($row->booking_ticket_qty!='0'){
                             $message .= '<tr>
                                <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;border-right: 3px solid #ffffff;">
                                 '.$row->events_tickets_name.'
                                </td>
                                 <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;border-right: 3px solid #ffffff;">
                                 '.$row->events_tickets_no.'
                                </td>
                                 <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">
                               '.$row->booking_ticket_qty.'
                                </td> 
                                <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">
                               '.$row->event_ticket_price.'
                                </td>
                              </tr>';
                              }}
                            $message .= '</table>
                          </td>

                        </tr>
                      </table>

                    </td>
                  </tr>
                  <tr>
                    <td class="mobile-padding">

                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td style="text-align: left;">
                            The amount of '.$booking_ticket_price.'  has been charged on the booking event ticket of '.$event_name.'
                            <br>
                            <br>
                          </td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td>
                  <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td class="mobile-padding" style="text-align:left;">
                      <br>
                        Thank you for your Interest. Please <a href="#">contact us</a> with any questions regarding this invoice.
                      <br>
                      <br>
                      Oya Charge 
                      <br>
                      <br>
                      <br>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td style="background-color:#c2c2c2;">
          <center>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td>
                  <table cellspacing="0" cellpadding="30" width="100%">
                    <tr>
                      <td style="text-align:center;">
                        <a href="#">
                          <img width="61" height="51" src="https://www.filepicker.io/api/file/vkoOlof0QX6YCDF9cCFV" alt="twitter" />
                        </a>
                        <a href="#">
                          <img width="61" height="51" src="https://www.filepicker.io/api/file/fZaNDx7cSPaE23OX2LbB" alt="google plus" />
                        </a>
                        <a href="#">
                          <img width="61" height="51" src="https://www.filepicker.io/api/file/b3iHzECrTvCPEAcpRKPp" alt="facebook" />
                        </a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <center>
                    <table style="margin:0 auto;" cellspacing="0" cellpadding="5" width="100%">
                      <tr>
                        <td style="text-align:center; margin:0 auto;" width="100%">
                           <a href="#" style="text-align:center;color: #A1A1A1;">
                              &copy; Oyacharge All right reserved.
                           </a>
                        </td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>'; 
$mpdf = new mPDF();
$mpdf->WriteHTML($message);
$mpdf->Output();



$mpdf->Output('uploads/event/'.$trans_id.'.pdf','F');
$bill='././uploads/event/'.$trans_id.'.pdf';


        $subject = 'Event Ticket Booking Confirmation of Event - '.$event_name;
        $headers = "Organization: OyaCharge\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

         $attach = $this->uploadAttachment($bill, "Eventticket.pdf");

        $mail=$this->sendElasticEmail($user_email, $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
      if($mail)
      {
        $subject1 = 'Event Ticket Booking Confirmation of '.$user_email;

        

     
     /// $attach = $this->uploadAttachment($bill, "Eventticket.pdf");
        $this->sendElasticEmail($biller_email, $subject1, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);      


      }
      return $bill;
  }


function event_new_pdf()
{

    $booking_ticket_id    = $this->uri->segment(3);
    $biller_email         = $this->uri->segment(4);
   // $booking_ticket_id = '28';
   //   $biller_email         ='blmindore1@gmail.com';
    $where=array('booking_event_tickets_id'=>$booking_ticket_id);
   // $ticket_records = $this -> login_model -> get_join_three_table_where('event_list','booking_event_tickets','user','booking_event_id','event_id','user_id','booking_user_id',$where);
      $ticket_records = $this -> login_model -> get_join_three_table_where('booking_event_tickets','user','event_list','user_id','booking_user_id','event_id','booking_event_id',$where);

$booking_event_tickets_id =   $ticket_records[0]->booking_event_tickets_id;
$booking_ticket_price    =   $ticket_records[0]->booking_ticket_price;
$ids                     =   $ticket_records[0]->booking_ticket_id;
$event_id                =   $ticket_records[0]->booking_event_id;
$biller_id               =   $ticket_records[0]->event_biller_id;
$sql11111                =  'select biller_company_logo from biller_details where biller_id="'.$biller_id.'"';
$biller_response         =   $this->login_model->get_simple_query($sql11111); 
$biller_company_logo     =   company_logo."/".$biller_response[0]->biller_company_logo;
$event_name              =   $ticket_records[0]->event_name;
$event_date              =   $ticket_records[0]->event_date;
$event_end_date          =   $ticket_records[0]->event_end_date;
$event_date              =   $ticket_records[0]->event_date;
$event_starttime         =   $ticket_records[0]->event_time;
$event_end_time          =   $ticket_records[0]->event_end_time;
$event_place             =   $ticket_records[0]->event_place;
$event_qrcode            =    event_image.$ticket_records[0]->booking_ticket_qrcode;   
$event_contact_no        =   $ticket_records[0]->event_contact_no;
$user_name               =   $ticket_records[0]->user_name;
$user_email              =   $ticket_records[0]->user_email;
$user_contact_no         =   $ticket_records[0]->user_contact_no;
$transaction_idss        =   $ticket_records[0]->transaction_id;
$transaction_date         =   $ticket_records[0]->transaction_date;
$transaction_amt          =   $ticket_records[0]->booking_ticket_price;
$id_ticket                =   explode(",", $ids);
$trans_id                 =   rand('1111111','999999');
  $sql            =   'SELECT * FROM `booking_event_tickets`  inner join  `booking_ticket_status` on `booking_ticket_status`.`booking_id`=`booking_event_tickets`.`booking_event_tickets_id` inner  join `event_ticket_record` on `event_ticket_record`.`event_ticket_id`=`booking_ticket_status`.`booking_ticket_id` inner join `events_tickets`on `events_tickets`.`events_tickets_id`=`booking_ticket_status`.`booking_ticket_id` where  `booking_ticket_status`.`booking_id`="'.$booking_event_tickets_id.'" GROUP BY `booking_ticket_status`.`booking_ticket_id`'; 
//  $response=mysql_query($sql);
     $response=$this->login_model->get_simple_query($sql); 
                            $this->load->library('ciqrcode');
                            $qr_image               = $ticket_records[0]->transaction_id.'.png';
                            $params['data']         = $ticket_records[0]->transaction_id;
                            $params['level']        = 'H';
                            $params['size']         = 12;
                            $params['savename']     = $_SERVER['DOCUMENT_ROOT'].'/uploads/event/'.$qr_image;
                            if($this->ciqrcode->generate($params))
                            {
                                $where321= array('booking_event_tickets_id'=>$booking_ticket_id);
                                $data211222['booking_ticket_qrcode'] = $qr_image;
                                $this->login_model->update_data('booking_event_tickets', $data211222, $where321);
                            }
   $mpdf = new mPDF();
  
   $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title></title>
 
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="" style="background-color: #eee;font-family: sans-serif;">
  <h4 style="text-align:center;">Ticket Invoice</h4>
  <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
    <tr>
      <td align="center" valign="top" width="100%" class="background">
        <center>
          <table cellpadding="0" cellspacing="0" width="600" style="box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);margin-top: 50px;background-color: #fff;padding: 0px">

            <tr style="width: 100%">
              <td style="width: 50%;text-align:left;">
              <img  style="width: 120px" src="'.$event_qrcode.'"> 
    <h6 style="color: #a06002;display:block!important; "> Ordered Date: '.$transaction_date.'</h6>
              </td>
              <td style=""></td>
              <td valign="top" class="wrap-cell" style="width: 40%;text-align: right;     color: #43a047;display: block; padding: 0px 0;font-size: 14px;font-weight: bold;padding-top: 0px;">Order ID: #'.$transaction_idss.' <br/>
                <span style="color: #333;display: block;padding: 5px 0;font-size: 14px;font-weight: bold;padding-bottom:2px;border-bottom:1px solid #ddd;">Order For</span><br/>
                <span style="color: gray;display: block;padding: 5px 0;font-size: 14px;border-bottom:1px solid #ddd;">'.$event_name.'</span><br/>
                <span style="color: gray;display: block;padding: 5px 0;font-size: 14px;">'.$event_date.'</span>
              </td>
              
            </tr>
           
            <tr><td colspan="3" style="border-bottom:1px solid #bbb; ;">&nbsp;</td></tr>
           

            <tr style="width: 100%;padding: 10px 0;">
              <td style="padding:20px 0;text-align:left;">
                <span style="color: #000;display: block;font-weight: bold;">Order By</span><br>
                <span style="color: #333;display: block!important;padding: 3px 0;font-size: 14px;">'.$user_name.'</span><br>
                <span style="color: #333;display: block!important;padding: 3px 0;font-size: 14px;">'.$user_email.'</span>
               
              </td>
              <td style="padding:20px 0;"></td>
              <td style="padding:20px 0;text-align:left;">
                <span style="color: #000;display: block;font-weight: bold;">Event Venue</span><br>
                <span style="color: #333;display: block!important;padding: 3px 0;font-size: 14px;">'.$event_place.' </span><br>
                <span style="color: #333;display: block!important;padding: 3px 0;font-size: 14px;">'.$event_contact_no.'</span>
               
              </td>
            </tr>
            <tr>
              <td colspan="3" style:"text-align:left;">
                <span style="padding-bottom: 5px!important;text-align:left;!important">Order details</span><br>
                <span style="background-color: #2b2b2b;padding: 5px;display: block;">
<br>
                <table style="width:100%">
                
                  <tr style="text-align: center;">
                  
                    <td style="width:20%;font-weight: bold;color: #fff;font-size: 12px;padding:5px;  background-color:#2b2b2b; text-align:center;">Ticket Name</td>
                    <td style="width:20%;font-weight: bold;color: #fff;font-size: 12px;padding:5px;  background-color:#2b2b2b; text-align:center;">Ticket Qty.</td>
                    <td style="width:20%;font-weight: bold;color: #fff;font-size: 12px;padding:5px;  background-color:#2b2b2b; text-align:center;">Price</td>
                    <td style="width:20%;font-weight: bold;color: #fff;font-size: 12px;padding:5px;  background-color:#2b2b2b; text-align:center;">Subtotal</td>
                     
                  </tr>   
                
                </table></span>
                <table style="width:100%">';
                 
                foreach ($response as  $row) {
            
           
                if($row->booking_ticket_qty!='0'){                             
                  $message .= '<tr>
                                <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;border-right: 3px solid #ffffff;">
                                 '.$row->events_tickets_name.'
                                </td>
                               
                                 <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">
                               '.$row->booking_ticket_qty.'
                                </td> 
                                <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">
                               &#8358;'.$row->event_ticket_price.'
                                </td>
                                  <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;border-right: 3px solid #ffffff;">
                                 &#8358;'.$row->booking_ticket_qty*$row->event_ticket_price.'
                                </td>
                              </tr>';
                              }}

                  $message .= '</table>
                 <table style="width: 100%;">
                 <tr><td colspan="2">&nbsp;</td></tr>
                 <tr><td colspan="2">&nbsp;</td></tr>
                  <tr style="width:100%;">
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;padding: 10px 0;background-color:#ddd;">
                      <span style="background-color: #ddd;display: block;padding: 10px;">
                        Grand Total:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &#8358; '.$transaction_amt.' 
                      </span><br/>
                      <span style="background-color: #ddd;display: block;padding: 10px;">
                        Total Amount:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      &#8358; '.$transaction_amt.'  
                      </span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            

          </table>
        </center>
      </td>
    </tr>
  </table>

</body>
</html>
';
    $mpdf->SetHTMLHeader($message);
     $mpdf->SetHTMLFooter('
<table cellpadding="0" cellspacing="0" border="0" width="794" align="center">
            <tr>
               <td  style="font-size: 12px;background-color: #43a047;padding: 10px;text-align: center;color: #fff;"> 

     Note:Please,check bill detail before proceeding for the payment, OyaCharge will not be responsible in any kind of discrepancies of biller,bills or amount payment.
           </tr>
           <tr>
             <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;""> 
           
                  <img src= "https://oyacharge.com/wassets/images/footerby.png" style="padding:8px;" width="170px" class="">
              </td>

           </tr>
           <tr>
            <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;"">  
         Powered by <img src="http://www.urbaneyouth.com/biller_assets/img/logo_1.png" style="width: 79px;margin-left: 3px;">
              </td> </td> 
              </td> </td> 
           </tr>

         </table>');  

    //$mpdf->Output();
      $mpdf->Output('uploads/event/'.$event_name.$trans_id.'.pdf','F');
      $bill='././uploads/event/'.$event_name.$trans_id.'.pdf';
      $where1 = array('event_biller_id' => $biller_id,'booking_event_tickets_id'=>$booking_ticket_id);
      $data['booking_event_pdf']=$event_name.$trans_id.'.pdf';
      $this->login_model->update_data('booking_event_tickets', $data, $where1);

        $subject = 'Event Ticket Booking Confirmation of Event - '.$event_name;
        $headers = "Organization: OyaCharge\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
         $attach = $this->uploadAttachment($bill, "Eventticket.pdf");
      $message = 'Event Ticket Booking Confirmation of '.$user_email.'of Event Name: '.$event_name;
      //   $mail=$this->sendElasticEmail($user_email, $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);


        $subject1 = 'Event Ticket Booking Confirmation of '.$user_email.'of Event Name: '.$event_name;
       
            $message = 'Event Ticket Booking Confirmation of '.$user_email.'of Event Name: '.$event_name;
     //   $this->sendElasticEmail($biller_email, $subject1, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);   
                     
      
      return $bill;
 //   $mpdf->Output();
}



   function sendElasticEmail2($to, $subject, $body_text, $body_html, $from, $fromName,$attachments)
  {
    $res = "";

    $data = "username=".urlencode("care@oyacharge.com");
    $data .= "&api_key=".urlencode("9baa5dc0-e443-4f06-ac91-e547d3845151");
    $data .= "&from=".urlencode($from);
    $data .= "&from_name=".urlencode($fromName);
    $data .= "&to=".urlencode($to);
    $data .= "&subject=".urlencode($subject);
    if($body_html)
      $data .= "&body_html=".urlencode($body_html);
    if($body_text)
      $data .= "&body_text=".urlencode($body_text);
    if($attachments)
      $data .= "&attachments=".urlencode($attachments);
    $header = "POST /mailer/send HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($data) . "\r\n\r\n";
    $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30);

    if(!$fp)
      return "ERROR. Could not open connection";
    else {
      fputs ($fp, $header.$data);
      while (!feof($fp)) {
        $res .= fread ($fp, 1024);
      }
      fclose($fp);
    }
    return $res;                  
  }

  function create_new_pdf_paid()
{
   $invoice_no=$_REQUEST['invoice_no'];
   $where=array('bill_invoice_no'=>$invoice_no);
      $data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
      $invoice_date=$data[0]->bill_invoice_date;
      $title='Bill Invoice'; 


     // $mpdf = new mPDF();
      $mpdf2 = new mPDF('utf-8', 'A4', 0, '', -5, -5, -5, -5, 0, 0);
     $html2='
     <!DOCTYPE html>
<html lang="en">
  <head>
    
    <title></title>

   
  </head>
  <body>
     
      <table font-family:Helvetica,Helvetica,Arial,sans-serif; cellpadding="0" cellspacing="0" border="0" width="794px" align="center">
         <tr>
            <td>
         <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" style="background-color:#456776;">
            <tr>
               <td width="50%"> 
                    <img src="'.company_logo."/".$data[0]->biller_company_logo.'" style="padding:10px;" width="50px" class="">
              </td>
              <td width="50%" align="left" style="padding: 10px; text-align:centtre; color: #fff">   '.$title.'
             </td> 
           </tr>
           
         </table>
          <table cellpadding="0" cellspacing="0" border="0" width="100%"  style="padding: 15px">
           <tr>
            <td>
               <table style="padding: 10px">
                    <tr>
                       <td> Biller:'.$data[0]->biller_company_name.'<br> </td> 
                    </tr> 
                     <tr>
                       <td> Service -'.$data[0]->biller_category_name.'<br> </td> 
                    </tr> 
                     <tr>
                       <td> Email:- '.$data[0]->biller_email .'<br> </td> 
                    </tr> 
                     <tr>
                       <td> Phone:-  '.$data[0]->biller_contact_no  .'<br></td> 
                    </tr> 
                    <tr>
                       <td>Consumer No:- '.$data[0]->biller_customer_id_no.'<br></td> 
                    </tr> 
               </table> 
            </td> 
             <td style="text-align: right; vertical-align:top; display: block;">
               <table width="100%" style="margin-top:">
                  <tr>
                     <td> <strong> Date:-'.$invoice_date.' </strong> </td> 
                  </tr> 
                   <tr>
                     <td> Invoice No:- '.$data[0]->bill_invoice_no.' </td> 
                  </tr> 
                   <tr>
                     <td> Transaction No:-'.$data[0]->bill_transaction_id.'</td> 
                  </tr> 
                   
             </table> 
            </td> 
           </tr>
         </table>
                <table style="padding:10px; margin-top:10px; width:100%;">
                    <tr>
                       <td style="text-align:center"> 
                            <img src="'.bill_invoice_paid.'/paid.png" style="padding:10px;" width="50px" class="">
                       </td>
                    </tr> 
                 </table>
               <table style="padding-left:25px; margin-top:10px;">
                    <tr>
                       <td> Bill To,</td> 
                    </tr> 
                     <tr>
                       <td>  '.$data[0]->biller_user_name.'<br></td> 
                    </tr> 
                     <tr>
                       <td> Email:- '.$data[0]->biller_user_email  .'<br></td> 
                    </tr> 
                     <tr>
                       <td> Phone:- '.$data[0]->biller_user_contact_no  .'<br></td> 
                    </tr> 
                     
               </table> 
          <table cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #ccc; margin: 0 20px;">
            <thead>
               <tr>
                  <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background-color:#456776; color:#fff; text-align:center;"> <strong>Product Name </strong></td>
                  <td style="padding:10px;border-right:1px solid #ccc; border-bottom:1px solid #ccc; background-color:#456776; color:#fff; text-align:center;"><strong> Price per Unit</strong> </td>
                  <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; background-color:#456776; color:#fff; text-align:center;"><strong> Product Qty</strong></td>
                <td style="padding:10px; border-bottom:1px solid #ccc; background-color:#456776; color:#fff; text-align:center;"> <strong>Total Price</strong> </td> 
               </tr>
            </thead>
            <tbody>';
  if(!empty($data[0]->bill_product_id))
    {
        for($i=0;$i<count($data[0]->bill_product_id); $i++)
        {
      
      $where12=array('biller_invoice_no'=>$data[0]->bill_invoice_no,'find_in_set(biller_invoice_product_id, "'.$data[0]->bill_product_id.'") '=>NULL);
      
      $biller_product = $this->login_model->get_data_where_condition('biller_invoice_products', $where12);
      $total=0;
      foreach ($biller_product as  $value) {
      $total+=($value->biller_invoice_product_price*$value->biller_invoice_product_qty);
               $html2 .='<tr>
                 <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:right;"> '.$value->biller_invoice_product_name.' </td>
                 <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:right;"><img  style="position:relative;top:8px;left:2px;" width="13px" src="http://image.flaticon.com/icons/svg/32/32974.svg"/> <strong>'.$value->biller_invoice_product_price.'/-</strong> </td>
                 <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;text-align:right;"> <strong>'.$value->biller_invoice_product_qty.'</strong> </td>
                 <td style="padding:10px; border-bottom:1px solid #ccc;text-align:right;"><img  style="position:relative;top:8px;left:2px;" width="13px" src="http://image.flaticon.com/icons/svg/32/32974.svg"/> <strong>'.$value->biller_invoice_product_price*$value->biller_invoice_product_qty.'/-</strong> </td> 
               </tr>';
             }
                                           
          }                                    
}else{
   $total=$data[0]->bill_amount;
}
              $html2 .='<tr>
                 <td colspan="4">
                     <table width="100%"> 
                        <tr>
                            <td  style="padding:10px;border-bottom:1px solid #ccc;"> <strong> Total
                       </strong>  </td> 
                       <td  style="padding:10px; text-align:right;  border-bottom:1px solid #ccc;"> <img  style="position:relative;top:8px;left:2px;" width="13px" src="http://image.flaticon.com/icons/svg/32/32974.svg"/> <strong> '.$total.'/-
                       </strong>  </td>  
                        </tr>
                        <tr>
                           <td colspan="2">Description:  '.$data[0]->bill_description.' </td> 
                        </tr>
                     </table>
                 </td>
                
                 
               </tr>
            </tbody>
         </table>
         <table width="100%" style="padding: 15px; background-color:#ccc; margin: 30px 20px 0;">
             <tr>
                <td style="width: 50%"> 
                     <table>
                         <tr>
                            <td> Bill Consumer No.:  '.$data[0]->biller_customer_id_no.'  </td> 
                         </tr>
                         <tr>
                           <td> via OyaCharge </td>  
                         </tr>
                     </table>
                </td> 
                 <td style="width: 50%"> 
                      <table width="100%">
                         <tr>
                            <td style="text-align: right;"> 
                              <p style="margin: 0"> '.$data[0]->biller_company_name.'<br>
                                              </p> 
                              <p style="margin: 0">  ('.$data[0]->biller_name.') </p> 
                          </td> 
                         </tr>
                     </table>
                 </td>
             </tr> 
         </table>
          </td>
         </tr>
       </table>

  
  </body>
</html>';
 $mpdf2->SetHTMLHeader($html2); 
$mpdf2->SetHTMLFooter('
<table cellpadding="0" cellspacing="0" border="0" width="794" align="center">
            <tr>
               <td style="background-color:#16262d; padding:15px; text-align:center; color:#fff; font-size:14px;"> 
                    You are receiving this newsletter because you have subscribed to our newsletter.Not interested anymore? 
Unsubscribe instantly.
           </tr>
           <tr>
             <td style="background-color:#456776;text-align:center;color:#fff;font-size:13px; padding:5px;"> 
                <img src="https://oyacharge.com/wassets/images/powredby.png" style="pdding-top:8px;" width="170px" class=""/>   
              </td>

           </tr>
           <tr>
            <td style="background-color:#456776;text-align:center;color:#fff;font-size:13px; padding:5px;">  
             Address: 8B, Lalupon close, Ikoyi Lagos
              </td> </td> 
           </tr>

         </table>');

$mpdf2->Output(); 
$mpdf2->Output('uploads/bill_invoice_101/'.$data[0]->bill_invoice_no.'.pdf','F');
//$bill='././uploads/bill_invoice_101/'.$data[0]->bill_invoice_no.'.pdf';
//return $bill;
}

}
