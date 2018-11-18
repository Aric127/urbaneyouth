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
             <?php if(!empty($free_coupon_category)){ ?>Edit Category<?php } else { ?>Add Category<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($free_coupon_category)){ ?>action="<?php echo site_url('admin/edit_free_coupon_category'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_free_coupon_category'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Category Name</label>
                <input type="text" name="free_coupon_category_name" <?php if(!empty($free_coupon_category)){ ?>value="<?php echo $free_coupon_category[0]->free_coupon_category_name; } ?>" class="form-control" data-validate="required" placeholder="Category Name" />
            </div>
            
          <br>
            <div class="form-group">
                <?php if(!empty($category_details)){ ?>
                    <input type="hidden" name="category_id" value="<?php echo $category_details[0]->category_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
