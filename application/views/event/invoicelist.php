
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
                      <b> Error - </b> <?php echo $this->session->flashdata('error'); ?></span>
                  </div>
  <?php } ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Invoice List</h4>
                  <a href="<?php echo base_url('biller/add_biller_user'); ?>" class="btn btn-raised btn-primary">
                  <i class="fa fa-plus-circle"></i> Add invoice
                  </a>
                  <button type="button" class="btn" data-toggle="modal" data-target="#noticeModal">
                      <span class="btn-label">
                        <img src="<?php echo base_url('biller_assets/img/upload.png');?>">
                      </span>
                    Upload invoice
                    <div class="ripple-container"></div></button>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                         <th>SNo.</th>
                          <th>Customer No</th>
                          <th>Invoice No</th>
                          <th>Name</th>
                          <th>Product</th>
                          <th>Contact No</th>
                          <th>Bill Amount</th>
                          <th>Due Date</th>
                          <!-- <th>Invoice Date</th> -->
                          <th>Status</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                       <tbody>
                <?php if (!empty($consumer_details)) {
       
                    $n = 1;
                    foreach ($consumer_details as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 12%"><?php echo $value->biller_customer_id_no; ?></td>
                             <td style="width: 12%"><?php echo $value->bill_invoice_no; ?></td>
                            <td style="width: 10%"><?php echo $value->biller_user_name; ?></td>
                            <td style="width: 19%"><?php echo $value->bill_product_name; ?></td>
                            <td  style="width: 13%"><?php echo $value->biller_user_contact_no; ?></td>
                             <td  style="width: 10%"><?php echo $value->bill_amount ; ?></td>
                               <td  style="width: 15%"><?php echo $value->bill_due_date ; ?></td>
                            <!-- <td  style="width: 15%"><?php echo $value->bill_invoice_date; ?></td> -->
                             <td  style="width: 15%"><?php  if($value->bill_pay_status=='1'){echo "Paid";}else{
                              echo "Panding";
                             }; ?></td>
                           
                            
                            <td style="width: 40%">
                         
                                <?php if($value->bill_pay_status=='1'){ ?>
                                        <a style="cursor: pointer" class="btn btn-link btn-warning btn-just-icon edit"" href="<?php echo invoice."/".$value->bill_paid_invoice ?>"><i class="material-icons">dvr</i></a>&nbsp;

                                <?php }else{ ?>
                                          <a style="cursor: pointer" class="btn btn-link btn-warning btn-just-icon edit"" href="<?php echo bill_invoice."/".$value->bill_invoice ?>"><i class="material-icons">dvr</i></a>&nbsp;

                                <?php } ?>
                             
                                <a onClick="if(!confirm('Are you sure, You want delete this Biller?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_bill_user/biller_user/biller_user_id/' . $value->biller_user_id; ?>" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
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
   