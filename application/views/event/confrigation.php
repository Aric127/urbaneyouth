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
                      <b> Error - </b> <?php echo $this->session->flashdata('error'); ?></span>
                  </div>
        <?php } ?>
          <div class="row">
            <div class="col-md-8 center">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Configuration
                 
                  </h4>
                  <div class="total-amt con-amt">
                          <h5>Balance</h5>
                          <h3>₦ <?php if(!empty($get_wallet[0]->wallet_amount)){ echo $get_wallet[0]->wallet_amount; }else{ echo "0"; } ?></h3>
                      </div>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url('church/church_config'); ?>" method="post">
                    <div class="row">
                          <div class="col-md-4">
                        <div class="card-avatar1">
                  <a href="#pablo"> 
                    <img class="img" src="<?php echo base_url('uploads/QR_Code')."/".$biller_config[0]->qr_code; ?>">
                  </a>
                </div>
                      </div>
                       <div id="nme" class="col-md-4 name" >
                        <div class="form-group">
                          <input type="text" class="form-control" name="biller_name" id="biller_name" value="<?php echo $biller_config[0]->biller_name; ?>" disabled>
                        </div>
                        <div class="form-group" >
                        	<i class="material-icons">business_center</i>
                        	 <label class="bmd-label-floating"><?php echo $biller_config[0]->biller_name; ?></label>
                        	
                          
                        </div>
                        <div class="form-group">
							<i class="material-icons">email</i>
                          <label class="bmd-label-floating"><?php echo $biller_config[0]->biller_email; ?></label>
                        </div>
                             <div class="form-group">
							<i class="material-icons">phone</i>
                          <label class="bmd-label-floating"><?php echo $biller_config[0]->biller_contact_no; ?></label>
                        </div>
                      </div>
                      <div class="col-md-3 name">
                        
                        <div class="form-group">
                          <label class="bmd-label-floating">Minimun Withdraw (₦)</label>
                          <input type="text" class="form-control"  name="minimum_withdraw_amount" id="minimum_withdraw_amount" value="<?php echo $biller_config[0]->minimum_withdraw_amount; ?>" >
                        </div>
                        
                         <div class="form-group">
                          <label class="bmd-label-floating">% Charge Transaction</label>
                          <input type="text" class="form-control" name="agent_margin" id="agent_margin" value="<?php echo $biller_config[0]->agent_margin; ?>" disabled>
                        </div>
                        
                      </div>
                     
                  
                      
                      <!-- <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control">
                        </div>
                      </div> -->
                    </div>
                  
                 
                    
                  <!--   <button type="submit" class="btn btn-rose pull-right" style="float: left;">Configure</button> -->
                    <button type="submit" class="btn btn-rose pull-right">Update</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>