 <!-- LoginModal HTML -->
  <?php $this->load->view('web/popup_modal'); ?>

  <footer>
        <div class="container">

            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>TV Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">MultiChoice DSTV  </a> </li>
                        <li> <a href="#">Star Times Cable TV </a> </li>
                        <li> <a href="#">MultiChoice GOTV </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Mobile Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">Etisalat  </a> </li>
                        <li> <a href="#">Airtel </a> </li>
                        <li> <a href="#">MTN </a> </li>
                        <li> <a href="#">Glo </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Data Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">Smile Recharge   </a> </li>
                        <li> <a href="#">Smile Bundle </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Support</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#"> care@oyacharge.com </a> </li>
                        <li> <a href="#vedio_section">About Us </a> </li>
                        <li> <a href="#contact_form ">Contact Us </a> </li>
                        <li> <a href="#">Terms &amp; Conditions</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright"> © 2017 All Rights Reserved. Developed by - <span class="footer-high-text">Oyecharge.com</span></div>
    </footer>
   

        

       

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
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
        <script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js'></script>
        <script type="text/javascript">
          $(".modal").each(function(l){$(this).on("show.bs.modal",function(l){var o=$(this).attr("data-easein");"shake"==o?$(".modal-dialog").velocity("callout."+o):"pulse"==o?$(".modal-dialog").velocity("callout."+o):"tada"==o?$(".modal-dialog").velocity("callout."+o):"flash"==o?$(".modal-dialog").velocity("callout."+o):"bounce"==o?$(".modal-dialog").velocity("callout."+o):"swing"==o?$(".modal-dialog").velocity("callout."+o):$(".modal-dialog").velocity("transition."+o)})});
        </script>
        <script>
            $('.responsive-tabs').responsiveTabs({
                accordionOn: ['xs', 'sm']
            });
        </script>
        <script type="text/javascript">
            $('.ststCntnr').owlCarousel({
                loop: true,
                margin: 5,
                nav: true,
                dots: false,
                navText: ["<i class='icon-arrow-left'></i>", "<i class='icon-arrow-right'></i>"],
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        </script>
        <script type="text/javascript">
            $('#owl-demo').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                var owl = $("#owl-demo");

                owl.owlCarousel({
                    items: 3, //10 items above 1000px browser width
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

            //plugin bootstrap minus and plus
            //http://jsfiddle.net/laelitenetwork/puJ6G/
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }

            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })

            $('#EventDetails').on('shown.bs.modal', function() {
                $('#myInput').focus()
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#mobile').keyup(function() {

                    var mobile = document.getElementById("mobileno");
                    var value = $('#mobileno').val();

                    $.ajax({
                        url: base_url + "check_operator",
                        type: "POST",
                        data: {
                            'mobile': value

                        },
                        success: function(data) {
                           // alert('test');
                            $("#rec_category").val(1);

                            var getdata = jQuery.parseJSON(data);
                            var operator_id = getdata.operator_id;
                            var operator_name = getdata.operator_name;
                           
                            if (operator_id) {
                                $("#mobile_operator_id").val(operator_id).change();
                            } else {
                                $("#mobile_operator_id").val(0).change();
                            }

                        }
                    });
                    if (value.length == 11) {
                        
                        $("#mob_num_error").removeClass("errormsg");
                        $("#mob_num_error").text("");
                    } else if (isNaN($('#mobile').val())) {
                        $("#mob_num_error").addClass("errormsg");
                      $("#mob_num_error").text("Enter valid 11 digit mobile number");
                    } else {
                        $("#mob_num_error").addClass("errormsg");
                        $("#mob_num_error").text("Enter valid 11 digit mobile number");
                    }

                });
                $('#tv_number').keyup(function() {

                    var tv_number = $('#tv_number').val();
                    if ($('#tv_number').val().length >= 5) {
                   //     $('#preloader').showLoading();

                        $("#dth_num_error").text("");
                        $("#dth_num_error").removeClass("errormsg");
                        var tv_operator_id = $("#dth_operator_id").val();
                        $.ajax({
                            url: base_url + "validate_tv_number",
                            type: "POST",
                            data: {
                                'tv_number': tv_number,
                                'tv_operator_id': tv_operator_id

                            },
                            success: function(data) {
                             //   $('#preloader').hideLoading();
                                $("#rec_category").val(2);
                                var getdata = jQuery.parseJSON(data);
                                var status = getdata.status;
                                if (status == 'true') {
                                    var customer_name = getdata.customer_name;
                                    $("#tv_number_name").val(customer_name);
                                    $("#service_id").val(getdata.service_id);
                                    $("#tv_new_number").val(getdata.customer_no);
                                } else {
                                    var message = getdata.message;
                                    $("#tv_number_name").val(message);

                                }

                            }

                        });
                    } else if (isNaN($('#tv_number').val())) {
                        $("#dth_num_error").addClass("errormsg");
                        $('#dth_num_error').text('Please Enter a valid Tv number');
                    } else {
                        $("#dth_num_error").addClass("errormsg");
                        $("#dth_num_error").text("Please Enter a valid Tv number");

                    }

                });

                $('#data_card_number').keyup(function() {
                    var value = $('#data_card_number').val();
                    if ($('#data_card_number').val().length >= 5) {
                        $("#data_number_error").text("");
                        $("#data_number_error").removeClass("errormsg");
                        var data_card_number = $("#data_card_number").val();
                        var datacard_operator_id = $("#datacard_operator_id").val();

                        $.ajax({
                            url: base_url + "validate_data_number",
                            type: "POST",
                            data: {
                                'data_number': data_card_number,
                                'data_operator_id': datacard_operator_id

                            },
                            success: function(data) {
                                $("#rec_category").val(3);
                                var getdata = jQuery.parseJSON(data);
                                var status = getdata.status;
                                if (status == 'true') {

                                    var customer_name = getdata.customer_name;
                                    $("#data_card_number_name12").val(customer_name);
                                    if (getdata.plans == '') {
                                        $("#plan_div").attr('style', 'display: none');
                                        $('#datacard_amount').attr('readonly', 'false');
                                    } else {
                                        $("#plan_div").attr('style', 'display: block');
                                        $('#datacard_amount').attr('readonly', 'true');
                                    }
                                } else {
                                    var message = getdata.message;

                                    $("#data_card_number_name12").val(message);
                                    $("#datacard_next").attr('style', 'display: none');
                                }

                            }

                        });
                    } else if (isNaN($('#data_card_number').val())) {
                        $("#data_number_error").addClass("errormsg");
                        $('#data_number_error').text('Please Enter a valid Data card number');
                    } else {
                        $("#data_number_error").addClass("errormsg");
                        $("#data_number_error").text("Please Enter minimum 5 digit Data card number");
                    }

                });

            });



        </script>

        <div id="fb-root"></div>
        <!--<script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1716710845207683";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>-->
        <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '594649877357899',
      xfbml      : true,
      version    : 'v3.1'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

        <script>
            function show_login() {
                
                $("#SignupModal").modal('hide');
                $("#LoginModal").modal();
            }
            // Auto logout functionlity


function reset_interval()
{
//resets the timer. The timer is reset on each of the below events:
// 1. mousemove   2. mouseclick   3. key press 4. scroliing
//first step: clear the existing timer
clearInterval(3000000);
//second step: implement the timer again
timer=setInterval("Logout()",3000000);

}

function auto_logout()
{
//this function will redirect the user to the logout script
localStorage.setItem("mobileno","");
    location.href = home_url +"web/logout";
     localStorage.clear();
}
        </script>
        





</body>

</html>