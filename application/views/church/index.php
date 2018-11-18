
<body class="off-canvas-sidebar">
 <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white" id="navigation-example">
    <div class="container">
      <!-- <div class="navbar-wrapper">
        <a class="navbar-brand" href="#pablo">Login Page</a>
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
          <li class="nav-item ">
            <a href="<?php echo base_url('biller_login/register'); ?>" class="nav-link">
              <i class="material-icons">person_add</i> Register
            </a>
          </li>
          <!-- <li class="nav-item  active ">
            <a href="../pages/login.html" class="nav-link">
              <i class="material-icons">fingerprint</i> Login
            </a>
          </li>
          <li class="nav-item ">
            <a href="../pages/lock.html" class="nav-link">
              <i class="material-icons">lock_open</i> Lock
            </a>
          </li> -->

        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('biller_assets/img/login-banner1.jpg'); background-size: cover; background-position:  bottom;">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container">
        <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
        <?php if ($this->session->flashdata('error')) { ?>
                   <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Error - </b> <?php echo $this->session->flashdata('error'); ?></span>
                  </div>
        <?php } ?>
            <div class="card card-login card-hidden">
              <div class="card-header card-header-rose text-center">
                <h4 class="card-title">Login</h4>
                <div class="social-line">
                 <!--  <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                    <i class="fa fa-facebook-square"></i>
                  </a>
                 
                  <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                    <i class="fa fa-google-plus"></i>
                  </a> -->
                </div>
              </div>
               <form action="<?php echo site_url('biller_login') ?>" method="post" role="form" id="login" class="form-inline">
              <div class="card-body ">
                
                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email..."  name="biller_email" id="biller_email" autocomplete="off" required="">
                  </div>
                </span>
                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                    <input type="password" class="form-control" placeholder="Password..." name="biller_password" id="biller_password" required="">
                  </div>
                </span>
              </div>
              <div class="card-footer justify-content-center">
                  <input  class="btn btn-rose btn-link btn-lg" type="submit" name="login" value="Log In">
              </div>
               <!-- <div class="card-footer justify-content-center">
                  <a href="<?php //echo base_url('biller_login/register'); ?>" class="btn btn-rose btn-link btn-lg">New Biller</a>
              </div> -->
             
            </form>
            </div>
       
        </div>
      </div>
 
    </div>
  </div>
  <!--   Core JS Files   -->
<style>
  .form-inline .input-group {
    width: 100%;
}
span.bmd-form-group {
    width: 100%;
    float: left;
}
</style>