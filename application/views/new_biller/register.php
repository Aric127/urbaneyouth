
  <link href="<?php echo base_url('biller_assets/demo/demo.css');?>" rel="stylesheet" />
  <script src="<?php echo base_url('biller_assets/demo/demo.js');?>"></script>

<body class="off-canvas-sidebar">
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white" id="navigation-example">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>" class="nav-link">
              <i class="material-icons">dashboard</i> Dashboard
            </a>
          </li>
          <li class="nav-item  active ">
            <a href="<?php echo base_url('biller_login'); ?>" class="nav-link">
              <i class="material-icons">fingerprint</i> Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="wrapper wrapper-full-page">
    <div class="page-header register-page header-filter" filter-color="black" style="background-image: url('http://www.urbaneyouth.com/biller_assets/img/login-banner1.jpg');background-size: cover; background-position: bottom;">

      <div class="container">
             <div class="row">
          <div class="col-md-10 ml-auto mr-auto">
            <div class="card card-signup">
              <h2 class="card-title text-center">Became a biller</h2>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5 ml-auto">
                    <div class="info info-horizontal">
                      <div class="icon icon-rose">
                        <i class="material-icons">timeline</i>
                      </div>
                      <div class="description">
                        <h4 class="info-title">Marketing</h4>
                        <p class="description">
                          We've created the marketing campaign of the website. It was a very interesting collaboration.
                        </p>
                      </div>
                    </div>
                    <div class="info info-horizontal">
                      <div class="icon icon-primary">
                        <i class="material-icons">code</i>
                      </div>
                      <div class="description">
                        <h4 class="info-title">Fully Coded in HTML5</h4>
                        <p class="description">
                          We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                        </p>
                      </div>
                    </div>
                    <div class="info info-horizontal">
                      <div class="icon icon-info">
                        <i class="material-icons">group</i>
                      </div>
                      <div class="description">
                        <h4 class="info-title">Built Audience</h4>
                        <p class="description">
                          There is also a Fully Customizable CMS Admin Dashboard for this product.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 mr-auto">
                    <?php if ($this->session->flashdata('error')) { ?>
                   <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Error - </b> <?php echo $this->session->flashdata('error'); ?></span>
                  </div>
        <?php } ?>
                    <form class="form" method="post" 
                    action="<?php echo base_url('Register') ?>">
                       <div class="col-lg-5 col-md-6 col-sm-3">
                          <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Single Select">
                            <option disabled selected>Single Option</option>
                            <option value="2">Foobar</option>
                            <option value="3">Is great</option>
                            <option value="4">Is bum</option>
                            <option value="5">Is wow</option>
                            <option value="6">boom</option>
                          </select>
                        </div>
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <input type="text" name="biller_company_name" id="biller_company_name" class="form-control" required="" placeholder="Business Name...">
                        </div>
                      </div>
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">mail</i>
                            </span>
                          </div>
                          <input type="text" class="form-control" name="biller_email" id="biller_email" required="" placeholder="Email..." onblur="check_email_phone(this.value,1)"> 
                         
                        </div>
                         <span id="email_error" style="margin-left: 60px;"></span>
                      </div>
                      <div class="form-group has-default pasd">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">lock_outline</i>
                            </span>
                          </div>
                          <input type="password" name="biller_password" id="biller_password" placeholder="Password..." class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">phone</i>
                            </span>
                          </div>
                          <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" class="form-control" name="biller_contact_no" id="biller_contact_no" placeholder="Phone..." required=""  onblur="check_email_phone(this.value,2)">
                         
                        </div>
                         <span id="phone_error" style="margin-left: 60px"></span>
                      </div>
                      <div class="row" style="padding: 0px 15px;">
                      <div class="form-group has-default col-6 haff">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>

                          <select name="biller_type" id="biller_type" required="" 
                          onchange="select_biller_cat(this.value)">
                            <option value="">Select Biller Type</option>
                            <option value="1">Biller</option>
                            <option value="2">Church</option>
                            <option value="3">Eevnts</option>
                          </select>
                        </div>
                      </div>
                        <div class="form-group has-default col-6 haff">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>

                          <select name="biller_category_name" id="biller_category_name" required="">
                            <option value="">Select Category</option>
                           
                          </select>
                        </div>
                      </div>
                       <!-- <div class="form-group has-default col-6 haff">
                         <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <input type="text" name="biller_category_name" id="biller_category_name" class="form-control" required="" placeholder="Biller Category...">
                        </div>
                      </div> -->

