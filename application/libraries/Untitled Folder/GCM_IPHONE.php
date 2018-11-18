<?php
class GCM_IPHONE {

	//put your code here
	// constructor
	function __construct() {

	}

	public function send_notification_iphone($registatoin_ids, $msg, $message, $count) {

		// Put your device token here (without spaces):
		//$deviceToken = '0f744707bebcf74f9b7c25d48e3358945f6aa01da5ddb387462c7eaf61bbad78';
		$deviceToken = $registatoin_ids;

		// Put your private key's passphrase here:
		$passphrase = 'ypsilon';

		// Put your alert message here:
		$message = $message;

		////////////////////////////////////////////////////////////////////////////////

		$ctx = stream_context_create();
		// stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/sharejob/webservices/ck.pem');
		stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/autodealer/webservices/notification/ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

		//echo 'Connected to APNS' . PHP_EOL;

		// Create the payload body
		$body['aps'] = array('alert' => $message, 'msg' => $msg,'sound' => 'strings.wav','badge'=>$count);

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		@$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));

		/*
		if (!$result) {
					echo 'Message not delivered' . PHP_EOL;
				} else {
					echo 'Message successfully delivered' . PHP_EOL;
				}*/
		

		// Close the connection to the server
		fclose($fp);
	}

}
