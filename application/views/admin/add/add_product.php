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
        <form <?php if(!empty($product_details)){ ?>action="<?php echo site_url('admin/edit_product'); ?>"<?php } else { ?>action="<?php echo site_url('admin/add_product'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
               <div class="form-group">
                <label class="control-label">Select Category</label>
                <select class=" form-control" id="product_category_id" name="product_category_id" onchange="get_filter_attributes(this.value);">
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
            <div id="all_category_attributes" class="form-group">
                <?php if(!empty($attributes_detail)){ ?>
<label class="control-label">Attributes</label>
                <?php if(!empty($attributes_detail)){ foreach ($attributes_detail as $value) { ?>
               <div class="row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="Attribute Name" value="<?php echo $value->attribute_name; ?>" readonly="true"/>
                    </div>
                    <div class="col-md-5">
                        <input type="hidden" name="attribute_id[]" value="<?php echo $value->attribute_id; ?>" readonly="true"/>
                        <select class="form-control" name="attribute_value_id[]" multiple="multiple">
                                <option value="">Select</option>
                                <?php //$explode=explode(',', $value->attribute_value); ?>
                                <?php foreach ($attribute_values as $val) {
                                    if($val ->attribute_id==$value->attribute_id){
                                    ?>
                                
                                <option value="<?php if (!empty($val -> attribute_value_id)) {
                                    
                                    echo $val ->attribute_value_id;    
                                    
                                     
                                }?>" <?php if (!empty($val -> attribute_value_id) && !empty($product_details[0] -> attribute_value_id)) {
                        $explode=explode(',', $product_details[0] -> attribute_value_id);
                        $test=in_array($val -> attribute_value_id, $explode);
                       // print_r($test);
        if ($val -> attribute_value_id == $test) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $val->attribute_value_name; ?></option><?php }} ?>
                                
                            </select>
                    </div>
                   
               </div>
                <?php }} ?>
                <div class="clearfix"></div>
                <?php } ?>
               
            </div>
