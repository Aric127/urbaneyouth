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
             Upload Plan Excel
       </div>
    </div>
        
    <div class="panel-body">
        <form action="<?php echo site_url('admin/upload_plans'); ?>" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
    
      <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="plan_excel" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
      
    <button type="submit" class="btn btn-success" name="Import" value="Import">Upload</button>
        </form>
    </div>
</div>
