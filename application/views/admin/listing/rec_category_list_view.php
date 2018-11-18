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
            Category List
        </div>
      <div class="panel-options">
            <a href="<?php echo site_url('admin/add_recharge_category'); ?>" class="btn blue-theme-btn" style="color: #fff;">
            <i class="fa fa-plus-circle"></i>
                Add Category
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
                    <th>Category name</th>
      				<th>Action</th>
                </tr>
            </thead>
			<tbody>
				<?php
                               
                  // $category_path = category_image.'/';?> 	
                <?php if (!empty($category_list)) {
                    $n = 1;
                    foreach ($category_list as $value) {
                        ?>
                        <tr>
                            <td style="width: 10%"><?php echo $n; ?></td>
                            <td><?php echo $value->category_name; ?></td>
                          
                            <td style="width: 25%">
                               
                                <?php $status = $value->category_status; ?>
                            
                        <a href="<?php echo site_url('admin/edit_recharge_category').'/'.$value->recharge_category_id; ?>" class="btn btn-blue btn-sm btn-icon icon-left">Edit</a>
                                                       &nbsp;
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/recharge_category_id/' . $value->recharge_category_id; ?>/recharge_category/category_status/2/recharge_category_list" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/recharge_category_id/' . $value->recharge_category_id; ?>/recharge_category/category_status/1/recharge_category_list" class="btn btn-warning btn-sm btn-icon icon-left">Inactive</a>
                                <?php } ?>
                             <!--    <a onClick="if(!confirm('Are you sure, You want delete this category?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_category/recharge_category/recharge_category_id/' . $value->recharge_category_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a> -->
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>