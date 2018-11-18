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
             <?php if(!empty($privecy_policy)){ ?>Edit Content<?php } else { ?>Add Content<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($privecy_policy)){ ?>action="<?php echo site_url('admin/edit_privecy_policy_content'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_about_content'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            
          <div class="form-group">
                <label class="control-label">Content</label>
             <textarea class="form-control ckeditor" rows="10" name="privacy_policy_content"  data-validate="required"  placeholder=" Content "><?php if(!empty($privecy_policy)){ ?> <?php echo $privecy_policy[0]->privacy_policy_content ; } ?></textarea>
            </div>
            <div class="form-group">
                <?php if(!empty($privecy_policy)){ ?>
                    <input type="hidden" name="privecy_policy_id" value="<?php echo $privecy_policy[0]->privecy_policy_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
