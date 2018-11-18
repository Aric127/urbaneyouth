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
            Biller Sattlement Transactions List
        </div>
        <div class="panel-options">
         <div class="panel-options">
          <a href="<?php echo site_url('admin/biller_sattlement'); ?>" class="btn blue-theme-btn" style="color: #fff;">
          <i class="fa fa-plus-circle"></i>
                Add Biller Sattlment
          </a> 
        </div>
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

        <table id="example-1" class="table table-striped table-small-font table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Biller Name</th>
                    <th>Biller Email</th>
                    <th>Amount</th>
                    <th>Trans Ref</th>
                    <th>Date</th>
                    
                    <th>A/C Number</th>
                    <th>Bank Name</th>
                    <th>A/C Holder Name</th>
                   
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($sattlement_list)) {
      
                    $n = 1;
                    foreach ($sattlement_list as $value) { ?>
            
                        <tr>
                            <td style="width: 8%"><?php echo $n; ?></td>
                            <td style="width: 10%"><?php echo $value->biller_name; ?></td>
                            <td style="width: 10%"><?php echo $value->biller_email	; ?></td>
                            <td style="width: 8%"><?php echo $value->settlement_amount; ?></td>
                            <td style="width: 10%"><?php echo $value->transaction_ref ; ?></td>
                          	<td style="width: 10%"><?php echo $value->sattlement_date ; ?></td>
                            <td style="width: 10%"><?php echo $value->bank_account_no ; ?></td>
                            <td style="width: 20%"><?php echo $value->bank_name ; ?></td>
                            <td style="width: 20%"><?php echo $value->account_holder_name ; ?></td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
