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
        <form <?php if(!empty($product_details)){ ?>action="<?php echo site_url('biller/edit_product'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_product'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
      		
            
            <div class="form-group">
                <label class="control-label">Product Name</label>
                <input type="text" name="product_name"  id="product_name" onblur="create_invoive_no()" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_name; } ?>" class="form-control" data-validate="required" data-msg="Please Enter Product Name" placeholder="Product Name" />
            </div>
             <div class="form-group">
                <label class="control-label">Product Code</label>
                <input type="text" name="product_code" id="product_code" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_code; } ?>" class="form-control" readonly=""/>
            </div>
            <div class="form-group">
                <label class="control-label">Price</label>
                <input type="text" name="product_price" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_price; } ?>" class="form-control" data-validate="required" placeholder="Product price" data-msg="Please Enter price"/>
            </div>
             
           <div class="form-group">
                <label class="control-label"> Product Description(Character Limit 200)</label>
             <textarea class="form-control" rows="8" id="product_desc" name="product_desc"  data-validate="required" data-msg="Please Enter product description"  placeholder=" Product Description "><?php if(!empty($product_details)){ ?> <?php echo $product_details[0]->product_desc ; } ?></textarea>
             <p style="color:red" id='text_error'></p>
            </div>
          <br>
            <div class="form-group">
                <?php if(!empty($product_details)){ ?>
                    <input type="hidden" name="product_id" value="<?php echo $product_details[0]->product_id; ?>">
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