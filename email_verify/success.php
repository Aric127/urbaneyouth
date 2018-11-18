<?php
$response = '';
if (isset($_GET['msg'])) {
	//$resdata = mysql_real_escape_string($_GET['msg']);
	$resdata = $_GET['msg'];
	//$data = base64_decode($resdata);
	$data = $resdata;
	if ($data == 'success') {
		$response = "<p style='color:green;font-size:25px;padding-top: 104px;'>Thanks for your email verification, account is active now !</p>";
	} elseif ($data == 'failed') {
		$response = "<p style='color:red;font-size:25px;padding-top: 104px;'>Your account is already verified !</p>";
	} else {
		$response = "<p style='color:red;font-size:25px;padding-top: 104px;'>Invalid data !</p>";
	}
}
?>

<html>
    <head>
        <style type="text/css">
			body {
				background: url(background.png) center fixed no-repeat #FF9933;
			}
			#content {
				margin-top: 170px;
			}
        </style>   
    </head>
    <body>
        <div id="header">

        </div>
        <div id="content">
           <span id="message"><center><?php echo $response?></center></span>
        </div>
        <div id="footer">

        </div>
    </body>
</html>
