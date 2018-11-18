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
             Change Email
        </div>
    </div>
        
    <div class="panel-body">
        <form action="<?php echo site_url('admin/change_email'); ?>" role="form" id="form1" method="post" class="validate">
            <div class="form-group">
                <label class="control-label">Current Email</label>
                <input type="email" class="form-control" placeholder="Email" value="<?php echo $a_email; ?>" disabled="disabled"/>
            </div>
            <div class="form-group">
                <label class="control-label">New Email</label>
                <input type="email" class="form-control" data-validate="required,email" name="a_email" placeholder="New Email" />
            </div>
            <div class="form-group">
                <input type="submit" name="change" value="Change" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
