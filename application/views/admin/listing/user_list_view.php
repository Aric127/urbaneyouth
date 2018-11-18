<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

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
.show-div-oparator{
	display: none;
}


down vote
#show:not(:checked) ~ p { display: none }

</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">User List</h3>
 <span id="msg" style="text-align:center;margin-left:50px;color:red"></span>
      
    </div>
     <div class="row panel-body">
       <div class="col-xs-6 counter-show-on-top">
        		<div class="counter-item">
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
        		</div>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
	
                    <!--<th>Login type</th>-->
                    <th>User created date</th>
                    <th>User wallet(₦)</th>
					<th>Agent</th>
                   <th>User IP</th>
                    <th width="150">Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($user_list)) {
       
                    $n = 1;
                    foreach ($user_list as $value) {
                    	$login_type=$value->user_login_type;
						if($login_type=='1'){
							$login_type="Email or Mobile";
						}else if($login_type=='2'){
								$login_type="Facebook";
						}else if($login_type=='3'){
								$login_type="Google+";
						}
                        ?>
                        <tr>
                            <td style="width: 2%"><?php echo $n; ?></td>
                            <td style="width: 15%"><?php echo $value->user_name; ?></td>
                            <td style="width: 15%"><?php echo $value->user_email; ?></td>
                            <td  style="width: 15%"><?php echo $value->user_contact_no; ?></td>
                      
                            <!--<td><?php echo $login_type; ?></td>-->
                            <td style="width: 12%"><?php echo date("d-m-Y H:i:s a", strtotime($value->user_created_date));?></td>
                            <td style="width: 10%">₦<?php echo $value->wallet_amount;?></td>
							<td style="width: 10%"><input type="checkbox" name="is_agent" id="is_agent<?php echo $value->user_id; ?>" value="<?php echo $value->user_id; ?>" onclick="select_agent(this.value)" <?php if($value->is_agent==1){?> checked  <?php } ?>></td>
                            <td style="width: 10%"><?php echo $value->user_ip_address;?></td>
                            <td width="150">
                               <a href="<?php echo site_url('admin/view_transaction') . '/user_id/' . $value->user_id; ?>" class="btn btn-warning btn-sm btn-icon icon-left">Transaction</a>
                          
                                <?php $status = $value->user_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/user_id/' . $value->user_id; ?>/user/user_status/2/user_list" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('admin/change_status') . '/user_id/' . $value->user_id; ?>/user/user_status/1/user_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;InActive&nbsp;</a>
                                <?php } ?>
                               
                                <a style="margin-left:0; margin-top:10px;" onClick="if(!confirm('Are you sure, You want delete this user?')){return false;}" href="<?php echo site_url('admin/delete') . '/delete_user/user/user_id/' . $value->user_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
</div>
    </div>
</div>
<button style="display: none"  type="button" id="popupmodal" class="btn btn-primary" data-toggle="modal" data-target="#myModal">

</button>
<script>
	function select_agent(user_id)
	{
		if($("#is_agent"+user_id).prop('checked') == true)
		{
            $("#user_id").val(user_id);
			$("#popupmodal").click();

		}else{
			if (confirm('Are you sure want to delete agent ?')) 
            {
                 $.ajax({
                url: '<?php echo site_url('admin/cancel_agent') ?>',
                type: "POST",
                data: {
                   'user_id': user_id
                       },
                       success: function (data) {
                       	setTimeout(function(){ $("#msg").text("Agent inactive successfully"); }, 2000);
                         
                        }
                   });
            } else {
               $("#is_agent"+user_id).prop( 'checked',true );
                }
		}
	}
	function slect_operator(op_id)
	{
		if($("#operator_"+op_id).prop('checked') == true)
		{
			$("#margin_"+op_id).removeAttr('disabled');
			$("#margin_"+op_id).prop('required',true);
		}else{
			$("#margin_"+op_id).prop("disabled", true);
			$("#margin_"+op_id).prop('required',false	);
		}
	}
</script>
 <div class="modal" id="myModal" style="margin-top: 70px">
    <div class="modal-dialog">
      <div class="modal-content">
       <span id="msg1" style="text-align:center;margin-left:50px;color:green"></span>
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create A Agent</h4>
          <button type="button" id="closemodal" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="<?php echo base_url('admin/add_agant') ?>" method="post" id="agent_form">
        <!-- Modal body -->
        <div class="modal-body">
		  
		  
<div class="row">
	 <input type="hidden" name="user_id" class="form-control" data-validate="required" id="user_id" value="85" readonly="readonly">
     <?php if(!empty($recharge_category))
     {
        foreach ($recharge_category as  $value) 
            { ?>
            <div class="col-sm-12">
        <div class="form-group">
            <label class="checkbox-inline">
                <input id="category_<?php echo $value->recharge_category_id;  ?>" name="recharge_category[]" type="checkbox" value="category_<?php echo $value->recharge_category_id;  ?>"><strong><?php echo $value->category_name;  ?></strong></label>
        </div>
        <div class="show-div-oparator box category_<?php echo $value->recharge_category_id;  ?>">
            <?php if(!empty($operator))
            {
                foreach ($operator as  $value1) 
                {
                if($value->recharge_category_id==$value1->recharge_category_id){ ?>
                     <div class="margin-percent-box">
                        <div class="form-group col-md-4 col-xs-12">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="<?php echo $value1->operator_id; ?>" name="operator[]" id="operator_<?php echo $value1->operator_id; ?>" onclick="slect_operator(this.value)"><?php echo $value1->operator_name; ?></label>
                        </div>
                        <div class="form-group col-md-8 col-xs-12">
                            <input type="text" name="margin[]" class="form-control" data-validate="required" placeholder="Agent Margin(%)" id="margin_<?php echo $value1->operator_id; ?>" value="" disabled="disabled">
                           
                        </div>
                    </div>
                <?php } } 
            } ?>
           
            

        </div>
        <hr/>
    </div>
     <?php   }
     } ?>


</div> 


         <br>
            <div class="form-group">
               <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $("#margin").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});
      function select_service(service_id)
      {
         $.ajax({
                url: '<?php echo site_url('admin/get_operator') ?>',
                type: "POST",
                data: {
                   'service_id': service_id
                       },
                       success: function (data) {
                         $("#Operator").html(data);
                        }
                   });
      }
// 	$("#agent_form").submit(function(e) {
// 	$("#msg1").text("");

//     var form = $(this);
//     var url = form.attr('action');

//     $.ajax({
//            type: "POST",
//            url: url,
//            data: form.serialize(), // serializes the form's elements.
//            success: function(data)
//            {
//              $("#msg1").text("Agent added successfully");
// 			 setTimeout(function()
// 			 {
//  				$("#closemodal").click();
//  				$('#agent_form').trigger("reset");
// 				}, 2000);
//            	}
//          });
// 		e.preventDefault(); // avoid to execute the actual submit of the form.
// });


 
  </script>

<script type="text/javascript">
$(document).ready(function(){
    $('input[type="checkbox"]').click(function(){
        var inputValue = $(this).attr("value");
        $("." + inputValue).toggle();
    });
});
function slect_operator(op_id)
    {
        if($("#operator_"+op_id).prop('checked') == true)
        {
            $("#margin_"+op_id).removeAttr('disabled');
            $("#margin_"+op_id).prop('required',true);
        }else{
            $("#margin_"+op_id).prop("disabled", true);
            $("#margin_"+op_id).prop('required',false   );
        }
    }
</script>


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