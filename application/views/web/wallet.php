<link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">

<div class="container-fluid">
    <div class="container over-lap-div">
        <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 680px;">
            <div class="trans-head-div">
                <h2 class=""><img src="https://oyacharge.com/wassets/images/wallet-icon-heading.png"  width="60"> Wallet</h2>
            </div>
            <div class="balance">
                <h2 class="blue">Available Balance  <span class="pull-right">&#8358; <?php echo $my_wallet; ?></span></h2>
            </div>
            <div class="wallet-tb-des wallet-pg clearfix">
                <ul class="nav responsive-tabs me col-sm-0 col-md-3 col-xs-12">
                    <li class="active"><a href="#a" data-toggle="tab">Add Money</a></li>
                    <li><a href="#b" data-toggle="tab">Transfer Money</a></li>
                    <li><a href="#c" data-toggle="tab">Bank Transfer</a></li>
                </ul>
                <div class="tab-content col-sm-8 col-md-5 col-xs-12 padding-0">
                    <div class="tab-pane active" id="a">

                        <div class="bank-act labe active">
                            <h3>Add Money</h3>
                            <form action="<?php echo base_url('Wallet') ?>" method="post">
                                <div class="bank-select-op">
                                    <div class="form-group">
                                        <label for="usr">Amount</label>
                                        <input class="form-control" id="amount" placeholder="Enter Amount" name="amount" required="" value="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Pay With</label>
                                        <div class="row pay-apply">
                                            <div class="col-sm-9 ">
                                                <input class="form-control" id="promo_code" placeholder="Apply Promocode" name="promo_code" value="" type="text">
                                                <input id="user_id" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>" type="hidden">
                                                <input type="hidden" id="coupon_amount" name="coupon_amount" value="" />
                                                <input type="hidden" id="coupon_id" name="coupon_id" value="" />
                                            </div>

                                            <div class="col-sm-3 pd">
                                                <button type="button" class="braun-btn btn pull-right b" name="apply_prmocode" onclick="apply_promocode_add_wallet()">Apply</button>

                                            </div>
                                            <span id="coupon_status"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <input name="sub_btn" class="blue-btn btn proc" value="Proceed" type="submit">
                                <a href="<?php echo site_url('web/cancel ') ?>" class="gray-btn btn proc">Cancel</a>

                            </form>
                        </div>

                    </div>
                    <div class="tab-pane" id="b">
                        <div class="bank-act labe active">
                            <h3>Transfer Money</h3>
                            <form action="<?php echo base_url('web/transfer_money') ?>" method="post">
                                <div class="bank-select-op">
                                    <div class="form-group">
                                        <label for="usr">Mobile No.</label>
                                        <input class="form-control" id="transfer_mobile_no" placeholder="Enter Number" name="transfer_mobile_no" required="" value="" type="text" onblur="check_number_field()">
                                        <span id="number_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Amount</label>
                                        <input class="form-control" id="transfer_amount" placeholder="Enter Amount" name="transfer_amount" required="" value="" type="text" onblur="check_amount_field()">
                                        <span id="amount_error"></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <input name="sub_btn" class="blue-btn btn proc" value="Proceed" type="submit">
                                <a href="<?php echo base_url('web'); ?>" class="gray-btn btn proc">Cancel</a>
                            </form>
                        </div>

                    </div>
                    <div class="tab-pane" id="c">
                        <div class="bank-act labe active">
                            <h3>Bank Transfer</h3>
                            <form class="userform" action="<?php echo base_url('BankTransfer') ?>" method="post" id="wallet_bank_form">
                                <div class="bank-select-op">
                                     <div class="form-group bank-select-custom">
                                      <label for="usr">Select Bank</label>
                                          <select class="selectpicker" id="user_bank_code" name="user_bank_code" required="" onchange="validate_account_number()">
                                            <option value="">Select Bank</option>
                                            <?php if(!empty($bank_list)){
                                       
                                          foreach ($bank_list as $key => $value) { ?>
                                            <option value="<?php echo $key ?>"><?php echo $value;?></option>
                                              
                                     <?php   }
                                          } ?>
                                      </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="usr">Account Number</label>
                                        <input class="form-control" id="user_ac_no" placeholder="Enter Account Number" name="user_ac_no" required="" value="" type="text" onblur="validate_account_number()">
                                    </div>
                                   <div class="form-group">
                                        <label for="usr">Account Holder's Name</label>
                                        <input class="form-control" id="account_holder_name" placeholder="Account Holder's Name" name="account_holder_name" required="" value="" type="text" readonly="">
                                        <label class="error" id="error_account_holder"></label>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="usr">Bank Code</label>
                                        <input class="form-control" id="user_bank_code" placeholder="Enter Bank Code" name="user_bank_code" required="" value="" type="text">
                                    </div> -->
                                     <div class="form-group">
                                        <label for="usr">Amount</label>
                                        <input class="form-control" id="transfer_amount" placeholder="Enter Amount" name="transfer_amount" required="" value="" type="text">
                                    </div>
                                     
                                </div>
                                <div class="clearfix"></div>
                                <input name="sub_btn" class="blue-btn btn proc" value="Proceed" type="submit">
                                <a href="<?php echo base_url('web'); ?>" class="gray-btn btn proc">Cancel</a>
                            </form>
                        </div>

                    </div>

                </div>
                <!-- /tab-content -->

                <div class="col-sm-4 col-md-4 col-xs-12">
                    <div id="owl-demo" class="owl-carousel add-mo-slide owl-theme">
                        <div class="item"><img src="https://oyacharge.com/wassets/images/add-money-patten.png" class="center-block"></div>
                        <div class="item"><img src="https://oyacharge.com/wassets/images/bank-wallet-patten.png" class="center-block"></div>
                        <div class="item"><img src="https://oyacharge.com/wassets/images/transfer-money-patten.png" class="center-block"></div>
                    </div>
                </div>

            </div>
            <!-- /tabbable -->

        </div>
    </div>
