<link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js"></script>
<?php $user_id= $this->session->userdata('user_id');  ?>
<div class="container-fluid">
    <div class="container over-lap-div">
        <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 400px;">
            <div class="my-dt clearfix">
                <div class="col-sm-6 col-xs-12 bank-select-op">
                    <!-- <h2>Add Money</h2> -->
                  <div class="outerblock titleBlock succ" id="success_delete" style="display: none">
					<i class="fa fa-check" aria-hidden="true"></i>
					<div class="titlecont">
						<b class="ln25">
							<span id="delete_success"></span> 
						</b>
					</div>
				  </div> 
                    <?php $this->load->view('alert'); ?>
				
                    <div class="save-cards-div">
                        <h3>Your Saved Cards</h3>
						
						<div class="card-scroll">
                        <input type="hidden" id="usersessionid" value="<?php echo $user_id ?>"/>
                      <?php if(!empty($save_card)){
                      	 
                      	foreach ($save_card as  $value) { 
							  if($value->card_name=='Visa')
								{
									$img=base_url('wassets/images/default_logos/visa_logo@3x.png');
								}else if($value->card_name=='DISCOVER')
								{
									$img=base_url('wassets/images/default_logos/discover_logo@3x.png');
								}else if($value->card_name=='Mastercard')
								{
									$img=base_url('wassets/images/default_logos/maestro@3x.png');
								}else if($value->card_name=='JCB')
								{
									$img=base_url('wassets/images/default_logos/jcb@3x.png');
								}else if($value->card_name=='American Express')
								{
									$img=base_url('wassets/images/default_logos/american_express@3x.png');
								}else 
								{
									$img=base_url('wassets/images/default_logos/maestro@3x.png');
								}
						?>
                            <div class="form-group cards-details-d">
                                <ul>
                                    <li><img src="<?php echo $img; ?>" width="50"></li>
                                    <li><span><?php echo $value->card_no; ?></span></li>
                                    <li>
                                    	
                                        <button class="btn remove-bt" onclick="delete_saved_card('<?php echo $value->save_card_id; ?>')">Remove</button>
                                    </li>
                                </ul>
                            </div>
                         <?php   }
                      }else{ ?>
                           <img src="<?php echo base_url('wassets/images/sorry.png');?>" width="70%" class="center-block"> <?php } ?>
                        </div>    

                       
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 text-center save-cardright-img-div">
                    <figure>
                        <div class="first-add-card">
                            <img src="<?php echo base_url('wassets/images/save-cards.png');?>" width="300" class="center-block">
                            <h3>Add your Credit/Debit Card and experience a faster checkout experience</h3>
                            <h5>For safety, we will never save CVV on your card</h5>
                            <a href="javascript:void(0)" class="btn blue-btn half-w-blue-btn text-center add_card" id="add_card-bt">Add Card</a>
                        </div>
					</figure>
                        <div class="second-add-card" style="display:none;">
                            <h3 class="text-left">Add Credit/Debit Card</h3>
						<form action="<?php echo site_url('web/savedcard') ?>" name="savecard_form" id="savecard_form" method="post">
                            <div class="sv-card-des1">
							<div class="form-group has-feedback">
                                    <label for="usr">Card Number</label>
									
									
									<input class="form-control" placeholder="Enter Card Number" id="card_no" name="card_no" value="" type="text"  pattern="[0-9.]+" maxlength="22" autocomplete="off">
									<span id="card_validtion" class="form-control-feedback glyphicon glyphicon-ok" style="display: none"></span>
                                      <span id="card_no_error"></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 padding-R-0">
                                        <div class="form-group">
                                            <label for="usr">Expiry Month</label>
                                            <select id="expiry_month" class="card-select-op" name="expiry_month">
                                                <option value="">MM</option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <span id="expiry_month_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 padding-L-0 padding-R-0">
                                        <div class="form-group">
                                            <label for="usr">Expiry Year</label>

                                            <select id="expiry_year" class="card-select-op" name="expiry_year">
                                                <option value="">YYYY</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                            </select>
                                             <span id="expiry_year_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="usr">CVV Number</label>
                                            <input class="form-control" placeholder="" name="cvv_no" id="savecvv_no" value="" maxlength="3" type="text">
                                            <span id="savecvv_error"></span>
											<!--<span class="info-cvv"><a href="#" id="infom_cvv" title=""><i class="icon-info" aria-hidden="true"></i></a></span>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
					</form>

                            <div class="form-group">
                                <a href="javascript:void(0)" onclick="add_new_card()" class="btn blue-btn btn proc text-center">Add Card</a>
                                <a href="javascript:void(0)" class="btn gray-btn btn proc text-center" id="cancel_card-bt">Cancel</a>
                            </div>

                        </div>
                </div>
                
            </div>
        </div>
    </div>

