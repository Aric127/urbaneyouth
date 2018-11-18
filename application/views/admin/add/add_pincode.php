<?php if($this->session->flashdata('error')){ ?>
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
<?php if($this->session->flashdata('success')){ ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>
    </div>
</div>
<?php } ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
             <?php if(!empty($pincode_details)){ ?>Edit Pin-code<?php } else { ?>Add Pin-code<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($pincode_details)){ ?>action="<?php echo site_url('admin/edit_pincode'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_pincode'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Pin Code</label>
                <input type="text" name="pincode" <?php if(!empty($pincode_details)){ ?>value="<?php echo $pincode_details[0]->pincode; } ?>" class="form-control" data-validate="required" placeholder="Pin-Code" />
            </div>
         <div class="form-group">
                <label class="control-label">City</label>
                <input type="text" name="city" <?php if(!empty($pincode_details)){ ?>value="<?php echo $pincode_details[0]->city; } ?>" class="form-control" data-validate="required" placeholder="City" />
            </div>
            <div class="form-group">
                <?php if(!empty($pincode_details)){ ?>
                    <input type="hidden" name="pincode_id" value="<?php echo $pincode_details[0]->pincode_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
