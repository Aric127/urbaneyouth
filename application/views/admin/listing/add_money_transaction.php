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
        <div class="panel-title">Email:
            <?php 
             echo $user_name=$user_record[0]->user_email; ?>
      </br>
            <?php 
              $user_contact_no=$user_record[0]->user_contact_no;
              if(!empty($user_contact_no)){ ?>Mobile:
              <?php	echo $user_contact_no;
              } ?>
    </br></br>Transaction Records
        </div>
    </div>

    <div id="user_list" class="panel-body">
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
        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Transation Type</th>
                    <th>Transation Number</th>
                    <th>Payment Type</th>
                    <th>Payment ID</th>
                    <th>Transaction Amount</th>
                    <th>Recharge Category</th>
                   	<th>Recharge number</th>
					<th>Transaction Date</th>
                    <th>Transaction Status</th>
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php  if (!empty($transaction_record)) {

                    $n = 1;
                    foreach ($transaction_record as $value) {
                    	$payment_type=$value->payment_type;
                    	if($payment_type=='0')
						{
							$p_type='Wallet';
						}else if($payment_type=='1')
						{
							$p_type='MoneyWave';
						}else if($payment_type=='2')
						{
							$p_type='WebPay';
						}
                    	$redund_status=$value->refund_status;
						if($redund_status=='1'){
							
							$ref_sttaus="Refund";
						}else if($redund_status=='2' || $redund_status=='0'){
							
							$ref_sttaus='';
						}
                        ?>
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                              <td ><?php  if($value->wt_category=='1'){echo "Add Money";}else if($value->wt_category=='2'){echo "Recharge";}elseif($value->wt_category=='3'){ echo "Refund Money";}elseif($value->wt_category=='4'){ echo "Cashback";}elseif($value->wt_category=='5'){ echo "Transfer Money";}elseif($value->wt_category=='6'){ echo "Recieved Money";}elseif($value->wt_category=='7'){ echo "Add SMS";}elseif($value->wt_category=='8'){ echo "Share Sms";}elseif($value->wt_category=='15'){ echo "Scretch Card";} ?></td>
                            <td><?php echo $value->transaction_id; ?></td>
                            <td><?php echo $p_type; ?></td>
                             <td><?php echo $value->payment_gateway_id; ?></td>
                            <td><?php echo $value->wt_amount; ?></td>
                            	<td><?php  if($value->rechage_category=='1'){echo "Mobile";}else if($value->rechage_category=='2'){ echo "DTH";}else if($value->rechage_category=='3'){ echo "TV";}
                            		
                            	;?></td>
                         	<td><?php echo $value->recharge_number;?></td>
                      		<td><?php echo $value->wt_datetime;?></td>
                            <td <?php if($value->wt_status=='3'){?> style="color: red" <?php }else{?> style="color: green" <?php } ?>><?php if($status = $value->wt_status=='1'){ echo "Success"; }else if($status = $value->wt_status=='3'){ echo "Failed".' '.$ref_sttaus; }?></td>
                           
                            <td style="width: 25%">
                            	  <a  href="<?php echo site_url('admin/user_perticuler_transaction') . '/'. $value->wt_id. '/'. $value->wt_user_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">View</a>
         <?php if($value->wt_category=='2' && $redund_status!=1 && $value->wt_status=='2'){ ?>
                               <a  onclick="if(!confirm('Are you sure, You want Refund this user?')){return false;}else{ fund_transfer(<?php echo $value->wt_user_id; ?>,<?php echo $value->wt_id;  ?>)}" class="btn btn-blue btn-sm btn-icon icon-left">Refund</a>
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