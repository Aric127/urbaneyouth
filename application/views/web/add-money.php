<link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">


<div class="container-fluid"> 
      <div class="container over-lap-div">
         <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 400px;">
         <div class="my-dt">
         <div class="col-sm-6 col-xs-12 bank-select-op">
         <!-- <h2>Add Money</h2> -->
         <div class="add-mone">
           <h3>Add money to your wallet & avail amazing benefits!</h3>
           <form>
              <div class="form-group">
                    <input class="form-control add" id="usr" placeholder="Enter Amount" name="user_ac_no" required="" value="" type="text">
              </div>
              <div class="form-group">
                    <input class="form-control" id="usr" placeholder="Promo Code" name="user_ac_no" required="" value="" type="text">
              </div>
              <div class="form-group">
                  <button class="btn blue-btn half-w-blue-btn">Add Now</button>
              </div>

           </form>
         </div>
         </div>
         <div class="col-sm-6 col-xs-12 mob-m">
            <div class="owl-carousel add-mo-slide">
                  <div class="item"><img src="https://oyacharge.com/wassets/images/superwow1.png" class="center-block"></div>
                 <div class="item"><img src="https://oyacharge.com/wassets/images/offer-mega.png" class="center-block"></div> 
                 <div class="item"><img src="https://oyacharge.com/wassets/images/banner3.png" class="center-block"></div> 
          </div>


              
              <!-- <p class="wlcmDtls">
                <span>Welcome,</span> 
                <strong>
                  <label data-ng-bind="UserInfo.firstName" class="ng-binding"></label>          
                  <label data-ng-bind="UserInfo.lastName" class="ng-binding"></label>
                </strong> 
                <a ui-sref="mywallet.settings.profile" href="/mywallet/settings/profile">
                  <font id="edt_dtl">Edit</font>
                </a>
              </p>

              <p class="dshDtls">
                  <label>Your Wallet Balance:</label>
                  <span>
                    <strong class="ng-binding">Rs. 0</strong>
                  </span>
              </p>
              <p class="dshDtls"><label>Primary Number:</label>
                  <span data-ng-bind="UserInfo.contactNo" class="ng-binding">9755142065</span>
              </p>
              <p class="dshDtls email">
                  <label>Email id:</label>
                  <span data-ng-bind="UserInfo.email" class="ng-binding">shilpa.ypsilon@gmail.com</span>
              </p>
              <div class="clearfix">
                
              </div> -->
            </div>
         </div>
         </div>


         </div><!--recharge-details-->
      </div>
</div><!--cont-fluid-->



 <script>
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
/*    autoPlay:1000,*/
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 2
          }
        }
      })
    </script>



<script type="text/javascript">
  $('.sv-crd a').click(function(e) {
        e.preventDefault();
        $('a').removeClass('active');
        $(this).addClass('active');
    });

</script>


<!-- <script type="text/javascript">
  function showDiv() {
   document.getElementById('promo_input').style.display = "block";
   document.getElementById('promo_d').style.display = "none";
}  
</script> -->

<script type="text/javascript">
  $(document).ready(function() {
    $("div.bhoechie-tab-menu-paymt>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab-paymt>div.bhoechie-tab-content-paymt").removeClass("active");
        $("div.bhoechie-tab-paymt>div.bhoechie-tab-content-paymt").eq(index).addClass("active");
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
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#card_payment").validate({
    
        // Specify the validation rules
        rules: {
            expiry_month: "required",
            expiry_year: "required",
            card_no: {
                required: true,
                minlength: 16
            },
            cvv_no: {
                required: true,
                minlength: 3,
                maxlength: 3
            },
            agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            firstname: "Please enter card expiry month",
            lastname: "Please enter card expiry year",
            card_no: {
                required: "Please enter a valid card number",
                minlength: "Please enter 16 digit card number"
            },
           cvv_no: {
                required: "Please enter a valid cvv number",
                minlength: "Please enter 3 digit cvv number"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>
<script type="text/javascript">

         $(document).ready(function() {
          
           var owl = $(".owl-carousel");
         
           owl.owlCarousel({
               items : 1, //10 items above 1000px browser width
               itemsDesktop : [1000,3], //5 items between 1000px and 901px
               itemsDesktopSmall : [900,3], // betweem 900px and 601px
               itemsTablet: [600,2], //2 items between 600 and 0
               itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
         
           });
          
           // Custom Navigation Events
           $(".next").click(function(){
             owl.trigger('owl.next');
           })
           $(".prev").click(function(){
             owl.trigger('owl.prev');
           })
           $(".play").click(function(){
             owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
           })
          
          
         });



</script>



</body>
</html>