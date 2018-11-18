<?php
include_once 'config.php';
if (!empty($_REQUEST['email'])) {
	$email = base64_decode($_REQUEST['email']);

	$query = mysql_query("select * from `user` where user_email='$email' and user_email_verify='2'");
	if (mysql_num_rows($query) > 0) {
		$data = mysql_fetch_array($query);
		$sql = mysql_query("update `user` set user_email_verify='1' where user_email='$email'");
		if ($sql) {
			$dt = base64_encode("success");
			// header("location:success.php?msg=$dt");
			echo '<script>window.location.href="success.php?msg=success"</script>';
		}
	} else {
		$dt = base64_encode("failed");
		// header("location:success.php?msg=$dt");
		echo '<script>window.location.href="success.php?msg=failed"</script>';
	}
} else {
	$dt = base64_encode("invalid");
	// header("location:success.php?msg=$dt");
	echo '<script>window.location.href="success.php?msg=invalid"</script>';
}
?>