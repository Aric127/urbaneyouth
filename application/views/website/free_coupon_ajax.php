
      	<div role="tabpanel" class="tab-pane active" id="OfferCat1">
          <div class="row">
          <?php foreach($coupon_list as $v){ ?>
            <div class="col-md-3 col-sm-4 col-xs-2">
              <div class="offer_holder"> <img src="<?php echo free_coupon_image.'/'.$v->coupon_img;?>" alt="..."/>
                <div class="offer_info">
                  <h3><?php echo $v->coupon_description ?></h3>
                </div>
                <div class="circle-offer add_offer_<?php echo $v->free_coupon_id; ?>" onclick="add_coupon_offer('<?php echo $v->free_coupon_id; ?>')"> <span>Get Offer</span><span class="addedoffer"><i class="fa fa-check"></i></span> </div>
              </div>
            </div>
           <?php } ?>   
           
           
<script>
$(".voucher").click(function() {
    $('html, body').animate({
        scrollTop: $("#voucher").offset().top
    }, 1000);
});
$(".circle-offer").click(function() {
    $('html, body').animate({
        scrollTop: $("#offertop").offset().top
    }, 1000);
});

</script>