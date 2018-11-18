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
             Change Password
        </div>
    </div>
        
    <div class="panel-body">
        <form action="<?php echo site_url('admin/change_password'); ?>" role="form" id="form1" method="post" class="validate">
            <div class="form-group">
                <label class="control-label">Old Password</label>
                <input type="password" class="form-control" data-validate="required" name="old_pass" placeholder="Old Password" />
            </div>
            <div class="form-group">
                <label class="control-label">New Password</label>
                <input type="password" id="new_pass" class="form-control" data-validate="required,minlength[6]" name="new_pass" placeholder="New Password" />
            </div>
            <div class="form-group">
                <label class="control-label">Confirm Password</label>
                <input type="password" class="form-control" equalto="#new_pass" data-validate="required" name="confirm_pass" placeholder="Confirm Password" />
            </div>
            <div class="form-group">
                <input type="submit" name="change" value="Change" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
