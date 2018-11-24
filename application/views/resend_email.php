  <?php if($this->session->userdata('verifyStatus')==1)
            { ?>
              <div class="alert alert-default" style="background-color:#fcf8e3!important;border:1px solid #faebcc">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height: 0.1;margin: 5px;" id="resend_linkbtn">
                      <i class="material-icons"  style="color: #bbb;">close</i>
                    </button>
                    <span>Account confirmation is required please check your email for the confirmation link</span>
                    <button onclick="send_resendmail()" class="btn btn-sm pull-right " style="margin-top: -24px;padding: 6px;right: 19px;">Resend Email</button>
                  </div>
                  
           <?php } ?>