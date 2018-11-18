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
            Consumer List
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
<div class="table-responsive">
        <table id="example-1" class="table-small-font table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Customer Name</th>
                    <th>Customer No</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Last Invoice Date</th>
					
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($biller_consumer)) {
       
                    $n = 1;
                    foreach ($biller_consumer as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 12%"><?php echo $value->biller_user_name; ?></td>
                             <td style="width: 12%"><?php echo $value->biller_customer_id_no; ?></td>
                            <td style="width: 10%"><?php echo $value->biller_user_email; ?></td>
                            <td style="width: 19%"><?php echo $value->biller_user_contact_no; ?></td>
                            <td  style="width: 13%"><?php echo $value->bill_invoice_date; ?></td>
                            
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
</div>
    </div>

</div>
