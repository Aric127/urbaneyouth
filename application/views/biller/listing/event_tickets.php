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
            Event Ticket List
        </div>
        <div class="panel-options">
            <a href="<?php echo site_url('biller/add_event_ticket'); ?>" class="btn blue-theme-btn btn-sm" style="color: #fff;">
                <i class="fa fa-plus-circle"></i>
                Add Tickets
            </a> 
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
                    <th>SNo.</th>
                    <th>Ticket Name</th>
                     <th>Ticket Price(&#8358;)</th>
                     <th>Image</th>
          			<th>Action</th>
                </tr>
            </thead>



            <tbody>
                <?php if (!empty($events_tickets)) {
       
                    $n = 1;
                    foreach ($events_tickets as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 12%"><?php echo $value->events_tickets_name; ?></td>
                             <td style="width: 10%"><?php echo $value->events_tickets_price; ?></td>
                             <td style="width: 15%"><img src="<?php echo event_ticket_image.'/'.$value->events_tickets_image; ?>" height="90" width="220"></td>
                           
                      	   
                            
                            <td style="width: 20%">
                          <!--  <a href="<?php echo site_url('biller/edit_event_ticket') . '/' . $value->events_tickets_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a> -->
                               
                       
                                 <?php $status = $value->events_tickets_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/events_tickets_id/' . $value->events_tickets_id; ?>/events_tickets/events_tickets_status/2/event_tickets" class="btn btn-secondary btn-sm btn-icon icon-left">&nbsp;Active&nbsp;</a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('biller/change_status') . '/events_tickets_id/' . $value->events_tickets_id; ?>/events_tickets/events_tickets_status/1/event_tickets" class="btn btn-warning btn-sm btn-icon icon-left">&nbsp;Inactive&nbsp;</a>
                                <?php } ?> 
                               
                                <a onClick="if(!confirm('Are you sure, You want delete this product?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_event_ticket/events_tickets/events_tickets_id/' . $value->events_tickets_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left">Delete</a>
                            </td>
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
        </table>

    </div>

</div>
