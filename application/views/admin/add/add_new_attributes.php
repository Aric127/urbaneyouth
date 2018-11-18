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
             <?php if(!empty($category_details)){ ?>Edit Attribute<?php } else { ?>Add Attribute<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        
            <form <?php if(!empty($brand_details)){ ?>action="<?php echo site_url('admin/edit_brand'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_new_attributes'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Select Category</label>
                <select class=" form-control" id="category_id" name="category_id" data-placeholder="" data-validate="required">
                                <option value="">Select Category</option>
                                <?php foreach ($category as $value) { ?>
                                <option value="<?php if (!empty($value -> category_id)) {
                                    echo $value -> category_id; 
                                }?>" <?php if (!empty($value -> category_id) && !empty($product_details[0] -> product_category_id)) {
        if ($value -> category_id == $product_details[0] -> product_category_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> category_name; ?></option><?php } ?>
                                
                            </select>
            </div>
<!--            <div class="form-group">
                <label class="control-label">Category Name</label>
                <input type="text" name="category_name" <?php if(!empty($category_details)){ ?>value="<?php echo $category_details[0]->category_name; } ?>" class="form-control" data-validate="required" placeholder="Category Name" />
            </div>-->
<!--            <div class="input_fields_wrap">
    <button class="btn btn-info add_field_button">Add More Fields</button>
    
    <div class="form-group"><input type="text" name="mytext[]" class="form-control"><input type="text" name="mytext1[]" class="form-control"></div>
</div>-->
            <div class="form-group input_fields_wrap">
                <label class="control-label">Attributes</label>
                <div class="clearfix"></div>
               <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="attribute_name1" class="form-control" placeholder="Attribute Name" data-validate="required">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="attribute_value1" class="form-control" placeholder="Attribute Value" data-validate="required">
                    </div>
                   <div class="col-md-2">
                       <button style="float:right;" class="btn btn-info add_field_button"><i class="fa fa-plus"></i></button>
                   </div>
                   </div>
               </div>
                <div class="clearfix"></div>
               
            </div>
          <br/>
            <div class="form-group">
                <?php if(!empty($category_details)){ ?>
                    <input type="hidden" name="category_id" value="<?php echo $category_details[0]->category_id; ?>">
                <?php } ?>
                    <input type="hidden" name="total_data" id="total_data" value="1">
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>

<script>
$(document).ready(function() {
   // var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
       // if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row"><div class="col-md-5"><input type="text" name="attribute_name'+x+'" class="form-control" placeholder="Attribute Name" data-validate="required"/></div><div class="col-md-5"><input type="text" name="attribute_value'+x+'" class="form-control" placeholder="Attribute Value" data-validate="required"/></div><a style="float:right; margin-right:15px;" href="#" class="btn btn-danger remove_field"><i class="fa fa-close"></i></a></div>'); //add input box <a href="#" class="remove_field">Remove</a>
            $("#total_data").val(x);
      //  }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--; $("#total_data").val(x);
    })
});
</script>

