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
        <form <?php if(!empty($coupon_details)){ ?>action="<?php echo site_url('admin/edit_coupon'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_coupon'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
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
                <select class=" form-control" id="coupon_type" name="coupon_type" data-placeholder="">
                                <option value="">Select Coupon Type</option>
                               	<option value="1"<?php if(!empty($coupon_details)){
                               	 if($coupon_details[0]->coupon_type=='1'){?> selected="selected" <?php }	
                               	} ?>>Cashback</option>
                               	<option value="2" <?php if(!empty($coupon_details)){
                               	 if($coupon_details[0]->coupon_type=='2'){?> selected="selected" <?php }	
                               	} ?>>Flat off</option>
                                <option value="2" <?php if(!empty($coupon_details)){
                               	 if($coupon_details[0]->promocode=='3'){?> selected="selected" <?php }	
                               	} ?>>Promo code</option>
                            </select>
            </div>
            
            <div class="form-group">
                <label class="control-label">Coupon Maximum price</label>
                <input type="text" name="coupon_minimum_price" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_minimum_price; } ?>" class="form-control" data-validate="required" placeholder="Coupon Maximum price" />
            </div>
             <div class="form-group">
                <label class="control-label">Coupon price</label>
                <input type="text" name="coupon_price" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_price; } ?>" class="form-control" data-validate="required" placeholder="Coupon price" />
            </div>
             <div class="form-group">
                <label class="control-label">Coupon Maximum user</label>
                <select class="form-control" id="coupon_maximum_user" name="coupon_maximum_user" onchange="coupon_limit_function(this.value)">
                                <option value="">Select coupon Limit</option>
                               	<option value="1" <?php if(!empty($coupon_details)){
                               	 if($coupon_details[0]->coupon_maximum_user=='1'){?> selected="selected" <?php }	
                               	} ?> >Limited</option>
                               	<option value="2" <?php if(!empty($coupon_details)){
                               	 if($coupon_details[0]->coupon_maximum_user=='2'){?> selected="selected" <?php }	
                               	} ?>>Unlimited</option>
                 </select>
            </div>
       		 <div class="form-group" id="c_limit" <?php if(!empty($coupon_details)){
                               	 if($coupon_details[0]->coupon_maximum_user=='2'){?> style="display: none" <?php }} ?>>
                <label class="control-label">Coupon Limit</label>
                <input type="text" name="coupon_limit" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_limit; } ?>" class="form-control" data-validate="required" placeholder="Coupon Limit" />
            </div>
             <div class="form-group">
                <label class="control-label">Coupon Expiry Date</label>
                
                <input type="text" name="coupon_expire_date" id="end_date" data-start-date="d" <?php if(!empty($coupon_details)){ ?>value="<?php echo $coupon_details[0]->coupon_expire_date; } ?>" class="form-control datepicker" placeholder="Coupon Expiry Date" data-format="yyyy-mm-dd"/>
            
            </div>

          <!--   <div class="form-group">
                <label class="control-label">Coupon Image</label>
                <input type="file" name="coupon_image" class="form-control" >
            </div> -->

            <div class="form-group">
                <label class="control-label">Coupon Description</label>
             <textarea class="form-control ckeditor" rows="5" name="coupon_desc"  data-validate="required"  placeholder=" Content "><?php if(!empty($coupon_details)){ ?> <?php echo $coupon_details[0]->coupon_desc ; } ?></textarea>
            </div>
          <br>
            <div class="form-group">
                <?php if(!empty($coupon_details)){ ?>
                    <input type="hidden" name="coupon_id" value="<?php echo $coupon_details[0]->coupon_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script>
	function coupon_limit_function(id){
		if(id=='1'){
			$("#c_limit").show();
		}else if(id=='2'){
			$("#c_limit").hide();
		}else if(id==''){
			$("#c_limit").hide();
		}
	}
	</script>	