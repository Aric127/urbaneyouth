<div class="share-earn-bg"></div>
	<div class="after_login_page">
    	
            <div class="col-sm-12 col-xs-12 col-620 share-img text-center offset-top-30">
                <img alt="..." src="https://oyacharge.com/webassets/images/share_icons.png">
            </div>
            <div class="col-sm-12 col-xs-12 col-620 service_heading text-center offset-top-30">
                <h3>Your <span class="color-seagreen">Earned</span> Points</h3>
                <span class="promocode">Promocode - <strong><?php echo  $pin_status= $this->session->userdata('reffer_code');?></strong></span>
                <div class="point-circle text-center">
                    <span>‎₦ <?php if(!empty($reffer_amount)){ echo $reffer_amount; }else{
                        echo "0";
                    } ?></span>
                </div>
                <div class="clearfix"></div>
            </div>
         
        <div class="clearfix"></div>
    </div>

 