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
             <?php if(!empty($skretch_coupon)){ ?>Edit Coupon<?php } else { ?>Add Coupon<?php } ?>
             
        </div>
    </div>
  
    <div class="panel-body">
        <form <?php if(!empty($skretch_coupon)){ ?>action="<?php echo site_url('admin/edit_scratch_card'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_scratch_card'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        	  <div class="form-group">
                <label class="control-label">Coupon Code</label>
                <input type="text" name="skretch_card_code" <?php if(!empty($skretch_coupon)){ ?>value="<?php echo $skretch_coupon[0]->skretch_card_code; } ?>" class="form-control" data-validate="required" placeholder="Skretch Code" />
   </div>
     <div class="form-group">
                <label class="control-label">Coupon Amount</label>
                <input type="text" name="skretch_card_amount" <?php if(!empty($skretch_coupon)){ ?>value="<?php echo $skretch_coupon[0]->skretch_card_amount; } ?>" class="form-control" data-validate="required" placeholder="Amount" />
   </div>
           
            
            <div class="form-group">
                <label class="control-label">Skretch user</label>
                <input type="text" name="skretch_card_user" <?php if(!empty($skretch_coupon)){ ?>value="<?php echo $skretch_coupon[0]->skretch_card_user; } ?>" class="form-control" data-validate="required" placeholder="Skretch user" />
            </div>
           
             <div class="form-group">
                <label class="control-label">Expiry Date</label>
                
                <input type="text" name="skretch_card_validity" id="end_date" data-start-date="d" <?php if(!empty($skretch_coupon)){ ?>value="<?php echo $skretch_coupon[0]->skretch_card_validity; } ?>" class="form-control datepicker" placeholder="Expiry Date" data-format="yyyy-mm-dd"/>
            
            </div>
          
          <br>
            <div class="form-group">
                <?php if(!empty($skretch_coupon)){ ?>
                    <input type="hidden" name="skretch_card_id" value="<?php echo $skretch_coupon[0]->skretch_card_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
