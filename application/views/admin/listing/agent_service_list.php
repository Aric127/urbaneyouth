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
            Agent Service List
        </div>
        <div class="backbutton">
            <button><a href="#"><i class="fa fa-arrow-left"></i> Back</a></button>
        </div>
    </div>
    <div class="row">
        <div class="container" style="margin-left: 50px">
                    
               
                 <?php if (!empty($agent_service_list)) {
       
                    $n = 1;
                    foreach ($agent_service_list as $value) {
                        ?>
                        <div>
                            <h5>Agent Name:<span style="margin-left: 50px;font-weight: 600"><?php echo $value->user_name; ?></span></</h5>
                           
                      
                            <h5>Agent Email:<span style="margin-left: 50px;font-weight: 600"><?php echo $value->user_email; ?></h5>
                            
                        </div>
                <?php
                    break;
                    }
                }
                ?>
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
        <table id="example-1" class="table table-striped table-bordered table-small-font " cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Service</th>
                    <th>Operator</th>
                    <th>Margin(%)</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($agent_service_list)) {
       
                    $n = 1;
                    foreach ($agent_service_list as $value) {
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
                            <td style="width: 10%"><?php echo $services; ?></td>
                            <td  style="width: 10%"><?php echo $value->operator_name; ?></td>
                      
                            <td style="width: 10%"><?php echo $value->agent_margin."%";?></td>
                            <td style="width: 15%"><?php echo date("d-m-Y H:i:s a", strtotime($value->agent_created_date));?></td>
                             <td style="width: 10%"> <?php $status = $value->agent_status;
                             $user_id = $value->user_id; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo base_url('admin/change_status') . '/agent_id/' . $value->agent_id; ?>/agent_users/agent_status/2/agent_list" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo base_url('admin/change_status') . '/agent_id/' . $value->agent_id; ?>/agent_users/agent_status/1/agent_list" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;InActive&nbsp;</a>
                                <?php } ?></td>
                           
                            
                          
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>
       </div>

    </div>

</div>
