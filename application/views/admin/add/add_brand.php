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
             <?php if(!empty($brand_details)){ ?>Edit Recharge Category<?php } else { ?>Add Recharge Category<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($brand_details)){ ?>action="<?php echo site_url('admin/edit_brand'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_brand'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Select Brand Type</label>
                <select class=" form-control" id="brand_type_id" name="brand_type_id" data-placeholder="">
                                <option value="">Select Brand Type</option>
                                <?php foreach ($brand_type as $value) { ?>
                                <option value="<?php if (!empty($value -> brand_type_id)) {
                                    echo $value -> brand_type_id; 
                                }?>" <?php if (!empty($value -> brand_type_id) && !empty($brand_details[0] -> brand_type_id)) {
        if ($value -> brand_type_id == $brand_details[0] -> brand_type_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> brand_type_name; ?></option><?php } ?>
                                
                            </select>
            </div>
            
            <div class="form-group">
                <label class="control-label">Brand Name</label>
                <input type="text" name="brand_name" <?php if(!empty($brand_details)){ ?>value="<?php echo $brand_details[0]->brand_name; } ?>" class="form-control" data-validate="required" placeholder="Brand Name" />
            </div>
       
          <br>
            <div class="form-group">
                <?php if(!empty($brand_details)){ ?>
                    <input type="hidden" name="brand_id" value="<?php echo $brand_details[0]->brand_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
