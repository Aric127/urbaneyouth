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
            Donation User List
        </div>
        
    </div>

    <div id="user_list" class="panel-body">
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

        <table id="example-1" class="table table-striped table-bordered table-small-font" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Church Name</th>
                    <th>User Name</th>
                    <th>Service Offer</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Image</th>
                  <th>Status</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($donation_details)) {
       
                    $n = 1;
                    foreach ($donation_details as $value) { ?>
            
                        <tr>
                            <td style="width: 8%"><?php echo $n; ?></td>
                             <td style="width: 12%"><?php echo $value->church_name; ?></td>
                               <td style="width: 15%"><?php echo $value->user_name; ?></td>
                            <td style="width: 15%"><?php echo $value->church_product_name ; ?></td>
                             <td style="width: 10%"><?php echo $value->church_product_price ; ?></td>
                              <td style="width: 10%"><?php echo $value->donate_datetime ; ?></td>
                           <td style="width: 15%"><img src="<?php echo church_image.'/'.$value->church_img; ?>" height="90" width="90"></td>
                      	   <td style="width: 25%"><?php  if($value->payment_status=='1'){ echo "Success"; }else if($value->payment_status=='3'){ echo "Failed"; } ; ?></td>
                            
                         
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
