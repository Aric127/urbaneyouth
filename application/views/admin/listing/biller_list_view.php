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
       <a href="<?php echo site_url('admin/add_biller'); ?>" class="btn blue-theme-btn" 
       style="color: #fff;">
                <i class="fa fa-plus-circle"> </i>
                Add Biller
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
<div class="table-responsive" style="border:none;">
        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
					<th>Biller Type</th>	
					<th>Company </th>	
					<th>Icon</th>	
                    <th style="min-width:220px;">Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($biller_details)) {
    $n = 1;
	
                    foreach ($biller_details as $value) { ?>
            
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                            <td style="width: 15%"><?php echo $value->biller_name; ?></td>
                            <td style="width: 15%"><?php echo $value->biller_email; ?></td>
                            <td  style="width: 13%"><?php echo $value->biller_contact_no; ?></td>
                             <td  style="width: 15%"><?php echo $value->category_name ; ?></td>
                            <td  style="width: 15%"><?php echo $value->biller_company_name; ?></td>
                      	   
                             <td><img src="<?php echo biller_company_logo.'/'.$value->biller_company_logo; ?>" height="90" width="90"></td>
                            <td style="min-width:220px;">
                      
                                   	<?php if($value->biller_reg_type=='1'){?>
                            <a href="<?php echo site_url('admin/edit_biller') . '/' . $value->biller_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a>
                               <a href="<?php echo site_url('admin/view_biller_details') . '/biller_id/' . $value->biller_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;View&nbsp;</a>
                           <!-- <a href="<?php echo site_url('admin/view_biller_details') . '/biller_id/' . $value->biller_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">View</a> -->
                                <?php $status = $value->biller_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/biller_id/' . $value->biller_id; ?>/biller_details/biller_status/2/biller_list" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/biller_id/' . $value->biller_id; ?>/biller_details/biller_status/1/biller_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?>
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this Biller?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_biller/biller_details/biller_id/' . $value->biller_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left delete-btn">Delete</a>
                                <?php }else{ 
                                	if($value->biller_status=='2'){
                                	?>
                                	 <!--<a href="<?php echo site_url('admin/edit_biller') . '/' . $value->biller_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a>-->
                                	<a href="<?php echo site_url('admin/change_biller_status') . '/biller_id/' . $value->biller_id; ?>/1" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Approve&nbsp;</a>
                                	<a href="<?php echo site_url('admin/change_biller_status') . '/biller_id/' . $value->biller_id; ?>/2" class="btn btn-red btn-sm btn-icon icon-left">&nbsp;Reject&nbsp;</a>
                                	<a href="<?php echo site_url('admin/view_biller_details') . '/biller_id/' . $value->biller_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;View&nbsp;</a>
                                	<?php }else if($value->biller_status=='1'){
                                 $status = $value->biller_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/biller_id/' . $value->biller_id; ?>/biller_details/biller_status/2/biller_list" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/biller_id/' . $value->biller_id; ?>/biller_details/biller_status/1/biller_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                
                                <?php } ?>
										<a onClick="if(!confirm('Are you sure, You want delete this Biller?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_biller/biller_details/biller_id/' . $value->biller_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
										<a href="<?php echo site_url('admin/view_biller_details') . '/biller_id/' . $value->biller_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;View&nbsp;</a>
                                <?php	}
                                elseif($value->biller_status=='3'){?>  
                                	<a href="#" class="btn btn-red btn-sm btn-icon icon-left">&nbsp;Rejected&nbsp;</a>
                                	<a href="<?php echo site_url('admin/view_biller_details') . '/biller_id/' . $value->biller_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;View&nbsp;</a>
                                	 <?php }} ?>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
</div>
    </div>

</div>
<script>
	function check_address()
	{
		alert("No address added by user");
	}
</script>