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
            Event Booking List
        </div>
        <div class="panel-options">
       
        </div>
        <div id="ticket_error" style="color:red"></div>
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
                    <th>User Name</th>
                     <th>Email</th>
                    <th>Contact</th>
                    <th>Amount(&#8358;)</th>
                    <th>Date</th>
                     <th>Transaction ID</th>
                     <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($booking_user)) {
       
                    $n = 1;
                    foreach ($booking_user as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 10%"><?php echo $value->user_name; ?></td>
                             <td style="width: 24%"><?php echo $value->user_email; ?></td>
                             <td style="width: 15%"><?php echo $value->user_contact_no ; ?></td>
                              <td style="width: 10%"><?php echo $value->booking_ticket_price; ?></td>
                             <td style="width: 15%"><?php echo $value->transaction_date ; ?></td>
                           <td style="width: 20%"><?php echo $value->transaction_id ; ?></td>
                           <td style="width: 20%"><a href="<?php echo site_url('biller/view_ticket_details') . '/' . $value->booking_event_tickets_id.'/'.$value->user_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >View</a>
                               
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