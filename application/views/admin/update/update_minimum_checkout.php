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
             <?php if(!empty($minimum_checkout_details)){ ?>Edit Minimum Checkout<?php } else { ?>Add Minimum Checkout<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($minimum_checkout_details)){ ?>action="<?php echo site_url('admin/edit_minimum_checkout'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_ideal_for'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Minimum Checkout Cost</label>
                <input type="text" name="minimum_checkout_cost" <?php if(!empty($minimum_checkout_details)){ ?>value="<?php echo $minimum_checkout_details[0]->minimum_checkout_cost; } ?>" class="form-control" data-validate="required" placeholder="Minimum Checkout Cost" />
            </div>
          
          <br>
            <div class="form-group">
                <?php if(!empty($minimum_checkout_details)){ ?>
                    <input type="hidden" name="minimum_checkout_id" value="<?php echo $minimum_checkout_details[0]->minimum_checkout_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
