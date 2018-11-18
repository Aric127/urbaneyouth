<?php if($this->session->flashdata('error')){ ?>

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> <span class="sr-only">Close</span> </button>
      <strong><?php echo $this->session->flashdata('error'); ?></strong> </div>
  </div>
</div>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> <span class="sr-only">Close</span> </button>
      <strong><?php echo $this->session->flashdata('success'); ?></strong> </div>
  </div>
</div>
<?php } ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">
      <?php if(!empty($biller)){ ?>
      Edit Event
      <?php } else { ?>
      Add Event
      <?php } ?>
    </div>
  </div>
  <div class="panel-body">
    <div class="col-md-6">
      <form class="add_bill" <?php if(!empty($event_details)){ ?>action="<?php echo site_url('biller/edit_event'); ?>"<?php } else { ?>action="<?php echo site_url('biller/add_event'); ?>"<?php } ?> role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputEmail1">Event Name</label>
          <input type="text" class="form-control" id="event_name" name="event_name"  <?php if(!empty($event_details)){ ?>value="<?php echo $event_details[0]->event_name; } ?>" class="form-control" required="required" data-msg="Please Enter Event Name" placeholder="Event Name">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Event Address</label>
          <input type="text" class="form-control" id="store_storelocation"  name="event_place" <?php if(!empty($event_details)){ ?>value="<?php echo $event_details[0]->event_place; } ?>" data-validate="required" placeholder="Address" data-msg="Please Enter Address" required="required">
          <input type="hidden" name="event_place_lat" id="r_lat" value="<?php if (!empty($event_details)) {
               echo $event_details[0]->event_place_lat;}?>">
           <input type="hidden" name="event_place_log" id="r_long" value="<?php if (!empty($event_details)) {
                   echo $event_details[0]->event_place_log;} ?>">
        </div>
      <div class="form-group">
               <label class="control-label">Event Image</label>
               <?php if(!empty($event_details) && !empty($event_details[0]->event_image)){ ?>
               <br>
               <img src="<?php echo base_url('uploads/event').'/'.$event_details[0]->event_image; ?>" height="90" width="90">
               
               <input type="hidden" name="event_image" value="<?php echo $event_details[0]->event_image; ?>">
               <?php } ?>
               <input type="file" accept="image/*" name="event_image" class="form-control" <?php if(!empty($event_details) && !empty($event_details[0]->event_image)){ } else { ?>data-validate="required"  data-msg="Please Select image"<?php } ?>  required="required"/>
           </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Contact No.</label>
          <input type="text" name="event_contact_no" <?php if(!empty($event_details)){ ?>value="<?php echo $event_details[0]->event_contact_no; } ?>" class="form-control" required="required" placeholder="Event Contact No" data-msg="Please Enter Event Contact No">
        </div>
    
    </div>
    
    <div class="col-md-6">
      <div class="add_bill">
      	<div class="invoice-sec">
      		  <h3>Select Event Type</h3>
                <select class=" form-control" id="event_category" name="event_category" required="required" data-msg="Please Select Category" placeholder="" >
                               <option value="">Select Event Category</option>
                     		   <?php if(!empty($biller_category)){
                     		   	foreach ($biller_category as $key => $value) { ?>
										<option value="<?php echo $value->biller_category_id; ?>"><?php echo $value->biller_category_name; ?></option>
								<?php	}
                     		   } ?>
                            </select>
            <h3>Date - Time</h3>
            
        </div>
          
   <div class="clearfix"></div>
  
    <div class='col-md-6' >
        <div class="form-group">
            <div class='input-group date' id='datetimepicker6'>
                <input placeholder="<?php if(!empty($event_details)){ echo $event_details[0]->event_date; } ?>" type='text' class="form-control" required="required" data-msg="Please Select Event Start Date" name="event_date" data-start-date="d" <?php if(!empty($event_details)){ ?>value="<?php echo date("m/d/Y H:i A", strtotime($event_details[0]->event_date)); } ?>"  />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>   Start
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-6'>
        <div class="form-group">
        	
            <div class='input-group date' id='datetimepicker7'>
                <input placeholder="<?php if(!empty($event_details)){ echo $event_details[0]->event_end_date; } ?>" type='text' class="form-control" <?php if(!empty($event_details)){ ?> required="required" data-msg="Please Select Event End Date" <?php } ?> name="event_end_date" data-start-date="d" <?php if(!empty($event_details)){ ?>value="<?php echo  date("m/d/Y H:i A", strtotime($event_details[0]->event_end_date)); } ?>"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>End
                </span>
            </div>
        </div>
    </div>

        <div class="clearfix"></div>
     
         <!-- <div class="form-group">
            <label for="inputEmail3" class="col-sm-6 control-label">Event Start Date</label>
            <div class="col-sm-6">
              <input type="text"  name="event_date" id="event_date" data-start-date="d" <?php if(!empty($event_details)){ ?>value="<?php echo $event_details[0]->event_date; } ?>" class="form-control datepicker" data-validate="required" placeholder="Event Start Date" data-msg="Please Enter Event Start Date" >
            </div>
          </div>
          <div class="form-group">
          	
            <label for="inputPassword3" class="col-sm-6 control-label">Start Time</label>
            <div class="col-sm-6">
              <input type="text" name="event_time" id="event_time" value="" class="form-control timepicker" data-template="dropdown" data-default-time="" data-show-meridian="true" data-minute-step="5" data-validate="required" placeholder="Event Start Time" data-msg="Please Enter Time">
              
            </div>
          </div></br>
           <div class="form-group">
            <label for="inputEmail3" class="col-sm-6 control-label">Event End Date</label>
            <div class="col-sm-6">
              <input type="text"  name="event_end_date" id="event_end_date" data-start-date="d" <?php if(!empty($event_details)){ ?>value="<?php echo $event_details[0]->event_end_date; } ?>" class="form-control datepicker" data-validate="required" placeholder="Event End Date" data-msg="Please Enter Event End  Date" >
            </div>
          </div>
           <div class="form-group">
          	
            <label for="inputPassword3" class="col-sm-6 control-label">End Time</label>
            <div class="col-sm-6">
              <input type="text" name="event_end_time" id="event_end_time" value="" class="form-control timepicker" data-template="dropdown" data-default-time="" data-show-meridian="true" data-minute-step="5" data-validate="required" placeholder="Event End Time" data-msg="Please Enter Time">
              
            </div>
          </div>-->
        
      </div>
    </div>
    <div class="col-md-12">
      <table class="table table-bordered text-center" style="border-radius:8px">
        <thead>
          <tr>
          	<th style="background:#39998F; color:#fff" width="50px">&nbsp;</th>
            <th style="background:#39998F; color:#fff">Name</th>
            <th style="background:#60C4BA; color:#fff">Price</th>
            <th style="background:#77e0d6; color:#fff">Limit</th>
          </tr>
        </thead>
        <tbody>
        	<?php if(!empty($events_tickets) && empty($event_details)){
        		foreach($events_tickets as $val){ ?>
          <tr>
          	<td width="50px"><input type="checkbox" name="event_tickets_id[]" id="event_ticket<?php echo $val ->events_tickets_id ?>"  value="<?php echo $val ->events_tickets_id ?>" onClick="bill_amount_value(this);" >
          		
          	</td>
            <td><?php echo $val->events_tickets_name; ?>
            	<input type="hidden"  id="event_tickets_name" name="event_tickets_name[]" value="<?php echo $val->events_tickets_name; ?>"/>
            </td>
            <td><?php echo $val->events_tickets_price; ?>
            	<input type="hidden"  id="ticket_price" name="ticket_price[]" value="<?php echo $val->events_tickets_price; ?>"/>
            </td>
            <td><input type="text" value="0" id="ticket_limit<?php echo $val ->events_tickets_id ?>" name="ticket_limit[]"/ readonly=""></td>
          </tr>
          <?php } }else if(!empty($event_details)){
   foreach($event_details[0]->event_ticket as $ticket)
   { 	?>
   	 <tr>
          	<td width="50px"><input type="checkbox" name="event_tickets_id[]" checked="checked"  disabled=""></td>
            <td><?php echo $ticket->events_tickets_name; ?> </td>
            <td><?php echo $ticket->events_tickets_price; ?></td>
            <td><?php echo $ticket->event_ticket_limit; ?></td>
          </tr>
 <?php  } }?>
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
    	
            <div class="form-group">
             <label for="comment">Event Description</label>
 			 <textarea class="form-control textarea-height" rows="5" id="event_desc" name="event_desc"  required="required" data-msg="Please Enter Event Description"  placeholder=" Event Description "><?php if(!empty($event_details)){ ?> <?php echo $event_details[0]->event_desc ; } ?></textarea>
            </div>
      
    </div>
    <div class="col-md-12">
    	<div class="form-group">
		<?php if(!empty($event_details)){ ?>
            <input type="hidden" name="event_id" value="<?php echo $event_details[0]->event_id; ?>">
        <?php } ?>
        <input id="submit" type="submit" name="submit" value="Submit" class="btn btn-success" onclick="">
       
    </div>
    </div>
      </form>
  </div>
</div>
<!-- Imported scripts on this page -->
<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/timepicker/bootstrap-timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>                       
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script>


	var total=0;
	function bill_amount_value(item)
	{
	var c_bill=$("#event_ticket"+item.value).val();
	
		 if(item.checked){
		 $("#ticket_limit"+c_bill).attr("readonly", false);
       //   $("#ticket_limit").removeAttribute('readonly');
        }else{
            $("#ticket_limit"+c_bill).attr("readonly", true);
             $("#ticket_limit"+c_bill).val(0);
        }
       
       
	}
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDgWoQhtqx3_E-AKLuPnwWWQpIgIU63Jtg"></script>

<script type="text/javascript">
   google.maps.event.addDomListener(window, 'load', function () {
       var places = new google.maps.places.Autocomplete(document.getElementById('store_storelocation'));
       google.maps.event.addListener(places, 'place_changed', function () {

//             document.getElementById('userlat').value='';
//                document.getElementById('userlong').value='';

           var place = places.getPlace();
           var address = place.formatted_address;
           var latitude = place.geometry.location.lat();
           var longitude = place.geometry.location.lng();
           var mesg = "Address: " + address;
           mesg += "\nLatitude: " + latitude;
           mesg += "\nLongitude: " + longitude;

           document.getElementById('r_lat').value = latitude;
           document.getElementById('r_long').value = longitude;

       });
   });
  // Jquery( document ).ready(function($) {
    $('#datetimepicker6').datetimepicker({
   
    //minDate: moment().add(1, 'd').toDate()
    });
            $('#datetimepicker7').datetimepicker({
                useCurrent: false,
                minDate: moment().add(1, 'd').toDate(),
               
                //Important! See issue #1075
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
//});

   </script>
   <script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/timepicker/bootstrap-timepicker.min.js"></script>