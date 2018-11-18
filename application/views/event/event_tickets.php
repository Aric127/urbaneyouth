
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <?php if ($this->session->flashdata('status')) { ?>
          <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> <?php echo $this->session->flashdata('status'); ?></span>
                  </div>
          <?php } ?>
          <?php if ($this->session->flashdata('error')) { ?>
                             <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                              </button>
                              <span>
                                <?php echo $this->session->flashdata('error'); ?></span>
                            </div>
            <?php } ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Event Tickets</h4>
                 
                  <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add New Ticket
                  </button>
                  
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover bor" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th style="text-align: center;">SNo</th>
                          <th style="text-align: center;">Ticket Name</th>
                          <th style="text-align: center;">Ticket No.</th>
                          <th style="text-align: center;">Price(₦)</th>
                          <th style="text-align: center;">Image</th>
                          <th style="text-align: center;">QR Code</th>
                          <th style="text-align: center;">Desc</th>
                          <th class="disabled-sorting text-center">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                <?php if (!empty($events_tickets)) {
       
                    $n = 1;
                    foreach ($events_tickets as $value) { ?>
            
                        <tr>
                            <td style="width: 15%;text-align: center;"><?php echo $n; ?></td>
                            <td style="width: 15%;text-align: center;"><?php echo $value->events_tickets_name; ?></td>
                             <td style="width: 15%;text-align: center;"><?php echo $value->events_tickets_no; ?></td>
                            <td style="width: 15%;text-align: center;"><?php echo $value->events_tickets_price; ?></td>
                            <td style="width: 15%"><img src="<?php echo event_ticket_image.'/'.$value->events_tickets_image; ?>" height="90" width="90"></td>
                            <td style="width: 15%"><img src="<?php echo event_ticket_image.'/'.$value->event_ticket_qrcode; ?>" height="90" width="90"></td>

                            <td style="width: 15%;text-align: center;"><?php echo $value->events_tickets_desc; ?></td>
                            <td style="text-align: center;">
                               <?php $status = $value->events_tickets_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('event/change_status') . '/events_tickets_id/' . $value->events_tickets_id; ?>/events_tickets/events_tickets_status/2/event_tickets" class="btn btn-secondary btn-sm btn-icon icon-left"><i class="material-icons">check</i></a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('event/change_status') . '/events_tickets_id/' . $value->events_tickets_id; ?>/events_tickets/events_tickets_status/1/event_tickets" class="btn btn-warning btn-sm btn-icon icon-left"><i class="material-icons">check</i></a>
                                <?php } ?> 
                            </td>
                           
                        </tr>
                <?php $n = $n + 1; } } ?>
            </tbody>
                      
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
          </div>
          <!-- end row -->
        </div>
      </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                             
                            <div class="modal-body">
                            
                <div class="card ">
                  <div class="card-header card-header-rose card-header-icon">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons" id="cl">clear</i>
                              </button>
                    <div class="card-icon">
                     <img src="<?php echo base_url('biller_assets/img/add.png');?>">
                    </div>
                    <h4 class="card-title">Create New Ticket</h4>
                  </div>
                   <form id="RegisterValidation" action="<?php echo site_url('event/add_event_ticket'); ?>"  method="post" enctype="multipart/form-data">
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Ticket Name *</label>
                      <input type="text" class="form-control" name="events_tickets_name"  id=" 	events_tickets_name"  required="true" onblur="genrate_ticket_no()">
                    </div>
                      <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Ticket Code *</label>
                      <input type="text" class="form-control" name="events_tickets_no"  id="events_tickets_no"  required="true" readonly="readonly">
                    </div>
                    <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating">  Price *</label>
                      <input type="text" class="form-control" name="events_tickets_price" id="events_tickets_price">
                    </div>
                    <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Ticket image </label>
                                <input type="file" class="file" name="events_tickets_image" required="" aria-required="true">
                      </div>
                     <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Ticket Description *</label>
                     <textarea class="meassge" rows="8" id="events_tickets_desc" name="events_tickets_desc" data-validate="required" data-msg="Please Enter product description" placeholder="Please Enter product description"></textarea>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    
                    
                <input type="submit" name="submit" value="Add" class="btn btn-success" >
                  </div>
                    </form>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>
                      <!--upload popu -->
                      <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-notice">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="width: auto!important;float: left;    line-height: 47px;">UPLOAD PRODUCT EXCEL</h4>
                  <a href="<?php echo base_url('uploads/demo_excel/product_excel.xlsx'); ?>" class="btn btn-raised btn-primary" style="color: #fff;">
                <i class="fa-plus-circle"> </i> Sample Excel
            </a> 
                            
                </div>
                
                <div class="card-body">
                  <form action="<?php echo site_url('biller/upload_product_excel'); ?>" role="form" id="form1" method="post" class="validate" enctype="multipart/form-data">
                    <div class="card-block">
                       <div class="input-group mb-3">
                      
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="product_excel" name="product_excel" placeholder="Upload product Excel" required="">
                        <label class="custom-file-label" for="inputGroupFile01" style="font-size: 12px;color: #ccc;font-size: 12px;color: #777;line-height: 25px;">Upload product Excel...</label>
                      </div>
                    </div> 
                    <button type="submit" class="btn btn-raised btn-primary">
                 Upload
                              </button>
                    </div>
                  </form>
                </div>
            </div>
              <!--  end card  -->
            </div>
                            </div>
                            
                          </div>
                        </div>
                           </div>
    <style>
      .modal-body {
    padding: 0!important;
}
.modal-dialog {
    margin-top: 62px!important;
}
.modal-content{background-color: transparent;box-shadow: none!important;}
    </style>               
<script type="text/javascript">
	function genrate_ticket_no()
	{
		var ticket_no =Date.now();
		$("#events_tickets_no").val(ticket_no);
	}
</script>