</div>
<!--recharge-details-->
</div>
<!--cont-fluid-->

<script type="text/javascript">
    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs'] // xs, sm, md, lg
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

    function validate_account_number()
    {
       var account_no  = $("#user_ac_no").val();
       var bank_code   = $("#user_bank_code").val();
       if(account_no!='' && bank_code!='')
       {
        $.ajax({
            url : '<?php echo base_url('web/validate_account_number') ?>',

            type : "POST",
            data : {
                'account_no' : account_no,
                'bank_code'  : bank_code

            },
            success : function(data) { 
                var getdata = jQuery.parseJSON(data);
                var status = getdata.status; 
                var message = getdata.message; 
                    if(status=='true')
                    {
                        $("#account_holder_name").val(getdata.name);
                    }else{
                        $("#account_holder_name").text(getdata.message);
                    }
            }
        });
       }
       
}
</script>
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

        var owl = $("#owl-demo");

        owl.owlCarousel({
            items: 1, //10 items above 1000px browser width
            itemsDesktop: [1000, 1], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 1], // betweem 900px and 601px
            itemsTablet: [600, 1], //2 items between 600 and 0
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

    // function check field of transfer money page//
    function check_amount_field() {
        var transfer_amount = $("#transfer_amount").val();
        var amount = parseInt(transfer_amount);

        if (isNaN(amount)) {
            $("#amount_error").text("Please Enter a valid amount");
            $("#amount_error").attr('style', 'color:red');
        } else {
            $("#amount_error").text("");
            $("#amount_error").attr('style', 'color:');
        }

    }

    function check_number_field() {

        var transfer_mobile_no = $("#transfer_mobile_no").val();
        var number = parseInt(transfer_mobile_no);
        if (isNaN(number)) {
            $("#number_error").text("Please Enter a valid number");
            $("#number_error").attr('style', 'color:red');
        } else if ($('#transfer_mobile_no').val().length > 11) {
            $("#number_error").text("Please Enter a 11 digit number");
            $("#number_error").attr('style', 'color:red');
        } else if ($('#transfer_mobile_no').val().length < 11) {
            $("#number_error").text("Please Enter a 11 digit number");
            $("#number_error").attr('style', 'color:red');
        } else {
            $("#number_error").text("");
            $("#number_error").attr('style', 'color:');
        }

    }
</script>
<!--<script>
$(document).ready(function() {

  var sync1 = $("#owl-demo");

  sync1.owlCarousel({
    items : 1,
    slideSpeed : 2000,
    nav: true,
    autoplay: true,
    dots: true,
    loop: true,
  })
});
</script>-->

</body>

</html>
<script>
    //apply_promocode_add_wallet
    function apply_promocode_add_wallet() {
        var amount = $("#amount").val();
        var user_id = $("#user_id").val();
        var promo_code = $("#promo_code").val();

        $.ajax({
            url: base_url + "apply_promocode",
            'type': 'POST',
            'data': {
                'promo_code': promo_code,
                'user_id': user_id

            },
            'success': function(data) {
                var getdata = jQuery.parseJSON(data);
                var status = getdata.status;
                var message = getdata.message;
                if (status == 'true') {

                    var coupon_amount = getdata.coupon_amount;
                    var coupon_price = getdata.amount_price;

                    if (amount >= parseInt(coupon_price)) {

                        var coupon_id = getdata.coupon_id;

                        $.ajax({
                            url: site_url + "promocode_session",
                            'type': 'POST',
                            'data': {
                                'coupon_amount': coupon_amount,
                                'coupon_id': coupon_id

                            },
                            'success': function(data) {

                            }
                        });

                        $("#coupon_status").text(message);
                        $("#coupon_amount").val(coupon_amount);
                        $("#coupon_id").val(coupon_id);
                        $('#coupon_status').attr('style', 'color: green');
                        $('#promo_code').attr('style', 'border-color: white');
                        $('#amount').attr('style', 'border-color: white');
                    } else {
                        $('#amount').attr('style', 'border-color: red');
                        $('#coupon_status').attr('style', 'color: red');
                        $("#coupon_status").text('promocode apply with ₦ ' + coupon_price);
                    }

                } else if (status == 'false') {

                    $('#promo_code').attr('style', 'border-color: red');
                    $('#coupon_status').attr('style', 'color: red');
                    $("#coupon_status").text(message);
                }
            }
        });
    }
</script>
<script>
$(document).ready(function() {
    $("#wallet_bank_form").validate({
        rules: {
            user_ac_no: {
                required: true,
                number: true
            },
            user_bank_code: "required",
            transfer_amount: {
                required: true,
                number: true
            }
           
        },
        messages: {
            user_ac_no: {
                required: "Please enter valid account number",
                number: "Please enter only numeric value"
            },
            user_bank_code: "Please Select Bank",
            transfer_amount: {
                required: "Please enter valid amount",
                number: "Please enter only numeric value"
            }
          
        }
    });
});

</script>
<style type="text/css">
    .userform{width: 500px;}
.userform p {
    width: 100%;
}
.userform label {
    width: 200px;
    color: #333;
    float: left;
}
input.error {
    border: 1px dotted red;
}
label.error{
    width: 100%;
    color: red;
    font-style: italic;
    margin-left: 10px;
    margin-bottom: 5px;
}
.userform input.submit {
    margin-left: 20px;
}
</style>