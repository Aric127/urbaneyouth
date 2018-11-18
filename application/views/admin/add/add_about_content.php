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
             <?php if(!empty($about_us)){ ?>Edit Content<?php } else { ?>Add Content<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($about_us)){ ?>action="<?php echo site_url('admin/edit_about_content'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_about_content'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
         
          <div class="form-group">
                <label class="control-label">Content</label>
                <input type="text" name="about_us_video" <?php if(!empty($about_us)){ ?>value="<?php echo $about_us[0]->about_us_video; } ?>" class="form-control" data-validate="required" placeholder="Video URL" />
            
            </div>
             <div class="form-group">
                <label class="control-label">Website Content</label>
             <textarea class="form-control ckeditor" rows="10" name="website_content"  data-validate="required"  placeholder=" Content "><?php if(!empty($about_us)){ ?> <?php echo $about_us[0]->website_content ; } ?></textarea>
            </div>
            
            <div class="form-group">
                <label class="control-label">App Content</label>
             <textarea class="form-control ckeditor" rows="10" name="about_us_content"  data-validate="required"  placeholder=" Content "><?php if(!empty($about_us)){ ?> <?php echo $about_us[0]->about_us_content ; } ?></textarea>
            </div>
            <div class="form-group">
                <?php if(!empty($about_us)){ ?>
                    <input type="hidden" name="about_us_id" value="<?php echo $about_us[0]->about_us_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
