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
            Plan List
        </div>
         <div class="panel-options">
            <a href="<?php echo site_url('admin/add_recharge_plan'); ?>" class="btn blue-theme-btn" style="color: #fff;">
                <i class="fa fa-plus-circle"></i>
                Add Plan
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
                    <th>Service Id</th>
                    <th>Plan Name</th>
                    
                    <th>Amount</th>
					<th>Plan Code</th>
                    <th>Validity</th>
                    <th>Description</th>
                    <!--<th>Activation Code</th>-->
                    <th width="150"  style="max-width:150px;">Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($dstv_plan)) {
       
                    $n = 1;
                    foreach ($dstv_plan as $value) {
                    	
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                            <td style="width: 8%"><?php echo $value->service_id; ?></td>
                            <td style="width: 10%"><?php echo $value->tv_plans_name; ?></td>
                            <td style="width: 10%"><?php echo $value->tv_plans_price; ?></td>
                            <td style="width: 6%"><?php echo $value->tv_plans_code; ?></td>
                            <td  style="width: 6%"><?php echo $value->plan_validity."Month"; ?></td>
                      		<td style="width: 10%"><?php echo $value->description;?></td>
                           
                           <!-- <td style="width: 12%"><?php echo $value->recharge_activation_code;?></td>-->
                            <td width="100" style="max-width:100px;">
                              <a href="<?php echo site_url('admin/edit_dstv_plan') . '/' . $value->tv_plans_id; ?>" 
                              class="btn btn-blue btn-sm btn-icon icon-left">Edit</a>
                              
                                    &nbsp;
                          <?php $status = $value->tv_plans_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/tv_plans_id/' . $value->tv_plans_id; ?>/offer_coupon/coupon_status/2/coupon_list" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/tv_plans_id/' . $value->tv_plans_id; ?>/offer_coupon/coupon_status/1/coupon_list" class="btn btn-warning btn-sm btn-icon icon-left">Failed</a>
                                <?php } ?>
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this coupon?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_coupon/offer_coupon/tv_plans_id/' . $value->tv_plans_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left delete-btn">Delete</a>
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