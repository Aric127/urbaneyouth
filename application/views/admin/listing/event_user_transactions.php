<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php if ($this->session->flashdata('status')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('status'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    function PrintDiv() {
        var divContents = $("#current_page").html();
       	var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head><title>OyaCharge</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
       
    }
</script>
<style>
	.dl-horizontal dt{text-align: left; margin-bottom:5px;}
  .detail-page p{
    line-height: 18.5px;
  }
</style>
</head>

<body bgcolor="#f1f1f1">
	  <div class="btn btn-warning pull-right" onclick="PrintDiv()">
            <i class="fa fa-print"></i> Print
        </div>
        






<div style="width:649px;margin:10px auto;border:#ececec solid 1px; background:#fff;" id="current_page">
  <div style="padding:22px 34px 15px 34px">
    <div style="padding:10px; width:100%; background:#456776;"><img title="" src="<?php echo base_url(); ?>assets/images/logo_1.png" alt="Paytm" class="CToWUd">
    </div>
    <div class="detail-page" style="color:#333333;font:normal 14px Arial,Helvetica,sans-serif;width:100%">
      <div  style="color:#666; font:bold 19px Arial,Helvetica,sans-serif;margin-top:10px;margin-bottom:10px"><b>User Name</b> <?php echo $transaction_record[0]->user_name; ?></div>
      <div style="width:50%; float: left; font:normal 14px Arial,Helvetica,sans-serif;"><p>
       
		<?php	//print_r($transaction_record);  ?>
	   <b>Transaction ID:</b> 
        <?php echo $transaction_record[0]->transaction_id; ?> 
        <br>

        <b>Contact Number : </b> 
        <?php echo $transaction_record[0]->user_contact_no; ?> 
        <br>

        <b>Refference No : </b> 
        <?php echo $transaction_record[0]->trans_ref_no; ?> 
        <br>

       
        
        <b>Transaction Status  : </b> 
        <span  <?php  if($transaction_record[0]-> wt_status=='3'){?> style="color: red" <?php }else{?> style="color: green" <?php } ?>><?php if($transaction_record[0]-> wt_status=='1'){echo "Success";}elseif($transaction_record[0]-> wt_status=='2'){echo "Pending";} elseif($transaction_record[0]-> wt_status=='3'){echo "Failed";}  ?></span>
        <br>
        </p>
      </div>
      <div style="width:50%; float: left; font:normal 14px Arial,Helvetica,sans-serif;">
        <p>
        <b>User Email : </b> 
        <?php echo $transaction_record[0]->user_email; ?> 
        <br>

        <b>Transaction Type :</b> 
        <?php  if($transaction_record[0]->wt_category=='1'){ echo "Add Money";}elseif($transaction_record[0]->wt_category=='2') {echo "Recharge";}elseif($transaction_record[0]->wt_category=='3'){ echo "Refund Money";}; ?>
        <br>
        <b>Transaction Date: </b> 
        <?php echo date('d-m-Y h:i:s', strtotime($transaction_record[0]->wt_datetime)); ?> 
        <br>

       
        <b>Transaction Description : </b> 
        <?php echo $transaction_record[0]->wt_desc; ?>
        <br>
      </p>


      </div>







    
    </div>
    
    <div style="clear:both"></div>
  </div>
  <div style="width:584px;background-color:#ffffff;border:#e8e7e7 solid 1px;padding:27px 0;margin:0 auto;border-bottom:0">
    <div style="border-bottom:#717171 dotted 1px;font:normal 14px Arial,Helvetica,sans-serif;color:#666666;padding:0px 33px 10px">
      <br>
      <table style="width:100%" cellspacing="0" cellpadding="2" border="0">
        <tbody>
        <tr>
          <td width="450px">Wallet Amount</td>
          <td style="text-align: right;">₦<?php echo $transaction_record[0]-> wallet_amount; ?></td>
        </tr>
        
        </tbody>
      </table>
    </div>
    <div style="border-bottom:#717171 dotted 1px;font:normal 14px Arial,Helvetica,sans-serif;color:#666666;padding:10px 33px 10px">
      <br>
      <table style="width:100%" cellspacing="0" cellpadding="2" border="0">
        <tbody>
        <tr>
          <td width="450px">Transaction Amount</td>
          <td style="text-align: right;">₦ <?php echo $transaction_record[0]->wt_amount; ?></td>
        </tr>
        </tbody>
      </table>
    </div>


    <div style="border-bottom:#717171 dotted 1px;font:normal 14px Arial,Helvetica,sans-serif;color:#666666;padding:10px 33px 10px">
      <br>
      <table style="width:100%" cellspacing="0" cellpadding="2" border="0">
        <tbody>
        <tr>
          <td width="450px">Total</td>
          <td style="text-align: right;">₦<?php echo $transaction_record[0]->wt_amount; ?></td>
        </tr>
        </tbody>
      </table>
    </div>
    <div style="border-bottom:#717171 dotted 1px;font:600 14px Arial,Helvetica,sans-serif;color:#333333;padding:17px 33px 17px">
      <table style="width:100%" cellspacing="0" cellpadding="2" border="0">
        <tbody>
        <tr>
          <td width="450px">Amount paid</td>
          <td style="text-align: right;">₦<?php echo $transaction_record[0]->wt_amount; ?></td>
        </tr>
        </tbody>
      </table>
    </div>
      
    <form style="margin:0;font:normal 12px Arial,Helvetica,sans-serif" id="m_407477710045046901m_-4127472163058342348m_-5297201480658981960surveyForm" target="_blank">
      <table style="padding:15px" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
         
        </tr>
        </tbody>
      </table>
    </form>
  </div>
  <div style="margin:0 auto;width:594px"><img title="" src="https://ci5.googleusercontent.com/proxy/KoI1e0i-XD71NTdXVAH38AgfxPH70VVIqKcp0XGdC1F2-RuInPQoMsfcUVXCHeCacnb7T3Ydm3ixZ_A2savD7eQ0MytFi1wouRw9=s0-d-e1-ft#http://assets.paytm.com/images/footer/receiptedge.png" alt="" class="CToWUd">
  </div>
</div>  
































         <!-- <div class="invocewrapper">
            <div class="invoice_header"> 
               <div class="inv_logo"> 
               <img src="<?php echo base_url(); ?>assets/images/logo_1.png" alt="..."/></div>
            </div>
            <div class="invoice-body"> 
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Transaction ID :
                   </div> 
                     <div class="inv_lable_input"> 
                      <?php echo $transaction_record[0]->transaction_id; ?>
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      User Name1 :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo $transaction_record[0]->user_name; ?> 
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Contact Number :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo $transaction_record[0]-> user_contact_no; ?>
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      User Email :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo $transaction_record[0]->user_email; ?>
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Transaction Type :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php  if($transaction_record[0]->wt_category=='1'){ echo "Add Money";}elseif($transaction_record[0]->wt_category=='2') {echo "Recharge";}elseif($transaction_record[0]->wt_category=='3'){ echo "Refund Money";}; ?>
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Transaction Date:
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo date('d-m-Y h:i:s', strtotime($transaction_record[0]->wt_datetime)); ?>
                     </div>  
                     
                 </div>
                   <?php if($transaction_record[0]->wt_category!='3'){?>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Transaction ID :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo $transaction_record[0]-> transaction_id; ?> 
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Refference No :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo $transaction_record[0]-> trans_ref_no; ?>
                     </div>  
                 </div>
                  <?php } ?>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Transaction Amount :
                   </div> 
                     <div class="inv_lable_input"> 
                      <?php echo $transaction_record[0]-> wt_amount; ?>
                     </div>  
                 </div>
                  <?php if($transaction_record[0]->wt_category=='2'){?>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Recharge Type :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php  if($transaction_record[0]->rechage_category=='1'){echo "Mobile";}else if($transaction_record[0]->rechage_category=='2'){ echo "DTH";}else if($transaction_record[0]->rechage_category=='3'){ echo "TV";}else if($transaction_record[0]->rechage_category=='5'){ echo "Electricity Bill";} ?> 
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                     Recharge Operator :
                   </div> 
                     <div class="inv_lable_input">
                      <?php echo $transaction_record[0]->operator_name; ?> 
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Recharge Number :
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo $transaction_record[0]->recharge_number; ?> 
                     </div>  
                 </div>
                  <?php } ?>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Transaction Description :	
                   </div> 
                     <div class="inv_lable_input"> 
                     <?php echo $transaction_record[0]-> wt_desc; ?> 
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                      Transaction Status :
                   </div> 
                     <div class="inv_lable_input"> 
                     <span  <?php  if($transaction_record[0]-> wt_status=='3'){?> style="color: red" <?php }else{?> style="color: green" <?php } ?>><?php if($transaction_record[0]-> wt_status=='1'){echo "Success";}elseif($transaction_record[0]-> wt_status=='2'){echo "Pending";} elseif($transaction_record[0]-> wt_status=='3'){echo "Failed";}  ?></span> 
                     </div>  
                 </div>
                 <div class="inv_group">
                   <div class="inv_label label-strong"> 
                     Wallet Amount:
                   </div> 
                     <div class="inv_lable_input">
                     <?php echo $transaction_record[0]-> wallet_amount; ?> 
                     </div>  
                 </div>
            </div>
            <div class="invoice_footer"> 
            </div> 
         </div> -->
        
<!--<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;" id="current_page">
	<thead>
       <tr>
        	<td style="background-color:#456776; height:62px; width:100%; padding:5px; 
            border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#">
                <img width="100" src="<?php echo base_url(); ?>assets/images/logo_1.png" alt="..."/></a>
            </td>
        </tr>
        <tr>  
       <td> <h2 style=" border-bottom: 1px solid #ccc;color: #333;font-size:20px; padding-bottom:13px;
    text-align:center;">View User Transaction</h2> </td>
        </tr>
    </thead>
    <tbody style=" border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
                     <tr> 
                      <td> <strong style="width:120px;">Transaction ID :</strong> </td>
				      <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]->transaction_id; ?></td> 
                   </tr>   
            	   <tr>
                     <td> <strong style="width:120px;">User Name :</strong> </td> 
                     <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]->user_name; ?> </td> 
                   </tr>
                   <tr> 
                       <td> <strong>Contact Number :</strong> </td> 
                       <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"><?php echo $transaction_record[0]-> user_contact_no; ?></td>
                   </tr>
                <tr> 
                   <td> <strong>User Email :</strong> </td>
				   <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"><?php echo $transaction_record[0]->user_email; ?> </td>
                </tr>
                <tr> 
                  <td> <strong>Transaction Type :</strong> </td>
				  <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php  if($transaction_record[0]->wt_category=='1'){ echo "Add Money";}elseif($transaction_record[0]->wt_category=='2') {echo "Recharge";}elseif($transaction_record[0]->wt_category=='3'){ echo "Refund Money";}; ?> </td>
                  </tr>
              
                <tr> 
                   <td><strong>Transaction Date:</strong>  </td>
				   <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"><?php echo date('d-m-Y h:i:s', strtotime($transaction_record[0]->wt_datetime)); ?>
                </td>
                </tr>
                 <?php if($transaction_record[0]->wt_category!='3'){?>
                <tr> 
                    <td> <strong>Transaction ID :</strong> </td>
                   <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]-> transaction_id; ?> </td>
                </tr>
                 <tr> <td><strong>Refference No :</strong> </td> 
				<td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]-> trans_ref_no; ?>
                    <?php } ?> </td>
                </tr>
                <tr>
                     <td> <strong>Transaction Amount :</strong> </td> 
                     <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]-> wt_amount; ?> </td>
                </tr>
                <?php if($transaction_record[0]->wt_category=='2'){?>
                 <tr> 
                    <td> <strong>Recharge Type :</strong> </td>
				<td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php  if($transaction_record[0]->rechage_category=='1'){echo "Mobile";}else if($transaction_record[0]->rechage_category=='2'){ echo "DTH";}else if($transaction_record[0]->rechage_category=='3'){ echo "TV";}else if($transaction_record[0]->rechage_category=='5'){ echo "Electricity Bill";} ?> </td> 
                </tr>
                  <tr>
                    <td> <strong>Recharge Operator :</strong> </td> 
				   <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]->operator_name; ?> </td>
                  </tr>
                   <tr>
                    <td> <strong>Recharge Number :</strong> </td>
				   <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]->recharge_number; ?> </td>
                  <?php } ?></tr>
                   <tr> 
                       <td><strong>Transaction Description :</strong> </td>
                       <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"><?php echo $transaction_record[0]-> wt_desc; ?> </td> 
                   </tr>
                    <tr> 
                    <td><strong>Transaction Status :</strong> </td>
                    <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <span  <?php  if($transaction_record[0]-> wt_status=='3'){?> style="color: red" <?php }else{?> style="color: green" <?php } ?>><?php if($transaction_record[0]-> wt_status=='1'){echo "Success";}elseif($transaction_record[0]-> wt_status=='2'){echo "Pending";} elseif($transaction_record[0]-> wt_status=='3'){echo "Failed";}  ?></span> <td>
                   </tr>
                    <tr> 
                        <td> <strong>Wallet Amount:</strong> </td>
                       <td style="background:#f1f1f1;display:block;margin-bottom:2px;padding:5px;"> <?php echo $transaction_record[0]-> wallet_amount; ?> </td> 
                    </tr>
                </tbody>
                </table>
           </td>
        </tr>
        
        <tr>
           <td> 
               <table width="100%" cellpadding="0" cellspacing="0" style="border-top:1px solid #ccc">
                  <tbody>
                      <tr> 
                         <td style="padding:10px; color:#666;">OyaCharge Panel</td>
                        <td style="padding:10px; color:#666; text-align:right">
                        Copyright &copy; 2016 OyaCharge</td>
                      </tr> 
                  </tbody>
               </table>
           </td> 
        </tr>
    </tbody>
</table>-->
</body>
</html>