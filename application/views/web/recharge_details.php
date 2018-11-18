<?php   $user_id= $this->session->userdata('user_id');?>

<div class="container-fluid"> 
            <div class="container over-lap-div recharge-detail-page">
               <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result">
               <ul class="recharge-result-list">
               		<li>
               			<div class="mobile-sim-com">
							<div class="pull-left">
	               			<img src="<?php echo $operator_image; ?>" class="img-responsive img-circle">
							</div>
	               			<div class="sim-detail">
							<p></p>
	               			<p><?php if(!empty($recharge_category_id)){ if($recharge_category_id=='6'){ echo "Church Donation";  } else if($recharge_category_id=='7'){ echo "Event Ticket";  }else if($recharge_category_id=='4'){ echo "Bill Invoice";  } else{ echo "Recharge Payment";} } ?> of <?php echo $operator_name; ?> of <?php echo $mobile ?> </p>
	               			<input type="hidden" id="recharge_amount" value="<?php echo $mobile_amount ?>">
	               			<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	               			</div>
               			</div>
               		</li>
               		<li class="rech">
               			<h5><?php if(!empty($recharge_category_id)){ if($recharge_category_id=='6'){ echo "Donation";  }}else{ echo "Recharge";} ?></h5>
               			<span><?php echo $mobile_amount ?>/-</span>

               		</li>
               		<li class="pro_d_main">
                    <a class="promocode-link" onclick="showDiv()" id="promo_d">Have a promocode?</a>
                    
                    <div class="pro_inp_div" style="display:none;" id="promo_input"  >
                      <input type="text" id="promo_code"  name="pro-i"   class="form-control hasclear" value="" placeholder="promocode" />
                      <span class=" apply-b"><a href="javascript:void(0)" onclick="apply_promocode()">Apply</a></span>
                      <span id="coupon_status"></span>
                    </div>
                  
                     
               		</li>
               		<li class="paybtn">
               			<a href="<?php echo site_url('web/payment_details') ?>" class="pay-btn-wallet">Proceed to pay &#8358; <?php echo $mobile_amount ?> </a>
               		</li>
               </ul>
               </div>
            


<div class="col-sm-12 col-xs-12 col-lg-12 recharge-offer">
     <h3 class="head-offer-punlimt" >Unlimited Offers With Your Recharge <span>(Showing <span id="product_count"><?php if(!empty($coupon_count)) echo $coupon_count; ?></span> Products)</span></h3>   
 <div class="short-by-div">

 	<div class="dropdown dropdown-select" style="float: right;" >
            <select class="selectpicker">
              <option>Sort By</option>
              <option>Popular</option>
              <option>Low to High</option>
              <option>High to Low</option>
               <option>New</option>
            </select>

            <!--
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        Sort By
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu sp-dp" role="menu" aria-labelledby="dropdownMenu1">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Popular</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Low to High</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">High to Low</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">New</a></li>
    </ul>-->
 </div>
 </div>
 <div class="clearfix">
 </div>
 <hr style="margin-top: 10px; margin-bottom: 2px;">

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="tabs-left tabs-rech-div clearfix">
        <button type="button" id="mo" class="navbar-toggle abc" data-toggle="collapse" data-target="#mobile" aria-expanded="false" aria-controls="navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <p>Menu</p>
        </button>
        <ul id="mobile" class="nav recharge-tab-sp nav-tabs col-sm-2 col-md-2 col-xs-12 navbar-collapse collapse" >
        	<li role="presentation" class="active"><a href="#OfferCat1" aria-controls="home" role="tab" data-toggle="tab" onclick="get_all_coupon()">All</a></li>
        
        	  <?php foreach($coupon_category as $v){ ?>
        <li role="presentation" ><a href="#OfferCat2" aria-controls="profile" role="tab" data-toggle="tab" onclick="get_coupon_cat_id(<?php echo $v->free_coupon_category_id ?>)" ><?php echo $v->free_coupon_category_name; ?>
        	
        </a></li>
       
        <?php } ?>
              <!--<li class="active"><a href="#a" data-toggle="tab"><i class="icon-drop"></i> All</a></li>
              <li><a href="#b" data-toggle="tab"><i class="icon-cup"></i> Food</a></li>
              <li><a href="#c" data-toggle="tab"><i class="icon-film"></i> Entertainment </a></li>
              <li><a href="#d" data-toggle="tab"><i class="icon-handbag" aria-hidden="true"></i> Store</a></li>
              <li><a href="#e" data-toggle="tab"> <i class="fa fa-sun-o" aria-hidden="true"></i>Care </a></li>
              <li><a href="#a" data-toggle="tab"><i class="icon-heart" aria-hidden="true"></i>Lifestyle</a></li>
              <li><a href="#f" data-toggle="tab"><i class="icon-social-dribbble"></i> SuperMarket</a></li>-->
        </ul>
