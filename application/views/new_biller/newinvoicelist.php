
      <div class="content">
    

<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="current_page" class="card" style="margin: 0 auto;display: table;float: none;width: 70%">
                <div class="card-body p-0">
                    <div class="row p-5" style="padding-bottom: 0!important;">
                        <div class="col-md-8">
                            <img src="<?php if(!empty($biller_details)){ echo company_logo."/".$biller_details[0]->biller_company_logo; } ?>" style="background: rgba(67,160,71,.8);padding: 15px;border: 1px dashed #ccc; width: 100px" >
                        </div>

                        <div class="col-md-4">
                        	<h4 style="margin-bottom: 10px;font-size: 15px;color: #43a047;font-weight: 600;text-transform: capitalize;"><?php if(!empty($biller_details)){ echo $biller_details[0]->biller_company_name; } ?></h4>
                        	<p class="font-weight-bold mb-1"><i class="fa fa-file-text-o" aria-hidden="true"></i> Name : <?php if(!empty($biller_details)){ echo $biller_details[0]->biller_name; } ?></p>
                          <p class="font-weight-bold mb-1"><i class="fa fa-phone" aria-hidden="true"></i> <?php if(!empty($biller_details)){ echo $biller_details[0]->biller_contact_no; } ?></p>
                            <p class="font-weight-bold mb-1"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php if(!empty($biller_details)){ echo $biller_details[0]->biller_email; } ?></p>
                        </div>
                    </div>

                  
                    <div class="row p-5" style="padding-top: 0!important;padding-bottom: 0!important;">
                        <div class="col-md-6">
                        	<h4 style="margin-bottom: 10px;font-size: 14px;color: #000;font-weight: 600;text-transform: capitalize;">Consumer </h4>
                          <p class="font-weight-bold mb-1"><i class="fa fa-calendar-o" aria-hidden="true"></i> Consumer : #<?php if(!empty($invoice_details)){ echo $invoice_details[0]->biller_customer_id_no; } ?></p>
                            <p class="font-weight-bold mb-1"><i class="fa fa-file-text-o" aria-hidden="true"></i> Name : <?php if(!empty($invoice_details)){ echo $invoice_details[0]->biller_user_name; } ?></p>
                            <?php if($invoice_details[0]->bill_pay_status==1){ ?>
                              <p class="font-weight-bold mb-1"><i class="fa fa-asterisk" aria-hidden="true"></i>Transaction No : #<?php if(!empty($invoice_details)){ echo $invoice_details[0]->bill_transaction_id; } ?></p>
                           <?php } ?>
                           <p class="font-weight-bold mb-1"><i class="fa fa-phone" aria-hidden="true"></i> <?php if(!empty($invoice_details)){ echo $invoice_details[0]->biller_user_contact_no; } ?></p>
                            <p class="font-weight-bold mb-1"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php if(!empty($invoice_details)){ echo $invoice_details[0]->biller_user_email; } ?></p>
                        </div>

                        <div class="col-md-6" style="background: #333;padding: 17px;margin-top: 10px;color: #fff;">
                            <p class="font-weight-bold" style="font-size: 23px;margin-bottom: 14px;">Invoive : # <?php if(!empty($invoice_details)){ echo $invoice_details[0]->bill_invoice_no; } ?></p>
                            <table>
                              <tr>
                                <th style="padding: 3px 18px 3px 0px;">Invoice Date</th>
                                <th style="padding: 3px 18px 3px 0px;"><?php if(!empty($invoice_details)){  if($invoice_details[0]->bill_pay_status==2){ echo "Due";  }else if($invoice_details[0]->bill_pay_status==1){ echo "Paid";  }else if($invoice_details[0]->bill_pay_status==3){ echo "Cancelled";  } } ?> Date</th>
                                <th style="padding: 3px 18px 3px 0px;">Status</th>
                              </tr>
                              <tr>
                                <td style="padding: 3px 18px 3px 0px;"><?php if(!empty($invoice_details)){ echo $invoice_details[0]->bill_invoice_date; } ?></td>
                                <td style="padding: 3px 18px 3px 0px;">
                                  <?php if(!empty($invoice_details)){  if($invoice_details[0]->bill_pay_status==2){ echo $invoice_details[0]->bill_due_date;  }
                                  else if($invoice_details[0]->bill_pay_status==1){ echo $invoice_details[0]->bill_paid_date;  }
                                  else if($invoice_details[0]->bill_pay_status==3){ echo $invoice_details[0]->bill_cancel_date;  } } ?></td>
                                <td style="padding: 3px 18px 3px 0px;"><?php if(!empty($invoice_details)){  if($invoice_details[0]->bill_pay_status==2){ echo "Draft";  }else if($invoice_details[0]->bill_pay_status==1){ echo "Paid";  }else if($invoice_details[0]->bill_pay_status==3){ echo "Cancelled";  } } ?></td>
                              </tr>
                            </table>
                          </div>
                    </div>

                    <div class="row p-5" style="padding-bottom: 0!important;padding-top: 0!important;">
                        <div class="col-md-12" style="padding: 0;">
                            <table class="table" style="margin-top: 20px;">
                                <thead>
                                    <tr style="background-color: #333;color: #fff;">
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Price</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php  if(!empty($invoice_details['products'][0]))
                                  {

                                    $i=1;$j=0;
                                    foreach ($invoice_details['products'] as $value) {  ?>
                                     <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value[0]->biller_invoice_product_name; ?></td>
                                        <td><?php echo $value[0]->biller_invoice_product_qty; ?></td>
                                        <td><?php echo "₦".$value[0]->biller_invoice_product_price; ?></td>
                                        <td><?php echo "₦".$value[0]->biller_invoice_product_price*$value[0]->biller_invoice_product_qty; ?></td>
                                        
                                    </tr>
                                 <?php $i++; $j++;  }
                                  } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse text-white p-4">
                       <table style=" float: right;width: 100%;">
                                <thead>
                                    <tr style="background-color: #eee;color: #333;float: right;width: 44%;">
                                        <th style="float: left;color: #333;font-size: 12px!important;padding: 15px 25px;" class="border-0 text-uppercase small font-weight-bold">Total Amount</th>
                                       
                                        <th style="float: right;color: #333;margin-left: 50px;font-size: 20px!important;padding: 16px;font-weight: bold !important;" class="border-0 text-uppercase small font-weight-bold">₦<?php if(!empty($invoice_details)){ echo $invoice_details[0]->bill_amount; } ?>/-</th>
                                      
                                    </tr>
                                    <tr style="color: #333;float: left;width: 100%;">
                                    	<td style="color: #777;padding-left: 26px;font-weight: 500;text-transform: capitalize;font-size: 12px;width: 100%;text-align: center;padding-top: 21px !important;"><?php echo $invoice_details[0]->bill_description; ?></td>
                                    </tr>
                                </thead>
                              </table>
                       
                    </div>
                   
                    <div class="d-flex flex-row-reversetext-white p-4" style="    padding-top: 10px!important;float: left;
    background-color: #43a047;
    padding-bottom: 10px!important;">
                      <p style="text-align: center;font-size: 12px;color: #fff;margin-bottom: 0;">Note:Please,check bill detail before proceeding for the payment, OyaCharge will not be responsible in any kind of discrepancies of

