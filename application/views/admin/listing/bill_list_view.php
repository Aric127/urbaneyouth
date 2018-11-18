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
        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="1000">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Name</th>
                    <th>Consumer Id</th>
                     <th>Email</th>
                    <th>Contact No</th>
					<th>Bill amount</th>	
					<th>Bill Genrate </th>	
					<th>Bill Paid</th>	
                    <th>Status</th>	
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($biller_details)) {
                	
    $n = 1;
                    foreach ($biller_details as $value) { 
             				if($value->bill_pay_status=='1'){
             					$bill="Paid";
             				}else{
             					$bill="Pending";
             				}
                    	?>
            
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                            <td style="width: 8%"><?php echo $value->biller_user_name; ?></td>
                            <td style="width: 12%"><?php echo $value->biller_customer_id_no; ?></td>
                            <td  style="width: 10%"><?php echo $value->biller_user_email; ?></td>
                            <td  style="width: 8%"><?php echo $value->biller_user_contact_no; ?></td>
                             <td  style="width: 8%"><?php echo $value->bill_amount ; ?></td>
                            <td  style="width: 10%"><?php echo $value->bill_invoice_date; ?></td>
                      	    <td  style="width: 10%"><?php echo $value->bill_paid_date; ?></td>
                            <td  style="width: 8%"><?php echo $bill; ?></td> 
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
