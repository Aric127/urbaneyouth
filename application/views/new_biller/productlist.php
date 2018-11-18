
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
                  <h4 class="card-title">Product List</h4>
                 
                  <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add Product
                  </button>
                  <button type="button" class="btn" data-toggle="modal" data-target="#noticeModal">
                      <span class="btn-label">
                        <img src="<?php echo base_url('biller_assets/img/upload.png');?>">
                      </span>
                    Upload Excel
                    <div class="ripple-container"></div></button>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover prodct" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>SNo</th>
                          <th>Product Name</th>
                          <th>Product Code</th>
                          <th>Barcode</th>
                          <th>Price(₦)</th>
                          <th>Image</th>
                          <th>Description</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                <?php if (!empty($product_details)) {
       
                    $n = 1;
                    foreach ($product_details as $value) { ?>
            
                        <tr>
                            <td style="width: 5%"><?php echo $n; ?></td>
                             <td style="width: 12%"><?php echo $value->product_name; ?></td>
                             <td style="width: 10%"><?php echo $value->product_code; ?></td>
                              <td style="width: 10%"><?php echo $value->product_barcode; ?></td>
                            <td style="width: 10%"><?php echo $value->product_price; ?></td>
                            <td style="width: 15%"><img src="<?php echo biller_product."/".$value->product_pic; ?>" width="90" height="90"></td>
                            <td style="width: 35%"><?php echo $value->product_desc; ?></td>
                           
                           
                            
                            <td>
                            <a style="margin-left: 60px" data-toggle="modal" data-target="#edit_product<?php echo $value->product_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" > <i class="material-icons">edit</i></a> 

                                    <div class="modal fade" id="edit_product<?php echo $value->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                   <form id="RegisterValidation" <?php if(!empty($product_details)){ ?> action="<?php echo site_url('biller/edit_product'); ?>"<?php } else { ?> action="<?php echo site_url('biller/add_product'); ?>"<?php } ?>  method="post">
                 
                    <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Product Name *</label>
                      <input type="text" class="form-control" name="product_name"  id="product_name"  required="true" value="<?php echo $value->product_name; ?>">
                    </div>
                       <div class="row" id="custom-row">
                    <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product code *</label>
                      <input type="text" class="form-control" name="product_code" id="product_code" required="true" value="<?php echo $value->product_code; ?>">
                    </div>
                     <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product Barcode *</label>
                      <input type="text" class="form-control" name="product_barcode" id="product_barcode" required="true" value="<?php echo $value->product_barcode; ?>">
                    </div>
                  </div>
                   <div class="row" id="custom-row">
                   
                      <div class="form-group col-md-6"">
                      <label for="product_pic" class="bmd-label-floating"> Product Image *</label>
                      <input type="file" class="form-control" data-validate="required" data-msg="Please Enter Image" required="true" id="product_pic"  name="product_pic" value=""> 
                       <ul id="image_preview" class="image-manage">
                                        <?php 
                                            $imges = explode(",", $value->product_pic);
                                            if(!empty($imges))
                                            {
                                                foreach ($imges as  $value1) { ?>
                                                    <img src="<?php echo biller_product."/".$value1; ?>" style="height:80px;width: 80px">
                                              <?php  }
                                            }
                                         ?>
                                        
                                    </ul>
                    </div>
                     <div class="form-group col-md-6"">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Price *</label>
                      <input type="text" class="form-control" data-validate="required" data-msg="Please Enter price" required="true"  name="product_price" value="<?php echo $value->product_price; ?>">
                    </div>
                  </div>
                    
                     <div class="form-group" style="margin-top: 20px">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Description *</label>
                     
                      <input type="text" class="form-control" name="product_desc" id="product_desc" required="true" data-msg="Please Enter product description" value="<?php echo $value->product_desc; ?>">
                     </div>
                  </div>
                  <div class="card-footer text-right">
                    
                   
                    <input type="hidden" name="product_id" value="<?php echo $value->product_id; ?>">

                <input type="submit" name="submit" value="Update" class="btn btn-success" >
                  </div>
                    </form>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>
                               <a onClick="if(!confirm('Are you sure, You want delete this product?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_product/biller_produt/product_id/' . $value->product_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="material-icons">close</i></a>
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
                           
                            <div class="modal-body" style="padding: 0;">
                            
                <div class="card ">
                  <div class="card-header card-header-rose card-header-icon">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                              </button>
                    <div class="card-icon">
                     <img src="<?php echo base_url('biller_assets/img/add.png');?>">
                    </div>
                    <h4 class="card-title">Add Product</h4>
                  </div>
                   <form id="RegisterValidation" action="<?php echo site_url('biller/add_product'); ?>"  method="post" enctype="multipart/form-data">
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Product Name *</label>
                      <input type="text" class="form-control" name="product_name"  id="product_name"  required="true">
                    </div>
                       <div class="row" id="custom-row">
                    <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product code *</label>
                      <input type="text" class="form-control" name="product_code" id="product_code" required="true">
                    </div>
                     <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product Barcode *</label>
                      <input type="text" class="form-control" name="product_barcode" id="product_barcode" required="true" >
                    </div>
                  </div>
                   <div class="row" id="custom-row">
                   
                      <div class="form-group col-md-6"">
                      <label for="product_image1" class="bmd-label-floating"> Product Image *</label>
                      <input type="file" class="form-control" data-validate="required" data-msg="Please Enter Image" required="true" id="product_image1"  name="product_pic" value=""> 
                      <ul id="image_preview1" class="image-manage"></ul>
                    </div>
                     <div class="form-group col-md-6"">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Price *</label>
                      <input type="text" class="form-control" data-validate="required" data-msg="Please Enter price" required="true"  name="product_price">
                    </div>
                  </div>
                    
                     <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Description *</label>
                     
                      <input type="text" class="form-control" name="product_desc" id="product_desc" required="true" data-msg="Please Enter product description" >
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
                <img src="http://www.urbaneyouth.com/biller_assets/img/upload.png"> Sample Excel
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

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-load-image/2.19.0/load-image.all.min.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
 <script language="javascript" type="text/javascript">
$(function () {
    $("#product_pic").change(function (e) {
      $('#image_preview').empty();
      var total_file = e.target.files.length;
    for(var i=0;i<total_file;i++){
      var loadingImage = loadImage(
        e.target.files[i],
        function(img){
          var base = img.toDataURL();
          $('#image_preview').append('<img src="' + base + '" height="100" width="100">');
          // $('#upload_preview').attr('src',base);
        },
        {
          maxWidth: 600,
              maxHeight: 300,
              minWidth: 100,
              minHeight: 50,
          canvas: true,
          orientation: true,

        }
      )
    }
      
      
    });
});

</script>
 <script language="javascript" type="text/javascript">
$(function () {
    $("#product_image1").change(function (e) { 
      $('#image_preview1').empty();
      var total_file = e.target.files.length; 
    for(var i=0;i<total_file;i++){
      var loadingImage = loadImage(
        e.target.files[i],
        function(img){
          var base = img.toDataURL();
          $('#image_preview1').append('<img src="' + base + '" height="90" width="90">');
          // $('#upload_preview').attr('src',base);
        },
        {
          maxWidth: 600,
              maxHeight: 300,
              minWidth: 100,
              minHeight: 50,
          canvas: true,
          orientation: true,

        }
      )
    }
      
      
    });
});

</script>
<script>
function create_invoive_no(){
  var product_name=$("#product_name").val();
  var res = product_name.slice(0,5); 
  var num = Math.floor(Math.random() * 999999) + 199999;
  var invoice_no=res+num;
  $("#product_code").val(invoice_no);
  }
</script>
<!-- <style>
  #noticeModal .card-block button {
    float: left;
}
</style> -->
<style>
  #noticeModal .card-block button {
    float: left;
}

.modal-dialog.modal-notice {
    background: #fff!important;
}
label.bmd-label-floating.custom {
    top: -15px;
}
#myModal  .modal-dialog {
    margin-top: 20px !important;
}
#noticeModal .modal-body {
    padding: 0;
}
.form-group.imf-my {
    border-bottom: 1px solid #ccc;
}
div#custom-row {
    margin-top: 16px;
    padding: 0px 15px;
}
.form-group.imf-my {
    margin-top: 20px!important;
    margin-bottom: 24px!important;
}
#edit_product .modal-dialog {
    margin-top: 44px;
    background: #fff!important;
}

textarea {
    height: 100px !important;}

 #edit_product .imf-my{
  margin: 0!important;
 } 
 #edit_product .card-footer.text-right{margin: 0px!important;    padding-left: 20px;}
  #edit_product .btn.btn-success {
    margin-right: 16px;
}  
.mypic-1{
      width: 70px!important;
    margin: 0 auto;
    float: none;
    display: table
}
#edit_product2 .modal-dialog {
    margin-top: 40px;
}
#edit_product2 .modal-dialog 
 textarea {
    height: 100px !important;
    border: 0;
    border-bottom: 1px solid #ccc;
}
</style>