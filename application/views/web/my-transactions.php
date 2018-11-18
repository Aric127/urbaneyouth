
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">


<div class="container-fluid">
    <div class="container over-lap-div">
        <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 560px;">
            <div class="trans-head-div">
                <h2><img src="<?php echo base_url('wassets/images/transaction.png');?>" width="45">My Transactions</h2>
            </div>

            <div class="trans-tb transp-pg">
                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab">
                                Normal Transaction</a>
                            </li>
                             <li>
                                <a href="#tab_default_2" data-toggle="tab">
                                Church Donation</a>
                            </li>
                            <li>
                                <a href="#tab_default_3" data-toggle="tab">
                                Event Transaction</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                <div class="table-responsive">
                                    <table id="example12" class="table table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product Description</th>
                                                <th>Status</th>
                                                <th> &nbsp; &nbsp; Price &nbsp; &nbsp;</th>
                                                <th>Order No.</th>
                                                <th>Payment Status</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody class="tbl-design">
                                        	<?php  
                                        	if(!empty($transaction)){
                                        		//echo "<pre>"; print_r($transaction);
                                        	foreach ($transaction as $value) {
                                        		if($value->transaction_type != '13' && $value->transaction_type != '16'){
                                        		 if($value->transaction_type=='1')
                                        		 { $type= "Transaction Of Add Money";}
                                        		 else 
                                        		 if($value->transaction_type=='2')
                                        		 { $type="Recharge" ; }
												 else 
                                        		 if($value->transaction_type=='3')
                                        		 { $type="Refund" ; }
                                        		 else 
                                        		 if($value->transaction_type=='4')
                                        		 { $type= "Cashback Is Recieved" ; }
                                        		 else
												 if($value->transaction_type=='5')
												 { $type= "Transfer Amount" ; }
												 else 
												 if($value->transaction_type=='6')
												 { $type= "Amount is Recieved" ; }
												 else 
												 if($value->transaction_type=='7')
												 { $type= "SMS added in your sms wallet" ; }
												 else 
												 if($value->transaction_type=='8')
												 { $type= "SMS transfer" ; }
												 else
												 if($value->transaction_type=='10')
												 { $type= "Recieved Money" ; }
												 else
												 if($value->transaction_type=='11')
												 { $type= "Pay Bill" ; }
												 else 
												 if($value->transaction_type=='12')
												 { $type= "Electricity Bill" ; }
												 else 
												 if($value->transaction_type=='16')
												 { $type= "Event Ticket" ; }else{
												 	$type="";
												 } 
									          ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php if(!empty($value->operator_image)) { echo $value->operator_image; }else{ echo default_logo;} ?>" class="ratio img-responsive img-circle center-block">
                                                </td>
                                                <td>
                                                    <span>
                                                        <h4><?php echo $type; ?></h4>
                                                        <?php  if($value->transaction_type!='1' && $value->transaction_type!='4'&& $value->transaction_type!='11'){ ?>
                                                        <p>Operator: <?php echo $value->operator_name; ?> |  Number :<?php if(!empty($value->mobile_number))echo $value->mobile_number; ?> </p> <?php } else{ ?>
                                                 <p>Consumer No: <?php echo $value->consumer_no; ?> 
                                                 <p>Consumer Name: <?php echo $value->consumer_name; ?>
                                                 <p>Biller Name: <?php echo $value->biller_company; ?> 
                                              
                                                        	 <?php } ?>
                                                        <p>Payment Via:<?php echo $value->pay_type ?></p>
                                                      </span>
                                                </td>
                                                <td><?php if($value->transaction_type=='1'){ echo "Transaction Of Add Money";}else if($value->transaction_type=='2'){ echo $type ; }else if($value->transaction_type=='3'){ echo "Refund is Recieved" ; }else if($value->transaction_type=='4'){ echo "Cashback Is Recieved" ; }else if($value->transaction_type=='5'){ echo "Transfer Amount" ; }else if($value->transaction_type=='6'){ echo "Amount is Recieved" ; }else if($value->transaction_type=='7'){ echo "SMS added in your sms wallet" ; }else if($value->transaction_type=='8'){ echo "SMS transfer" ; }else if($value->transaction_type=='10'){ echo "Recieved Money" ; }else if($value->transaction_type=='11'){ echo "Pay Bill Invoice" ; }else if($value->transaction_type=='12'){ echo "Electricity Bill" ; }?></td>
                                                <td>₦ <?php echo $value->recharge_amount ?></td>
                                                <td><span>
                                                    <p><?php if(!empty($value->trans_ref_no)){ echo $value->trans_ref_no; }else { echo $value->transaction_number; }?></p>
                                                    <p><?php echo $value->transction_date; ?> </p>
                                               </span>
                                                </td>
                                                <td><?php if($value->transaction_status=='1'){ echo "Success";}else if($value->transaction_status=='2'){ echo "Pending"; }else if($value->transaction_status=='3'){ echo "Failure"; } ?>
                                                <?php if($value->transaction_status=='3' && $value->transaction_type=='2'){ ?>	</br><a class="btn btn-border repeat-btn offset-top-30" onclick="repeat_recharge('<?php echo $value->operator_id; ?>','<?php echo $value->mobile_number; ?>','<?php echo $value->recharge_amount; ?>','<?php echo $value->recharge_category; ?>')">Retry</a>
                                                    
                                                    <?php } ?>
                                                </td>
                                              
                                            </tr>
                                           <?php
                                           } } }?>

                                        </tbody>

                                    </table>
                                </div>
                                <!--end of .table-responsive-->
								
                            </div>
                            <div class="tab-pane" id="tab_default_2">

                                <div class="table-responsive">
                                    <table id="tbl_12" class="table table-hover responsive tables">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product Description</th>
                                                <th>Status</th>
                                                <th>&nbsp; &nbsp; Price &nbsp; &nbsp;</th>
                                                <th>Order No.</th>
                                                <th>Payment Status</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody class="tbl-design">
                                        	<?php  
                                        	if(!empty($transaction)){
                                        	foreach ($transaction as $value) {
                                        		if($value->transaction_type == '13'){
                                        		
                                        		$type= "Church Donation" ; 
									          ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php if(!empty($value->operator_image)) { echo $value->operator_image; }else{ echo default_logo;} ?>" class="ratio img-responsive img-circle center-block">
                                                </td>
                                                <td>
                                                    <span>
                                                        <h4><?php echo $type; ?></h4>
                                                      
                                                        <p>Church: <?php echo $value->church_name; ?> </p>   <p>Area: <?php echo $value->church_area; ?> </p> 
                                                        <p>Payment Via:<?php echo $value->pay_type ?></p>
                                                      </span>
                                                </td>
                                                <td>Church Donation </td>
                                                <td>₦ <?php echo $value->recharge_amount ?></td>
                                                <td><span>
                                                    <p><?php if(!empty($value->trans_ref_no)){ echo $value->trans_ref_no; }else { echo $value->transaction_number; }?></p>
                                                    <p><?php echo $value->transction_date; ?> </p>
                                               </span>
                                                </td>
                                                <td><?php if($value->transaction_status=='1'){ echo "Success";}else if($value->transaction_status=='2'){ echo "Pending"; }else if($value->transaction_status=='3'){ echo "Failure"; } ?></td>
                                               
                                            </tr>
                                           <?php
                                           } } }?>

                                        </tbody>

                                    </table>
                                </div>
                                <!--end of .table-responsive-->

                            </div>
                              <div class="tab-pane" id="tab_default_3">

                                <div class="table-responsive">
                                    <table id="tbl_123" class="table table-hover responsive tables">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product Description</th>
                                                <th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Status &nbsp; &nbsp; &nbsp; &nbsp; </th>
                                                <th> &nbsp; &nbsp; Price &nbsp; &nbsp;</th>
                                                <th>Order No.</th>
                                                <th>Payment Status</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody class="tbl-design">
                                        	<?php  
                                        	if(!empty($transaction)){
                                        	foreach ($transaction as $value) {
                                        		if($value->transaction_type == '16'){
                                        		
                                        		$type= "Event Ticket Booking" ; 
									          ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php if(!empty($value->operator_image)) { echo $value->operator_image; }else{ echo default_logo;} ?>" class="ratio img-responsive img-circle center-block">
                                                </td>
                                                <td>
                                                    <span>
                                                        <h4><?php echo $type; ?></h4>
                                                      
                                                        <p>Event: <?php echo $value->event_name; ?> </p>   
                                                        <p>Payment Via:<?php echo $value->pay_type ?></p>
                                                      </span>
                                                </td>
                                                <td>Event Ticket</td>
                                                <td>₦ <?php echo $value->recharge_amount ?></td>
                                                <td><span>
                                                    <p><?php if(!empty($value->trans_ref_no)){ echo $value->trans_ref_no; }else { echo $value->transaction_number; }?></p>
                                                    <p><?php echo $value->transction_date; ?> </p>
                                               </span>
                                                </td>
                                                <td><?php if($value->transaction_status=='1'){ echo "Success";}else if($value->transaction_status=='2'){ echo "Pending"; }else if($value->transaction_status=='3'){ echo "Failure"; } ?> 
                                                	</br><a class="btn btn-border repeat-btn offset-top-30" onclick="regenrate_ticket('<?php echo $value->booking_event_tickets_id; ?>')">Regenrate Ticket</a>
                                                    <span class="success-event" id="succes_span<?php echo $value->booking_event_tickets_id; ?>" style="display:none;">Ticket regenrate successfully</span>
                                                </td>
                                                
                                            </tr>
                                           <?php
                                           } } }?>

                                        </tbody>

                                    </table>
                                </div>
                                <!--end of .table-responsive-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--recharge-details-->
    </div>
