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
             <?php if(!empty($recharge_category)){ ?>Edit Recharge Category<?php } else { ?>Add Recharge Category<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($recharge_category)){ ?>action="<?php echo site_url('admin/edit_recharge_category'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_recharge_category'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
           
            
            <div class="form-group">
                <label class="control-label">Recharge Category</label>
                <input type="text" name="category_name" <?php if(!empty($recharge_category)){ ?>value="<?php echo $recharge_category[0]->category_name; } ?>" class="form-control" data-validate="required" placeholder="Recharge Category" />
            </div>
         
          <br>
            <div class="form-group">
                <?php if(!empty($recharge_category)){ ?>
                    <input type="hidden" name="recharge_category_id" value="<?php echo $recharge_category[0]->recharge_category_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
