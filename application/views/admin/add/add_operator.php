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
             <?php if(!empty($operator)){ ?>Edit Operaor<?php } else { ?>Add Operator<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($operator)){ ?>action="<?php echo site_url('admin/edit_operator'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_operator'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        	<div class="form-group">
                <label class="control-label">Select Recharge Category</label>
                <select class=" form-control" id="recharge_category_id" name="recharge_category_id" data-placeholder="">
                                <option value="">Select Recharge Category</option>
                                <?php foreach ($recharge_category as $value) { ?>
                                <option value="<?php if (!empty($value ->recharge_category_id)) {
                                    echo $value ->recharge_category_id; 
                                }?>" <?php if (!empty($value -> recharge_category_id) && !empty($operator[0] -> recharge_category_id)) {
        if ($value -> recharge_category_id == $operator[0] -> recharge_category_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> category_name; ?></option><?php } ?>
                                
                            </select>
            </div>
            <div class="form-group">
                <label class="control-label">Operator Name</label>
                <input type="text" name="operator_name" <?php if(!empty($operator)){ ?>value="<?php echo $operator[0]->operator_name; } ?>" class="form-control" data-validate="required" placeholder="Operator Name" />
            </div>
              <div class="form-group">
                <label class="control-label">Operator Code</label>
                <input type="text" name="operator_code" <?php if(!empty($operator)){ ?> value="<?php echo $operator[0]->operator_code; } ?>" class="form-control"  placeholder="Operator Code" />
            </div>
              <div class="form-group">
                <label class="control-label">Bundle ServiceID</label>
                <input type="text" name="operator_bundle_code" <?php if(!empty($operator)){ ?> value="<?php echo $operator[0]->operator_bundle_code; } ?>" class="form-control"  placeholder="Bundle ServiceID" />
            </div>
    		<div class="form-group">
               <label class="control-label">Operator Image</label>
               <?php if(!empty($operator) && !empty($operator[0]->operator_image)){ ?>
               <br>
               <img src="<?php echo base_url('uploads/operator').'/'.$operator[0]->operator_image; ?>" height="90" width="90">
               
               <input type="hidden" name="operator_image" value="<?php echo $operator[0]->operator_image; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="operator_image" class="form-control" <?php if(!empty($operator) && !empty($operator[0]->operator_image)){ } else { ?>data-validate="required"<?php } ?> />
           </div>
          <br>
            <div class="form-group">
                <?php if(!empty($operator)){ ?>
                    <input type="hidden" name="operator_id" value="<?php echo $operator[0]->operator_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
