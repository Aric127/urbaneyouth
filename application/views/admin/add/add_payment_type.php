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
             <?php if(!empty($payment_type_details)){ ?>Edit Payment Type<?php } else { ?>Add Category<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($payment_type_details)){ ?>action="<?php echo site_url('admin/edit_payment_type'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_payment_type'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Payment Type Name</label>
                <input type="text" name="payment_type_name" <?php if(!empty($payment_type_details)){ ?>value="<?php echo $payment_type_details[0]->payment_type_name; } ?>" class="form-control" data-validate="required" placeholder="Payment Type Name" />
            </div>
        
            <div class="form-group">
                <?php if(!empty($payment_type_details)){ ?>
                    <input type="hidden" name="payment_type_id" value="<?php echo $payment_type_details[0]->payment_type_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
