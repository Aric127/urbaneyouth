 <form action="<?php echo base_url('admin/edit_agent') ?>" method="post" id="agent_form">
        <!-- Modal body -->
        <div class="modal-body" >
          
          
<div class="row">
     <input type="hidden" name="user_id" class="form-control" data-validate="required" id="user_id" value="<?php echo $user_id; ?>" readonly="readonly">
     <?php if(!empty($recharge_category))
     { 
        $i=0;
        foreach ($recharge_category as  $value) 
            { ?>
            <div class="col-sm-12">
        <div class="form-group">
            <label class="checkbox-inline">
                <input id="category_<?php echo $value->recharge_category_id;  ?>" name="recharge_category[]" type="checkbox" value="category_<?php echo $value->recharge_category_id;  ?>" <?php if (in_array($value->recharge_category_id, $service_id)) { ?> checked <?php } ?>
                >
                <strong><?php echo $value->category_name;  ?></strong></label>
        </div>
        <div class="show-div-oparator box category_<?php echo $value->recharge_category_id;  ?>">
            <?php if(!empty($operator))
            {

                $k=0;
                foreach ($operator as  $value1) 
                {
                if($value->recharge_category_id==$value1->recharge_category_id){
                     $operator12= array_search($value1->operator_id,$operator_records);

                 ?>
                     <div class="margin-percent-box">
                        <div class="form-group col-md-4 col-xs-12">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="<?php echo $value1->operator_id; ?>" name="operator[]" id="operator_<?php echo $value1->operator_id; ?>" onclick="slect_operator(this.value,'<?php echo $value->recharge_category_id; ?>')" <?php if (in_array($value1->operator_id, $operator_records)) { ?> checked <?php } ?>
                                ><?php echo $value1->operator_name; ?></label>
                        </div>
                        <div class="form-group col-md-8 col-xs-12">
                            <input type="text" name="margin[]" class="form-control" data-validate="required" placeholder="Agent Margin(%)" id="margin_<?php echo $value1->operator_id; ?>" value="<?php if (in_array($value1->operator_id, $operator_records)) { echo $margin_records[$operator12]; } ?>" 
                            <?php if (in_array($value1->operator_id, $operator_records)) { ?>  <?php }else { ?> disabled="disabled" <?php } ?>
                            >
                           
                        </div>
                    </div>
                <?php } $k++; } $i++;
            } ?>
           
            

        </div>
        <hr/>
    </div>
     <?php   }
     } ?>
</div> 
<br>
            <div class="form-group">
               <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>