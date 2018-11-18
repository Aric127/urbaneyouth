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
             <?php if(!empty($biller)){ ?>Edit Bill<?php } else { ?>Add Bill<?php } ?>
       </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($biller_details)){ ?>action="<?php echo site_url('biller/edit_bill_user'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_biller_user'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
      		
            
            <div class="form-group">
                <label class="control-label">Consumer Name</label>
                <input type="text" name="biller_user_name"  id="biller_user_name" onblur="create_invoive_no()" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_user_name; } ?>" class="form-control" data-validate="required" data-msg="Please Enter Consumer Name" placeholder="Consumer Name" />
            </div>
            <div class="form-group">
                <label class="control-label">Select Product</label>
                <select class=" form-control" id="bill_product_id" name="bill_product_id[]" data-validate="required" data-msg="Please Select Product" placeholder="" multiple="multiple">
                               
                                <?php foreach ($product as $value) { ?>
                                <option value="<?php if (!empty($value ->product_id)) {
                                    echo $value ->product_id; 
                                }?>" <?php if (!empty($value -> product_id) && !empty($biller_details[0] -> bill_product_id)) {
        if ($value -> product_id == $biller_details[0] -> bill_product_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> product_name." "."(".$value -> product_code.")"; ?></option><?php } ?>
                                
                            </select>
            </div>
             <div class="form-group">
                <label class="control-label">Invoice No</label>
                <input type="text" name="bill_invoice_no" id="bill_invoice_no" value="" class="form-control" readonly="" />
            </div>
            <div class="form-group">
                <label class="control-label">Consumer No</label>
                <input type="text" onkeyup="check_number(this.value)" name="biller_customer_id_no" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_customer_id_no; } ?>" class="form-control" data-validate="required" placeholder="Consumer No" data-msg="Please Enter Consumer ID" data-validate="required"/>
                <label id="consumer_no_error" style="color:red"></label>
            </div>
             <div class="form-group">
                <label class="control-label">Consumer Email</label>
                <input type="text" name="biller_user_email" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_user_email; } ?>" class="form-control" data-validate="required" data-msg="Please Enter Consumer Email" placeholder="Consumer Email" />
            </div>
             
            <div class="form-group">
                <label class="control-label">Consumer Contact No</label>
                <input type="text" name="biller_user_contact_no" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->biller_user_contact_no; } ?>" class="form-control" data-validate="required" placeholder="Consumer Contact No" data-msg="Please Enter Consumer Contact No"/>
            </div>
             <div class="form-group">
                <label class="control-label">Bill Amount</label>
                <input type="text" name="bill_amount" <?php if(!empty($biller_details)){ ?>value="<?php echo $biller_details[0]->bill_amount; } ?>" class="form-control" data-validate="required" placeholder="Bill Amount" data-msg="Please Enter Consumer Bill Amount"/>
            </div>
         
             <div class="form-group">
                <label class="control-label">Last Date</label>
                <input type="text" name="bill_due_date" id="end_date" data-start-date="d" <?php if(!empty($biller)){ ?>value="<?php echo $biller_details[0]->bill_due_date; } ?>" class="form-control datepicker" data-validate="required" placeholder="Bill Last Date" data-msg="Please Enter Consumer Bill Last Date"/>
            </div>
           <div class="form-group">
                <label class="control-label"> Bill Description(Character Limit 200)</label>
             <textarea class="form-control" rows="8" id="bill_description" name="bill_description"  data-validate="required" data-msg="Please Enter Consumer Bill Description"  placeholder=" Bill Description "><?php if(!empty($biller_details)){ ?> <?php echo $biller_details[0]->bill_description ; } ?></textarea>
             <p style="color:red" id='text_error'></p>
            </div>
          <br>
            <div class="form-group">
                <?php if(!empty($biller_details)){ ?>
                    <input type="hidden" name="biller_id" value="<?php echo $biller_details[0]->biller_id; ?>">
                <?php } ?>
                <input id="submit" type="submit" name="btnSubmit" value="Submit" class="btn btn-success" onclick="">
                 <input style="display: none" id="error_btn" type="button" name="btnSubmit" value="Submit" class="btn btn-success" >
            </div>
        </form>
    </div>
</div>
<script>
function create_invoive_no(){
	var bill_user_name=$("#biller_user_name").val();
	var res = bill_user_name.slice(0,5); 
	var num = Math.floor(Math.random() * 999999) + 199999;
	var invoice_no=res+num;
	$("#bill_invoice_no").val(invoice_no);
	
}
function check_number(val){
	var consumer_no=val;
	if((isNaN(consumer_no))){
		$("#consumer_no_error").text("Please enter only number");
		$("#submit").attr('style','display: none');
		$("#error_btn").attr('style','display: block');
	}else{
		$("#consumer_no_error").text("");
		$("#submit").attr('style','display: block');
		$("#error_btn").attr('style','display: none');
	}
}
	function check_word_limit(){
		var bill_description=$("#bill_description").val();
		var len = bill_description.length;
		if(len<=200){
			document.getElementById("form1").submit();
			//document.getElementById("form1").submit();
		}else{
			$("#text_error").text("Please Enter character less then 200, you enter character "+len);
		}
	}
</script>