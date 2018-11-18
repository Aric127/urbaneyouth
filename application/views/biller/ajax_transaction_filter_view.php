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

        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                            <td style="width: 10%" <?php if($value->wt_status=='2'){?> style="color: red" <?php } ?>><?php if($value->wt_status=='1'){echo "Success";}else if($value->wt_status=='3'){echo "Failed".' '.$ref_sttaus;}else if($value->wt_status=='2'){echo "Pending";}?></td>
                            
                            <td style="width: 10%">
                              <a  href="<?php echo site_url('biller/event_perticuler_transaction') . '/'. $value->wt_id. '/'. $value->wt_user_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">View</a>
                           
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>