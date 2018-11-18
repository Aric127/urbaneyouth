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
<style type="text/css">
  .alert-mg {
  position: absolute;
  bottom: 220px;
  display: block;
  width: 600px;
}
.alert-mg .alert-danger {
  background: rgba(235, 204, 209,0.78);
  border-radius: 4px;
}
</style>


</head>

<body class="page-body biller-body" onload="startTime()">
<section id="wrapper" class="new-login-register">
    <div class="lg-info-panel"> 
       <div  class="inner-panel"> 
          <div class="lock-wrapper">  
          <div id="time"></div> 
            



            <div class="lock-box text-center">
           <form action="<?php echo site_url('biller_login') ?>" method="post" role="form" id="login" class="form-inline">
            <?php if($this->session->flashdata('error')){ ?>
            

            <div class="alert-mg">
               <div class="alert alert-danger text-center center-block">
                <?php echo $this -> session -> flashdata('error'); ?> 
              </div>
            </div>
                                <?php } ?>
            <div class="lock-name">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control lock-input <?php if (form_error('biller_email')!=" ") echo "error "; ?>" name="biller_email" id="biller_email" autocomplete="off" value="<?php echo set_value('biller_email'); ?>" onkeypress="remove_class('biller_email')" />
               <?php echo form_error('biller_email'); ?>
               </div>
            </div>
            <img src="<?php echo base_url(); ?>assets/images/lock_thumb.jpg" alt="lock avatar"/>
            <div class="lock-pwd">
             <div class="form-group">
               <input type="password" placeholder="Password" class="form-control lock-input <?php if (form_error('biller_password')!=" ") echo "error "; ?>" name="biller_password" id="biller_password" value="<?php echo set_value('biller_password'); ?>" autocomplete="off" onkeypress="remove_class('biller_password')" />
                  <?php echo form_error('user_password'); ?>
               
               <button class="btn btn-lock" type="submit" value="Log In" name="login">
                   <i class="fa fa-arrow-right"></i>
               </button>
           </div>
                
            </div>
          </form>
        </div>
         </div>
       </div>
       
    </div>
	<!--<div class="col-sm-8">
      <div class="lg-info-panel">
              <div class="inner-panel">
                  <a href="javascript:void(0)" class="p-20 di">
                  <img src="<?php echo base_url(); ?>assets/images/logo_1.png"></a>
                  <div class="lg-content">
                     
                  </div>
              </div>
      </div>
    </div>-->
   <!-- <div class="col-sm-4">
     <div class="new-login-box">
        <div class="white-box">
          <form action="<?php echo site_url('biller_login') ?>" method="post" role="form" id="login" class="form-signin">
                            <?php if($this->session->flashdata('msg')){ ?>
            <div class="alert-message alert-<?php echo $this -> session -> flashdata('msg-class');?>">
               <?php echo $this -> session -> flashdata('msg'); ?> 
               <span class="close-message"><span class="glyphicon glyphicon-remove"></span></span>
                                </div>
                                <?php } ?>

<h2 class="form-signin-heading">sign in now</h2>
  <div class="login-wrap">
	<div class="user-login-info">
	  <input type="text" placeholder="Email" class="form-control input-dark <?php if (form_error('biller_email')!=" ") echo "error "; ?>" name="biller_email" id="biller_email" autocomplete="off" value="<?php echo set_value('biller_email'); ?>" onkeypress="remove_class('biller_email')" />
                                        	<?php echo form_error('biller_email'); ?>

<input type="password" placeholder="Password" class="form-control input-dark <?php if (form_error('biller_password')!=" ") echo "error "; ?>" name="biller_password" id="biller_password" value="<?php echo set_value('biller_password'); ?>" autocomplete="off" onkeypress="remove_class('biller_password')" />
                                        	<?php echo form_error('user_password'); ?>
							            </div>
							            <label class="checkbox">
							                <input value="remember-me" type="checkbox"> Remember me
							                <span class="pull-right">
							                  
							                </span>
							            </label>
							            <button class="btn btn-lg btn-login btn-block" type="submit" value="Log In" name="login">Log In</button>
							            
							        </div>
</div> 
 </form>
 </div>            
   	</div>-->

   </div>
</section>















<!-- <div class="login-over">
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

               
                <div class="errors-container">

                </div>
                <?php if(!empty($error)){ ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>


                    			<a href="" class="center-block">
									<img src="<?php echo base_url(); ?>assets/images/logo_1.png" alt="" width="200" class="center-block"/>
								</a>
								
                        
                        <form action="<?php echo site_url('biller_login') ?>" method="post" role="form" id="login" class="form-signin">
                            <?php if($this->session->flashdata('msg')){ ?>
                                <div class="alert-message alert-<?php echo $this -> session -> flashdata('msg-class');?>">
                                    <?php echo $this -> session -> flashdata('msg'); ?> <span class="close-message"><span class="glyphicon glyphicon-remove"></span></span>
                                </div>
                                <?php } ?>


									<h2 class="form-signin-heading">sign in now</h2>
							        <div class="login-wrap">
							            <div class="user-login-info">
							                <input type="text" placeholder="Email" class="form-control input-dark <?php if (form_error('biller_email')!=" ") echo "error "; ?>" name="biller_email" id="biller_email" autocomplete="off" value="<?php echo set_value('biller_email'); ?>" onkeypress="remove_class('biller_email')" />
                                        	<?php echo form_error('biller_email'); ?>

							                <input type="password" placeholder="Password" class="form-control input-dark <?php if (form_error('biller_password')!=" ") echo "error "; ?>" name="biller_password" id="biller_password" value="<?php echo set_value('biller_password'); ?>" autocomplete="off" onkeypress="remove_class('biller_password')" />
                                        	<?php echo form_error('user_password'); ?>
							            </div>
							            <label class="checkbox">
							                <input value="remember-me" type="checkbox"> Remember me
							                <span class="pull-right">
							                  
							                </span>
							            </label>
							            <button class="btn btn-lg btn-login btn-block" type="submit" value="Log In" name="login">Log In</button>
							            
							        </div>
                                </div> 

                        </form>
            </div>

        </div>

    </div>
</div> -->
    <!-- Bottom Scripts -->   
  

</body>

 <script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
</html>