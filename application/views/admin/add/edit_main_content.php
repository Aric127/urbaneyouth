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
        <form <?php if(!empty($main_content)){ ?>action="<?php echo site_url('admin/edit_main_content'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_main_content'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Slider 1 Heading</label>
                <input type="text" name="slider1_heading" <?php if(!empty($main_content)){ ?>value="<?php echo $main_content[0]->slider1_heading; } ?>" class="form-control" data-validate="required" placeholder="Slider 2 Heading" />
            </div>
            
            <div class="form-group">
                <label class="control-label">Slider 1</label>
             <textarea class="form-control ckeditor" rows="2" name="slider1"  data-validate="required"  placeholder=" Slider 1 Content "><?php if(!empty($main_content)){ ?> <?php echo $main_content[0]->slider1 ; } ?></textarea>
            </div>
            
            <div class="form-group">
                <label class="control-label">Slider 2 Heading</label>
                <input type="text" name="slider2_heading" <?php if(!empty($main_content)){ ?>value="<?php echo $main_content[0]->slider2_heading; } ?>" class="form-control" data-validate="required" placeholder="Slider 2 Heading" />
            </div>
            
             <div class="form-group">
                <label class="control-label">slider 2</label>
             <textarea class="form-control ckeditor" rows="2" name="slider2"  data-validate="required"  placeholder="Slider 2 Content "><?php if(!empty($main_content)){ ?> <?php echo $main_content[0]->slider2 ; } ?></textarea>
            </div>
            
            <div class="form-group">
                <label class="control-label">Slider 3 Heading</label>
                <input type="text" name="slider3_heading" <?php if(!empty($main_content)){ ?>value="<?php echo $main_content[0]->slider3_heading; } ?>" class="form-control" data-validate="required" placeholder="Slider 3 Heading" />
            </div>
            
          <div class="form-group">
                <label class="control-label">Slider 3</label>
             <textarea class="form-control ckeditor" rows="2" name="slider3"  data-validate="required"  placeholder="Slider 3 Content "><?php if(!empty($main_content)){ ?> <?php echo $main_content[0]->slider3 ; } ?></textarea>
            </div>
            
            <div class="form-group">
                <?php if(!empty($main_content)){ ?>
                    <input type="hidden" name="main_content_id" value="<?php echo $main_content[0]->main_content_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
