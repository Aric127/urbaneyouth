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
             <?php if(!empty($product_details)){ ?>Edit Product<?php } else { ?>Add Product<?php } ?>
       </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($product_details)){ ?>action="<?php echo site_url('biller/church_edit_product'); ?>"<?php } else { ?>action="<?php echo site_url('biller/church_add_product'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
      		
            
            <div class="form-group">
                <label class="control-label">Product Name</label>
                <input type="text" name="church_product_name"  id="product_name" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->church_product_name; } ?>" class="form-control" data-validate="required" data-msg="Please Enter Product Name" placeholder="Product Name" />
            </div>
            
            <div class="form-group">
                <label class="control-label">Price</label>
                <input type="text" name="church_product_price" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->church_product_price; } ?>" class="form-control" placeholder="Product price" data-msg="Please Enter price"/>
            </div>
             
           
          <br>
            <div class="form-group">
                <?php if(!empty($product_details)){ ?>
                    <input type="hidden" name="church_product_id" value="<?php echo $product_details[0]->church_product_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success" >
            </div>
        </form>
    </div>
</div>
<script>
function create_invoive_no(){
	var product_name=$("#product_name").val();
	var res = product_name.slice(0,5); 
	var num = Math.floor(Math.random() * 999999) + 199999;
	var invoice_no=res+num;
	$("#product_code").val(invoice_no);
	
}
	function check_word_limit(){
		var product_desc=$("#product_desc").val();
		var len = product_desc.length;
		if(len<=200){
			alert();
			document.getElementById("form1").submit();
			//document.getElementById("form1").submit();
		}else{
			$("#text_error").text("Please Enter character less then 200, you enter character "+len);
		}
	}
</script>