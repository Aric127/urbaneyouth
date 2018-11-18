<?php if ($this->session->flashdata('status')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('status'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
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
<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panel-title">
            Event List
        </div>
        <div class="panel-options">
        <a onclick="check_event_ticket()" class="btn blue-theme-btn btn-sm" style="color: #fff;">
             <i class="fa fa-plus-circle"></i>
                Add Event
            </a> 
        </div>
        <div id="ticket_error" style="color:red"></div>
    </div>
     <style>
    	.counter-item {
  background: #37313b none repeat scroll 0 0;
  border: 1px solid #ddd;
  border-radius: 3px;
  color: #fff;
  float: left;
  margin: 5px;
  text-align: center;
  width: 70px;
}
    </style>
 <div class="row">
       <div class="col-xs-6 counter-show-on-top">
        		<div class="counter-item">
        			<h5><?php echo $past_event[0]->past_event; ?></h5>
        			<h6>Past Event</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $start_event[0]->start_event; ?></h5>
        			<h6>Start Event</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $upcoming_event[0]->upcoming_event; ?></h5>
        			<h6>Upcoming</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $total_event[0]->total_event; ?></h5>
        			<h6>Total</h6>
        		</div>
        	</div> 
        </div>
    <div id="user_list" class="panel-body">
        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-1").dataTable({
                    aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                    ]
                });
            });
        </script>

        <table id="example-1" class="table-small-font table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Event Name</th>
                     <th>Address</th>
                    <th>Event Start Date</th>
                    <th>Event End Date</th>
                     <th>Event Tickets</th>
                    <th>Sold Tickets</th>
                    <th>Remainning</th>
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($events_list)) {
     
                    $n = 1;
                    foreach ($events_list as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 10%"><?php echo $value->event_name; ?></td>
                                 <td style="width: 15%"><?php echo $value->event_place; ?></td>
                            <td style="width: 10%"><?php echo $value->event_date ; ?></td>
                              <td style="width: 20%"><?php echo $value->event_end_date ; ?></td>
                               <td style="width: 10%"><?php echo $value->event_total_tickets ; ?></td>
                          <td style="width: 10%"><?php echo $value->sold_tickets ; ?></td>
                      	    <td style="width: 10%"><?php echo $value->remaining_ticket ; ?></td>
                            
                            <td style="width: 25%">
                         <a href="<?php echo site_url('biller/edit_event') . '/' . $value->event_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a> 
                           
                       
                                 <?php $status = $value->event_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/ 	event_id/' . $value->event_id; ?>/event_list/event_status/2/event_list" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/event_id/' . $value->event_id; ?>/event_list/event_status/1/event_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?> 
                                  <a href="<?php echo site_url('biller/booking_ticket') . '/' . $value->event_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >View Booking</a>
                               <!-- <a onClick="if(!confirm('Are you sure, You want delete this event?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_product/event_list/event_id/' . $value->event_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>-->
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
<script>
	function check_event_ticket()
	{
		var biller_id='<?php echo $this->session->userdata('biller_id') ?>';
			$.ajax({
		url : '<?php echo site_url('biller/check_event_ticket'); ?>',

		type : "POST",
		data : {
			'biller_id' : biller_id

		},
		success : function(data) {
		
			if(data=='1')
			{
				location.href="<?php echo site_url('biller/add_event'); ?>";
			}else if(data=='2'){
						$("#ticket_error").text("Please Create ticket befor create event");			
			}
			
			}

		
		
	});
	}
</script>