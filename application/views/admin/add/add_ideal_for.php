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
             <?php if(!empty($ideal_for_details)){ ?>Edit Ideal for<?php } else { ?>Add Ideal for<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($ideal_for_details)){ ?>action="<?php echo site_url('admin/edit_ideal_for'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_ideal_for'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Ideal Name</label>
                <input type="text" name="ideal_name" <?php if(!empty($ideal_for_details)){ ?>value="<?php echo $ideal_for_details[0]->ideal_name; } ?>" class="form-control" data-validate="required" placeholder="Ideal Name" />
            </div>
          
          <br>
            <div class="form-group">
                <?php if(!empty($ideal_for_details)){ ?>
                    <input type="hidden" name="ideal_for_id" value="<?php echo $ideal_for_details[0]->ideal_for_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
