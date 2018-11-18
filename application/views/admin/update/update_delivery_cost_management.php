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
             <?php if(!empty($delivery_cost_details)){ ?>Edit Delivery cost<?php } else { ?>Add Delivery cost<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($delivery_cost_details)){ ?>action="<?php echo site_url('admin/edit_delivery_cost_management'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_ideal_for'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label">Delivery Cost Type</label>
                <p>
                <label class="radio-inline">
                	
                	<input type="radio" name="delivery_cost_type" value="1" class="free-tab" <?php if(!empty($delivery_cost_details)){ if($delivery_cost_details[0]->delivery_cost_type == 1){ echo 'checked'; } } else { echo set_radio('delivery_cost_type', '1'); } ?>>
                    Free
                </label>
                <label class="radio-inline">
                    <input type="radio" name="delivery_cost_type" value="2" class="paid-tab" <?php if(!empty($delivery_cost_details)){ if($delivery_cost_details[0]->delivery_cost_type == 2){ echo 'checked'; } } else { echo set_radio('delivery_cost_type', '2'); } ?>>
                    Paid 
                </label>
                </p>
           </div>
            <div class="form-group delivery-price-tab">
                <label class="control-label">Delivery Cost</label>
                <input type="text" name="delivery_price" <?php if(!empty($delivery_cost_details)){ ?>value="<?php echo $delivery_cost_details[0]->delivery_price; } ?>" class="form-control" data-validate="required" placeholder="Delivery Cost" />
            </div>
          
          <br>
            <div class="form-group">
                <?php if(!empty($delivery_cost_details)){ ?>
                    <input type="hidden" name="delivery_cost_id" value="<?php echo $delivery_cost_details[0]->delivery_cost_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){
    <?php if(!empty($delivery_cost_details)){ if($delivery_cost_details[0]->delivery_cost_type==2){
        
     ?>
	$('.delivery-price-tab').show();
        <?php }else{ ?>
            $('.delivery-price-tab').hide();
        <?php }} ?>
	$('.paid-tab').click(function(){
		$('.delivery-price-tab').show();
		//$('.6-month').show();
	});
	$('.free-tab').click(function(){
		$('.delivery-price-tab').hide();
		//$('.6-month').show();
	});
	
	
});
</script>