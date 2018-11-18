

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
<?php } $today=date('Y-m-d H:i:s');?>
<style type="text/css">
 span.bold-red {
    color: red;
    font-weight: bold;
}
 span.bold-green {
    color: green;
    font-weight: bold;
}
 span.bold-yellow {
    color: orange;
    font-weight: bold;
}

</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            Agent List
        </div>
       <!--  <div class="panel-options">
            <a href="<?php echo site_url('admin/add_agent'); ?>" class="btn blue-theme-btn" style="color: #fff;">
            <i class="fa fa-plus-circle"></i>
                Add Agent
            </a> 
        </div> -->
    </div>
     <div class="row panel-body">
       <div class="col-xs-6 counter-show-on-top">
         
        		<!-- <div class="counter-item">
        			<h5><?php echo $day_user[0]->day_user; ?></h5>
        			<h6>Today</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $week_user[0]->week_user; ?></h5>
        			<h6>Weekly</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $month_user[0]->month_user; ?></h5>
        			<h6>Monthly</h6>
        		</div>
        		<div class="counter-item">
        			<h5><?php echo $year_user[0]->year_user; ?></h5>
        			<h6>Yearly</h6>
        		</div> -->
        	</div> 
        </div>
    <div class="panel-body">

        <script type="text/javascript">
            jQuery(document).ready(function ($)
            {
                $("#example-4").dataTable({
                    
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
        <table class="table table-small-font table-bordered table-striped" id="example-4">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Agent Name</th>
                    <th>Email</th>
                    <th>Margin(₦)</th>
                    <th>Transactions</th>
	               <!--<th>Operator</th>
                    <th>Margin(%)</th>-->
                   <th>Created Date</th>
                   <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($agent_list)) {
       
                    $n = 1;
                    foreach ($agent_list as $value) {
                    	$services=$value->agant_service;
						if($services=='1'){
							$services="Mobile";
						}else if($services=='2'){
								$services="Data Recharge";
						}else if($services=='3'){
								$services="DTH Recharge";
						}else if($services=='4'){
                                $services="Electricity Recharge";
                        }
                        ?>
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                            <td style="width: 15%"><?php echo $value->user_name; ?></td>
                            <td style="width: 15%"><?php echo $value->user_email; ?></td>
                            <td style="width: 10%"><?php echo $value->total_margin ?></td>
                            <td style="width: 10%"><?php echo $value->total_transactions ?></td>
                            <td style="width: 15%"><?php echo date("d-m-Y H:i:s a", strtotime($value->agent_created_date));?></td>
                            <td style="width: 10%">
                                <a href="javascript:void(0)" onclick="edit_agent('<?php echo $value->user_id; ?>')" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a>&nbsp;
                                <a href="<?php echo site_url('admin/view_agent_list') . '/user_id/' . $value->user_id ; ?>" class="btn btn-warning btn-sm btn-icon icon-lef">View</a>&nbsp;
                             <a href="<?php echo site_url('admin/agent_view_transaction') . '/' . $value->user_id; ?>" class="btn btn-blue btn-sm btn-icon icon-left">Transaction</a>
                         </td>
                          
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
</div>
    </div>
</div>

 <div class="modal" id="myModal" style="margin-top: 70px">
    <div class="modal-dialog">
      <div class="modal-content">
       <span id="msg1" style="text-align:center;margin-left:50px;color:green"></span>
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Agent</h4>
          <button type="button" id="closemodal" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div id="agent_details">
       
        </div>
      </div>
    </div>
  </div>
  <button style="display: none"  type="button" id="popupmodal" class="btn btn-primary" data-toggle="modal" data-target="#myModal">

</button>
<style>
     .modal-dialog {
    width: 600px;
    margin: 30px auto;
    overflow-y: scroll;
    display: block;
    height: 400px;
}
.margin-percent-box {
    float: left;
    width: 100%;
}
 </style>
<script type="text/javascript">
      $("#margin").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});
    function slect_operator(op_id,cat_id)
    {
        if($("#operator_"+op_id).prop('checked') == true)
        {
            $("#margin_"+op_id).removeAttr('disabled');
            $("#margin_"+op_id).prop('required',true);
            $("#category_"+cat_id).prop( 'checked',true );
        }else{
            $("#margin_"+op_id).prop("disabled", true);
            $("#margin_"+op_id).prop('required',false   );
        }
    }
    function edit_agent(user_id)
    {
         $.ajax({
                url: '<?php echo site_url('admin/edit_agent_list') ?>',
                type: "POST",
                data: {
                   'user_id': user_id
                       },
                       success: function (data) {
                         $("#user_id").val(user_id);
                        $("#popupmodal").click();
                       $("#agent_details").html(data);
                         
                        }
                   });
    }
</script>