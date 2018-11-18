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
             <?php if(!empty($shipping_schedule_date_details)){ ?>Edit Shipping Schedule Date<?php } else { ?>Add Shipping Schedule Date<?php } ?>
             
        </div>
    </div>
        
    <div class="panel-body">
        <form <?php if(!empty($shipping_schedule_date_details)){ ?>action="<?php echo site_url('admin/edit_shipping_schedule_date'); ?>"<?php } else { ?>action="<?php echo site_url('admin/edit_shipping_schedule_date'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label">Select Shipping Schedule Date</label>
                 
                <input type="text" name="shipping_schedule_date_count" <?php if(!empty($shipping_schedule_date_details)){ ?>value="<?php echo $shipping_schedule_date_details[0]->shipping_schedule_date_count; } ?>" class="form-control" data-validate="required" placeholder="Schedule day" />
          
            </div>
           
          <br>
            <div class="form-group">
                <?php if(!empty($shipping_schedule_date_details)){ ?>
                    <input type="hidden" name="shipping_schedule_id" value="<?php echo $shipping_schedule_date_details[0]->shipping_schedule_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>

function get_filter_data(data)
      {
         // alert(data);
            var count;
            if(data==1){
            count=1;
            } else if(data==2){
            count=2;
            } else if(data==3){
            count=3;
            } else if(data==4){
            count=4;
            } else if(data==5){
            count=7;
            } else if(data==6){
            count=14;
            }
           // alert(count);
         $('#shipping_schedule_date_count').val(count);
      }
</script>
