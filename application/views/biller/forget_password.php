<?php

    	include_once 'config.php';

	    $user_email = $_REQUEST['user_email'];
	    if (!empty($user_email)) {
		$query="select * from user where user_email = '".$user_email."' ";
		$record=mysql_query($query);
		$records_user=mysql_fetch_array($record);
		if (!empty($records_user)) {
			$pass=rand(11111111, 99999999);
					$password = md5($pass);
					$update="update user set user_password='".$password."' where user_id='".$records_user[0]['user_id']."'";
					$record1=mysql_query($update);
				$user_email = $user_email;
				$subject = 'Eventsza';
			//	$mail_msg = 'New Password of login to in Eventsza.' . ' ' . ' - ' . $pass;
				
				$message1 = '<!DOCTYPE html>
<html>
   <head>
      <title></title>
   </head>
   <body>
      <div class="container">
         <div style="font-family:&quot;Trebuchet MS&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.6em;background-color:#fff;text-align:center">
            <table cellspacing="0" cellpadding="0" bgcolor="#fff" align="center" style="border-spacing:0;border-collapse:collapse;padding:20px;max-width:600px;min-width:320px;">
               <tbody>
                  <tr>
                     <td bgcolor="#fff" style="border:1px solid #f0f0f0">
                        <div style="display:block;margin:0 auto;max-width:600px">
                           <table style="width:100%;border-spacing:0;border-collapse:collapse">
                              <tbody>
                                 <tr>
                                    <td style="text-align:center">
                                       <table style="width:100%;border-spacing:0;border-collapse:collapse;padding:15px 10px">
                                          <tbody>
                                             <tr>
                                                <td align="left" colspan="2" style="padding:10px 35px;background-color:#2C2E2F">
                                                   <a>
                                                   
                                                   </a>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                
                                 <tr>
                                    <td style="background-color:#ddd;padding:30px 15px 15px 10px">
                                       <table align="center" style="border-spacing:0;border-collapse:collapse">
                                          <tbody>
                                             <tr>
                                                <td style="padding:10px">
                                                   <a data-saferedirecturl=" " target="_blank" style="text-decoration:none;color:inherit" href=" ">
                                                      <table width="100%" cellpadding="10" style="border-spacing:0;border-collapse:collapse;background-color:#fff;padding:10px 15px;text-align:left">
                                                         <tbody>
                                                            <tr>
                                                               <td style="border-bottom:1px solid #ddd;padding-top:10px;padding-left:15px;padding-right:15px" colspan="2">
                                                                  <span style="font-size:18px;line-height:1.5em;font-weight:bold">Dear ' . ucwords($user_email)  . '<p> You have request for forget password.</p><p> Your password for Eventsza is : ' . $pass  . ' </p></span>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td style="color: #333;font-size: 14px;font-weight: lighter;line-height: 1.5em;padding-bottom: 10px;padding-left: 15px;padding-right: 15px;text-align: justify;" colspan="2">'.$message.'                             
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td style="color:#FFB22C;font-size:15px;padding-left:20px">Thanks & regards<br>
                                                               <span style="color:gray">Eventsza</span>
                                                               </td>
                                                               <td style="text-align:right">
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </a>
                                                </td>
                                             </tr>
                                             
                                              
                                              
                                       
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 
                                 <tr>
                                    <td style="width:100%;padding:0;background:#FFB22C;border-collapse:collapse;border-spacing:0;margin:auto;text-align:center">
                                       <table style="width:100%;border-collapse:collapse;border-spacing:0">
                                          <tbody>
                                             <tr align="center">
                                                <td colspan="2">
                                                   <p style="margin-top:15px;margin-bottom:10px;font-size:20px;font-weight:300;color:#ffffff;letter-spacing:0.01em;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif">
                                                     
                                                   </p>
                                                </td>
                                             </tr>
                                            
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="background-color:#000;font-size:12px;color:#fff;text-align:center;padding:10px">
                                        Copyright &copy; 2016 Eventsza
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </td>
                     <td>
                     </td>
                  </tr>
               </tbody>
            </table>
             
       
         </div>
      </div>
   </body>
</html>';
				
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "From: blm.ypsilon@gmail.com" . "\r\n" . "Reply-To: blm.ypsilon@gmail.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();
				// $headers .= 'Cc: myboss@example.com' . "\r\n";
				$mail = mail($user_email, $subject, $message1, $headers);
				$post = array('status' => "true", "message" => "New Password send to your Registered Email",'password'=>$pass);
					} else {
						$post = array("status" => "false", "message" => "Invalid Email address");
					}
				
			

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_email' => $user_email);
			// $this->response($this->json($error), 400);

		}
			echo json_encode($post);
?>
