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
            <a href="<?php echo site_url('admin/add_scratch_card'); ?>" class="btn blue-theme-btn" style="color: #fff;">
            <i class="fa fa-plus-circle"></i>
                Add Card
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
                    <th>Skretch Card</th>
                    <th>Create Date</th>
                    <th>Validity</th>
                    <th>Amount</th>
					<th>Remaining User</th>
                   
                    <!--<th>Activation Code</th>-->
                    <th width="150"  style="max-width:150px;">Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($skretch_card)) {
       
                    $n = 1;
                    foreach ($skretch_card as $value) {
                    	
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                            <td style="width: 15%"><?php echo $value->skretch_card_code; ?></td>
                            <td style="width: 10%"><?php echo $value->skretch_card_date; ?></td>
                            <td style="width: 10%"><?php echo $value->skretch_card_validity; ?></td>
                            <td style="width: 6%"><?php echo $value->skretch_card_amount; ?></td>
                            <td  style="width: 6%"><?php echo $value->skretch_card_user; ?></td>
                      		
                           <!-- <td style="width: 12%"><?php echo $value->recharge_activation_code;?></td>-->
                            <td width="100" style="max-width:100px;">
                              <a href="<?php echo site_url('admin/edit_scratch_card') . '/' . $value->skretch_card_id; ?>" 
                              class="btn btn-blue btn-sm btn-icon icon-left">Edit</a>
                              
                                    &nbsp;
                          <?php $status = $value->	skretch_card_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/skretch_card_id/' . $value->skretch_card_id; ?>/skretch_card/skretch_card_status/2/skretch_card" class="btn btn-secondary btn-sm btn-icon icon-left active-btn">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/skretch_card_id/' . $value->skretch_card_id; ?>/skretch_card/skretch_card_status/1/skretch_card" class="btn btn-warning btn-sm btn-icon icon-left">Inactive</a>
                                <?php } ?>
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this coupon?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_skretch_coupon/skretch_card/skretch_card_id/' . $value->skretch_card_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left delete-btn">Delete</a>
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