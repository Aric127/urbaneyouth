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
             <?php if(!empty($recharge_type)){ ?>Edit Recharge type<?php } else { ?>Add Recharge type<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($recharge_type)){ ?>action="<?php echo site_url('admin/edit_recharge_type'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_recharge_type'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Select Recharge Category</label>
                <select class=" form-control" id="recharge_category_id" name="recharge_category_id" data-placeholder="">
                                <option value="">Select Recharge Category</option>
                                <?php foreach ($recharge_category as $value) { ?>
                                <option value="<?php if (!empty($value ->recharge_category_id)) {
                                    echo $value ->recharge_category_id; 
                                }?>" <?php if (!empty($value -> recharge_category_id) && !empty($recharge_type[0] -> recharge_category_id)) {
        if ($value -> recharge_category_id == $recharge_type[0] -> recharge_category_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> category_name; ?></option><?php } ?>
                                
                            </select>
            </div>
            
            <div class="form-group">
                <label class="control-label">Recharge Type</label>
                <input type="text" name="recharge_type" <?php if(!empty($recharge_type)){ ?>value="<?php echo $recharge_type[0]->recharge_type; } ?>" class="form-control" data-validate="required" placeholder="Recharge Type" />
            </div>
       
          <br>
            <div class="form-group">
                <?php if(!empty($recharge_type)){ ?>
                    <input type="hidden" name="recharge_type_id" value="<?php echo $recharge_type[0]->recharge_type_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
