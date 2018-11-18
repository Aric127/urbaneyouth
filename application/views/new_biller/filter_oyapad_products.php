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
                   <form id="RegisterValidation<?php echo $value->oya_product_id; ?>" <?php if(!empty($oyapad_products)){ ?> action="<?php echo base_url('biller/edit_oypad_product'); ?>"<?php } else { ?> action="<?php echo base_url('biller/add_oyapad_product'); ?>"<?php } ?>  method="post" enctype="multipart/form-data">
                  <div class="card-body ">
                 
                    <div class="row" id="custom-row">
                     <div class="form-group col-md-6">
                       <select class="form-control" name="product_cat_id" id="product_cat_id<?php echo $value->oya_product_id; ?>">
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
                      <input type="text" class="form-control" name="product_name"  id="product_name<?php echo $value->oya_product_id; ?>"  required="true" value="<?php echo $value->product_name ?>">
                    </div>
                  </div>
                    <div class="row" id="custom-row">
                    <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product code *</label>
                      <input type="text" class="form-control" name="product_code" id="product_code<?php echo $value->oya_product_id; ?>" required="true" value="<?php echo $value->product_code ?>">
                    </div>
                     <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product Barcode *</label>
                      <input type="text" class="form-control" name="product_barcode" id="product_barcode<?php echo $value->oya_product_id; ?>" required="true" value="<?php echo $value->product_barcode ?>">
                    </div>
                  </div>
                  <div class="row" id="custom-row">
                     <div class="form-group col-md-6">
                      <label for="examplePassword" class="bmd-label-floating"> Product QTY *</label>
                      <input type="text" class="form-control" name="product_qty" id="product_qty<?php echo $value->oya_product_id; ?>" required="true" value="<?php echo $value->product_qty ?>">
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
                        <textarea style="padding: 10px;" id="product_desc<?php echo $value->oya_product_id; ?>" name="product_desc"  data-validate="required" data-msg="Please Enter product description" ><?php echo $value->product_desc ?></textarea>
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