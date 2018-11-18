<option value="">Select Operator</option>
<?php foreach ($operator as $value) 
{ ?>
     <option value="<?php if (!empty($value ->operator_id)) 
     {
           echo $value ->operator_id;  }?>" 
        <?php if (!empty($value -> operator_id) && !empty($recharge_plan[0] -> recharge_operator_id))
		{
          if ($value -> operator_id == $recharge_plan[0] -> recharge_operator_id) 
          {
        	echo "selected='selected'";
          }
		}
        ?>>
        <?php echo $value -> operator_name; ?></option>
   <?php } ?>