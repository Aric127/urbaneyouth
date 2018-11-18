
<select  name="attribute_product_id" id="attribute_product_id" data-rule-required="true">
	
    <option value="">Select Category</option>
    <?php foreach ($product as $value) { ?>
    <option value="<?php echo $value->product_id; {
                                    echo $value -> product_id; 
                                }?>" <?php if (!empty($value -> product_id) && !empty($attribute_details[0] -> attribute_product_id)) {
        if ($value -> category_id == $attribute_details[0] -> attribute_product_id) {echo "selected='selected'";
        }} ?>"><?php echo $value->product_name; ?></option>    
    <?php } ?>
</select>
 