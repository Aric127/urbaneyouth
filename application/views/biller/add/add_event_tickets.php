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
             <?php if(!empty($event_ticket)){ ?>Edit Ticket<?php } else { ?>Add Ticket<?php } ?>
       </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($event_ticket)){ ?>action="<?php echo site_url('biller/edit_event_ticket'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_event_ticket'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
      		
            
            <div class="form-group">
                <label class="control-label">Product Name</label>
                <input type="text" name="events_tickets_name"  id="product_name" onblur="create_invoive_no()" <?php if(!empty($event_ticket)){ ?>value="<?php echo $event_ticket[0]->events_tickets_name; } ?>" class="form-control" data-validate="required" data-msg="Please Enter Ticket Name" placeholder="Ticket Name" />
            </div>
             <div class="form-group">
                <label class="control-label">Ticket Code</label>
                <input type="text" name="events_tickets_no" id="product_code" <?php if(!empty($event_ticket)){ ?>value="<?php echo $event_ticket[0]->events_tickets_no; } ?>" class="form-control" readonly="" data-validate="required"/>
            </div>
            <div class="form-group">
                <label class="control-label">Price</label>
                <input type="text" name="events_tickets_price" <?php if(!empty($event_ticket)){ ?>value="<?php echo $event_ticket[0]->events_tickets_price; } ?>" class="form-control" data-validate="required" placeholder="Ticket price" data-msg="Please Enter price"/>
            </div>
              <div class="form-group">
               <label class="control-label">Ticket Image</label>
               <?php if(!empty($event_ticket) && !empty($event_ticket[0]->events_tickets_image)){ ?>
               <br>
               <img src="<?php echo base_url('event_ticket_image/church_image').'/'.$event_ticket[0]->events_tickets_image; ?>" height="90" width="90">
               
               <input type="hidden" name="events_tickets_image" value="<?php echo $event_ticket[0]->events_tickets_image; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="events_tickets_image" class="form-control" <?php if(!empty($event_ticket) && !empty($event_ticket[0]->events_tickets_image)){ } else { ?>data-validate="required"  data-msg="Please Select image"<?php } ?> />
           </div><br>
           <div class="form-group">
                <label class="control-label"> Ticket Description(Character Limit 200)</label>
             <textarea class="form-control" rows="8" id="events_tickets_desc" name="events_tickets_desc" data-validate="required"  data-validate="required" data-msg="Please Enter product description"  placeholder=" Ticket Description "><?php if(!empty($event_ticket)){ ?> <?php echo $event_ticket[0]->events_tickets_desc ; } ?></textarea>
             <p style="color:red" id='text_error'></p>
            </div>
          <br>
            <div class="form-group">
                <?php if(!empty($event_ticket)){ ?>
                    <input type="hidden" name="events_tickets_id" value="<?php echo $event_ticket[0]->product_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success" >
            </div>
        </form>
    </div>
</div>
<script>
function create_invoive_no(){
	var product_name=$("#product_name").val();
	var res = product_name.slice(0,5); 
	var num = Math.floor(Math.random() * 999999) + 199999;
	var invoice_no=res+num;
	$("#product_code").val(invoice_no);
	
}
	function check_word_limit(){
		var product_desc=$("#product_desc").val();
		var len = product_desc.length;
		if(len<=200){
			alert();
			document.getElementById("form1").submit();
			//document.getElementById("form1").submit();
		}else{
			$("#text_error").text("Please Enter character less then 200, you enter character "+len);
		}
	}
</script>