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
            Invoice List
        </div>
        <div class="panel-options">
            <a href="<?php echo base_url('Add-Invoice'); ?>" class="btn blue-theme-btn" style="color: #fff;">
               <i class="fa-plus-circle"> </i> Add Invoice
            </a> 
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
                    <th>Customer No</th>
                    <th>Invoice No</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Contact No</th>
					<th>Bill amount(&#8358;)</th>	
					<th>Due Date </th>	
					<th>Invoice Date</th>
					<th>Bill Status</th>	
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($consumer_details)) {
       
                    $n = 1;
                    foreach ($consumer_details as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 12%"><?php echo $value->biller_customer_id_no; ?></td>
                             <td style="width: 12%"><?php echo $value->bill_invoice_no; ?></td>
                            <td style="width: 10%"><?php echo $value->biller_user_name; ?></td>
                            <td style="width: 19%"><?php echo $value->bill_product_name; ?></td>
                            <td  style="width: 13%"><?php echo $value->biller_user_contact_no; ?></td>
                             <td  style="width: 10%"><?php echo $value->bill_amount ; ?></td>
                               <td  style="width: 15%"><?php echo $value->bill_due_date ; ?></td>
                            <td  style="width: 15%"><?php echo $value->bill_invoice_date; ?></td>
                             <td  style="width: 15%"><?php  if($value->bill_pay_status=='1'){echo "Paid";}else{
                             	echo "Pending";
                             }; ?></td>
                      	   
                            
                            <td style="width: 40%">
                            <!-- <a href="<?php echo site_url('biller/edit_bill_user') . '/' . $value->biller_user_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a> -->
                               
                           <!-- <a href="<?php echo site_url('admin/view_biller_details') . '/biller_id/' . $value->biller_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">View</a> -->
                                <!-- <?php $status = $value->bill_user_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/biller_user_id/' . $value->biller_user_id; ?>/biller_user/bill_user_status/2/consumer_list" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/biller_user_id/' . $value->biller_user_id; ?>/biller_user/bill_user_status/1/consumer_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?> -->
                                <?php if($value->bill_pay_status=='1'){ ?>
                                     <!--    <a style="cursor: pointer" class="btn btn-blue btn-sm btn-icon icon-lef" href="<?php echo invoice."/".$value->bill_paid_invoice ?>">Invoice</a>&nbsp; -->
                                         <a style="cursor: pointer" class="btn btn-blue btn-sm btn-icon icon-lef" href="<?php echo bill_invoice."/".$value->bill_invoice ?>">Invoice</a>&nbsp;

                                <?php }else{ ?>
                                          <a style="cursor: pointer" class="btn btn-blue btn-sm btn-icon icon-lef" href="<?php echo bill_invoice."/".$value->bill_invoice ?>">Invoice</a>&nbsp;

                                <?php } ?>
                             
                                <a onClick="if(!confirm('Are you sure, You want delete this Biller?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_bill_user/biller_user/biller_user_id/' . $value->biller_user_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
</div>
    </div>

</div>
