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
            User List
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
                    <th>Transaction Type</th> <!-- Add Money, 2-Recharge,3-Fund transfer-->
                    <th>Wallet Transaction</th><!-- Credit, 2-Debit-->
                    <th>Transaction Number</th><!--Add money then payment gatewat transaction id, Recharge then recharge id   -->
                    <th>Recharge Category</th>
					<th>Recharge Number</th>
                    <th>Recharge Amount</th>
                  	<th>Recharge date</th>
                  	<th>Recharge status</th>
                   
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($transaction_records)) {
                //	print_r($recharge_records);
       $i=0;
                    $n = 1;
                    foreach ($transaction_records as $value) {
                    	
                        ?>
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                            <td style="width: 15%"><?php  if($value->wt_category=='1'){echo "Add Money";}else if($value->wt_category=='2'){ echo "Recharge";} ?></td>
                            <td><?php echo $value->wt_type; ?></td>
                            <td><?php echo $value->transaction_id; ?></td>
                     		 <td><?php echo $recharge_records[$i]->rechage_category;  ?></td>
                           <td><?php  echo $recharge_records[$i]->recharge_number; ?></td>
                            <td><?php echo $value->wt_amount;?></td>
                            <td><?php echo $value->wt_datetime;?></td>
                           <td><?php  echo $recharge_records[$i]-> recharge_status; ?></td>
                            
                          
                        </tr>
                <?php $n = $n + 1;
				$i++;
				 } } ?>
            </tbody>
        </table>

    </div>

</div>
<script>
	function check_address()
	{
		alert("No address added by user");
	}
</script>