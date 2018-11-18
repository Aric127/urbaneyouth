
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
           <?php if ($this->session->flashdata('success')) { ?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b>  <?php echo $this->session->flashdata('success'); ?></span>
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

          <div class="col-md-8 col-12 mr-auto ml-auto">
            <!--      Wizard container        -->
            <div class="wizard-container">
              <div class="card card-wizard" data-color="rose" id="wizardProfile">
                <form action="<?php echo base_url('biller/update_biller_info'); ?>" method="post" name="biller_profile" enctype="multipart/form-data">
                  <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                  <div class="card-header text-center">
                  
                    <div class="parent">
                      <div class="total-amt">
                          <h5>Balance</h5>
                          <h3>₦ <?php if(!empty($get_wallet[0]->wallet_amount)){ echo $get_wallet[0]->wallet_amount; }else{ echo "0"; } ?></h3>
                      </div>
                        <?php if($biller_details[0]->biller_status==1){ ?>
                     <img class="cion" src="<?php echo base_url('biller_assets/img/approved.png');?>">
                     <?php }else if($biller_details[0]->biller_status==2){ ?>
                     <img class="cion" src="<?php echo base_url('biller_assets/img/pending.png');?>">
                      <?php }else if($biller_details[0]->biller_status==3){ ?>
                     <img class="cion" src="<?php echo base_url('biller_assets/img/reject.png');?>">
                     <?php } ?>
                    <div class="text-1">
                    <h3 class="card-title">
                      Build Your Profile
                    </h3>
                    <h5 class="card-description">This information will let us know more about you.</h5>
                     </div>
                 
                 
                </div>
                  <div class="wizard-navigation buil">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
                          About
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#account" data-toggle="tab" role="tab">
                          Business Info
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#bankaccount" data-toggle="tab" role="tab">
                          Bank Account 
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="#address" data-toggle="tab" role="tab">
                          Address
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="about">
                        <h5 class="info-text"> Let's start with the basic information </h5>
                        <div class="row justify-content-center">
                          <div class="col-sm-3">
                            <div class="picture-container">
                              <div class="picture">
                                <img src="<?php if(!empty($biller_details)){
                                echo company_logo."/".$biller_details[0]->biller_company_logo;
                                } ?>" class="picture-src" id="wizardPicturePreview" title="" />
                                <input type="file" id="wizard-picture" name="biller_company_logo" value="">
                              </div>
                              <h6 class="description">Choose Picture</h6>
                            
                            
                            </div>
                          </div>
                           <div class="col-sm-9">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Name </label>
                                <input type="text" class="form-control" id="biller_name" name="biller_name" required value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_name;
                                } ?>">
                              </div>
                            </div>
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">business</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput11" class="bmd-label-floating">Company Name</label>
                                <input type="text" class="form-control" id="biller_company_name" name="biller_company_name" required value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_company_name;
                                } ?>" <?php if(!empty($biller_details[0]->biller_contact_no)){?> readonly="readonly" <?php } ?>>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-12 mt-3">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">email</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Email</label>
                                <input <?php if(!empty($biller_details[0]->biller_email)){?> readonly="readonly" <?php } ?> type="email" class="form-control" id="biller_email" name="biller_email" required value="<?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_email;
                                                            } ?>">
                              </div>
                            </div>
                         <!--      <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">lock</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Password</label>
                                <input type="text" class="form-control" id="exampleemalil" name="email">
                              </div>
                            </div> -->
                          
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="account">
                        
                         <div class="row justify-content-center">
                         <div class="col-sm-3">
                            <div class="picture-container">
                              <div class="picture">
                                <img src="<?php if(!empty($biller_details)){
                                echo company_logo."/".$biller_details[0]->biller_company_logo;
                                } ?>" class="picture-src" id="wizardPicturePreview2" title="" />
                               
                              </div>
                              
                             
                            
                            </div>
                          </div>
                          <div class="col-sm-9">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">phone</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Business Phone No</label>
                                <input <?php if(!empty($biller_details[0]->biller_contact_no)){?> readonly="readonly" <?php } ?> type="text" class="form-control" id="biller_contact_no" name="biller_contact_no" required value="<?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_contact_no;
                                                            } ?>">
                              </div>
                            </div>
                      
                             <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">
                                  <i class="material-icons">settings</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Biller Category</label>
                                <input type="text" class="form-control" id="biller_category_name" name="biller_category_name" required value="<?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_category_name;
                                                            } ?>" >
                              </div>
                            </div>
                          </div>
                              <div class="col-lg-12 mt-3">
                                <div class="input-group-prepend col-md-2" style="float: left;">
                                 <span class="input-group-text">
                                 <img src="<?php echo base_url('biller_assets/img/number.png');?>" class="num-icon">
                                </span>
                              </div>
                          <div class="input-group form-control-lg col-md-4" style="float: left;">
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Registration No</label>
                                <input type="text" class="form-control" id="company_reg_no" name="company_reg_no" value=" <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->company_reg_no;
                                                            } ?>">
                              </div>
                            </div>
                            <div class="input-group form-control-lg col-md-3" style="float: left;">
                          
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">RC No</label>
                                <input type="text" class="form-control" id="rc_no" name="rc_no" value="<?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->rc_no;
                                                            } ?>">
                              </div>
                            </div>
                            <div class="input-group form-control-lg col-md-3" style="float: left;">
                             
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating">Tin No</label>
                                <input type="text" class="form-control" id="tin_no" name="tin_no" value="<?php if(!empty($biller_details)){ echo $biller_details[0]->tin_no;} ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="input-group form-control-lg" style="float: left;">
                             
                              <div class="form-group">
                                <label for="exampleInput1" class="bmd-label-floating" style="float: left;">Upload Document</label>
                                <input type="file" class="form-control"  name="biller_document" id="biller_document" value="" style="opacity: 1 !important;position: static!important;">
                              </div>
                            </div>
                          </div>
                       </div>
                      </div>
                          <div class="tab-pane" id="bankaccount">
                            
                         <div class="row justify-content-center">
                          
                          <div class="col-sm-3">
                            <div class="picture-container">
                              <div class="picture">
                                <img src="<?php if(!empty($biller_details)){
                                echo company_logo."/".$biller_details[0]->biller_company_logo;
                                } ?>" class="picture-src" id="wizardPicturePreview3" title="" />
                              
                              </div>
                             
                            </div>
                          </div>
                          <div class="col-sm-9">
                             <div class="input-group form-control-lg">
                             <div class="input-group-prepend">
                                <span class="input-group-text">
                                   <img src="http://www.urbaneyouth.com/biller_assets/img/bank.png" class="num-icon">
                                </span>
                              </div>
                            <div class="form-group select-wizard">
                             <?php if($biller_details[0]->biller_status==1){?>
                              <input  type="text" class="form-control"  value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->bank_name;
                                } ?>" readonly>
                              <?php }else{ ?>
                              <select   class="selectpicker" name="bank_code" id="bank_code" data-size="7" data-style="select-with-transition" title="Select Bank" required="" >
                               <?php if(!empty($bank_list)){
                                  foreach ($bank_list as  $value) { ?>
                                       <option value="<?php echo $value->bank_code ?>" <?php if($value->bank_code==$biller_details[0]->bank_code){ ?> selected="selected" <?php } ?>> <?php echo $value->bank_name ?> </option>
                                 <?php }
                                } ?>
                            </select>

                          <?php   } ?>
                             
                            </div>
                        </div>
                            <div class="input-group form-control-lg">
                               
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">edit</i>
                                </span>
                              </div>
                            <div class="form-group">
                               
                              <label>Account No</label>
                              <input  <?php if($biller_details[0]->biller_status==1){?> readonly="readonly" <?php } ?> type="text" class="form-control" name="bank_account_no" id="bank_account_no"  required="" value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->bank_account_no;
                                } ?>" onblur="check_bank_verified()">
                            </div>
                            <span id="bank_error" style="color: red;text-align: center;font-size: 14px"></span>
                            <span id="bank_info_msg" style="color: green;font-size: 14px"></span>
                          </div>
                        </div>
                          <div class="col-lg-12 mt-3">
                            <div class="input-group form-control-lg">
                               
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              
                            <div class="form-group">
                               
                              <label>Account Holder Name</label>
                              <input type="text" class="form-control" name="bank_account_holder" id="bank_account_holder" value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->bank_account_holder;
                                } ?>" required="" readonly="readonly">
                                
                            </div>
                          </div>
                      </div>
                      
                      
                      </div>
                        </div>
                      <div class="tab-pane" id="address">
                              <h5 class="info-text"> Are you living in a nice area? </h5>
                         <div class="row justify-content-center">
                          <div class="col-sm-3">
                            <div class="picture-container">
                              <div class="picture">
                                <img src="<?php if(!empty($biller_details)){
                                echo company_logo."/".$biller_details[0]->biller_company_logo;
                                } ?>" class="picture-src" id="wizardPicturePreview4" title="" />
                                
                              </div>
                             
                            </div>
                          </div>

                          <div class="col-sm-9">
                              <div class="input-group form-control-lg">
                                 <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">streetview</i>
                                </span>
                              </div>
                          <div class="form-group">
                              <label>Street Name</label>
                              <input type="text" class="form-control" required="" id="biller_address" name="biller_address" value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_address;
                                } ?>">
                            </div>
                          </div>
                            <div class="input-group form-control-lg">
                               
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                 <img src="http://www.urbaneyouth.com/biller_assets/img/state.png" class="num-icon">
                                </span>
                              </div>
                            <div class="form-group">
                               
                              <label>State</label>
                              <input type="text" class="form-control" id="biller_state" name="biller_state" required="" value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_state;
                                } ?>" >
                            </div>
                          </div>
                      </div>
                      
                        <div class="col-sm-12">
                           <div class="input-group form-control-lg">
                         <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">location_city</i>
                                </span>
                              </div>
                            <div class="form-group">
                              <label>City</label>
                              <input type="text" class="form-control" id="biller_city" name="biller_city"
                               value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_city;
                                } ?>" required="">
                            </div>
                         </div>
                    
                     <div class="input-group form-control-lg">
                         <div class="input-group-prepend">
                                <span class="input-group-text">
                                 <img src="http://www.urbaneyouth.com/biller_assets/img/zip.png" class="num-icon"> 
                                </span>
                              </div>
                            <div class="form-group">
                              <label>Zip Code</label>
                              <input type="text" class="form-control" id="biller_zipcode" name="biller_zipcode" required="" value="<?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_zipcode;
                                } ?>">
                            </div>
                         </div>
                         <!--   <div class="input-group form-control-lg">
                             <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">country</i>
                                </span>
                              </div>
                            <div class="form-group select-wizard">
                             
                              <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Country">
                                <option value="Afghanistan"> Afghanistan </option>
                                <option value="Albania"> Albania </option>
                                <option value="Algeria"> Algeria </option>
                                <option value="American Samoa"> American Samoa </option>
                                <option value="Andorra"> Andorra </option>
                                <option value="Angola"> Angola </option>
                                <option value="Anguilla"> Anguilla </option>
                                <option value="Antarctica"> Antarctica </option>
                              </select>
                            </div>
                        </div> -->
                          </div>
                      </div>
                        </div>
                
                  </div>
                  <div class="card-footer">
                    <div class="mr-auto">
                      <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                    </div>
                    <div class="ml-auto">
                      <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
                      <input id="submit_btn" type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish" style="display: none;">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
<script type="text/javascript">
  function check_bank_verified()
  {
    $('#bank_error').text(''); 
    $("#bank_info_msg").text("Please wait.. We fetching bank information!");
    var bank_code   = $("#bank_code").val();
    var ac_no       = $("#bank_account_no").val();
    var holder_name = $("#bank_account_holder").val();
     var URL = "<?php echo base_url('webservices/api.php?rquest=validate_bank_account_number'); ?>";
            $.ajax({
              url: URL,
              data: {"bank_code" : bank_code,"account_number":ac_no},
              dataType:"json",
              type: "post",
              success: function(data){ 
                $("#bank_info_msg").text('');
              
               if(data.status == 'true'){
                  $('#bank_account_holder').val(data.name);
                   $('#bank_account_no').css('color','green');
                   $('#bank_code').css('color','green');
                  $('#bank_error').text('');   
                  $("#submit_btn").prop("type", "submit");
                }else{
                  $('#bank_account_holder').val('');
                  $('#bank_account_no').css('color','red');
                  $('#bank_code').css('color','red');
                  $('#bank_error').text(data.message);  
                   $("#submit_btn").prop("type", "button"); 
                 
                }               
              }
          });
  }
</script>