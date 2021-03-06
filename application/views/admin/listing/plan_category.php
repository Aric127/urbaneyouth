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
            Plan Category
        </div>
      <div class="panel-options">
            <a href="<?php echo site_url('admin/add_plan_category'); ?>" class="btn blue-theme-btn" style="color: #fff;">
            <i class="fa fa-plus-circle"></i>
                Add Plan Category
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
                     <th>Recharge Type</th>
                    <th>Plan Category</th>
                    <th>Action</th>
                </tr>
            </thead>
			<tbody>
				<?php
                  if (!empty($plan_category)) {
                    $n = 1;
                    foreach ($plan_category as $value) {
                        ?>
                        <tr>
                            <td style="width: 10%"><?php echo $n; ?></td>
                              <td><?php echo $value->category_name; ?></td>
                            <td><?php echo $value->plan_category_name; ?></td>
                          
                          	<td style="width: 25%">
                               
                                <?php $status = $value->plan_category_status; ?>
                            
                         <a href="<?php echo site_url('admin/edit_plan_category').'/'.$value->plan_category_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef">Edit</a>
                                                       &nbsp;
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/plan_category_id/' . $value->plan_category_id; ?>/plan_category/plan_category_status/2/plan_category" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/plan_category_id/' . $value->plan_category_id; ?>/plan_category/plan_category_status/1/plan_category" class="btn btn-warning btn-sm btn-icon icon-left">Inactive</a>
                                <?php } ?>
                              <!--   <a onClick="if(!confirm('Are you sure, You want delete this recharge type?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_recharge_type/recharge_type/plan_category_id/' . $value->plan_category_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a> -->
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>