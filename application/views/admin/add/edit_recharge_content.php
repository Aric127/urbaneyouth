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
             <?php if(!empty($recharge_content)){ ?>Edit Content<?php } else { ?>Add Content<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($recharge_content)){ ?>action="<?php echo site_url('admin/edit_recharge_content'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_recharge_content'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
          
            
            <div class="form-group">
                <label class="control-label">Mobile Recharge</label>
             <textarea class="form-control ckeditor" rows="2" name="mobile_recharge"  data-validate="required"  placeholder=" Mobile Recharge "><?php if(!empty($recharge_content)){ ?> <?php echo $recharge_content[0]->mobile_recharge ; } ?></textarea>
            </div>
            
           
            
             <div class="form-group">
                <label class="control-label">TV Recharge</label>
             <textarea class="form-control ckeditor" rows="2" name="tv_recharge"  data-validate="required"  placeholder="TV Recharge "><?php if(!empty($recharge_content)){ ?> <?php echo $recharge_content[0]->tv_recharge ; } ?></textarea>
            </div>
            
           
            
          <div class="form-group">
                <label class="control-label">Data Recharge</label>
             <textarea class="form-control ckeditor" rows="2" name="share_app_content"  data-validate="required"  placeholder="Share App Content "><?php if(!empty($recharge_content)){ ?> <?php echo $recharge_content[0]->share_app_content ; } ?></textarea>
            </div>
             <div class="form-group">
                <label class="control-label">Electricty Recharge</label>
             <textarea class="form-control ckeditor" rows="2" name="electricity_recharge"  data-validate="required"  placeholder=" Electricity Recharge "><?php if(!empty($recharge_content)){ ?> <?php echo $recharge_content[0]->electricity_recharge ; } ?></textarea>
            </div>
            
           
            
             <div class="form-group">
                <label class="control-label">Church Donation</label>
             <textarea class="form-control ckeditor" rows="2" name="church_content"  data-validate="required"  placeholder="Church Donation "><?php if(!empty($recharge_content)){ ?> <?php echo $recharge_content[0]->church_content ; } ?></textarea>
            </div>
            
           
            
          <div class="form-group">
                <label class="control-label">Bill Pay</label>
             <textarea class="form-control ckeditor" rows="2" name="biller_content"  data-validate="required"  placeholder="Bill Pay "><?php if(!empty($recharge_content)){ ?> <?php echo $recharge_content[0]->biller_content ; } ?></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Share App Content</label>
             <textarea class="form-control ckeditor" rows="2" name="data_recharge"  data-validate="required"  placeholder="Data Recharge "><?php if(!empty($recharge_content)){ ?> <?php echo $recharge_content[0]->data_recharge ; } ?></textarea>
            </div>
            <div class="form-group">
                <?php if(!empty($recharge_content)){ ?>
                    <input type="hidden" name="recharge_content_id" value="<?php echo $recharge_content[0]->recharge_content_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
