

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
<?php } $today=date('Y-m-d H:i:s');?>
<style type="text/css">
 span.bold-red {
    color: red;
    font-weight: bold;
}
 span.bold-green {
    color: green;
    font-weight: bold;
}
 span.bold-yellow {
    color: orange;
    font-weight: bold;
}

</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Guest User List</h3>

      
    </div>
     <div class="row panel-body">
       
        </div>
    <div class="panel-body">

        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-4").dataTable({
                    
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
        <table class="table table-small-font table-bordered table-striped" id="example-4">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Transactions </th>
                    <th>Transaction ID</th>
                    <th>Payment Type</th>
                    <th>Trans Amount</th>
					<th>Trans Datetime</th>
					<th>Trans Status</th>
                    <th>Guest IP</th>
                    
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($guest_user)) {
       
                    $n = 1;
                    foreach ($guest_user as $value) {
                    
                        ?>
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                            <td style="width: 15%"><?php echo $value->guest_user_email; ?></td>
                            <td style="width: 15%"><?php echo $value->guest_user_mobile; ?></td>
                            <td style="width: 15%"><?php echo $value->guest_user_trans_desc; ?></td>
                            <td style="width: 15%"><?php echo $value->guest_user_transaction_id; ?></td>
                            <td style="width: 15%"><?php if($value->payment_type=='1'){ echo "Via Card"; }else if($value->payment_type=='2'){  echo "Via Bank"; } ?></td>
                            <td style="width: 15%"><?php echo $value->guest_user_trans_amount; ?></td>
                            <td style="width: 15%"><?php echo $value->guest_user_trans_datetime; ?></td>
                             <td style="width: 15%"><?php if($value->guest_user_trans_status=='1'){ echo "Success"; }else if($value->guest_user_trans_status=='2'){ echo "Pending"; }else if($value->guest_user_trans_status =='3') { echo "Failed"; } ?></td>
                            <td style="width: 15%"><?php echo $value->guest_user_ip; ?></td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
</div>
    </div>
</div>
