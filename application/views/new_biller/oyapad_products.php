<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-load-image/2.19.0/load-image.all.min.js"></script>
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
                   <div class="filter-by-box">
                        <select class="selectpicker" data-style="select-with-transition" title="Select Category" data-size="5" onchange="get_products(this.value)">
                            <option disabled> Select Category</option>
                            <?php if(!empty($oyapad_category))
                            {
                            	foreach ($oyapad_category as  $value12) 
                            	{ ?>
                            		<option value="<?php echo $value12->p_cate_id; ?>"><?php echo $value12->p_cat_name; ?></option>
                            	<?php } } ?>
                             
                          </select>
                      </div>
                  <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add Product
                  </button>
                 </div>
                <div class="card-body">
                  <div class="toolbar">
                  </div>
                  <div class="material-datatables" id="filters">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover prodct" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>SNo</th>
                          <th>Category</th>
                          <th>Name</th>
                          <th>Code</th>
                          <th>Barcode</th>
                          <th>Qty</th>
                          <th>Price(₦)</th>
                          <th>Image</th>
                          <th>Description</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                <?php if (!empty($oyapad_products)) {
       
                    $n = 1;
                    foreach($oyapad_products as $value) { ?>
            
                        <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $value->p_cat_name; ?> </td>
                             <td><?php echo $value->product_name; ?></td>
                             <td ><?php echo $value->product_code; ?></td>
                              <td ><?php echo $value->product_barcode; ?></td>
                            
                            <td><?php echo $value->product_qty; ?></td>
                            <td style="text-align: center;"><?php echo "₦".$value->product_price; ?></td>
                            <td><img src="<?php echo oyapad_product."/".$value->product_image; ?>" width="90" height="90"></td>
                            <td ><?php echo substr($value->product_desc,0,80) . '...';  ?></td>
                           
                           
                            
                            <td>
                            <a data-toggle="modal" data-target="#edit_product<?php echo $value->oya_product_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" > <i class="material-icons">edit</i></a> 

                                    <div class="modal fade" id="edit_product<?php echo $value->oya_product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <h4 class="card-title">Update Product</h4>
                  </div>
                   <form id="RegisterValidation" <?php if(!empty($oyapad_products)){ ?> action="<?php echo base_url('biller/edit_oypad_product'); ?>"<?php } else { ?> action="<?php echo base_url('biller/add_oyapad_product'); ?>"<?php } ?>  method="post" enctype="multipart/form-data">
                  <div class="card-body ">
                 
                    <div class="row" id="custom-row">
                     <div class="form-group col-md-6">
                       <select class="form-control" name="product_cat_id" id="product_cat_id">
                        <option value="">Select Category </option>
                        <?php
                        if(!empty($oyapad_category))
                        {
                          foreach ($oyapad_category as  $value2) 
                            { ?>
                              <option <?php if($value->product_cat_id==$value2->p_cate_id){ ?> selected="selected" <?php } ?> value="<?php echo $value2->p_cate_id; ?>">
                                <?php echo $value2->p_cat_name; ?></option>
                         <?php }
                        } 
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6 ">
                       <label for="exampleEmail" class="bmd-label-floating custom"> Product Name *</label>
                      <input type="text" class="form-control" name="product_name"  id="product_name"  required="true" value="<?php echo $value->product_name ?>">
                    </div>
                  </div>
                    <div class="row" id="custom-row">
                    <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product code *</label>
                      <input type="text" class="form-control" name="product_code" id="product_code" required="true" value="<?php echo $value->product_code ?>">
                    </div>
                     <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product Barcode *</label>
                      <input type="text" class="form-control" name="product_barcode" id="product_barcode" required="true" value="<?php echo $value->product_barcode ?>">
                    </div>
                  </div>
                  <div class="row" id="custom-row">
                     <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product QTY *</label>
                      <input type="text" class="form-control" name="product_qty" id="product_qty" required="true" value="<?php echo $value->product_qty ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Price(₦) *</label>
                      <input type="text" class="form-control" data-validate="required" data-msg="Please Enter price" required="true"  name="product_price" value="<?php echo $value->product_price ?>">
                    </div>
                  </div>
                  
                   <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <h4 class="title">Product Image</h4>
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="<?php echo oyapad_product."/".$value->product_image; ?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new text-center">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file"  id="product_pic"  name="product_pic" data-validate="required" data-msg="Please Select Image" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h4 class="title">Descriptions</h4>
                      <div class="form-groupr" data-provides="fileinput">
                        <textarea style="padding: 10px;" id="product_desc" name="product_desc"  data-validate="required" data-msg="Please Enter product description" ><?php echo $value->product_desc ?></textarea>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="card-footer text-right">
                    
                   
                    <input type="hidden" name="oya_product_id" value="<?php echo $value->oya_product_id; ?>">

                <input type="submit" name="submit" value="Update" class="btn btn-success" >
                  </div>
                    </form>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>
                               <a onClick="if(!confirm('Are you sure, You want delete this product?')){return false;}" href="<?php echo site_url('biller/delete') . '/delete_oyapad_product/oyapad_products/oya_product_id/' . $value->oya_product_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="material-icons">close</i></a>
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
        <div class="modal fade my-new" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                   <form id="RegisterValidation" action="<?php echo site_url('biller/add_oyapad_product'); ?>"  method="post" enctype="multipart/form-data">
                  <div class="card-body ">
                 
                    <div class="row" id="custom-row">
                     <div class="form-group col-md-6">
                       <select class="form-control" name="product_cat_id" id="product_cat_id">
                        <option value="">Select Category </option>
                        <?php
                        if(!empty($oyapad_category))
                        {
                          foreach ($oyapad_category as  $value) 
                            { ?>
                              <option value="<?php echo $value->p_cate_id; ?>">
                                <?php echo $value->p_cat_name; ?></option>
                         <?php }
                        } 
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                       <label for="exampleEmail" class="bmd-label-floating custom"> Product Name *</label>
                      <input type="text" class="form-control" name="product_name"  id="product_name"  required="true">
                    </div>
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
                     <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product QTY *</label>
                      <input type="text" class="form-control" name="product_qty" id="product_qty" required="true" value="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="examplePassword1" class="bmd-label-floating"> Product Price(₦) *</label>
                      <input type="text" class="form-control" data-validate="required" data-msg="Please Enter price" required="true"  name="product_price">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <h4 class="title">Product Image</h4>
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="<?php echo base_url('biller_assets/img/image_placeholder.jpg');?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new text-center">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file"  id="product_pic"  name="product_pic" data-validate="required" data-msg="Please Select Image" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h4 class="title">Descriptions</h4>
                      <div class="form-groupr" data-provides="fileinput">
                        <textarea style="padding: 10px;" id="product_desc" name="product_desc"  data-validate="required" data-msg="Please Enter product description" ></textarea>
                      </div>
                    </div>
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
<script>
function create_invoive_no(){
  var product_name=$("#product_name").val();
  var res = product_name.slice(0,5); 
  var num = Math.floor(Math.random() * 999) + 199;
  var invoice_no=res+num;
  $("#product_code").val(invoice_no);
  }
  function get_products(cat_ID)
  {
  	$("#filters").html(''); 
  	var URL = "<?php echo site_url('biller/get_oyapad_products'); ?>";
  	 $.ajax({
              url: URL,
              data: {"cat_ID" : cat_ID},
              dataType:"html",
              type: "post",
              success: function(data){
              $("#filters").html(data);
                  //$("#filters").html(data);    
              }
          });
  }
</script>
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
ul#image_preview img{padding-bottom: 10px;}


.form-group.imf-my.col-md-6.lst {
    margin: 0 0 8px 0!important;
}
.filter-by-box {
    width: 265px;
    float: left;
    margin-left: 39%;
}
</style>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>

 <script language="javascript" type="text/javascript">
$(function () {
    $("#product_image").change(function (e) {
      $('#image_preview').empty();
      var total_file = e.target.files.length; alert(total_file);
    for(var i=0;i<total_file;i++){
      var loadingImage = loadImage(
        e.target.files[i],
        function(img){
          var base = img.toDataURL();alert(base);
         $('#edit_prd_image').attr('src',base);
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