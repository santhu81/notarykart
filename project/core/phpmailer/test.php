<?php
ini_set("memory_limit",-1);
ini_set('max_execution_time', 1400);
 ini_set("display_errors","On");
require("class.phpmailer.php");

 
$mail = new PHPMailer();
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Mailer = "smtp";
$mail->Host = "ssl://smtp.gmail.com";
$mail->Port = 465;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "ramukneevan.n.v@gmail.com"; // SMTP username
$mail->Password = "RAMUKneevan.n.v628336"; // SMTP password 
 $mail->SMTPDebug = 1;
$mail->From     = "ramukneevan.n.v@gmail.com";
$mail->AddAddress("ramukneevannv@yahoo.in");  
 
$mail->Subject  = "First PHPMailer Message";
$mail->Body     = "Hi! \n\n This is my first e-mail sent through PHPMailer.";
$mail->WordWrap = 50;  
 
if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent.';
}
?>
