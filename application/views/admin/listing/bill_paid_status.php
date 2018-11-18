<?php if ($this->session->flashdata('status')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('status'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
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
<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panel-title">
           Bill Status
        </div>
       
    </div>

    <div id="user_list" class="panel-body">
    	
	<div class="form-group">
             <label class="control-label">Select Biller</label>
                <select class=" form-control" id="biller_id" name="biller_id" data-validate="required" data-msg="Please Select Biller" placeholder="" onchange="select_biller(this.value)">
                                <option value="">Select Biller</option>
                                <?php foreach ($biller as $value) { ?>
                                <option value="<?php if (!empty($value ->biller_id)) {
                                    echo $value ->biller_id; 
                                }?>" >
        <?php echo $value -> biller_name." "."(".$value -> biller_company_name.")"; ?></option><?php } ?>
                                
                  </select>
            </div>
            <div class="form-group" id="paid_status" style="display: none">
             <label class="control-label">Bill Status</label>
                <select class=" form-control" id="bill_status" name="bill_status" data-validate="required" data-msg="Please Select status" placeholder="" onchange="select_bill_status(this.value)">
                                <option value="0">Select Bill Status</option>
                                <option value="1">Paid</option>
                                <option value="2">Pending</option>
                  </select>
            </div>
		<div class="table-responsive"> 
        <div id="bill_record" style="display: none">
		
        </div>
		</div>
    </div>

</div>


<script>

   	function select_biller(id){
   		var biller_id=id;
		if(biller_id!=''){
				$.ajax({
							 url: "<?php echo site_url('admin/bill_record_by_biller') ?>",
							 type: "POST",
							 data: {
								 'biller_id': biller_id
							
								},
								success: function (data) 
								  {
								  	$("#bill_status").prop("selectedIndex", "");
									$("#paid_status").css("display","Block");
								  	$("#bill_record").css("display","Block");
								  	$("#bill_record").html(data);
								  	
								  }
					});
				}else{
						$("#bill_record").css("display","none");
				}
	}
	
	function select_bill_status(status){
		
		if(status!=''){
			var biller_id=$("#biller_id").val();
			if(biller_id!=''){
				$.ajax({
							 url: "<?php echo site_url('admin/bill_record_by_bill_status') ?>",
							 type: "POST",
							 data: {
								 'status': status,
								 "biller_id":biller_id
							
								},
								success: function (data) 
								  {
								  	$("#bill_record").css("display","Block");
								  	$("#bill_record").html(data);
								  	
								  }
					});
			}else{
				$("#error").text("Please Select Biller");
			}
		}
	}
</script>
