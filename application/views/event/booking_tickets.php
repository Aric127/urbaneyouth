
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Event Booking Transactions </h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Username</th>
                          <th>Useremail</th>
                          <th>Userphone</th>
                          <th>Event Name</th>
                          <th>Amount(₦)</th>
                          <th>Tickets</th>
                          <th>Booking Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php if(!empty($transaction_record))
                        {  
                          $i=1;
                          foreach ($transaction_record as $value) 
                          {
                        
                        
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $value->user_name; ?></td>
                              <td><?php echo $value->user_email; ?></td>
                              <td><?php echo $value->user_contact_no; ?></td>
                              <td><?php echo $value->event_name; ?></td>
                              <td><?php echo "₦".$value->booking_ticket_price; ?></td>
                              <td><?php echo $value->ticket_qty; ?></td>
                              <td><?php echo $value->transaction_date; ?></td>
                              <td><a style="cursor: pointer" class="btn btn-link btn-warning btn-just-icon edit"" href="<?php echo base_url('event/eventicket/'.$value->booking_event_tickets_id); ?>"><i class="material-icons">visibility</i></a>&nbsp;</td>
                         </tr>
                      <?php $i++; } } ?>
                        
                        
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
  