
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
                  <h4 class="card-title">My  Settlement </h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover setl" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Amount(₦)</th>
                          <th>Transaction Ref</th>
                          <th>Date</th>
                          <th>Bank Name</th>
                          <th>A/C Number</th>
                          <th>A/C Holder</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php 
                        if(!empty($my_sattlement))
                        {
                          $i=1;
                          foreach ($my_sattlement as  $value) {  ?>
                           <td><?php echo $i; ?></td>
                           <td><?php echo "₦".$value->settlement_amount; ?></td>
                           <td><?php echo $value->transaction_ref; ?></td>
                           <td><?php echo $value->transaction_date; ?></td>
                           <td><?php echo $value->bank_name; ?></td>
                           <td><?php echo $value->bank_account_no; ?></td>
                           <td><?php echo $value->account_holder_name; ?></td>
                           <td><?php echo $value->sattlement_status; ?></td>
                         <?php }
                        }
                        ?>
                        
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
  