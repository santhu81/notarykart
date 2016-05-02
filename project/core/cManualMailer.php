<?php
function send_manual_mail($to,$subject,$message,$replay_to=null,$cc=null,$bcc=null,$attachment_arr=null)
	{
	require_once(dirname(dirname(__FILE__)).'/phpmailer/class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPSecure = "ssl";
	$mail->Host       = "smtpout.asia.secureserver.net"; // SMTP server
	$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "admin@pegarse.com"; // SMTP account username
	$mail->Password   = "Pegarse@123";        // SMTP account password
	$mail->SetFrom('admin@pegarse.com', 'Eazyshop');
	$mail->AddReplyTo("admin@pegarse.com","Eazyshop");
	$to_arr=explode(",",$to);
	 
	foreach($to_arr as $v)
	{
		if(!empty($v))
		$mail->AddAddress($v,$v);
	 
	}
	$cc_arr=explode(",",$cc);
	foreach($cc_arr as $v)
	{
		if(!empty($v))
		$mail->AddCC($v,$v);
	}
	if(!empty($attachment_arr))
	{
		foreach($attachment_arr as $akk)
		{
			if(!empty($akk['path']))
			$mail->AddAttachment($akk['path'],$akk['name']); 
		}
	}
	//$mail->AddBCC("natesha.s@tarkasoft.com",'Natesha S');
 
	$mail->WordWrap = 50;                              // set word wrap
	$mail->IsHTML(true);                               // send as HTML
	$mail->Subject  =  $subject;
	$mail->Body     =  $message;
	$mail->MsgHTML($message);
	$mail->AltBody  =  $message;

	if(!$mail->Send())
	{
	  $data="Message was not sent Mailer Error: " . $mail->ErrorInfo;
	    
	}

	$data='true';
	return $data;
	 
	}
 
?>