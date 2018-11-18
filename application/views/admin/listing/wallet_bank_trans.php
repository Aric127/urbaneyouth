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
            Wallet To Bank Transactions List
        </div>
        <div class="panel-options">
     
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
<div class="table-responsive" style="border:none;">
        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Account Number</th>
                    <th>Bank Code</th>
					<th>Amount</th>	
					<th>Date </th>	
					<th>Transaction ID / Ref</th>	
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($wallet_transactions)) {
    $n = 1;
	
                    foreach ($wallet_transactions as $value) { ?>
            
                    <tr>
                        <td style="width: 2%"><?php echo $n; ?></td>
                        <td style="width: 15%"><?php echo $value->user_name; ?></td>
                        <td style="width: 15%"><?php echo $value->wallet_bank_trans_account_no; ?></td>
                        <td style="width: 13%"><?php echo $value->wallet_bank_trans_bankcode; ?></td>
                        <td style="width: 15%"><?php echo $value->wallet_bank_trans_amount ; ?></td>
                        <td style="width: 15%"><?php echo $value->wallet_bank_trans_date; ?></td>
                      	<td style="width: 15%"><?php echo $value->wallet_bank_trans_id ;?></td>
                        <td style="width: 15%"><?php echo $value->wallet_bank_trans_ref; ?></td>  
                        <td style="width: 15%"><?php echo $value->wallet_bank_trans_msg; ?></td>  
                        <td style="width: 15%"><?php echo $value->wallet_bank_trans_status; ?></td>  
                  </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
</div>
    </div>

</div>
