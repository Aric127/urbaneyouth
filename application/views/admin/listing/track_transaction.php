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
            Track Record
       </div>
    </div>
        
    <div class="panel-body">
       <div class="form-group">
                <label class="control-label">Transaction ID</label>
                <input type="text" name="transaction_id" id="transaction_id"  class="form-control" data-validate="required" placeholder="Transaction ID" value="" />
            </div>
        <div class="form-group">
             <input type="button" name="submit" value="Search" class="btn btn-success" onclick="track_transaction()">
        </div>
        <div id="error" style="color: red;font-weight: 600"></div>
        <div id="track_record"></div>
    </div>
</div>
<script>
	function track_transaction()
	{
		var transaction_id=$("#transaction_id").val();
		    if(transaction_id!='')
		    {
		    $.ajax({
					url: "<?php echo site_url('admin/track_transaction') ?>",
					type: "POST",
					data: 
						{
						  "transaction_id":transaction_id
						 },
					success: function (data) 
						{
							if(data!='2'){
								 $("#track_record").html(data);
								  $("#error").html("");
							}else{
								$("#track_record").html('');
								 $("#error").html("No Record Found, please enter a valid transaction id");
							}
						  
						}
				});
		    }else
		    {
		    	 $("#error").html("Please Enter a Transaction ID");
		    } 
	}
</script>