biller,bills or amount payment.</p>
                    </div>
                    <div class="d-flex flex-row-reverse  bg-dark  text-white p-4" style="padding-top: 10px!important;float: right;width: 100%!important;padding-bottom: 10px!important;">
                    <p style="float: right;width: 100%;margin: 0;text-align: center;line-height: 34px;
    font-size: 12px;">Powered by <img src="<?php echo base_url('biller_assets/img/logo_1.png');?>" style="width: 79px;margin-left: 3px;"></p>
                     
                    </div>
                </div>
            </div>
           <!--   <button onclick="clickprint()" class="print" style="float: right;
    width: auto;cursor: pointer;
    margin: 7px 34px 7px 9px;
    display: table;
    background: #333;
    border: 0;
    color: #fff;
    width: 73px;
    padding: 4px;
    position: absolute;
    top: 0;
    right: 0;">print</button> -->
        </div>
    </div>
    
    

</div>



      </div>
  <!-- <script src="https://gist.github.com/btd/2390721.js"></script> -->
<script type="text/javascript">
function clickprint()
{
   var divContents = $("#current_page").html();
        // var printWindow = window.open('', '', 'height=200,width=200');
        // printWindow.document.write('<html><head><title>OyaCharge</title>');
        // printWindow.document.write('</head><body >');
        // printWindow.document.write(divContents);
        // printWindow.document.write('</body></html>');
        // printWindow.document.close();
        // printWindow.print();
}
     

</script>