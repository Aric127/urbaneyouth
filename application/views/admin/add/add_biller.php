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
             <?php if(!empty($biller_details)){ ?>Edit Biller<?php } else { ?>Add Biller<?php } ?>
       </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($biller_details)){ ?>action="<?php echo site_url('admin/edit_biller'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_biller'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
     		      <div class="form-group">
                <label class="control-label">Select Biller Type</label>
                <select class=" form-control" id="biller_type" name="biller_type" data-validate="required" data-msg="Please Select Category" placeholder="" onchange="select_category(this.value)">
                                <option value="">Select Category</option>
                              <option value="1">Biller</option>
                              <option value="2">Church</option>  
                               <option value="3">Events</option>  
                            </select>
            </div>
     		     <div class="form-group">
                <label class="control-label">Select Biller Category</label>
                <select class="form-control" id="biller_category_id" name="biller_category_id[]" data-validate="required" data-msg="Please Select Biller Category" placeholder="" multiple="multiple">
                                <option value="">Select Biller Category</option>
                                
                            </select>
            </div>
            
            <div class="form-group">
                <label class="control-label">Biller Name</label>
                <input type="text" name="biller_name" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_name; } ?>" class="form-control" data-validate="required" placeholder="Biller Name" />
            </div>
            <div class="form-group">
                <label class="control-label">Biller Email</label>
                <input type="email" name="biller_email" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_email; } ?>" class="form-control" data-validate="required" placeholder="Biller Email" />
            </div>
             <div class="form-group">
                <label class="control-label">Biller Password</label>
                <input type="password" name="biller_password" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_original_pass; } ?>" class="form-control" data-validate="required" placeholder="Biller Password" data-validation-length="min4" />
            </div>
             
            <div class="form-group">
                <label class="control-label">Biller Contact No</label>
                <input type="text" name="biller_contact_no" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_contact_no; } ?>" class="form-control" data-validate="required" placeholder="Biller Contact No" />
            </div>
             <div class="form-group">
                <label class="control-label">Biller Company Name</label>
                <input type="text" name="biller_company_name" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_company_name; } ?>" class="form-control" data-validate="required" placeholder="Biller Company Name" />
            </div>
             <div class="form-group">
                <label class="control-label">Biller Marign(%)</label>
                <input type="text" name="biller_margin" <?php if(!empty($biller_details)){ ?> value="<?php echo $biller_details[0]->biller_margin; } ?>" class="form-control" data-validate="required" placeholder="Biller Marign(%)" />
            </div>
             <div class="form-group">
                <label class="control-label">Biller Minimum Withdraw Amount</label>
                <input type="text" name="minimum_withdraw_amount" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->minimum_withdraw_amount; } ?>" class="form-control" data-validate="required" placeholder="Biller Minimum Withdraw Amount" />
            </div>
            <div class="form-group">
               <label class="control-label">Company Logo</label>
               <?php if(!empty($biller_details) && !empty($biller_details[0]->biller_company_logo)){ ?>
               <br>
               <img src="<?php echo base_url('uploads/biller_company_logo').'/'.$biller_details[0]->biller_company_logo; ?>" height="90" width="90">
               
               <input type="hidden" name="biller_company_logo" value="<?php echo $biller_details[0]->biller_company_logo; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="biller_company_logo" class="form-control" <?php if(!empty($biller_details) && !empty($biller_details[0]->biller_company_logo)){ } else { ?>data-validate="required"<?php } ?> />
           </div>

          <br>
            <div class="form-group">
                <?php if(!empty($biller_details)){ ?>
                    <input type="hidden" name="biller_id" value="<?php echo $biller_details[0]->biller_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
	function select_category(id)
	{
		
	
		  $.ajax({
	            url: '<?php echo site_url('admin/ajax_biller_type') ?>',
	            type: "POST",
	            data: {
	               'biller_type': id
	                   },
	                   success: function (data) {
	                 //  alert(data);
						if(data!=''){
							$("#biller_category_id").html(data);
							 
						}
	                  
	                   }
	               });
	               
	}
</script>
<style>
  .form-group {
    margin-bottom: 15px;
    float: left;
    width: 48%;
    margin-right: 15px;
}
select[multiple], select[size] {
    height: 33px;
}
</style>