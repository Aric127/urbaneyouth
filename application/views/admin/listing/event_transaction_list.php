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
         Event Transaction List
        </div>
        
    </div>
    
    <div class="clearfix evetrans-row">

            
	    <div class="col-md-3">
	    <label class="control-label">Date Wise</label>
	    <div class="clearfix"></div>
	    <input type="hidden" id="input_test" value=""/>
	   
	    <input type="text" name="txt" id="selected_date" class="daterange form-control add-ranges" data-format="MMMM D, YYYY" data-start-date="<?php echo date("M d,Y"); ?>" data-end-date=" <?php echo date("M d,Y"); ?>" value=""/> 
	    </div>
	 
	   
	    <div class="col-md-3">
            <label class="control-label">Transaction Status</label>

                <select id="trans_status" class="form-control input-dark" name="trans_status" data-validate="required" >
                                <option value="">--- Select ---</option>
								<option value="1">Success</option>
				                <option value="2">Pending</option>
								<option value="3">Failed</option>
				
				
                </select>
            </div>
	
	    <div class="col-md-3">
	    <label class="control-label">&nbsp;</label>
	    <div class="clearfix"></div>
	    <input type="button" id="sub" class="btn btn-success pull-left" value="Submit" onclick="transaction_filter()">

	    &nbsp; &nbsp;
	    <input type="submit" style="display: none;" id="excel" class="btn btn-success pull-left" value="Export"/>

	    </div>

        </div>

    <div id="ajax_transaction_list" class="panel-body">
        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-1").dataTable({
                	dom: 'Bfrtip',
                    buttons: ['excel', 'print'],
                    aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                    ]
                });
                $( "a.buttons-excel" ).removeClass( "dt-button" ).addClass( "btn btn-blue btn-sm btn-icon" );
                $( "a.buttons-pdf" ).removeClass( "dt-button" ).addClass( "btn btn-blue btn-sm btn-icon" );
                $( "a.buttons-print" ).removeClass( "dt-button" ).addClass( "btn btn-blue btn-sm btn-icon" );
            });
        </script>

       <div class="table-responsive"> 
        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Event Name</th>
                    <th>Transaction Type</th>
					<th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Transaction Date</th>
                    <th>Transaction Status</th>
                   
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($transaction_record)) {
    //   print_r($wallet_transaction);
                    $n = 1;
                    foreach ($transaction_record as $value) {
                    	$trans_type=$value->wt_category;
						if($trans_type==16)
						{
							$trans_type="Event Ticket Booking";
						}
                        ?>
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                            <td style="width: 10%"><?php echo $value->user_name; ?></td>
                            <td style="width: 20%"><?php echo $value->user_email; ?></td>
                            <td style="width: 20%"><?php echo $value->event_name; ?></td>
                            <td  style="width: 10%"><?php echo $trans_type ?></td>
                        	 <td style="width: 20%"><?php echo $value->transaction_id;?></td>
                            <td style="width: 15%"><?php echo $value->wt_amount; ?></td>
                            <td style="width: 15%"><?php echo $value->wt_datetime;?></td>
                            <td style="width: 10%" <?php if($value->wt_status=='2'){?> style="color: red" <?php } ?>><?php if($value->wt_status=='1'){echo "Success";}else if($value->wt_status=='3'){echo "Failed";}else if($value->wt_status=='2'){echo "Pending";}?></td>
                            
                            <td style="width: 10%">
                              <a  href="<?php echo site_url('admin/event_perticuler_transaction') . '/'. $value->wt_id. '/'. $value->wt_user_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">View</a>
                           
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
       </div>

    </div>

</div>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/multiselect/css/multi-select.css">

<!-- Bottom Scripts -->

<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>


<!-- Imported scripts on this page -->
<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/js/multiselect/js/jquery.multi-select.js"></script>
<script>

function transaction_filter()
    {
	
      $date = $("#selected_date").val();
      $trans_status = $("#trans_status").val();
	
        
         if($date !='' || $trans_status !='' )
         {
            
              $.post("<?php echo site_url(); ?>/admin/ajax_event_transaction",{"date":$date,"transaction_status":$trans_status},
            function(data){
            
     $("#ajax_transaction_list").html(data);
		
            });
            
        }
        else
        {
             alert("Please select at least one");
        }
    }

</script>