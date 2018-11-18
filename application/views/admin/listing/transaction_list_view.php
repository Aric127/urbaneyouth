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
<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panel-title">
            Transaction List
        </div>
        
    </div>
    
    <div class="panel-body">
		 <div class="clearfix transrow">
            <div class="col-md-2">
	            <label class="control-label">Date Wise</label>
	            <div class="clearfix"></div>
	            <input type="hidden" id="input_test" value=""/>
	           
	            <input type="text" name="txt" id="selected_date" class="daterange form-control add-ranges" data-format="MMMM D, YYYY" data-start-date="<?php echo date("M d,Y"); ?>" data-end-date=" <?php echo date("M d,Y"); ?>" value=""/> 
            </div>
             <div class="col-md-2">
                <label class="control-label">User Type</label>
    			<select id="user_type" class="form-control input-dark" name="user_type" data-validate="required" >
                    <option value="">--- Select ---</option>
                    <option value="1">Registered User</option>
                    <option value="2">Guest User</option>
                  </select>
            </div>

            <div class="col-md-2">
                <label class="control-label">Operator</label>
    
                    <select id="operator_id" class="form-control input-dark" name="operator_id" data-validate="required" >
                                    <option value="">--- Select ---</option>
                    <?php if(!empty($operator_list)){ foreach ($operator_list as $value) { ?>
                    <option value="<?php echo $value->operator_id; ?>"><?php echo $value->operator_name;?></option>
                                    <?php }}?>
                   </select>
                </div>
            <div class="col-md-2">
                <label class="control-label">Recharge Type</label>
    
                  <select id="recharge_type" class="form-control input-dark" name="recharge_type" data-validate="required" >
                    <option value="">--- Select ---</option>
                    <option value="1">Mobile</option>
                    <option value="2">DTH</option>
                    <option value="3">Data Card</option>
                   </select>
                </div>
            <div class="col-md-2">
                <label class="control-label">Recharge Status</label>
    			<select id="recharge_status" class="form-control input-dark" name="recharge_status" data-validate="required" >
                    <option value="">--- Select ---</option>
                    <option value="1">Success</option>
                    <option value="2">Failed</option>
                    <option value="3">Pending</option>
                  </select>
            </div>

            <div class="col-md-2">
                    <label class="control-label">Transaction Type</label>
        
                        <select id="transaction_type" class="form-control input-dark" name="transaction_type" data-validate="required" >
                                        <option value="">--- Select ---</option>
                        <option value="1">Add Money</option>
                                        <option value="2">Recharge</option>
                        <option value="3">Refund</option>
                        <option value="4">Cashback</option>
                        <option value="5">Transfer Money</option>
                        <option value="6">Receive Benifits</option>
                        <option value="7">Add SMS</option>
                        <option value="8">Share SMS</option>
                        <option value="9">Refer Money</option>
                        <option value="20">Biller Wallet Transfer</option>
                        <option value="21">Agent Margin</option>
        <!--				<option value="10">6 - Month</option>-->
                        </select>
                    </div>
            <div class="col-md-2">
            <label class="control-label">&nbsp;</label>
            <div class="clearfix"></div>
            <input type="button" id="sub" class="btn btn-success pull-left" value="Submit" onclick="transaction_filter()">
    
            &nbsp; &nbsp;
            <input type="submit" style="display: none;" id="excel" class="btn btn-success pull-left" value="Export"/>
    
            </div>
        </div>
 <div class="row">
       <div class="col-xs-6 counter-show-on-top">
        		<div class="counter-item">
        			<h5><?php echo $day_user[0]->day_user; ?></h5>
        			<h6>Today</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $week_user[0]->week_user; ?></h5>
        			<h6>Weekly</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $month_user[0]->month_user; ?></h5>
        			<h6>Monthly</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $year_user[0]->year_user; ?></h5>
        			<h6>Yearly</h6>
        		</div>
        	</div> 
        </div>
        </div>

    <div id="ajax_transaction_list" class="panel-body">
        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-1").dataTable({
                	dom: 'Bfrtip',
                    buttons: ['excel', 'print'],
                    aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                    ]
                });
                $( "a.buttons-excel" ).removeClass( "dt-button" ).addClass( "btn btn-blue btn-sm btn-icon" );
                $( "a.buttons-pdf" ).removeClass( "dt-button" ).addClass( "btn btn-blue btn-sm btn-icon" );
                $( "a.buttons-print" ).removeClass( "dt-button" ).addClass( "btn btn-blue btn-sm btn-icon" );
            });
        </script>