<div class="recharge-tbs tab-content col-sm-10 col-md-10 col-xs-12">
          <div class="tab-pane active" id="coupons">

           <div class="row">
              <!--  <?php foreach($coupon_list as $v){ ?>
            <div class="col-md-3 col-sm-4 col-xs-2">
              <div class="offer_holder"> <img src="<?php echo free_coupon_image.'/'.$v->coupon_img;?>" alt="..."/>
                <div class="offer_info">
                  <h3><?php echo $v->coupon_description ?></h3>
                   <span style="position:absolute; bottom:0px; background: #78C2BB; color:#fff; padding:3PX; font-size: 14px; right:0;cursor: pointer" onclick="show_terms_condtions('<?php echo $v->free_coupon_id; ?>')" >T&C</span>
                </div>
                <div class="circle-offer add_offer" onclick="add_coupon_offer('<?php echo $v->free_coupon_id; ?>')" id="picked_offer"> Get Offer </div>
              </div>
            </div>
              <?php } ?>
           -->

           <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner1.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner2.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner1.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner2.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-2">
              <div class="offer-item-box">
              <div class="offer-item">
                 <img class="img-responsive" src="<?php echo base_url('wassets/images/oyabanner.png');?>" alt="..."/>
              </div>
                 
              </div>
            </div>

           </div>


          </div>
          
       
        </div><!-- /tab-content -->
      </div><!-- /tabbable -->
    </div><!-- /col -->
  </div><!-- /row -->
</div><!-- /container -->








</div>
</div>
</div>



<script type="text/javascript">
  function showDiv() {
   document.getElementById('promo_input').style.display = "block";
   document.getElementById('promo_d').style.display = "none";
}  
</script>
<script type="text/javascript">
$(document).ready(function () {
    $("#mo li a").click(function(event) {
        // check if window is small enough so dropdown is created
    $("#mobile").removeClass("in").addClass("collapse");
   
});
});
</script>






 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="<?php echo base_url('wassets/js/jquery.bootstrap-responsive-tabs.min.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/bootstrap.min.js')?>"> </script>
      <script src="<?php echo base_url('wassets/js/jquery-ui.min.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/owl.carousel.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/slick.min.js');?>"></script>
      <script src="<?php echo base_url('wassets/js/matchHeight.min.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/bootstrap-select.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/custom.js');?>"> </script>
      <script>
         $('.responsive-tabs').responsiveTabs({
           accordionOn: ['xs', 'sm']
         });
      </script>
<script type="text/javascript">
		$('.dropdown-select').on( 'click', '.dropdown-menu li a', function() { 
	   var target = $(this).html();

	   //Adds active class to selected item
	   $(this).parents('.dropdown-menu').find('li').removeClass('active');
	   $(this).parent('li').addClass('active');

	   //Displays selected text on dropdown-toggle button
	   $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <span class="caret"></span>');
	});


</script>



</body>
</html>