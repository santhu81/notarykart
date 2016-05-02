<?php
 ini_set("display_errors","On");
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                // send via SMTP
$mail->Host     = "smtp.ecandor.com"; // SMTP servers
$mail->SMTPAuth = false;     // turn on SMTP authentication
$mail->Username = "salary@ecandor.com";   // SMTP username
$mail->Password = "candorsalary123"; // SMTP password

$mail->From     = "salary@ecandor.com";
$mail->FromName = "Ecandor";
$mail->AddAddress("natesha.s@tarkasoft.com","Natesha");
$mail->AddAddress("ssnatesha@gmail.com","Natesha Gmail");
$mail->AddAddress("hrangaswamaiah@intevaproducts.com","hrangaswamaiah");
$mail->AddAddress("SDSouza@intevaproducts.com","SDSouza");

$mail->AddReplyTo("salary@ecandor.com","Ecandor");

$mail->WordWrap = 50;                              // set word wrap
 
$mail->IsHTML(true);                               // send as HTML

$mail->Subject  =  "Here is the subject";
$mail->Body     =  "This is the <b>HTML body</b>";
$mail->AltBody  =  "This is the text-only body";

if(!$mail->Send())
{
   echo "Message was not sent <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";

?>
