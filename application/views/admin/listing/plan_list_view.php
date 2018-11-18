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
  <div class="panel-body">
         <div class="clearfix transrow">
            <form action="<?php echo base_url('admin/recharge_plan_sync'); ?>" method="post">
            <div class="col-md-2">
                <label class="control-label">Select Operator</label>
                <select id="user_type" class="form-control input-dark" name="service_id" data-validate="required" >
                    <option value="">Select Operator</option>
                    <option value="AEC">9Mobile</option>
                    <option value="ACC">Airtel</option>
                    <option value="ADC">GLO</option>
                    <option value="ALC">MTN</option>
                   
                  </select>
            </div>
             <div class="col-md-2">
            <label class="control-label">&nbsp;</label>
            <div class="clearfix"></div>
            <input type="submit" id="sub" class="btn btn-success pull-left" value="Sync Plan" >
             </div>
             </form>
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
                    <th>Recharge Type</th>
                    <th>Plan Type</th>
                    <th>Operator Name</th>
                    <th>Amount(₦)</th>
					<th>Data Pack</th>
                    <th>Talk time</th>
                    <th>Validity</th>
                    <!--<th>Activation Code</th>-->
                    <th width="150"  style="max-width:150px;">Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($plan_list)) {
       
                    $n = 1;
                    foreach ($plan_list as $value) {
                    	
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                            <td style="width: 8%"><?php echo $value->category_name; ?></td>
                            <td style="width: 10%"><?php echo $value->plan_category_name; ?></td>
                            <td style="width: 10%"><?php echo $value->operator_name; ?></td>
                            <td style="width: 6%"><?php echo $value->rechage_amount; ?></td>
                            <td  style="width: 6%"><?php echo $value->recharge_data_pack; ?></td>
                      		<td style="width: 10%"><?php echo $value->recharge_talktime;?></td>
                            <td style="width: 10%"><?php echo $value->recharge_validity." "."Days";?></td>
                           <!-- <td style="width: 12%"><?php echo $value->recharge_activation_code;?></td>-->
                            <td width="150" style="max-width:150px;">
                              <a href="<?php echo site_url('admin/edit_recharge_plan') . '/' . $value->recharge_plan_id; ?>" 
                              class="btn btn-blue btn-sm btn-icon icon-left">Edit</a>
                              
                                    &nbsp;
                          <?php $status = $value->recharge_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/coupon_id/' . $value->recharge_plan_id; ?>/delete_recharge_plan/coupon_status/2/coupon_list" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/coupon_id/' . $value->recharge_plan_id; ?>/offer_coupon/coupon_status/1/coupon_list" class="btn btn-warning btn-sm btn-icon icon-left">Failed</a>
                                <?php } ?>
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this coupon?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_recharge_plan/recharge_plan/recharge_plan_id/' . $value->recharge_plan_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left delete-btn">Delete</a>
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