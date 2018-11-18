
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
                  <h4 class="card-title">Consumer List</h4>
                  <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add Consumer
                  </button>
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
                          <th>Customer Name</th>
                          <th>Customer No</th>
                          <th>Email</th>
                          <th>Contact No</th>
                          <th>Last Invoice Date</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($biller_consumer)) {
               
                            $n = 1;
                            foreach ($biller_consumer as $value) { ?>
                    
                                <tr>
                                    <td style="width: 5%"><?php echo $n; ?></td>
                                     <td style="width: 12%"><?php echo $value->biller_user_name; ?></td>
                                     <td style="width: 12%"><?php echo $value->biller_customer_id_no; ?></td>
                                    <td style="width: 10%"><?php echo $value->biller_user_email; ?></td>
                                    <td style="width: 19%"><?php echo $value->biller_user_contact_no; ?></td>
                                    <td  style="width: 13%"><?php echo $value->bill_invoice_date; ?></td>
                                    
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
                            <div class="modal-header">
                              
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body">
                            
                <div class="card ">
                  <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                     <img src="<?php echo base_url('biller_assets/img/add.png');?>">
                    </div>
                    <h4 class="card-title">Add  Consumer</h4>
                  </div>
                   <form id="RegisterValidation" action="<?php echo base_url('biller/add_consumer'); ?>"  method="post">
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Consumer Name *</label>
                      <input type="text" class="form-control" name="biller_user_name"  id="biller_user_name" required="true">
                    </div>
                    <div class="form-group">
                      <label for="examplePassword" class="bmd-label-floating"> Consumer No </label>
                      <input type="text" class="form-control"  data-validate="required" data-msg="Please Enter Consumer No" name="biller_customer_id_no" id="biller_customer_id_no" required="true"  onblur="create_invoive_no()">
                    </div> 
                    <span id="consumner_no_errro" style="color:red;"></span>
                    <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Email *</label>
                      <input type="text" class="form-control" data-validate="required" data-msg="Please Enter Email" required="true"  id="biller_user_email" name="biller_user_email">
                    </div>
                     <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Contact No </label>
                     <input type="text" class="form-control" data-validate="required" data-msg="Please Enter Contact No" required="true"  name="biller_user_contact_no" id="biller_user_contact_no">
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    
                    <!--  <?php if(!empty($product_details)){ ?>
                    <input type="hidden" name="product_id" value="<?php echo $product_details[0]->product_id; ?>">
                <?php } ?> -->
                <input id="submit_btn" type="submit" name="submit" value="Add" class="btn btn-success" >
                  </div>
                    </form>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>


  <script type="text/javascript">
      function create_invoive_no(){
          var consumer_no  = $("#biller_customer_id_no").val();
            var URL = "<?php echo site_url('biller/get_consumer_details'); ?>";
            $.ajax({
              url: URL,
              data: {"consumer_no" : consumer_no},
              dataType:"json",
              type: "post",
              success: function(data){ 
                   if(data.status==1)
                   {
                      $("#biller_customer_id_no").css("color","red");
                      $("#consumner_no_errro").text("These Consumer Number already exist");
                      $("#submit_btn").prop('type','button');
                   } else{
                    $("#biller_customer_id_no").css("color","");
                      $("#consumner_no_errro").text("");
                      $("#submit_btn").prop('type','submit');
                   }       
              }
          });
        }
  </script>