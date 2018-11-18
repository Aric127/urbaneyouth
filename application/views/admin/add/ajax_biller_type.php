 						<option value="">Select Biller Category</option>
                             <?php foreach ($biller as $value) { ?>
                       <option value="<?php if (!empty($value ->biller_category_id)) {
                                    echo $value ->biller_category_id; 
                                }?>" <?php if (!empty($value -> biller_category_id) && !empty($biller_details[0] -> biller_category_id)) {
        if ($value -> biller_category_id == $biller_details[0] -> biller_category_id) {echo "selected='selected'";
        }}
        ?>>
        <?php echo $value -> biller_category_name; ?></option><?php } ?>