<!--            <div class="form-group">
                <label class="control-label">Select Brand Type</label>
                <select class=" form-control" id="brand_type_id" name="brand_type_id" data-placeholder="" onchange="get_filter_brand(this.value);">
                                <option value="">Select Brand Type</option>
                                <?php foreach ($brand_type as $value) { ?>
                                <option value="<?php if (!empty($value -> brand_type_id)) {
                                    echo $value -> brand_type_id; 
                                }?>" <?php if (!empty($value -> brand_type_id) && !empty($product_details[0] -> brand_type_id)) {
        if ($value -> brand_type_id == $product_details[0] -> brand_type_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> brand_type_name; ?></option><?php } ?>
                                
                            </select>
            </div>
            
                <div class="form-group">
                <label class="control-label">Select Brand</label>
                <select class=" form-control" id="product_brand_id" name="product_brand_id" data-placeholder="" onchange="get_filter_ideal_for(this.value);">
                                <option value="">Select Brand</option>
                                
                                <option value="<?php if (!empty($product_details[0] ->brand_id)) {
                                    echo $product_details[0] -> brand_id; 
                                }?>" <?php if (!empty($product_details[0] -> brand_id) && !empty($product_details[0] -> product_brand_id)) {
        if ($product_details[0] -> brand_id == $product_details[0] -> product_brand_id) {echo "selected='selected'";
        }}
        ?>>
        <?php if (!empty($product_details[0] ->brand_name)) { echo $product_details[0] -> brand_name; } ?></option>
                                
                            </select>
            </div>
            <div class="form-group">
                <label class="control-label">Select Ideal For</label>
                <select class=" form-control" id="ideal_for_id" name="ideal_for_id" data-placeholder="">
                                <option value="">Select Ideal For</option>
                                <?php foreach ($ideal_for as $value) { ?>
                                <option value="<?php if (!empty($value -> ideal_for_id)) {
                                    echo $value -> ideal_for_id; 
                                }?>" <?php if (!empty($value -> ideal_for_id) && !empty($product_details[0] -> ideal_for_id)) {
        if ($value -> ideal_for_id == $product_details[0] -> ideal_for_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> ideal_name; ?></option><?php } ?>
                                
                            </select>
            </div>-->
           <!---- <div class="form-group">
                <label class="control-label">Product Brand</label>
                <input type="text" name="product_title" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_title; } ?>" class="form-control" data-validate="required" placeholder="Product Brand" />
           </div>--->
            <div class="form-group">
                <label class="control-label">Product Name</label>
                <input type="text" name="product_name" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_name; } ?>" class="form-control" data-validate="required" placeholder="Product Name" />
            </div>
              <div class="form-group">
                <label class="control-label">Product Cost</label>
                <input type="text" name="product_cost" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_cost; } ?>" class="form-control" data-validate="required" placeholder="Product Cost" />
            </div>
            <div class="form-group">
                <label class="control-label">Product Old Cost</label>
                <input type="text" name="product_old_cost" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_old_cost; } ?>" class="form-control" data-validate="required" placeholder="Product Old Cost" />
            </div>
              <div class="form-group">
                <label class="control-label">Product SKU</label>
                <input type="text" name="product_sku" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_sku; } ?>" class="form-control" data-validate="required" placeholder="Product SKU" />
            </div>
             <div class="form-group">
                <label class="control-label">Stock of Product</label>
                <input type="text" name="product_of_stock" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_of_stock; } ?>" class="form-control" data-validate="required" placeholder="Stock of Product" />
            </div>
           <div class="form-group">
                <label class="control-label">Pack Unit</label>
                <input type="text" name="product_pack_unit" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_pack_unit; } ?>" class="form-control" data-validate="required" placeholder="Pack Unit" />
            </div>
           <div class="form-group">
                <label class="control-label">Discount Percent</label>
                <input type="text" name="product_discount_per" <?php if(!empty($product_details)){ ?>value="<?php echo $product_details[0]->product_discount_per; } ?>" class="form-control" placeholder="Discount Percent" />
            </div>
            <div class="form-group">
               <label class="control-label">Product Image</label>
               <?php if(!empty($product_details) && !empty($product_details[0]->product_image)){ ?>
               <br>
               <img src="<?php echo base_url('uploads/product').'/'.$product_details[0]->product_image; ?>" height="90" width="90">
               
               <input type="hidden" name="product_image" value="<?php echo $product_details[0]->product_image; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="product_image" class="form-control" <?php if(!empty($product_details) && !empty($product_details[0]->product_image)){ } else { ?>data-validate="required"<?php } ?> />
           </div>
             <div class="form-group">
                <label class="control-label"> Product Description</label>
             <textarea class="form-control ckeditor" rows="10" name="product_description"  data-validate="required"  placeholder=" Product Description "><?php if(!empty($product_details)){ ?> <?php echo $product_details[0]->product_description ; } ?></textarea>
            </div>
          <br>
            <div class="form-group">
                <?php if(!empty($product_details)){ ?>
                    <input type="hidden" name="product_id" value="<?php echo $product_details[0]->product_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
function get_filter_brand(brand_type_id)
      {
        //  alert(brand_type_id);
         $.ajax({
            'url' :'<?php echo site_url();?>/admin/get_brand_according_brand_type',
            'type':'POST',
            'data':{'brand_type_id':brand_type_id},
            'success' : function(data)
             { 

                document.getElementById('product_brand_id').innerHTML=data;

             }
            });
      }
function get_filter_ideal_for(brand_id)
{
  //  alert(brand_type_id);
   $.ajax({
      'url' :'<?php echo site_url();?>/admin/get_ideal_for_according_brand',
      'type':'POST',
      'data':{'brand_id':brand_id},
      'success' : function(data)
       { 

          document.getElementById('ideal_for_id').innerHTML=data;

       }
      });
}
function get_filter_attributes(category_id)
      {
          //alert(category_id);
         $.ajax({
            'url' :'<?php echo site_url();?>/admin/get_attributes_by_category_id',
            'type':'POST',
            'data':{'category_id':category_id},
            'success' : function(data)
             { 
                // alert(data);
                document.getElementById('all_category_attributes').innerHTML=data;

             }
            });
      }
</script>