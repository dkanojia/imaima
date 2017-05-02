<?php
include "PHPMailer_5.2.4/class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "support@iimaima.com";
$mail->Password = "imaima@123";
$mail->SetFrom("support@iimaima.com);
$mail->Subject = "Here is the subject";
$mail->Body = "This is the HTML message body <b>in bold!</b>";
 if(!$mail->Send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else{
    echo "Message has been sent";
}
?>