</div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" value="" checked="" disabled>
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                          I agree to the
                          <a href="#" data-toggle="modal" data-target="#noticeModal">terms and conditions</a>.
                        </label>
                      </div>
                      <div class="text-center">
                        <input  class="btn btn-rose btn-link btn-lg" type="submit" name="signup" value="Sign up" id="submit" style="margin: 20px auto  0;float: none;">
                       
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
            <?php if ($this->session->flashdata('error')) { ?>
                   <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Error - </b> <?php echo $this->session->flashdata('error'); ?></span>
                  </div>
        <?php } ?>
       
        </div>
      </div>
    
    </div>
  </div>
  <script type="text/javascript">
      function check_email_phone(email_phone,type){
        if(email_phone!='')
        {
          var URL = "<?php echo site_url('biller_login/get_user_details'); ?>";
            $.ajax({
              url: URL,
              data: {"email_phone" : email_phone,'type':type},
              dataType:"json",
              type: "post",
              success: function(data){
                if(data == 1){
                 if(type==1)
                 {
                  $("#email_error").css("color","red");
                  $("#biller_email").css("background-color","red");   
                  $("#email_error").text("Email ID Alredy Exist");
                  $("#submit").attr('type', 'button');
                 }else 
                  if(type==2)
                 {
                   $("#biller_contact_no").css("background-color","red");
                  $("#phone_error").css("color","red");
                  $("#phone_error").text("Contact Number Alredy Exist");
                  $("#submit").attr('type', 'button');
                 }
                }else if(data == 2){
                 if(type==1)
                 {
                  $("#email_error").css("color","");
                  $("#email_error").text("");
                  $("#biller_email").css("background-color",""); 
                  $("#submit").attr('type', 'submit');
                 }else 
                  if(type==2)
                 {
                  $("#phone_error").css("color","");
                  $("#phone_error").text("");
                  $("#biller_contact_no").css("background-color","");
                  $("#submit").attr('type', 'submit');
                 }
                }               
              }
          });
          }
        }
        function select_biller_cat(biller_type)
        {
         var URL = "<?php echo site_url('biller_login/get_biller_category'); ?>";
            $.ajax({
              url: URL,
              data: {"biller_type" : biller_type},
              dataType:"html",
              type: "post",
              success: function(data){ 
                $("#biller_category_name").html(data);
                 }
          });
        }
  </script>
       <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-notice">
                          <div class="modal-content" style="    background: #fff!important;">
                            <div class="modal-header">
                              <h5 class="modal-title" id="myModalLabel">Terms and Conditions</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="instruction">
                                <div class="row">
                                  <div class="col-md-12">
                                    <strong>1. Register</strong>
                                    <p class="description">The first step is to create an account at
                                      <a href="http://www.creative-tim.com/">Creative Tim</a>. You can choose a social network or go for the classic version, whatever works best for you.</p>
                                  </div>
                                
                                </div>
                              </div>
                              <div class="instruction">
                                <div class="row">
                                  <div class="col-md-12">
                                    <strong>2. Apply</strong>
                                    <p class="description">The first step is to create an account at
                                      <a href="http://www.creative-tim.com/">Creative Tim</a>. You can choose a social network or go for the classic version, whatever works best for you.</p>
                                  </div>
                                
                                </div>
                              </div>
                             
                            </div>
                         
                          </div>
                        </div>
                      </div>
<style>
  .footer .copyright {
    padding-right: 15px;
    color: #fff!important;
    font-weight: 500;
}
</style>                      