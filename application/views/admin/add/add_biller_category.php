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
             <?php if(!empty($biller)){ ?>Edit Biller Category<?php } else { ?>Add Biller Category<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
       <div class="position-center"> 
       		<form <?php if(!empty($biller_category)){ ?>action="<?php echo site_url('admin/edit_biller_category'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_biller_category'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
     
             <div class="form-group">
                <label class="control-label">Select Category </label>
                <select class=" form-control" id="category" name="category" data-validate="required" data-msg="Please Select Category" placeholder="">
                                <option value="">Select Category</option>
                              <option value="1">Biller</option>
                              <option value="2">Church</option>  
                               <option value="3">Events</option>  
                            </select>
            </div>
           <div class="form-group">
                <label class="control-label">Select Category Name</label>
                <input type="text" name="biller_category_name" <?php if(!empty($biller_category)){ ?>value="<?php echo $biller_category[0]->biller_category_name; } ?>" class="form-control" data-validate="required" placeholder="Biller Category Name" />
            </div>

            <div class="form-group">
               <label class="control-label">Biller Category Logo</label>
               <?php if(!empty($biller_category) && !empty($biller_category[0]->biller_category_logo)){ ?>
               <br>
               <img src="<?php echo base_url('uploads/biller_category_logo').'/'.$biller_category[0]->biller_category_logo; ?>" height="90" width="90">
               
               <input type="hidden" name="biller_category_logo" value="<?php echo $biller_category[0]->biller_category_logo; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="biller_category_logo" class="form-control" <?php if(!empty($biller_category) && !empty($biller_category[0]->biller_category_logo)){ } else { ?>data-validate="required"  data-msg="Please Select image"<?php } ?> />
           </div>
          
          <br>
            <div class="form-group">
                <?php if(!empty($biller_category)){ ?>
                    <input type="hidden" name="biller_category_id" value="<?php echo $biller_category[0]->biller_category_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form> 
        </div>
    </div>
</div>
