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
             <?php if(!empty($church_details)){ ?>Edit Branch<?php } else { ?>Add Branch<?php } ?>
       </div>
    </div>
        
    <div class="panel-body">
     <form enctype="multipart/form-data" <?php if(!empty($church_details)){ ?>action="<?php echo site_url('biller/edit_church'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_branch'); ?>"<?php } ?> role="form1" id="form1" method="post" class="validate"> 

 <!--         <form enctype="multipart/form-data" <?php if(!empty($church_details)){ ?>action="<?php echo site_url('biller/edit_church'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_church'); ?>"<?php } ?> role="form1" id="form1" method="post" class="validate"> -->
          
      		
            
           <!--  <div class="form-group">
                <label class="control-label">Church Name</label>
                <input type="text" name="church_name"  id="church_name" <?php if(!empty($church_details)){ ?>value="<?php echo $church_details[0]->church_name; } ?>" class="form-control" data-validate="required" data-msg="Please Enter Church Name" placeholder="Branch Name" />
            </div> -->
             <div class="form-group">
                <label class="control-label">Branch Area</label>
                <input type="text" name="church_area"  id="church_area" <?php if(!empty($church_details)){ ?>value="<?php echo $church_details[0]->church_area; } ?>" class="form-control" data-validate="required" data-msg="Please Enter Branch Area" placeholder="Branch Area" />
            </div>
           <!--   <div class="form-group">
                <label class="control-label">Branch Area</label>
                	<div id="field"><input autocomplete="off" class="input" id="field1" name="church_area[]" type="text" placeholder="Branch Area" data-items="8" data-validate="required"/><button id="b1" class="btn add-more" type="button">+</button></div>
                
          </div> -->
             <div class="form-group">
               <label class="control-label">Branch Image</label>
               <?php if(!empty($church_details) && !empty($church_details[0]->church_img)){ ?>
               <br>
               <img src="<?php echo base_url('uploads/church_image').'/'.$church_details[0]->church_img; ?>" height="90" width="90">
               
               <input type="hidden" name="church_img" value="<?php echo $church_details[0]->church_img; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="church_img" class="form-control" <?php if(!empty($church_details) && !empty($church_details[0]->church_img)){ } else { ?>data-validate="required"  data-msg="Please Select image"<?php } ?> />
           </div>
           
           </br>
              <div class="col-md-12">
      <table class="table table-bordered text-center" style="border-radius:8px">
        <thead>
          <tr>
          	<th style="background:#39998F; color:#fff" width="50px">&nbsp;</th>
            <th style="background:#39998F; color:#fff">Product</th>
            <th style="background:#77e0d6; color:#fff">Price</th>
          </tr>
        </thead>
        <tbody>
        	<?php if(!empty($product_details)){

            //print_r($product_details);
            //print_r($p);

        		if(!empty($church_details)) {
        	$p=explode(",",$church_details[0]->church_product_ids);
			 }
				$i=0;
        		foreach($product_details as $val){ ?>
          <tr>
          	
          	<td width="50px">

    <input type="checkbox" id="church_product_id" name="church_product_id[]" value="<?php echo $val->church_product_id ?>" <?php if(!empty($church_details)) { if($p[$i]==$val->church_product_id){  ?>checked="checked" <?php } }?> >

              </td>
            <td><?php echo $val->church_product_name; ?></td>
            <td><?php echo $val->church_product_price; ?></td>
          </tr>
          <?php $i++; } }?>
        </tbody>
      </table>
    </div>
           
          <br>
            <div class="form-group">
                <?php if(!empty($church_details)){ ?>
                    <input type="hidden" name="church_area_id" value="<?php echo $church_details[0]->church_area_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success" >
            </div>
        </form>
    </div>
</div>
<style>
	* {
  .border-radius(0) !important;
}

#field {
    margin-bottom:20px;
} 
</style>
<script>
	
	$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input" id="field' + next + '" name="church_area[]" type="text" placeholder="Branch Area"">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
    

    
});
</script>
