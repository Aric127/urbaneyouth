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
             <?php if(!empty($plan_category)){ ?>Edit Plan-Category<?php } else { ?>Add Plan-Category<?php } ?>
             
        </div>
    </div>
       
    <div class="panel-body">
        <form <?php if(!empty($plan_category)){ ?>action="<?php echo site_url('admin/edit_plan_category'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_plan_category'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        	
        	    <div class="form-group">
                <label class="control-label">Select Recharge Category</label>
                <select class=" form-control" id="plan_recharge_category_id" name="plan_recharge_category_id" data-validate="required" data-msg="Please Select Recharge Category" placeholder="">
                                <option value="">Select Recharge Category</option>
                                <?php foreach ($recharge_category as $value) { ?>
                                	
                                <option value="<?php if (!empty($value ->recharge_category_id)) {
                                    echo $value ->recharge_category_id; 
                                }?>" <?php if (!empty($value ->recharge_category_id) && !empty($plan_category[0] -> plan_recharge_category_id)) {
        if ($value ->recharge_category_id == $plan_category[0]->plan_recharge_category_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> category_name; ?></option><?php } ?>
                                
                            </select>
            </div>
            <div class="form-group">
                <label class="control-label">Plan Category</label>
                <input type="text" name="plan_category_name" <?php if(!empty($plan_category)){ ?>value="<?php echo $plan_category[0]->plan_category_name; } ?>" class="form-control" data-validate="required" placeholder="Plan Category" />
            </div>
       
            <div class="form-group">
                <?php if(!empty($plan_category)){ ?>
                    <input type="hidden" name="plan_category_id" value="<?php echo $plan_category[0]->plan_category_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
