<style>
  .file {
    position: absolute;
} 
</style>

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
             Upload Product Excel
       </div>
        <div class="panel-options">
            <a href="<?php echo base_url('uploads/demo_excel/product_excel.xlsx'); ?>" class="btn blue-theme-btn" style="color: #fff;">
                <i class="fa-plus-circle"> </i> Sample Excel
            </a> 
        </div> 
    </div>
        
    <div class="panel-body">
        <form action="<?php echo site_url('biller/upload_product_excel'); ?>" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        
      <div class="form-group">
    <input type="file" name="img[]" class="file">
    <div class="input-group col-xs-12">
      <input type="text" class="form-control input-lg" disabled placeholder="Upload Product Excel">
      <span class="input-group-btn">
        <button class="browse btn btn-success input-lg" type="button">Browse</button>
      </span>
    </div>
    <p class="help-block">Only Excel/CSV File Import.</p>
  </div>
      <!--<div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="product_excel" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>-->
      
    <button type="submit" class="btn btn-success" name="Import" value="Import">Upload</button>
        </form>
    </div>
</div>

<script>
 $(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
}); 
</script>