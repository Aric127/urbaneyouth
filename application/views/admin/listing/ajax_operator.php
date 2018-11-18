<option value="">Select Operator</option>
<?php 
if(!empty($operator))
{
	foreach ($operator as  $value) { ?>
		<option value="<?php echo $value->operator_id; ?>">
			<?php echo $value->operator_name; ?>
		</option>
	<?php }
}

?>