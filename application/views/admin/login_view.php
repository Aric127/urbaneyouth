<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>OyaCharge</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-components.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-skins.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body class="page-body  login-body">
<div class="login-over">

    <div class="login-page">

        <div class="container">

            <div class="col-sm-12">
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        // Reveal Login form
                        setTimeout(function() {
                            $(".fade-in-effect").addClass('in');
                        }, 1);
                    });
                </script>
                <script type="text/javascript">
                    function remove_class(id) {
                        document.getElementById(id).className = 'form-control input-dark';
                        var divName = id.split('_');
                        var div = divName[1];
                    }
                </script>

                <!-- Errors container -->
                <div class="errors-container">

                </div>
                <?php if(!empty($error)){ ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>							
                        <a href="<?php echo site_url(); ?>" class="center-block">
							<img src="<?php echo base_url(); ?>assets/images/logo_1.png" alt="" width="200" class="center-block" />
						</a>
                        <!-- Add class "fade-in-effect" for login form effect -->
                        <form action="<?php echo site_url('login') ?>" method="post" role="form" id="login" class="form-signin">
							<?php if($this->session->flashdata('msg')){ ?>
                                <div class="alert-message alert-<?php echo $this -> session -> flashdata('msg-class');?>">
                                    <?php echo $this -> session -> flashdata('msg'); ?> <span class="close-message"><span class="glyphicon glyphicon-remove"></span></span>
                                </div>
                                <?php } ?>




							        <h2 class="form-signin-heading">sign in now</h2>
							        <div class="login-wrap">
							            <div class="user-login-info">
							                <input type="text" placeholder="Email" class="form-control input-dark <?php if (form_error('user_email')!=" ") echo "error "; ?>" name="user_email" id="user_email" autocomplete="off" value="<?php echo set_value('user_email'); ?>" onkeypress="remove_class('user_email')" />
                                        	<?php echo form_error('user_email'); ?>

							                <input type="password" placeholder="Password" class="form-control input-dark <?php if (form_error('user_password')!=" ") echo "error "; ?>" name="user_password" id="user_password" value="<?php echo set_value('user_password'); ?>" autocomplete="off" onkeypress="remove_class('user_password')" />

                                        <?php echo form_error('user_password'); ?>
							            </div>
							            <label class="checkbox">
							                <input value="remember-me" type="checkbox"> Remember me
							                <span class="pull-right">
							                   <!--  <a data-toggle="modal" href="#myModal"> Forgot Password?</a> -->
							                </span>
							            </label>
							            <button class="btn btn-lg btn-login btn-block" type="submit" value="Log In" name="login">Log In</button>
							            <!-- <div class="registration">
							                Don't have an account yet?
							                <a class="" href="registration.html">
							                    Create an account
							                </a>
							            </div> -->

							        </div>

							</form>


							<!-- 
                            <?php if($this->session->flashdata('msg')){ ?>
                                <div class="alert-message alert-<?php echo $this -> session -> flashdata('msg-class');?>">
                                    <?php echo $this -> session -> flashdata('msg'); ?> <span class="close-message"><span class="glyphicon glyphicon-remove"></span></span>
                                </div>
                                <?php } ?>

                                   

                                    <div class="form-group" id="email">
                                        <input type="text" placeholder="Email" class="form-control input-dark <?php if (form_error('user_email')!=" ") echo "error "; ?>" name="user_email" id="user_email" autocomplete="off" value="<?php echo set_value('user_email'); ?>" onkeypress="remove_class('user_email')" />
                                        <?php echo form_error('user_email'); ?>
                                    </div>

                                    <div class="form-group" id="password">
                                        <input type="password" placeholder="Password" class="form-control input-dark <?php if (form_error('user_password')!=" ") echo "error "; ?>" name="user_password" id="user_password" value="<?php echo set_value('user_password'); ?>" autocomplete="off" onkeypress="remove_class('user_password')" />

                                        <?php echo form_error('user_password'); ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Log In" name="login" class="btn btn-dark btn-block">
                                    </div>

                                    <div class="login-footer">
                                       

                                    </div>

                        </form> -->

                       

            </div>
            <div class="col-sm-12 text-center">
            	<a href=""> 
            	<img src="<?php echo base_url(); ?>assets/images/andoird-ico.png" width="120px">
            	</a>
            	<a href=""> 
            		<img src="<?php echo base_url(); ?>assets/images/ios-ico.png" width="120px">
            	</a>

            </div>

        </div>

    </div>
</div>
    <!-- Bottom Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/TweenMax.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/xenon-api.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/xenon-toggles.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-validate/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/toastr/toastr.min.js"></script>

    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo base_url(); ?>assets/js/xenon-custom.js"></script>

</body>

</html>