<div class="table-responsive">
        <table id="example-1" class="table table-striped table-bordered table-small-font " cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User Type</th>
                    <th>User Name</th>
                    <th>User Email / Mobile</th>
                    <th>Transaction Type</th>
					<th>TransactionID / Refference</th>
                    <th>Amount(₦)</th>
                    <th>Transaction Date</th>
                    <th>Transaction Status</th>                
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($wallet_transaction)) {
    //   print_r($wallet_transaction);
                    $n = 1;
                    foreach ($wallet_transaction as $value) {
                    	$trans_type=$value->wt_category;
						if($trans_type=='1'){
							$trans_type="Add Money";
						}else if($trans_type=='2'){
								$trans_type="Recharge";
						}else if($trans_type=='3'){
								$trans_type="Refund Money";
						}else if($trans_type=='4'){
								$trans_type="Cashback";
						}else if($trans_type=='5'){
								$trans_type="Transfer";
						}else if($trans_type=='7'){
								$trans_type="Add SMS";
						}else if($trans_type=='8'){
								$trans_type="Share SMS";
						}else if($trans_type=='9'){
								$trans_type="Refer Amount";
						}
						else if($trans_type=='10'){
								$trans_type="Transfer money from";
						}else if($trans_type=='11'){
								$trans_type="Bill pay";
						}else if($trans_type=='12'){
								$trans_type="Electrictiy Bill";
						}else if($trans_type=='13'){
								$trans_type="Donation to Church";
						}else if($trans_type=='16'){
								$trans_type="Event Ticket Booking";
						}else if($trans_type=='17'){
                                $trans_type="Wallet To Bank Transfer";
                        }else if($trans_type=='20'){
                                $trans_type="Amount add to Agent Wallet";
                        }else if($trans_type=='21'){
                                $trans_type="Recived cashback to agent";
                        }
						$redund_status=$value->refund_status;
						if($redund_status=='1'){
							
							$ref_sttaus="Refund";
						}else if($redund_status=='2'){
							
							$ref_sttaus='';
						}
						if($value->transaction_user_type=='1')
						{
							$userType='Registered User';
						}else if($value->transaction_user_type=='2')
						{
							$userType='Guest User';
						}
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 5%"><?php echo $userType; ?></td>
                            <td style="width: 10%"><?php if(!empty($value->user_name)){  echo $value->user_name; } else{
                            	echo $value->user_contact_no;
                            	} ?></td>
                            <td style="width: 20%"><?php if(!empty($value->user_email)){ echo $value->user_email; }else{
                            	echo $value->user_contact_no;
                            	}  ?></td>
                            <td  style="width: 10%"><?php echo $trans_type ?></td>
                        	 <td style="width: 20%"><?php echo $value->transaction_id." / ".$value->trans_ref_no;?></td>
                            <td>₦<?php echo $value->wt_amount; ?></td>
                            <td style="width: 15%"><?php echo $value->wt_datetime;?></td>
                            <td style="width: 10%" <?php if($value->wt_status=='2'){?> style="color: red" <?php } ?>><?php if($value->wt_status=='1'){echo "Success";}else if($value->wt_status=='3'){echo "Failed".' '.$ref_sttaus;}else if($value->wt_status=='2'){echo "Pending";}?></td>
                            
                            <td style="width: 10%">
                              <a  href="<?php echo site_url('admin/view_perticuler_transaction') . '/'. $value->wt_id. '/'. $value->wt_user_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">View</a>
                            <?php if($value->wt_category=='2' && $redund_status!=1 && $value->wt_status=='2'){ ?>
                               <a  onclick="if(!confirm('Are you sure, You want Refund this user?')){return false;}else{ fund_transfer(<?php echo $value->wt_user_id; ?>,<?php echo $value->wt_id; ?>)}" class="btn btn-blue btn-sm btn-icon icon-left">Refund</a>
                               <?php }?>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
       </div>

    </div>

</div>
<script>
	function fund_transfer(user_id,wt_id)
	{
		var user_id=user_id;
		var wallet_id=wt_id;
		  $.ajax({
                    url: "<?php echo site_url('admin/refund')?>",
                    type: "POST",
                    data: {
                        'user_id': user_id,
                        'wallet_id': wallet_id

                    },
                    success: function (data) {
                     if(data=='1'){
                       	location.reload();
                       }else if(data=='2'){
                       	alert("error in refund amount, please try after sometime");
                       }

                        // $('#search_brand').val('');
                    }

                });
	}
</script>
<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/multiselect/css/multi-select.css">

<!-- Bottom Scripts -->

<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>


<!-- Imported scripts on this page -->
<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/js/multiselect/js/jquery.multi-select.js"></script>
<script>

function transaction_filter()
    {
	//$admin_id='<?php echo $adminid=$this->uri->segment(3); ?>';
        $date = $("#selected_date").val();
      
	$operator_id = $("#operator_id").val();
	$recharge_type = $("#recharge_type").val();
	$recharge_status = $("#recharge_status").val();
	$transaction_type = $("#transaction_type").val();
	$user_type=$("#user_type").val();
        
         if($date !='' || $operator_id !='' || $recharge_type !='' || $recharge_status !='' || $transaction_type !=''|| $user_type !='')
         {
            
              $.post("<?php echo site_url(); ?>/admin/ajax_transaction_filter",{"date":$date,"operator_id":$operator_id,"recharge_type":$recharge_type,"recharge_status":$recharge_status,"transaction_type":$transaction_type,"user_type":$user_type},
            function(data){
     				$("#ajax_transaction_list").html(data);
		
            });
            
        }
        else
        {
             alert("Please select at least one");
        }
    }

</script>