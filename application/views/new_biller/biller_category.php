<option value="">Select Category</option>
<?php
if(!empty($biller_cat)){
	foreach ($biller_cat as  $value) 
	{ ?>
		<option value="<?php echo $value->biller_category_id; ?>">
			<?php echo $value->biller_category_name; ?>
	  </option>
<?php	}
}
?>