</div>
<!--recharge-details-->
</div>
</div>
<!--cont-fluid-->








<script>
    $(document).ready(function() {
        $('#add_card-bt').click(function(e) {
            $('.first-add-card').css('display', 'none');
            $('.second-add-card').css('display', 'block');
        });
        $('#cancel_card-bt').click(function(e) {
            $('.first-add-card').css('display', 'block');
            $('.second-add-card').css('display', 'none');
        });
    });
</script>

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
<script src="<?php echo base_url('wassets/js/jquery.bootstrap-responsive-tabs.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/bootstrap.min.js')?>">
</script>
<script src="<?php echo base_url('wassets/js/jquery-ui.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/owl.carousel.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/slick.min.js');?>"></script>
<script src="<?php echo base_url('wassets/js/matchHeight.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/bootstrap-select.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/custom.js');?>">
</script>
<script>
    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
    });
</script>
<script type="text/javascript">
    $('.dropdown-select').on('click', '.dropdown-menu li a', function() {
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
                card_no: "required",
                cvv_no: {
                    required: true,
                    minlength: 3,
                    maxlength: 3
                },
               
            },

            // Specify the validation error messages
            messages: {
                firstname: "Please enter card expiry month",
                lastname: "Please enter card expiry year",
                card_no: {
                    required: "Please enter a valid card number"
           
                }, 
                cvv_no: {
                    required: "Please enter a valid cvv number",
                    minlength: "Please enter 3 digit cvv number"
                },
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
            items: 1, //10 items above 1000px browser width
            itemsDesktop: [1000, 3], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 3], // betweem 900px and 601px
            itemsTablet: [600, 2], //2 items between 600 and 0
            itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option

        });

        // Custom Navigation Events
        $(".next").click(function() {
            owl.trigger('owl.next');
        })
        $(".prev").click(function() {
            owl.trigger('owl.prev');
        })
        $(".play").click(function() {
            owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter
        })

    });
    
     $(document).ready(function() {
    $('#card_no').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    card_no = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }

  $(this).val(card_no);
  var re16digit = new RegExp("^[0-9 -]+$");
	
		if(card_no=='')
		{
			$("#card_no_error").addClass("errormsg my_account-error");
			$("#card_no_error").text("Please Enter Valid Card Number");
			$("#validcard").css("display","none");
			$("#card_validtion").css("display","none");
		}else
		if (!re16digit.test(card_no)) {
			$("#card_no_error").addClass("errormsg my_account-error");
			$("#card_no_error").text('Please Enter Valid Card Number');
			$("#validcard").css("display","none");
			$("#card_validtion").css("display","none");
		}else
		if (card_no.length < 18 || card_no.length>22) {
			$("#card_no_error").addClass("errormsg my_account-error");
			$("#card_no_error").text('Please Enter Valid Card Number');
			$("#validcard").css("display","none");
			$("#card_validtion").css("display","none");
		}else{
			
			$.ajax({
				url : base_url + "validate_card_number",
				type : "POST",
				data : {
					'card_number' : card_no
					
				},
				success : function(data) { 
					
						var getdata = jQuery.parseJSON(data);
						var status = getdata.status;
						if (status == 'true') {
							$("#card_no_error").removeClass("errormsg my_account-error");
							$("#card_no_error").text('');
							$("#validcard").css("display","block");
							$("#card_validtion").css("display","block");
						}else{
							$("#card_no_error").addClass("errormsg my_account-error");
							$("#card_no_error").text('Please Enter Valid Card Number');
							$("#validcard").css("display","none");
							$("#card_validtion").css("display","none");
						}
				}
			});
			
		}
});
});
</script>


<script>


</script>


</body>

</html>