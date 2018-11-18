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
            <a href="<?php echo site_url('admin/add_free_coupon_category'); ?>" class="btn blue-theme-btn" style="color: #fff;">
            <i class="fa fa-plus-circle"></i>
                Add Coupons Category
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
                    <th>Coupon Category</th>
                    <th>Created Date</th>
                    <th style="width:200px  !important;">Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($free_coupon_category)) {
       
                    $n = 1;
                    foreach ($free_coupon_category as $value) {
                    	
                        ?>
                        <tr>
                            <td style="width: 15%"><?php echo $n; ?></td>
                            <td style="width: 22%"><?php echo $value->free_coupon_category_name; ?></td>
                            <td style="width: 22%"><?php echo $value->free_coupon_category_create; ?></td>
                      
                            <td style="width:200px  !important;">
                              <a href="<?php echo site_url('admin/edit_free_coupon_category') . '/' . $value->free_coupon_category_id; ?>" class="btn btn-blue btn-sm btn-icon icon-left">Edit</a>
                                    &nbsp;
                          <?php $status = $value->free_coupon_category_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/free_coupon_category_id/' . $value->free_coupon_category_id; ?>/free_coupon_category/free_coupon_category_status/2/free_coupon_category" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/free_coupon_category_id/' . $value->free_coupon_category_id; ?>/free_coupon_category/free_coupon_category_status/1/free_coupon_category" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?>
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this coupon category?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_free_coupon_category/free_coupon_category/free_coupon_category_id/' . $value->free_coupon_category_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
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