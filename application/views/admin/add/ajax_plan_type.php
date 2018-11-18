
<option value="">Select Plan Type</option>
<?php foreach ($plan_type as $value) 
{ ?>
     <option value="<?php if (!empty($value ->plan_category_id)) 
     {
           echo $value ->plan_category_id;  }?>" 
        <?php if (!empty($value -> plan_recharge_category_id) && !empty($recharge_plan[0] -> plan_category_id))
		{
          if ($value -> plan_recharge_category_id == $recharge_plan[0] -> plan_category_id) 
          {
        	echo "selected='selected'";
          }
		}
        ?>>
        <?php echo $value -> plan_category_name; ?></option>
   <?php } ?>