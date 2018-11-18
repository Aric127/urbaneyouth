
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
                  <h4 class="card-title">Product List</h4>
                 
                  <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add Product
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
                          <th style="text-align: center;">Product Name</th>
                          <th style="text-align: center;">Price(₦)</th>
                          <th style="text-align: center;">Description</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                <?php if (!empty($product_details)) {
       
                    $n = 1;
                    foreach ($product_details as $value) { ?>
            
                        <tr>
                            <td style="width: 15%;text-align: center;"><?php echo $n; ?></td>
                             <td style="width: 15%;text-align: center;"><?php echo $value->church_product_name; ?></td>
                             <td style="width: 15%;text-align: center;"><?php echo $value->church_product_price; ?></td>
                             <td style="width: 40%;text-align: center;"><?php echo $value->church_product_desc; ?></td>
                            
                            <td style="text-align: right;">
                            <a style="margin-left: 20px" data-toggle="modal" data-target="#edit_product<?php echo $value->church_product_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef ico-i" > <i class="material-icons">edit</i></a> 

                                    <div class="modal fade" id="edit_product<?php echo $value->church_product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <h4 class="card-title">Update Product</h4>
                  </div>
                   <form id="RegisterValidation" <?php if(!empty($product_details)){ ?> action="<?php echo base_url('church/edit_product'); ?>"<?php } else { ?> action="<?php echo base_url('church/church_add_product'); ?>"<?php } ?>  method="post">
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Product Name *</label>
                      <input type="text" class="form-control" name="church_product_name"  id="church_product_name" value="<?php  echo $value->church_product_name;?>" required="true">
                    </div>
                   <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Price *</label>
                      <input type="text" class="form-control" name="church_product_price" value="<?php echo $value->church_product_price; ?>"> 
                    </div>
                     <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Description </label>
                      <textarea class="form-control textarea-height" rows="5" name="church_product_desc" required="required" data-msg="Please Enter Invoice Product Description" aria-required="true"><?php echo $value->church_product_desc; ?></textarea>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    
                   
                    <input type="hidden" name="church_product_id" value="<?php echo $value->church_product_id; ?>">

                <input type="submit" name="submit" value="Update" class="btn btn-success" >
                  </div>
                    </form>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>
                               <a onClick="if(!confirm('Are you sure, You want delete this product?')){return false;}" href="<?php echo site_url('church/delete') . '/delete_product/church_product/church_product_id/' . $value->church_product_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="material-icons">close</i></a>
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
                    <h4 class="card-title">Add Product</h4>
                  </div>
                   <form id="RegisterValidation" action="<?php echo site_url('church/church_add_product'); ?>"  method="post">
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Product Name *</label>
                      <input type="text" class="form-control" name="church_product_name"  id="church_product_name"  required="true">
                    </div>
                   
                    <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Price *</label>
                      <input type="text" class="form-control" name="church_product_price" id="church_product_price">
                    </div>
                     <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Description </label>
                      <textarea class="form-control textarea-height" rows="5" id="church_product_desc" name="church_product_desc" required="required" data-msg="Please Enter Invoice Product Description" aria-required="true"></textarea>
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
  .form-group.bmd-form-group {
    margin-top: 15px!important;
}
</style>