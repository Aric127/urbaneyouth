
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <?php if ($this->session->flashdata('status')) { ?>
          <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> <?php echo $this->session->flashdata('status'); ?></span>
                  </div>
          <?php } ?>
          <?php if ($this->session->flashdata('error')) { ?>
                             <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                              </button>
                              <span>
                                 <?php echo $this->session->flashdata('error'); ?></span>
                            </div>
            <?php } ?>
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Event List</h4>
                   <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add New Event
                  </button>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>SNo</th>
                          <th>Event Name</th>
                          <th>Event Address</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Tickets</th>
                          <th>Sold Tickets</th>
                          <th>Remains</th>
                          <th>Image</th>
                         <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                <?php if (!empty($events_list)) {
       
                    $n = 1;
                    foreach ($events_list as $value) { 
					$img=explode(",",$value->event_image);
					?>
            
                        <tr>
                           <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 10%"><?php echo $value->event_name; ?></td>
                                 <td style="width: 15%"><?php echo $value->event_place; ?></td>
                            <td style="width: 10%"><?php echo $value->event_date ; ?></td>
                              <td style="width: 20%"><?php echo $value->event_end_date ; ?></td>
                               <td style="width: 10%"><?php echo $value->event_total_tickets ; ?></td>
                          <td style="width: 10%"><?php echo $value->sold_tickets ; ?></td>
                            <td style="width: 10%"><?php echo $value->remaining_ticket ; ?></td>
                           <td style="width: 15%"><img src="<?php echo event_image.'/'.$img[0]; ?>" height="90" width="90"></td>
                          <td> <?php $status = $value->event_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('event/change_status') . '/event_id/' . $value->event_id; ?>/event_list/event_status/2/event_list" class="btn btn-success btn-sm btn-icon icon-left"><i class="material-icons">check</i></a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('event/change_status') . '/event_id/' . $value->event_id; ?>/event_list/event_status/1/event_list" class="btn btn-default btn-sm btn-icon icon-left"><i class="material-icons">check</i></a>
                                <?php } ?> </td>
                            
                         
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
                      
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
          </div>
          <!-- end row -->
        </div>
      </div>
        <div class="modal fade event" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 700px!important;">
                          <div class="modal-content">
                          
                            <div class="modal-body">
                            
                <div class="card ">
                 
              <div class="wizard-container">
               
              <div class="card card-wizard" data-color="rose" id="wizardProfile">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                              </button>
                <form method="post" action="<?php echo base_url('event/add_event'); ?>" class="validate" enctype="multipart/form-data">
                  <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                  <div class="card-header text-center">
                    <h3 class="card-title">
                      Build Your Event
                    </h3>
                    <h5 class="card-description"></h5>
                  </div>
                  <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
                          Event Details
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#account" data-toggle="tab" role="tab">
                          Venue
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#ticket" data-toggle="tab" role="tab">
                          Add Ticket
                        </a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" href="#descripton" data-toggle="tab" role="tab">
                          Description
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" style="padding-top: 0px;">
                      <div class="tab-pane active" id="about">
                        <h5 class="info-text"> Let's start with the event information</h5>
                        <div class="row justify-content-center">
                           <div class="col-sm-12">
                            <div class="input-group form-control-lg col-md-6">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="event_name" class="bmd-label-floating">Event Name </label>
                                <input type="text" class="form-control" id="event_name" name="event_name" required>
                              </div>
                            </div>
                            <div class="input-group form-control-lg col-md-6">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">place</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="event_place" class="bmd-label-floating">Event Address</label>
                                <input type="text" class="form-control" id="event_place" name="event_place" required>
                                <input type="hidden" name="event_place_lat" id="r_lat" value="">
                                <input type="hidden" name="event_place_log" id="r_long" value="">
                              </div>
                            </div>
                          </div>
                           <div class="col-sm-12">

                           <div class="input-group form-control-lg col-md-6">
                            <!-- <div class="input-group form-control-lg"> -->
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">phone</i>
                                </span>
                              </div>
                              <div class="form-group">
                            	<label for="event_contact_no" class="bmd-label-floating">Organiser Contact No.</label>
                                <input type="phone" class="form-control" id="event_contact_no" name="event_contact_no" required>
                              </div>
                            <!-- </div> -->
                          </div>
                           <div class="input-group form-control-lg col-md-6">
                           <!--  <div class="input-group form-control-lg"> -->
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">record_voice_over</i>
                                </span>
                              </div>
                              <div class="form-group">
                            	<label for="event_category" class="bmd-label-floating">Event Type</label>
                                <input type="text" class="form-control" id="event_category" name="event_category" required>
                              </div>
                            <!-- </div> -->
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="account">
                      
                         <div class="row justify-content-center">
                       
                          <div class="col-sm-12">
                            <div class="input-group form-control-lg col-md-12">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">add_photo_alternate</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Event image </label>
                                <input type="file" class="file" name="event_image[]" id="event_image" multiple="multiple" required>
                              </div style="position: static!important;
                              opacity: 1!important;">
                            </div>
                            
                          </div>
                               <div class="col-sm-12">
                                <div class="input-group form-control-lg col-md-12">
                                   <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">date_range</i>
                                </span>
                              </div>
                           <div class="form-group">
                            <div class="input-group form-control-lg col-md-6">
                              <div class="card " style="margin: 0;">
               					 <div class="card-header card-header-rose card-header-text">
                 					<h4 class="card-title">Date Start</h4>
                				</div>
				                <div class="card-body ">
				                  <div class="form-group">
				                    <input type="text" class="form-control datetimepicker" name="event_date" id="event_date" value="">
				                  </div>
				                </div>
				              </div>
                            </div>
				            <div class="input-group form-control-lg col-md-6">
				               <div class="card " style="margin: 0;">
				                <div class="card-header card-header-rose card-header-text">
				                 <i class="material-icons">today</i><h4 class="card-title"> Date End</h4>
				                </div>
				                <div class="card-body ">
				                  <div class="form-group">
				                    <input type="text" name="event_end_date" id="event_end_date" class="form-control datetimepicker" value="">
				                  </div>
				                </div>
				              </div>
				           </div>
                          </div>
                          </div>
                        </div>
                           <div class="col-lg-12">
                             <div class="input-group form-control-lg col-md-12">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="contact_person_name" class="bmd-label-floating">Contact Person Name </label>
                                <input type="text" class="form-control" name="contact_person_name" id="contact_person_name" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="ticket">
                        <div class="row justify-content-center">
                          <div class="col-md-12">
                                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th></th>
                          <th> Name</th>
                          <th class="text-right">Price</th>
                          <th class="text-center">Limit</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php if(!empty($events_tickets))
                      	{
                      		$i=1;
                      		foreach ($events_tickets as  $value) { ?>
                      			<tr>
		                          <td class="text-center"><?php echo $i; ?></td>
		                          <td>
		                            <div class="form-check">
		                              <label class="form-check-label">
		                                <input class="form-check-input" type="checkbox" value="<?php echo $value->events_tickets_id ?>" name="event_tickets_id[]" id="event_tickets_id">
		                                <span class="form-check-sign">
		                                  <span class="check"></span>
		                                </span>
		                              </label>
		                            </div>
		                          </td>
		                          <td><?php echo $value->events_tickets_name ?> </td>
		                          <td class="text-right">&euro; <?php echo $value->events_tickets_price; ?></td>
		                          <td class="text-right"><input type="text" name="ticket_limit[]" id="ticket_limit"></td>
                        		</tr>
                      	<?php $i++;	}
                      	} ?>
                        
                   
                        
                      </tbody>
                    </table>
                  </div>
                          </div>
                          
                         
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="descripton">
                    	
                         <div class="row justify-content-center">
                        	
                      </div> 
                          <div class="row justify-content-center">
                          		 <div class="col-sm-12">
                            <div class="form-group">
                              <label>Event Description</label>
                             <textarea class="form-control textarea-height" rows="5" id="event_desc" name="event_desc" required="required" data-msg="Please Enter Invoice Bill Description" aria-required="true"></textarea>
                            </div>
                          </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="mr-auto">
                      <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                    </div>
                    <div class="ml-auto">
                      <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
                      <input type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="submit" value="Add" style="display: none;">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>
                      <!--upload popu -->
 <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-notice" style="max-width: 700px;">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="width: auto!important;float: left;    line-height: 47px;">UPLOAD PRODUCT EXCEL</h4>
                  <a href="<?php echo base_url('uploads/demo_excel/product_excel.xlsx'); ?>" class="btn btn-raised btn-primary" style="color: #fff;">
                <i class="fa-plus-circle"> </i> Sample Excel
            </a> 
                            
                </div>
                
                <div class="card-body">
                  <form action="<?php echo site_url('biller/upload_product_excel'); ?>" role="form" id="form1" method="POST" class="validate" enctype="multipart/form-data">
                    <div class="card-block">
                       <div class="input-group mb-3">
                      
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="product_excel" name="product_excel" placeholder="Upload product Excel" required="">
                        <label class="custom-file-label" for="inputGroupFile01" style="font-size: 12px;color: #ccc;font-size: 12px;color: #777;line-height: 25px;">Upload product Excel...</label>
                      </div>
                    </div> 
                    <button type="submit" class="btn btn-raised btn-primary">
                 Upload
                              </button>
                    </div>
                  </form>
                </div>
            </div>
              <!--  end card  -->
            </div>
                            </div>
                            
                          </div>
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
</script>
  <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      }
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="http://www.urbaneyouth.com/biller_assets/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="http://www.urbaneyouth.com/biller_assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"/>
</script>
<!-- <input id="datetimepicker" type="text" value=""> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#event_date').datetimepicker({
          minDate: new Date()
        });
    });
     $(document).ready(function() {
      
        $('#event_end_date').datetimepicker({
          minDate: new Date()
        });
    });
</script>
<style>
  .moving-tab{width: 23%!important;    margin-left: 12px;}
  .card-wizard .moving-tab{left: 0px!important;}
.dropdown.bootstrap-select {
width: 
100%!important
;}
#account .card {
    box-shadow: none!important;
}
#account h4.card-title {
    font-size: 14px;
    color: #aaa;
    text-shadow: none;
    margin: 0!important;
    height: 20px;
}
#account .card-header.card-header-rose.card-header-text {
    height: 20px;
}
.ml-auto, .mx-auto {
    /* margin-left: auto !important; */
    margin: 10px!important;
}
.card-footer {
    width: 97%;
        padding-top: 0!important;
}
.card .card-body .form-group{margin-top: 0!important;}
div#descripton {
    margin-top: 40px;
}
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBF9n3fRxuqQJpMsEGDtvnkS0mtJXZrpB8"></script>

<script type="text/javascript">
   google.maps.event.addDomListener(window, 'load', function () {
       var places = new google.maps.places.Autocomplete(document.getElementById('event_place'));
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
 </script>