</div>
<!--cont-fluid-->

<script type="text/javascript">
    $('.sv-crd a').click(function(e) {
        e.preventDefault();
        $('a').removeClass('active');
        $(this).addClass('active');
    });
</script>

<!-- <script type="text/javascript">
  function showDiv() {
   document.getElementById('promo_input').style.display = "block";
   document.getElementById('promo_d').style.display = "none";
}  
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $("div.bhoechie-tab-menu-paymt>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab-paymt>div.bhoechie-tab-content-paymt").removeClass("active");
            $("div.bhoechie-tab-paymt>div.bhoechie-tab-content-paymt").eq(index).addClass("active");
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url('wassets/js/jquery.bootstrap-responsive-tabs.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/bootstrap.min.js')?>">
</script>
<script src="<?php echo base_url('wassets/js/jquery-ui.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/owl.carousel.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/slick.min.js');?>"></script>
<script src="<?php echo base_url('wassets/js/matchHeight.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/bootstrap-select.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/custom.js');?>">
</script>
<script>
    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
    });
</script>
<script type="text/javascript">
    $('.dropdown-select').on('click', '.dropdown-menu li a', function() {
        var target = $(this).html();

        //Adds active class to selected item
        $(this).parents('.dropdown-menu').find('li').removeClass('active');
        $(this).parent('li').addClass('active');

        //Displays selected text on dropdown-toggle button
        $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <span class="caret"></span>');
    });
</script>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>
    // When the browser is ready...
    $(function() {

        // Setup form validation on the #register-form element
        $("#card_payment").validate({

            // Specify the validation rules
            rules: {
                expiry_month: "required",
                expiry_year: "required",
                card_no: {
                    required: true,
                    minlength: 16
                },
                cvv_no: {
                    required: true,
                    minlength: 3,
                    maxlength: 3
                },
                agree: "required"
            },

            // Specify the validation error messages
            messages: {
                firstname: "Please enter card expiry month",
                lastname: "Please enter card expiry year",
                card_no: {
                    required: "Please enter a valid card number",
                    minlength: "Please enter 16 digit card number"
                },
                cvv_no: {
                    required: "Please enter a valid cvv number",
                    minlength: "Please enter 3 digit cvv number"
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>

<script>

$(document).ready(function() {
	 $('#example12').DataTable();
	 $("#tbl_12").DataTable();
	 $("#tbl_123").DataTable();
} );


</script>


<script src=" https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js "></script>




</body>

</html>