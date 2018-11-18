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
             <?php if(!empty($coupon_details)){ ?>Edit Coupon<?php } else { ?>Add Coupon<?php } ?>
             
        </div>
    </div>
  
    <div class="panel-body">
        <form <?php if(!empty($coupon_details)){ ?>action="<?php echo site_url('admin/edit_free_coupon'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_free_coupon'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        	
        	  <div class="form-group">
                <label class="control-label">Select Coupon Category</label>
                <select class=" form-control" id="fee_coupon_category_id" name="fee_coupon_category_id" data-validate="required" data-msg="Please Select coupon Category" placeholder="">
                                <option value="">Select Coupon Category</option>
                               
                                <?php foreach ($coupon_category as $value) { ?>
                                <option value="<?php if (!empty($value ->free_coupon_category_id)) {
                                    echo $value ->free_coupon_category_id; 
                                }?>" <?php if (!empty($value ->free_coupon_category_id) && !empty($coupon_details[0] ->fee_coupon_category_id )) {
        if ($value -> free_coupon_category_id == $coupon_details[0] -> fee_coupon_category_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value ->free_coupon_category_name; ?></option><?php } ?>
                                
                            </select>
            </div>
        	  <div class="form-group">
                <label class="control-label">Coupon Name</label>
                <input type="text" name="coupon_name" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_name; } ?>" class="form-control" data-validate="required" placeholder="Coupon Name" />
   			</div>
     		<div class="form-group">
                <label class="control-label">Coupon Code</label>
                <input type="text" name="coupon_code" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_code; } ?>" class="form-control" data-validate="required" placeholder="Coupon Code" />
   			</div>
   			 <div class="form-group">
                <label class="control-label">Select Coupon Type</label>
                <select class=" form-control" id="coupon_type" name="coupon_type" data-validate="required" data-msg="Please Select coupon Type" placeholder="" onchange="show_amount_div(this.value)">
                  <option value="">Select Coupon Type</option>
				  <option value="1">Free</option>
				  <option value="2">Amount</option>
                                
                </select>
            </div>
     		 <div class="form-group" style="display: none" id="coupon_amount_div">
                <label class="control-label">Coupon Amount</label>
                <input type="text" name="coupon_amount" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_amount; } ?>" class="form-control" data-validate="required" placeholder="Coupon Amount" />
            </div>
			<div class="form-group">
                <label class="control-label">Coupon Expiry Date</label>
                <input type="text" name="coupon_expiry_date" id="end_date" data-start-date="d" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_expiry_date; } ?>" class="form-control datepicker" placeholder="Coupon Expiry Date" data-format="yyyy-mm-dd" data-validate="required"/>
           </div>
           <div class="form-group">
                <label class="control-label">Refference wensite</label>
                <input type="text" name="refference_website"  data-start-date="d" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->refference_website; } ?>" class="form-control" placeholder="Coupon Website"  data-validate="required"/>
           </div>
            <div class="form-group">
               <label class="control-label">Coupon Logo</label>
               <?php if(!empty($coupon_details) && !empty($coupon_details[0]->coupon_img)){ ?>
               <br>
               <img src="<?php echo base_url('uploads/coupon_img').'/'.$coupon_details[0]->coupon_img; ?>" height="90" width="90">
               
               <input type="hidden" name="coupon_img" value="<?php echo $coupon_details[0]->coupon_img; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="coupon_img" size='20' class="form-control" <?php if(!empty($coupon_details) && !empty($coupon_details[0]->coupon_img)){ } else { ?>data-validate="required"  data-msg="Please Select image"<?php } ?> />
           </div>
            <div class="form-group">
                <label class="control-label">Coupon Description</label>
             <textarea class="form-control ckeditor" rows="3" name="coupon_description"  data-validate="required"  placeholder=" Content "><?php if(!empty($coupon_details)){ ?> <?php echo $coupon_details[0]->coupon_description ; } ?></textarea>
            </div>
              <div class="form-group">
                <label class="control-label">Terms and Conditions</label>
             <textarea class="form-control ckeditor" rows="5" name="coupon_terms"  data-validate="required"  placeholder=" Content "><?php if(!empty($coupon_details)){ ?> <?php echo $coupon_details[0]->coupon_terms ; } ?></textarea>
            </div>
          <br>
            <div class="form-group">
                <?php if(!empty($coupon_details)){ ?>
                    <input type="hidden" name="free_coupon_id" value="<?php echo $coupon_details[0]->free_coupon_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
	function show_amount_div(id)
	{
		var coupon_type=id;
		if(coupon_type==2)
		{
			$("#coupon_amount_div").attr("style","display:Block");
		}else{
			$("#coupon_amount_div").attr("style","display:none");
		}
	}
</script>
<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
	