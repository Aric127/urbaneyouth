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
             <?php if(!empty($recharge_plan)){ ?>Edit Plan<?php } else { ?>Add Plan<?php } ?>
       </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($recharge_plan)){ ?>action="<?php echo site_url('admin/edit_recharge_plan'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_recharge_plan'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
     		     <div class="form-group">
                <label class="control-label">Select Recharge Category</label>
                <select class=" form-control" id="recharge_category_id" name="recharge_category_id" data-validate="required" data-msg="Please Select Recharge Category" placeholder="" onchange="change_plan_type(this.value)">
                                <option value="">Select Recharge Category</option>
                                <?php foreach ($recharge_category as $value) { ?>
                                <option value="<?php if (!empty($value ->recharge_category_id)) {
                                    echo $value ->recharge_category_id; 
                                }?>" <?php if (!empty($value -> recharge_category_id) && !empty($recharge_plan[0] -> recharge_category_id)) {
        if ($value -> recharge_category_id == $recharge_plan[0] -> recharge_category_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> category_name; ?></option><?php } ?>
                                
                            </select>
            </div>
              <div class="form-group">
                <label class="control-label">Select Plan Category</label>
                <select class=" form-control" id="plan_category_id" name="plan_category_id" data-validate="required" data-msg="Please Select Plan Type" placeholder="">
                                <option value="">Select Plan Type</option>
                                
                            </select>
            </div>
            <div class="form-group">
                <label class="control-label">Select Operator</label>
                <select class=" form-control" id="recharge_operator_id" name="recharge_operator_id" data-validate="required" data-msg="Please Select operator" placeholder="">
                                <option value="">Select Operator</option>
                                
                            </select>
            </div>
            <div class="form-group">
                <label class="control-label">Amount</label>
                <input type="text" name="rechage_amount" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->rechage_amount; } ?>" class="form-control" data-validate="required" placeholder="Amount" />
            </div>
            <div id="mobile_plan">
           
             <div class="form-group">
                <label class="control-label">SMS</label>
                <input type="text" name="recharge_sms" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->recharge_sms; } ?>" class="form-control" data- placeholder="SMS" />
            </div>
             <div class="form-group">
                <label class="control-label">Talktime</label>
                <input type="text" name="recharge_talktime" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->recharge_talktime; } ?>" class="form-control" data- placeholder="Talktime" />
            </div>
              <div class="form-group">
                <label class="control-label">Validity</label>
                <input type="text" name="recharge_validity" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->recharge_validity; } ?>" class="form-control" data-validate="required" placeholder="Validity" />
            </div>
             <div class="form-group">
                <label class="control-label">ersPlanId</label>
                <input type="text" name="ersPlanId" <?php if(!empty($recharge_plan)){ ?> value="<?php echo $recharge_plan[0]->ersPlanId; } ?>" class="form-control" data-validate="required" placeholder="ersPlanId" />
            </div>
             </div>
             <div id="dth_plan">
	             <div class="form-group">
	                <label class="control-label">DTH Channel</label>
	                <input type="text" name="recharge_dth_channel" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->recharge_dth_channel; } ?>" class="form-control" data-validate="required" placeholder="DTH Channel" />
	            </div>
            </div>
        <!--   <div id="datacard">
          	 <div class="form-group">
                <label class="control-label">Data Pack</label>
                <input type="text" name="recharge_data_pack" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->recharge_data_pack; } ?>" class="form-control" data- placeholder="Data Pack" />
            </div>
          </div> -->
           <!--
             <div class="form-group">
                           <label class="control-label">Activation Code</label>
                           <input type="text" name="recharge_activation_code" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->recharge_activation_code; } ?>" class="form-control" data-validate="required" placeholder="Activation Code" />
                       </div>-->
            <div class="form-group">
                <label class="control-label">Data Pack</label>
                <input type="text" name="recharge_data_pack" <?php if(!empty($recharge_plan)){ ?>value="<?php echo $recharge_plan[0]->recharge_data_pack; } ?>" class="form-control" data- placeholder="Data Pack" />
            </div>
          <div class="form-group">
                <label class="control-label">plan Description</label>
             <textarea class="form-control ckeditor" rows="5" name="recharge_desc"  data-validate="required"  placeholder="Content "><?php if(!empty($recharge_plan)){ ?> <?php echo $recharge_plan[0]->recharge_desc ; } ?></textarea>
            </div>

          <br>
            <div class="form-group">
                <?php if(!empty($recharge_plan)){ ?>
                    <input type="hidden" name="recharge_plan_id" value="<?php echo $recharge_plan[0]->recharge_plan_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>


<script>
$(window).load(function() {
	
	var id = $("#recharge_category_id").val();
	
	change_plan_type(id);
});
	
		function change_plan_type(id){
			if(id=='1'){
				$("#mobile_plan").show();
				$("#dth_plan").hide();
				$("#datacard").hide();
			}else if(id=='2'){
				$("#mobile_plan").hide();
				$("#dth_plan").show();
					$("#datacard").hide();
			}else if(id=='3'){
				$("#datacard").show();
				$("#mobile_plan").hide();
				$("#dth_plan").hide();
			}
			else{
				$("#dth_plan").hide();
				$("#datacard").hide();
			}
		  $.ajax({
	            url: '<?php echo site_url('admin/change_plan_type') ?>',
	            type: "POST",
	            data: {
	               'recharge_category_id': id
	                   },
	                   success: function (data) {
	                   
						if(data!=''){
							$("#plan_category_id").html(data);
							 $.ajax({
	           					 url: '<?php echo site_url('admin/change_operator') ?>',
	           					 type: "POST",
	            					data: {
	               						'recharge_category_id': id
	                   				},
	                   				success: function (data) {
									if(data!=''){
										$("#recharge_operator_id").html(data);
									}
	                  
	                   			}
	               				}); 
						}
	                  
	                   }
	               }); 
		
	}
</script>