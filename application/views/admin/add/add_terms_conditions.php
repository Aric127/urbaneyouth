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
             <?php if(!empty($terms_conditions)){ ?>Edit Content<?php } else { ?>Add Content<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($terms_conditions)){ ?>action="<?php echo site_url('admin/edit_terms_conditions'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_terms_conditions'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
           
          <div class="form-group">
                <label class="control-label">Content</label>
             <textarea class="form-control ckeditor" rows="10" name="terms_content"  data-validate="required"  placeholder=" Content "><?php if(!empty($terms_conditions)){ ?> <?php echo $terms_conditions[0]->terms_content ; } ?></textarea>
            </div>
            <div class="form-group">
                <?php if(!empty($terms_conditions)){ ?>
                    <input type="hidden" name="terms_conditions_id" value="<?php echo $terms_conditions[0]->terms_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
