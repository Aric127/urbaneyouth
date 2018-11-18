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
            Coupons List
        </div>
         <div class="panel-options">
            <a href="<?php echo site_url('admin/add_coupon'); ?>" class="btn blue-theme-btn" style="color: #fff;">
            <i class="fa fa-plus-circle"></i>
                Add Coupons
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

        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Coupon Name</th>
                    <th>Coupon Code</th>
                    <th>Coupon Type</th>
					<th>Coupon Min Price</th>
                    <th>Coupon off (Rs)</th>
                    <th>Limit</th>
                    <!--<th>Coupon Create date</th>-->
                   <th>Coupon Expiry date</th>
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($coupon_list)) {
       
                    $n = 1;
                    foreach ($coupon_list as $value) {
                    	
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                            <td style="width: 10%"><?php echo $value->coupon_name; ?></td>
                            <td style="width: 10%"><?php echo $value->coupon_code; ?></td>
                            <td style="width: 12%"><?php if($value->coupon_type=='1'){ echo "Cashback";}else if($value->coupon_type=='2'){echo "Flat off";}; ?></td>
                            <td  style="width: 10%"><?php echo $value->coupon_minimum_price; ?></td>
                      		<td style="width: 10%"><?php echo $value->coupon_price;?></td>
                            <td style="width: 10%"><?php if($value->coupon_limit!='0'){echo $value->coupon_limit .' '.'Users';}else{ echo "Unlimited User";}?></td>
                            <!--<td><?php echo $value->coupon_create_date;?></td>-->
                            <td style="width: 12%"><?php echo $value->coupon_expire_date;?></td>
                            <td style="width: 75%">
                              <a href="<?php echo site_url('admin/edit_coupon') . '/' . $value->coupon_id; ?>" class="btn btn-blue btn-sm btn-icon icon-left">Edit</a>
                                    &nbsp;
                          <?php $status = $value->coupon_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/coupon_id/' . $value->coupon_id; ?>/offer_coupon/coupon_status/2/coupon_list" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/coupon_id/' . $value->coupon_id; ?>/offer_coupon/coupon_status/1/coupon_list" class="btn btn-warning btn-sm btn-icon icon-left">Failed</a>
                                <?php } ?>
                               
                                <a style="margin-top:5px; margin-left:0px;" onClick="if(!confirm('Are you sure, You want delete this coupon?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_coupon/offer_coupon/coupon_id/' . $value->coupon_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left delete-btn">Delete</a>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
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