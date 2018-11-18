
  <link href="<?php echo base_url('biller_assets/demo/demo.css');?>" rel="stylesheet" />
  <script src="<?php echo base_url('biller_assets/demo/demo.js');?>"></script>

<body class="off-canvas-sidebar">
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white" id="navigation-example">
    <div class="container">
     <!--  <div class="navbar-wrapper">
        <a class="navbar-brand" href="#pablo">Register Page</a>
      </div> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="../dashboard.html" class="nav-link">
              <i class="material-icons">dashboard</i> Dashboard
            </a>
          </li>
          <!-- <li class="nav-item ">
            <a href="<?php //echo base_url('biller_login/register'); ?>" class="nav-link">
              <i class="material-icons">person_add</i> Register
            </a>
          </li> -->
          <li class="nav-item  active ">
            <a href="<?php echo base_url('biller_login'); ?>" class="nav-link">
              <i class="material-icons">fingerprint</i> Login
            </a>
          </li>
        <!--   <li class="nav-item ">
            <a href="../pages/lock.html" class="nav-link">
              <i class="material-icons">lock_open</i> Lock
            </a>
          </li> -->

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
                          <input type="text" class="form-control" name="biller_email" id="biller_email" required="" placeholder="Email...">
                        </div>
                      </div>
                      <div class="form-group has-default">
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
                          <input type="text" class="form-control" name="biller_contact_no" id="biller_contact_no" placeholder="Phone..." required="">
                        </div>
                      </div>
                      <div class="row">
                      <div class="form-group has-default col-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>

                          <select name="biller_type" id="biller_type" required="">
                            <option value="">Select Biller Type</option>
                            <option value="1">Biller</option>
                            <option value="2">Church</option>
                            <option value="3">Eevnts</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group has-default col-6">
                         <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <input type="text" name="biller_category_name" id="biller_category_name" class="form-control" required="" placeholder="Biller Category...">
                        </div>
                      </div>
</div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" value="" checked="">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                          I agree to the
                          <a href="#something">terms and conditions</a>.
                        </label>
                      </div>
                      <div class="text-center">
                        <input  class="btn btn-rose btn-link btn-lg" type="submit" name="signup" value="Sign up" style="margin: 20px auto  0;float: none;">
                       
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
         <!--  <div class="col-md-5 ml-auto mr-auto">
            <div class="card card-signup">
              <h2 class="card-title text-center">Became a Biller</h2>
              <div class="card-body">
                <div class="row">
                 
                  <div class="col-md-12 mr-auto">
                    <div class="social text-center">
                    
                    </div>
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
                          <input type="text" class="form-control" name="biller_email" id="biller_email" required="" placeholder="Email...">
                        </div>
                      </div>
                      <div class="form-group has-default">
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
                          <input type="text" class="form-control" name="biller_contact_no" id="biller_contact_no" placeholder="Phone..." required="">
                        </div>
                      </div>
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>

                          <select style="width: 320px" name="biller_type" id="biller_type" required="">
                            <option value="">Select Biller Type</option>
                            <option value="1">Biller</option>
                            <option value="2">Church</option>
                            <option value="3">Eevnts</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group has-default">
                         <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <input type="text" name="biller_category_name" id="biller_category_name" class="form-control" required="" placeholder="Biller Category Name...">
                        </div>
                      </div>

                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" value="" checked="">
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                          I agree to the
                          <a href="#something">terms and conditions</a>.
                        </label>
                      </div>
                      <div class="text-center">
                        <input  class="btn btn-rose btn-link btn-lg" type="submit" name="signup" value="Sign up">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    
    </div>
  </div>
