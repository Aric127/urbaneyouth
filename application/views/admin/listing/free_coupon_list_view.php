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
            <a href="<?php echo site_url('admin/add_free_coupon'); ?>" class="btn btn-turquoise fa-plus-circle" style="color: #fff;">
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

        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Category</th>
                    <th>Coupon</th>
                    <th>Coupon Code</th>
                    <th>Coupon Amount</th>
					<th>Coupon Image</th>
        			<th>Expiry date</th>
                    <th width="200">Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($free_coupon_list)) {
       
                    $n = 1;
                    foreach ($free_coupon_list as $value) {
                    	
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                              <td style="width: 10%"><?php echo $value->free_coupon_category_name ; ?></td>
                            <td style="width: 12%"><?php echo $value->coupon_name; ?></td>
                            <td style="width: 12%"><?php echo $value->coupon_code; ?></td>
                            <td  style="width: 12%"><?php if($value->coupon_type=='2'){ echo $value->coupon_amount; }else if($value->coupon_type=='1'){ echo "Free"; } ?></td>
                      		
                           <td style="width: 15%"><img src="<?php echo coupon_logo.'/'.$value->coupon_img; ?>" height="90" width="90"></td>
                            <td style="width: 12%"><?php echo $value->coupon_expiry_date;?></td>
                            <td width="200">
                              <a href="<?php echo site_url('admin/edit_free_coupon') . '/' . $value->free_coupon_id; ?>"
                              	 class="btn btn-blue btn-sm btn-icon icon-left">Edit</a>
                                    &nbsp;
                          <?php $status = $value->coupon_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/free_coupon_id/' . $value->free_coupon_id; ?>/free_coupon_list/coupon_status/2/free_coupon_list" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/free_coupon_id/' . $value->free_coupon_id; ?>/free_coupon_list/coupon_status/1/free_coupon_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?>
                               
                                <a style="margin-top:5px;" onClick="if(!confirm('Are you sure, You want delete this coupon?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_free_coupon/offer_coupon/free_coupon_id/' . $value->free_coupon_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left delete-btn">Delete</a>
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