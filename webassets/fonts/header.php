<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Recharge</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/recharge.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
    <link href="css/magicsuggest.css" rel="stylesheet"> 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="bg"></div>
  <div class="container">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <nav class="nav_block">
                <div class="logo">
                    <img src="images/logo.png" alt="..."/>
                </div>
                <div class="menu-bar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="menu">
                    <ul>
                        <li  class="active"><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Share& Earn</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#LoginPop">SMS Management</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Contact</a></li>
                        <li data-toggle="modal" data-target="#loginPop"><a href="#"><img width="25" src="images/login_icon.png"/></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
            
 <!------------- login popup -------------->          
<div class="modal fade" id="loginPop" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
        	<div class="col-sm-7 col-xs-7 col-620">
            	<h2 class="text-green">Login</h2>
            	<div class="form-group">
                	<input type="text" class="field" placeholder="USERNAME">
                </div>
                <div class="form-group">
                	<input type="text" class="field" placeholder="PASSWORD">
                </div>
                <div class="form-group">
                	<a href="#">Forgot Password?</a>
                </div>
                <div class="form-group">
                	<input type="submit" class="field btn-green" value="LOGIN">
                </div>
            </div>
            <div class="col-sm-5 col-xs-5 col-620">
            	<h2 class="text-green">Or Login with</h2>
            	<div class="form-group">
                	<a href="#"><img src="images/facebook_btn.png" alt="..." class="img-responsive"></a>
                </div>
                <div class="form-group">
                	<a href="#"><img src="images/google_btn.png" alt="..." class="img-responsive"></a>
                </div>
            </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->