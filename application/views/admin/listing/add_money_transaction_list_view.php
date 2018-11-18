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

    <div id="user_list" class="panel-body">
        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-1").dataTable({
                    aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                    ]
                });
            });
        </script>

        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Transaction Type</th>
					<th>Transaction ID</th>
                    <!--<th>Login type</th>-->
                    <th>Transaction Date date</th>
                    <th>Transaction Status</th>
                   
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($wallet_transaction)) {
       
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
						}
						$redund_status=$value->refund_status;
						if($redund_status=='1'){
							
							$ref_sttaus="Refund";
						}else if($redund_status=='2'){
							
							$ref_sttaus='';
						}
                        ?>
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                            <td style="width: 20%"><?php echo $value->user_name; ?></td>
                            <td><?php echo $value->user_email; ?></td>
                            <td  style="width: 2%"><?php echo $trans_type ?></td>
                        	 <td><?php echo $value->transaction_id;?></td>
                            <!--<td><?php echo $login_type; ?></td>-->
                            <td><?php echo $value->wt_datetime;?></td>
                            <td <?php if($value->wt_status=='2'){?> style="color: red" <?php } ?>><?php if($value->wt_status=='1'){echo "Success";}else if($value->wt_status=='2'){echo "Failed".' '.$ref_sttaus;}else if($value->wt_status=='3'){echo "Pending";}?></td>
                            
                            <td style="width: 45%">
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