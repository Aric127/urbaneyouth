<?php $cat=$biller_details[0]->category;?>
      <!-- End Navbar -->
      <div class="content">
        <div class="content">
           <?php if ($this->session->flashdata('success')) { ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b>  <?php echo $this->session->flashdata('success'); ?>
                    </span>
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
          <div class="container-fluid">
             <div class="row">
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Branch List</h4>
                  <button type="button" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus-circle"></i> Add Branch
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
                          <th>Branch Name</th>
                          <th>Church Name</th>
                          <th>Image</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                     
                      <tbody>
                         <?php if (!empty($branch_list)) {
       
                    $n = 1;
                    foreach ($branch_list as $value) { ?>
            
                        <tr>
                           <td style="width: 8%"><?php echo $n; ?></td>
                           <td style="width: 25%"><?php echo $value->church_area; ?></td>
                           <td style="width: 25%"><?php echo $value->church_name; ?></td>
                           <td style="width: 15%"><img src="<?php echo church_image.'/'.$value->church_area_img; ?>" height="90" width="90"></td>
                           
                            
                            <td style="width: 10%" class="action">
                           <!--  <a href="<?php echo site_url('church/edit_church') . '/' . $value->church_area_id; ?>" class="btn btn-blue btn-sm btn-icon icon-lef" >Edit</a>  -->
                               
                       
                                 <?php $status = $value->church_area_status; ?>
                                <?php if ($status == 1) { ?>
                                <a href="<?php echo site_url('church/change_status') . '/church_area_id/' . $value->church_area_id; ?>/church_area/church_area_status/2/branch_list" class="btn btn-success btn-sm btn-icon icon-left"><i class="material-icons">check</i></a>
                                <?php } elseif ($status == 2) { ?>
                                <a href="<?php echo site_url('church/change_status') . '/church_area_id/' . $value->church_area_id; ?>/church_area/church_area_status/1/branch_list" class="btn btn-default btn-sm btn-icon icon-left"><i class="material-icons">check</i></a>
                                <?php } ?> 
                               
                             <!--    <a onClick="if(!confirm('Are you sure, You want delete this Branch?')){return false;}" href="<?php echo site_url('church/delete') . '/delete_branch/church_area/church_area_id/' . $value->church_area_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left"> <i class="material-icons">close</i> </a> -->
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
                        </div>
                      
                      </div>
                    </div>
                  </div>

  <div class="modal fade addcharch_model_wrap" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="margin-top: 10px;">
                          <div class="modal-content" style="background-color: #fff!important;">
                            <div class="modal-header">
                              
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body" style="padding-bottom: 0;padding-top: 0;">
                            
                <div class="card " style="">
                  <div class="card-header card-header-rose card-header-icon">
                     <div class="card-icon">
                     <img src="<?php echo base_url('biller_assets/img/add.png');?>">
                    </div>  
                    <h4 class="card-title">Add Branch</h4>
                  </div>
                   <form id="RegisterValidation" action="<?php echo base_url('church/add_branch'); ?>"  method="post" enctype= multipart/form-data>
                  <div class="card-body " style="padding-bottom: 0;padding-top: 0;">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Branch Area *</label>
                      <input type="text" class="form-control" name="church_area" id="church_area"  required="true">
                    </div>
                   
                    <div class="form-group">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="<?php echo base_url('biller_assets/img/image_placeholder.jpg');?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                           
                            <input type="file" name="church_img" required="" value="">
                         
                         </span>
                       
                        </div>
                      </div>
                    </div>
                     <div class="form-group">
                        <div 
                        class="col-md-12" style="padding: 0;">
                           <div class="table-responsive">
                             <table class="table">
                                <thead class=" text-primary">
                                  <tr>
                                    <th></th>
                                    <th>Product </th>
                                    <th>Price(₦)</th>
                                  </tr>
                                </thead>
                            <tbody>
                              <?php if(!empty($product_details)){
                                foreach ($product_details as  $value) { ?>
                                  <tr>
                                  <td>
                                           <div class="form-check mr-auto">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="checkbox" value="<?php echo $value->church_product_id; ?>" name="church_product_id[]">
                                              <span class="form-check-sign">
                                                <span class="check"></span>
                                              </span>
                                            </label>
                                          </div>
                                  </td>
                                  <td>
                                    <?php echo $value->church_product_name; ?>
                                  </td>
                                  <td>
                                    <?php echo $value->church_product_price; ?>
                                  </td>
                                </tr>
                              <?php  }
                              } ?>
                                
                             
                       
                        </tbody>
                      </table>
                    </div>
               
                
              </div>
                     </div>
                  </div>
                  <div class="card-footer text-right" style="padding-top: 0;">
                    
                    
                <input type="submit" name="submit" value="Add" class="btn btn-success" >
                  </div>
                    </form>
                </div>
            
                              
                          </div>
                        </div>
                      </div>
</div>
<style>
  button.btn.btn-raised.btn-primary.sub {
    float: left;
}
.addcharch_model_wrap .modal .modal-dialog {

    margin-top: 10px!important;
  

}
.addcharch_model_wrap span.btn.btn-rose.btn-round.btn-file {
  border-radius: 0!important;
  background: transparent !important;
  color: #000!important;
  box-shadow: none!important;
  text-align: left!important;
  float: left!important;
  padding: 0 0 6px 0!important;
  border-bottom: 1px solid #ccc !important;
  
  position: absolute!important;
  top: 0;
  opacity: 0;
  left: 0;
  width: 207px!important;
  height: 100px!important;
}
</style>