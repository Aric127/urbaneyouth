
	<div class="after_login_page">
     	<h3>Transaction History</h3>
     	
     	
     	<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Normal Transaction</a></li>
			  <li><a data-toggle="tab" href="#menu1">Event Transaction</a></li>
			   
			</ul>
			
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			  		    <h3>Transaction</h3>
			  	 <div class="filter">
        <div class="btn-group dilter-drop-daown">
             <select class="btn btn-default dropdown-toggle" onchange="change_transaction_rec(this.value)">
             <option value="">All Transaction</option>
             <option value="1" <?php if($wt_category=='1'){ ?> selected="" <?php } ?>>Add Wallet</option>
            <option value="2" <?php if($wt_category=='2'){ ?>selected="" <?php }?>>Recharge</option>
            <option value="3" <?php if($wt_category=='3'){ ?> selected="" <?php } ?>>Refund</option>
            <option value="4" <?php if($wt_category=='4'){ ?> selected="" <?php } ?>>Cashback</option>
           <option value="5" <?php if($wt_category=='5'){ ?> selected="" <?php } ?>>Transfer Money</option>
                <option value="7" <?php if($wt_category=='7'){ ?> selected="" <?php } ?>>Add SMS</option>  
                <option value="8" <?php if($wt_category=='8'){ ?> selected="" <?php } ?>>Share SMS</option>
                <option value="10" <?php if($wt_category=='10'){ ?> selected="" <?php } ?>>Recieved Money</option>
                  <option value="11" <?php if($wt_category=='11'){ ?> selected="" <?php } ?>>Pay Bill</option>  
                   <option value="12" <?php if($wt_category=='12'){ ?> selected="" <?php } ?>>Electricity Bill</option>  <option value="16" <?php if($wt_category=='16'){ ?> selected="" <?php } ?>>Event Ticket </option>  
             </select>
        </div>
        <!-- <div class="btn-group dilter-drop-daown">
              <select class="btn btn-default dropdown-toggle ">
                <option>Status</option>
                <option value="1">Success</option>
                <option>Failed</option>
                <option>Pending</option>
             </select>
        </div> -->
     </div>
		
			   <?php if(!empty($transaction)){
 
        foreach ($transaction as $value) {
        //	echo "<pre>"; print_r($value);
        	if($value->transaction_type != '16'){
        ?>

        <div class="detail_table border">
        	<div class="operater">
            	<?php if(empty($value->operator_image) && empty($value->church_image)&& empty($value->biller_company_logo)&& empty($value->event_image)){?>
            	<img width="70" height="70" class="img-circle" src="<?php echo base_url(); ?>webassets/images/default_logo.png" alt="..."/>
            	<?php }else if(!empty($value->operator_image)){ ?>
            	<img src="<?php echo $value->operator_image ?>" alt="..."/>
            	<?php }else if(!empty($value->church_image)){
            		 ?>
            		<img width="70" height="70" class="img-circle" src="<?php echo church_image."/".$value->church_image ?>" alt="..."/>
            		<?php }else if(!empty($value->biller_company_logo)){ ?>
            	<img width="70" height="70" class="img-circle" src="<?php echo $value->biller_company_logo ?>" alt="..."/>
            	<?php }else if(!empty($value->event_image)){ ?>
            	<img width="70" height="70" class="img-circle" src="<?php echo $value->event_image ?>" alt="..."/>
            	<?php } ?>
            </div>
            <div class="recharge_detail">
          <?php if($value->recharge_category=='1'){
          	$type="Mobile";
          }else  if($value->recharge_category=='2'){
          	$type="DTH";
          }else  if($value->recharge_category=='3'){
          	$type="Data Card";
          }else  if($value->recharge_category=='4'){
          	$type="Data Card";
          } else  if($value->recharge_category=='5'){
          	$type="Electricity Bill Recharge";
          }else
		  if($value->transaction_type=='13'){
		  		$type="Church Donation";
		  }else
		  if($value->transaction_type=='16'){
		  		$type="Event Ticket";
		  }
          ?>
				<h5 class="offset-top-0"> <?php if($value->transaction_type=='1'){ echo "Transaction Of Add Money";}else if($value->transaction_type=='2'){ echo "Recharge on $type" ; }else if($value->transaction_type=='4'){ echo "Cashback Is Recieved" ; }else if($value->transaction_type=='5'){ echo "Transfer Amount" ; }else if($value->transaction_type=='6'){ echo "Amount is Recieved" ; }else if($value->transaction_type=='7'){ echo "SMS added in your sms wallet" ; }else if($value->transaction_type=='8'){ echo "SMS transfer" ; }else if($value->transaction_type=='10'){ echo "Recieved Money" ; }else if($value->transaction_type=='11'){ echo "Pay Bill" ; }else if($value->transaction_type=='12'){ echo "Electricity Bill" ; }else if($value->transaction_type=='16'){ echo "Event Ticket" ; } ?> </h5>
			<?php if($value->transaction_type=='2' || $value->transaction_type=='12'){ ?><p>Operator: <b><?php  echo $value->operator_name;?></b></p> <?php } ?>
				<?php if($value->transaction_type=='2'){ ?>
				<p>Number :<?php echo $value->mobile_number; ?></p><?php }else 
				if($value->transaction_type=='12'){ ?>
					<p>Meter / Account number :<?php echo $value->mobile_number; ?></p>
				<?php	}?>
				<?php if($value->transaction_type=='11'){ ?>
				<p>Consumer Number :<?php echo $value->consumer_no; ?></p>
				<p>Consumer Name :<?php echo $value->consumer_name; ?></p>
				<p>Service Provider :<?php echo $value->biller_company; ?></p>
				<?php }?>
				<?php if($value->transaction_type=='13'){?> 
				<p>Church Name :<?php echo $value->church_name; ?></p>
				<?php }?>
				<p><?php echo date("jS F, Y H:i:s", strtotime($value->transction_date));?></p>
					<p>Status: <b><?php echo $value->transaction_desc;?></b></p>
					<p>Payment Via:<b><?php echo $value->pay_type;?></b></p>
			</div>
			
			<div class="tras_right">
            	<p>₦ <?php echo $value->recharge_amount; ?></p>
            		<p>Order Id: <span><?php echo $value->transaction_number;?></span></p>
            		<?php if(!empty($value->trans_ref_no)){ ?>
            		<p>Trans Ref-Id: <span><?php echo $value->trans_ref_no;?></span></p>
            		<?php } ?>
            		      		<?php if($value->transaction_type!='4' && $value->transaction_type!='6'){ ?>
            	<?php if($value->transaction_status=='1'){  ?>
            
      
            		  <p class="green"><i class="fa fa-check"></i> Payment Successful</p>
          <?php if($value->transaction_type !='11' && $value->transaction_type !='12'  && $value->transaction_type!='10' && $value->transaction_type!='16'){?>
          <a href="#" class="btn  repeat-btn offset-top-30" <?php if($value->transaction_type=='1'){?> onclick="repeat_add_money(<?php echo $value->recharge_amount;?>,<?php echo $value->wt_id;?>)" <?php } ?> <?php if($value->transaction_type=='2'){?> onclick="repeat_recharge(<?php echo $value->wt_id;?>,<?php echo $value->transaction_type;?>,<?php echo $value->recharge_category;?>)" <?php } ?><?php if($value->transaction_type=='5'){?> onclick="repeat_transfer_money(<?php echo $value->wt_id;?>,<?php echo $value->recharge_amount;?>,<?php echo $value->cashback_recharge_number;?>)" <?php } ?><?php if($value->transaction_type=='7'){?> onclick="repeat_add_sms()" <?php } ?><?php if($value->transaction_type=='8'){?> onclick="repeat_share_sms(<?php echo $value->wt_id;?>,<?php echo $value->recharge_amount;?>,<?php echo $value->cashback_recharge_number;?>)" <?php } ?>>Repeat Transaction</a>
          <?php } ?>
            		  <?php }else{ ?>
            		  	   <p class="red"><i class="fa fa-close"></i> Payment Failure</p>
            		  	   <a href="#" <?php if($value->transaction_type=='1'){?> onclick="repeat_add_money(<?php echo $value->recharge_amount;?>,<?php echo $value->wt_id;?>)" <?php } ?><?php if($value->transaction_type=='2'){?> onclick="repeat_recharge(<?php echo $value->wt_id;?>,<?php echo $value->transaction_type;?>,<?php echo $value->recharge_category;?>)" <?php } ?><?php if($value->transaction_type=='5'){?> onclick="repeat_transfer_money(<?php echo $value->wt_id;?>,<?php echo $value->recharge_amount;?>,<?php echo $value->cashback_recharge_number;?>)" <?php } ?><?php if($value->transaction_type=='7'){?> onclick="repeat_add_sms()" <?php } ?><?php if($value->transaction_type=='8'){?> onclick="repeat_share_sms(<?php echo $value->wt_id;?>,<?php echo $value->recharge_amount;?>,<?php echo $value->cashback_recharge_number;?>)" <?php } ?> class="btn btn-border repeat-btn offset-top-30"><span></span>Retry</a>
            	<?php	  }}?>
         	  </div> 
         	     </div>
            <?php 
			} ?>

	<?php	} }else{ ?>
     	<div class="no-record">
      		<img src="<?php echo base_url(); ?>webassets/images/no_record_found.png" alt="..."/>
      	</div>
       <?php }?>
			  </div>
			  <div id="menu1" class="tab-pane fade">
			    <h3>Event Transaction</h3>
			    <?php if(!empty($transaction)){
 // echo "<pre>";    print_r($transaction);
        foreach ($transaction as $value) {
        	if($value->transaction_type =='16'){
 
        ?>

        <div class="detail_table border">
        	<div class="operater">
            	<?php if(empty($value->event_image)){?>
            	<img width="70" height="70" class="img-circle" src="<?php echo base_url('webassets/images/default_logo.png'); ?>" alt="..."/>
            	
            	<?php }else if(!empty($value->event_image)){ ?>
            	<img width="70" height="70" class="img-circle" src="<?php echo $value->event_image ?>" alt="..."/>
            	<?php } ?>
            </div>
            <div class="recharge_detail">
          <?php if($value->recharge_category=='1'){
          	$type="Mobile";
          }else  if($value->recharge_category=='2'){
          	$type="DTH";
          }else  if($value->recharge_category=='3'){
          	$type="Data Card";
          }else  if($value->recharge_category=='4'){
          	$type="Data Card";
          } else  if($value->recharge_category=='5'){
          	$type="Electricity Bill Recharge";
          }else
		  if($value->transaction_type=='13'){
		  		$type="Church Donation";
		  }else
		  if($value->transaction_type=='16'){
		  		$type="Event Ticket";
		  }
          ?>
				<h5 class="offset-top-0"> <?php if($value->transaction_type=='1'){ echo "Transaction Of Add Money";}else if($value->transaction_type=='2'){ echo "Recharge on $type" ; }else if($value->transaction_type=='4'){ echo "Cashback Is Recieved" ; }else if($value->transaction_type=='5'){ echo "Transfer Amount" ; }else if($value->transaction_type=='6'){ echo "Amount is Recieved" ; }else if($value->transaction_type=='7'){ echo "SMS added in your sms wallet" ; }else if($value->transaction_type=='8'){ echo "SMS transfer" ; }else if($value->transaction_type=='10'){ echo "Recieved Money" ; }else if($value->transaction_type=='11'){ echo "Pay Bill" ; }else if($value->transaction_type=='12'){ echo "Electricity Bill" ; }else if($value->transaction_type=='16'){ echo "Event Ticket" ; } ?> </h5>
			<?php if($value->transaction_type=='2' || $value->transaction_type=='12'){ ?><p>Operator: <b><?php  echo $value->operator_name;?></b></p> <?php } ?>
				<?php if($value->transaction_type=='2'){ ?>
				<p>Number :<?php echo $value->mobile_number; ?></p><?php }else 
				if($value->transaction_type=='12'){ ?>
					<p>Meter / Account number :<?php echo $value->mobile_number; ?></p>
				<?php	}?>
				<?php if($value->transaction_type=='11'){ ?>
				<p>Consumer Number :<?php echo $value->consumer_no; ?></p>
				<p>Consumer Name :<?php echo $value->consumer_name; ?></p>
				<p>Service Provider :<?php echo $value->biller_company; ?></p>
				<?php }?>
				<?php if($value->transaction_type=='13'){?> 
				<p>Church Name :<?php echo $value->church_name; ?></p>
				<?php }?>
				<p><?php echo date("jS F, Y H:i:s", strtotime($value->transction_date));?></p>
					<p>Status: <b><?php echo $value->transaction_desc;?></b></p>
					<p>Payment Via:<b><?php echo $value->pay_type;?></b></p>
					
			</div>
			
			<div class="tras_right">
            	<p>₦ <?php echo $value->recharge_amount; ?></p>
            		<p>Order Id: <span><?php echo $value->transaction_number;?></span></p>
            		<?php if(!empty($value->trans_ref_no)){ ?>
            		<p>Trans Ref-Id: <span><?php echo $value->trans_ref_no;?></span></p>
            		<?php } ?>
            		      		<?php if($value->transaction_type!='4' && $value->transaction_type!='6'){ ?>
            	<?php if($value->transaction_status=='1'){  ?>
            
      
            	
            		   <p class="green"><i class="fa fa-check"></i> Payment Successful</p>
            		   <a  class="btn btn-border repeat-btn offset-top-30" onclick="regenrate_ticket('<?php echo $value->booking_event_tickets_id; ?>')">Regenrate Ticket</a>
         
            		  <?php }else{ ?>
            		  	   <p class="red"><i class="fa fa-close"></i> Payment Failure</p>
            		  	   
            	<?php	  }}?>
         	  </div> 
         	     </div>
            <?php 
			}}}else{ ?>
     	<div class="no-record">
      		<img src="<?php echo base_url(); ?>webassets/images/no_record_found.png" alt="..."/>
      	</div>
       <?php }?>
			  </div>
			   
			</div>
     	
     	
     	
    
 
        <!--<div class="clearfix"></div>
        <div class="form-group">
        <br>
        <h4 class="text-green">March, 2016</h4>
        </div>
        <div class="detail_table border">
        	<div class="operater">
            	<img src="<?php echo base_url(); ?>webassets/images/images/logo-gsm.png" alt="..."/>
            </div>
            <div class="recharge_detail">
				<h5 class="offset-top-0">Transaction on 9806911515</h5>
				<p>Fri Apr 01 2016, 12:19:04 PM</p>
			</div>
			<div class="tras_right">
            	<p>₦ 10</p>
                <p class="red"><i class="fa fa-close"></i> Payment Failure</p>
         </div>-->
         
        </div>
        
 <script>
 	
 	function regenrate_ticket(bookind_id)
	{
		$.ajax({
			url : base_url + "regenerate_event_ticket",
	
			type : "POST",
			data : {
				'booking_event_tickets_id' : bookind_id
	
			},
			success : function(data) {
				
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message; 
				
					$("#ticket_popup").modal();
					$("#booking_id").html(bookind_id);
					$("#genrate_response").html(message);
				
	
			
			}
		});
	}
 </script>
<div class="modal fade popup" id="ticket_popup" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
        <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            <h2 class="text-green">Ticket Genrate</h2>
             <div class="pop-order">
            	
            </div>
             <div class="pop-order">
            	 Ticket Status: <span id="genrate_response"></span> 	
            </div>
          </div>
        </div>
        
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
