<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SendEmailMsg 
{
	 
     function __construct()
    {
        $this->ci =& get_instance();
    }

     function sendElasticEmail($to, $subject, $body_text, $body_html, $from, $fromName,$attachments)
	{
    $res = "";

    $data = "username=".urlencode("care@oyacharge.com");
    $data .= "&api_key=".urlencode("9baa5dc0-e443-4f06-ac91-e547d3845151");
    $data .= "&from=".urlencode($from);
    $data .= "&from_name=".urlencode($fromName);
    $data .= "&to=".urlencode($to);
    $data .= "&subject=".urlencode($subject);
    if($body_html)
      $data .= "&body_html=".urlencode($body_html);
    if($body_text)
      $data .= "&body_text=".urlencode($body_text);
	if($attachments)
      $data .= "&attachments=".urlencode($attachments);
    $header = "POST /mailer/send HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($data) . "\r\n\r\n";
    $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30);

    if(!$fp)
      return "ERROR. Could not open connection";
    else {
      fputs ($fp, $header.$data);
      while (!feof($fp)) {
        $res .= fread ($fp, 1024);
      }
      echo $res;
      fclose($fp);
    }
   
    return $res;                  
}
function send_msg($mobile,$message)
	{
		 $encodedMessage = urlencode($message);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=abhishek.kumar@efficiencie.com&password=Abhi.ricky@12&sender=OyaCharge&recipient=$mobile&message=" . $encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);

		curl_close($ch);
	}
 }