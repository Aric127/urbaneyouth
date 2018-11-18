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
            Biller List
        </div>
        <div class="panel-options">
            <a href="<?php echo site_url('admin/add_biller_category'); ?>" class="btn blue-theme-btn btn-sm" style="color: #fff;">
                <i class="fa fa-plus-circle"></i>
                Add Biller Category
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
                    <th>Category Name</th>
                    <th>Category Logo</th>
                    <th>Type</th>
                   	<th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($biller_category)) {
       
                    $n = 1;
                    foreach ($biller_category as $value) { ?>
            
                        <tr>
                            <td style="width: 10%"><?php echo $n; ?></td>
                            <td style="width: 25%"><?php echo $value->biller_category_name; ?></td>
                           <td><img src="<?php echo base_url('uploads/biller_category_logo').'/'.$value->biller_category_logo; ?>" height="90" width="90"></td>
                            <td style="width: 25%"><?php  if($value->category=='1'){ echo "Biller";}else  if($value->category=='2'){ echo "Church";}else  if($value->category=='3'){ echo "Event";}; ?></td>
                            <td style="width: 25%">
                           
                           
                                <?php $status = $value->biller_category_status; ?>
                                  <a href="<?php echo site_url('admin/edit_biller_category') . '/' . $value->biller_category_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/biller_category_id/' . $value->biller_category_id; ?>/biller_category/biller_category_status/2/biller_category" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                               <a href="<?php echo site_url('admin/change_status') . '/biller_category_id/' . $value->biller_category_id; ?>/biller_category/biller_category_status/1/biller_category" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?>
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this Biller category?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_biller_category/biller_category/biller_category_id/' . $value->biller_category_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
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