var reCapchaFlag = false;
$(document).ready(function() {
    $('#test_navigate_app').click(function () {
        var checkbox = $("#test-checkbox").is(":checked");
        var msg = "Calling from Java Script";
        var temp = "{\"data\":[{\"key\":\"mode\",\"isEncoded\":false,\"value\":\"1\"},{\"key\":\"transactionType\",\"isEncoded\":false,\"value\":\"USER_TO_USER_RECEIVED_REQUEST\"},{\"key\":\"payRequest\",\"isEncoded\":true,\"value\":\"{\\\"note\\\":{\\\"tag\\\":\\\"Miscellaneous\\\",\\\"type\\\":\\\"text\\\"},\\\"requestId\\\":\\\"C1609221104492746306651\\\",\\\"supportedInstruments\\\":27}\"},{\"key\":\"uiConfig\",\"isEncoded\":true,\"value\":\"{\\\"confirmationScreenDuration\\\":0,\\\"initialAmount\\\":200,\\\"initialContactList\\\":[{\\\"data\\\":\\\"M2306160483220675579140\\\",\\\"displayId\\\":\\\"myntra@ybl\\\",\\\"id\\\":0,\\\"isSelfContact\\\":false,\\\"lookupId\\\":\\\"M2306160483220675579140\\\",\\\"name\\\":\\\"Myntra\\\",\\\"type\\\":3,\\\"vpaInternalMerchant\\\":\\\"myntra@ybl\\\"}],\\\"isAmountEditable\\\":true,\\\"isInitialContactEditable\\\":false,\\\"isNoteEditable\\\":true,\\\"showRateMeDialog\\\":true}\"}]}";
        JsHandler.jsFnCall("pay_short","market://details?id=com.phonepe.app","intent_action_view",1,checkbox);
    });
    $('#redirect_to_store').click(function () {
        JsHandler.jsFnCall("pay_short","market://details?id=com.phonepe.app","intent_action_view",1,0);
    });
    $('#test_navigate_app1').click(function () {
        var checkbox = $("#test-checkbox").is(":checked");
        var msg = "Calling from Java Script";
        var temp = "{\"data\":[{\"key\":\"mode\",\"isEncoded\":false,\"value\":\"1\"},{\"key\":\"transactionType\",\"isEncoded\":false,\"value\":\"USER_TO_USER_RECEIVED_REQUEST\"},{\"key\":\"payRequest\",\"isEncoded\":true,\"value\":\"{\\\"note\\\":{\\\"tag\\\":\\\"Miscellaneous\\\",\\\"type\\\":\\\"text\\\"},\\\"requestId\\\":\\\"C1609221104492746306651\\\",\\\"supportedInstruments\\\":27}\"},{\"key\":\"uiConfig\",\"isEncoded\":true,\"value\":\"{\\\"confirmationScreenDuration\\\":0,\\\"initialAmount\\\":200,\\\"initialContactList\\\":[{\\\"data\\\":\\\"M2306160483220675579140\\\",\\\"displayId\\\":\\\"myntra@ybl\\\",\\\"id\\\":0,\\\"isSelfContact\\\":false,\\\"lookupId\\\":\\\"M2306160483220675579140\\\",\\\"name\\\":\\\"Myntra\\\",\\\"type\\\":3,\\\"vpaInternalMerchant\\\":\\\"myntra@ybl\\\"}],\\\"isAmountEditable\\\":true,\\\"isInitialContactEditable\\\":false,\\\"isNoteEditable\\\":true,\\\"showRateMeDialog\\\":true}\"}]}";
        JsHandler.jsFnCall("pay_short",temp,"action_redirection",0,checkbox);
    });
    $('#test_navigate_app2').click(function () {
        var checkbox = $("#test-checkbox").is(":checked");
        var msg = "Calling from Java Script";
        var temp = "{\"data\":[{\"key\":\"mode\",\"isEncoded\":false,\"value\":\"1\"},{\"key\":\"transactionType\",\"isEncoded\":false,\"value\":\"USER_TO_USER_RECEIVED_REQUEST\"},{\"key\":\"payRequest\",\"isEncoded\":true,\"value\":\"{\\\"note\\\":{\\\"tag\\\":\\\"Miscellaneous\\\",\\\"type\\\":\\\"text\\\"},\\\"requestId\\\":\\\"C1609221104492746306651\\\",\\\"supportedInstruments\\\":27}\"},{\"key\":\"uiConfig\",\"isEncoded\":true,\"value\":\"{\\\"confirmationScreenDuration\\\":0,\\\"initialAmount\\\":200,\\\"initialContactList\\\":[{\\\"data\\\":\\\"M2306160483220675579140\\\",\\\"displayId\\\":\\\"myntra@ybl\\\",\\\"id\\\":0,\\\"isSelfContact\\\":false,\\\"lookupId\\\":\\\"M2306160483220675579140\\\",\\\"name\\\":\\\"Myntra\\\",\\\"type\\\":3,\\\"vpaInternalMerchant\\\":\\\"myntra@ybl\\\"}],\\\"isAmountEditable\\\":true,\\\"isInitialContactEditable\\\":false,\\\"isNoteEditable\\\":true,\\\"showRateMeDialog\\\":true}\"}]}";
        JsHandler.jsFnCall("pay_short",temp,"action_dismiss",0,checkbox);
    });
    $('.redirect-home-app').click(function () {
        console.log("redirection to home updated");
        var temp = "{\"data\":[{\"key\":\"mode\",\"isEncoded\":false,\"value\":\"1\"},{\"key\":\"transactionType\",\"isEncoded\":false,\"value\":\"USER_TO_USER_RECEIVED_REQUEST\"},{\"key\":\"payRequest\",\"isEncoded\":true,\"value\":\"{\\\"note\\\":{\\\"tag\\\":\\\"Miscellaneous\\\",\\\"type\\\":\\\"text\\\"},\\\"requestId\\\":\\\"C1609221104492746306651\\\",\\\"supportedInstruments\\\":27}\"},{\"key\":\"uiConfig\",\"isEncoded\":true,\"value\":\"{\\\"confirmationScreenDuration\\\":0,\\\"initialAmount\\\":200,\\\"initialContactList\\\":[{\\\"data\\\":\\\"M2306160483220675579140\\\",\\\"displayId\\\":\\\"myntra@ybl\\\",\\\"id\\\":0,\\\"isSelfContact\\\":false,\\\"lookupId\\\":\\\"M2306160483220675579140\\\",\\\"name\\\":\\\"Myntra\\\",\\\"type\\\":3,\\\"vpaInternalMerchant\\\":\\\"myntra@ybl\\\"}],\\\"isAmountEditable\\\":true,\\\"isInitialContactEditable\\\":false,\\\"isNoteEditable\\\":true,\\\"showRateMeDialog\\\":true}\"}]}";
        JsHandler.jsFnCall("xyz",temp,"action_dismiss",0,0);
    });

    $('.offer-detail-app').click(function () {

        var title = "Offer Details";
        var url = $(this).find("a").attr('href');
        if(!url) {
            var url = $(this).find("a").attr('data-href');
        }
        console.log(url);
        var temp = "{\"data\":[{\"key\":\"shouldShowToolBar\",\"isEncoded\":\"false\",\"value\":\"0\"},{\"key\":\"title\",\"isEncoded\":false,\"value\":\"" + title + "\"},{\"key\":\"url\",\"isEncoded\":false,\"value\":\""+url+"\"}]}";


        if($("#source").length > 0) {
            var source = $("#source").html();
            if(source == "iOS") {
                window.location.replace("phonepe://pw?url=" + url + "&title=" + title);
            }
            else {
                JsHandler.jsFnCall("sm_web_view",temp,"action_dismiss",0,0, false);
            }
        }
        else {
            window.location.replace(url);
        }
    });

    $('.redirect-home-ios-app').click(function () {
        window.location.replace("phonepe://home");
    });

    $('.redirect-self-ios-app').click(function () {
        window.location.replace("phonepe://stap");
    });

    $('.electricity-bill-offer').click(function () {

        var temp = "{\"data\":[{\"key\":\"category\",\"isEncoded\":false,\"value\":\"ELEC\"},{\"key\":\"info\",\"isEncoded\":true,\"value\":\"{\\\"mAnalyticsInfo\\\":{\\\"groupingKey\\\":\\\"5cc831bed7df121d14166ca89c13bcfc\\\",\\\"isFirstTime\\\":false,\\\"isTransactionalEvent\\\":true,\\\"lastTimeStamp\\\":1488866868741,\\\"startTimeStamp\\\":1488866868741}}\"}]}";
        if($("#source").length > 0) {
            var source = $("#source").html();
            if(source == "iOS") {
                window.location.replace("https://phon.pe/reliance_offer");
            }
            else {
                JsHandler.jsFnCall("bpf",temp,"action_dismiss",0,0, true);
            }
        }
        else {
            setTimeout(function(){
                window.location.replace("https://phon.pe/reliance_offer");
            }, 100);
            JsHandler.jsFnCall("bpf",temp,"action_dismiss",0,0);
        }
    });

    $('.play-store-app').click(function () {
        console.log("go to playstore");
        JsHandler.jsFnCall("pay_short","market://details?id=com.phonepe.app","intent_action_view",1,false);
    });

    $('.dismiss_banner').click(function () {
        JsHandler.jsFnCall("","","action_dismiss",0,0);
    });

    $('.split-bill-app').click(function () {
        console.log("click on split bill-");
        // setTimeout(function(){
        //     window.location.replace("https://phon.pe/p2p_split");
        // }, 100);
        JsHandler.jsCallOpenSplitBill(0);
    });

    $('.send-vpa-app').click(function () {
        console.log("click on send vpa-");
        // setTimeout(function(){
        //     window.location.replace("https://phon.pe/p2p_vpa");
        // }, 100);
        JsHandler.jsCallOpenVpaSendMoney(0);
    });

    $('.send-contact-app').click(function () {
        console.log("click on send contact");
        JsHandler.jsCallOpenSendMoney(0);
    });

    $('.send-contact-ios-app').click(function () {
        console.log("click on send contact");
        window.location.replace("phonepe://cp?launchSource=hsp");
    });

    $('.request-contact-app').click(function () {
        console.log("click on request contact");
        JsHandler.jsCallOpenRequestMoney(0);
    });

    $('.request-contact-ios-app').click(function () {
        console.log("click on request contact");
        window.location.replace("phonepe://cp?launchSource=hrp");
    });

    $('.split-bill-ios-app').click(function () {

        window.location.replace("https://phon.pe/p2p_split");

    });

    $('.send-vpa-ios-app').click(function () {

        window.location.replace("https://phon.pe/p2p_vpa");

    });


    $.ajax({
        url: "head.html",
        success: function(data) { $('head').append(data); },
        dataType: 'html'
    });

    //carousel
    $('.carousel.carousel-slider').carousel({ full_width: true, duration:500, dist: 0 });
    setTimeout(autoplay, 2500);

    function autoplay() {
        $('.carousel').carousel('next');
        setTimeout(autoplay, 2500);
    }
    //header
    $("#header").load("header.html", function(responseTxt, statusTxt, xhr) {
        $(".button-collapse").sideNav();
        var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
        if (pgurl == "")
            pgurl = "index.html";
        $("nav ul a").each(function() {
            if ($(this).attr("href") == pgurl) {
                $(this).parent().addClass("active");
            }
        });
    });

    //footer
    $("#footer").load("footer.html", function(responseTxt, statusTxt, xhr) {
        //Language Selector
        // $("#tx-live-lang-container").click(function() {
        //     $("#tx-live-lang-picker").toggleClass("txlive-langselector-list-opened");
        // });
        // $("#tx-live-lang-container ul a").each(function() {
        //     var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
        //     if (pgurl == "")
        //         pgurl = "index.html";
        //     var new_href = "../" + $(this).children().attr("data-value") + "/" + pgurl;
        //     $(this).attr("href", new_href);
        // });
    });


    //FAQ
    var _HS = {

        url: "phonepe.helpshift.com",
        // TODO: change this to your helpshift domain,
        //       e.g. "happyapps.helpshift.com"

        heightPadding: 150,
        // TODO: you will need to change this depending on your
        //       support-wrapper's width

        scrollTop: 0,
        // TODO: Change this to adjust the extent to which you want to
        //       scroll up on change of content. 0 is for topmost.
    };

    (function(w) {
        w.addEventListener("message", function(event) {
            if (event.origin.indexOf(_HS.url) !== -1) {
                var msg = event.data.match(/^(?:HS:)(.*)/);
                if (msg) {
                    var data = JSON.parse(msg[1]);
                    if (data.type === "height-change") {
                        document.getElementById("support-wrapper").style.height =
                            (data.data.ht + _HS.heightPadding + 150).toString() + "px";
                        w.document.body.scrollTop = _HS.scrollTop;
                    }
                }
            }
        });
    }(window));

    //Policy and terms
    $('.scrollspy').scrollSpy();

    //terms general
    $("#general").load("terms_general.html");

    //terms wallet
    $("#wallet").load("terms_wallet.html");

    //terms UPI
    $("#upi").load("terms_upi.html");

    //terms debit-credit
    $("#debit-credit").load("terms_debit-credit.html");
    
    //terms external-wallet
    $("#external-wallet").load("terms_external-wallet.html");
	
	//terms digi gold
//    $("#digigold").load("terms_digigold.html");

    //privacy policy
    $("#privacy").load("policy_privacy.html");

    //grievance policy
    $("#grievance").load("policy_grievance.html");
	
	 //Certifications policy
    $("#certifications").load("policy_certifications.html");

  //Swipable Tabs
  $('#tabs-swipe-demo').tabs({ 'swipeable': true });

  //Invite Friends Tabs
  $('ul.lb_tabs').tabs();

  //Modals
    if($('.modal').length !=0)
        $('.modal').modal();

  //====== Offer Page ====//

    //Coming Soon Offers
    $("#offer_coming_soon").load("offer_coming_soon.html");

    // unsubscribe page
    $("#unsubscribe_form").submit(function(e) {
        e.preventDefault();
        if(!validEmail($("#unsubscribe_email_id").val()))
            return;
        
        var googleResponse = jQuery('#g-recaptcha-response').val();
        if (!googleResponse) {
        $(".unsubscribe-error").show();
        return;
        } else {
            $(".unsubscribe-error").hide();
        }
        $("#unsubscribe_button").attr("disabled","true");

        var url = "/unsubscribe";
        $.ajax({
            type: "POST",
            url: url,
            datatype: "json",
            data: $("#unsubscribe_form").serialize(),
            success: function(data) {
                $("#unsubscribe_button").removeAttr("disabled");
                swal({
                    title: "Success",
                    text: "You have been unsubscribed successfully. You can always check for offers on PhonePe app or <a class='deep-purple-text' href='https://blog.phonepe.com'>PhonePe blog</a>",
                    html: true,
                    type: 'success',
                    confirmButtonColor: "#673ab7"
                });
            },
            error: function() {
                $("#unsubscribe_button").removeAttr("disabled");
                alert("Ooops! somthing went wrong, please try later.");
            }
        });
    });
    $("#close-modal").click(function () {
        location.reload();
    });

  $("#stories").click(function() {
    $("#journey-section").hide();
    $("#stories-parent-div").show();
    $("#culture-content-div").hide();
    $("#benefits-section").hide();

  });

  $("#benefits").click(function() {
    $("#journey-section").hide();
    $("#benefits-section").show();
    $("#culture-content-div").hide();
    $("#stories-parent-div").hide();
  });

  $("#culture").click(function() {
    $("#journey-section").hide();
    $("#culture-content-div").show();
    $("#benefits-section").hide();
    $("#stories-parent-div").hide();
  });

  $("#journey").click(function() {
    $("#journey-section").show();
    $("#culture-content-div").hide();
    $("#benefits-section").hide();
    $("#stories-parent-div").hide();
  });

  $('.life-list-menu').on('click', 'li', function() {
    $('.life-list-menu li.active').removeClass('active');
    $(this).addClass('active');
  });

});
function recaptchaCallback() {
    reCapchaFlag = true;
    if (validForm($("#ios_register_form")))
        $("#ios_register").removeClass("disabled");
};
function validEmail(data) {
    var atpos = data.indexOf("@");
    var dotpos = data.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= data.length) {
        return false;
    }
    return true;
}

var removeCapchaError = function () {
    $(".unsubscribe-error").hide();
};


