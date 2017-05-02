<?
 echo "Method-1 : Using Gmail smtp <br /><br />";

		include("includes/mailer/class.phpmailer.php");


/*	$mail = new PHPMailer(); // create a new object
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 4; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 587; // or 587
  $mail->IsHTML(true);  
  $mail->Username = "support@iimaima.com";
  $mail->Password = "imaima@123";
 
  // $mail->SetFrom("support@iimaima.com", 'Sajal Dewan');
   
    //$mail->FromName = "Imaima";
  $mail->From ="support@iimaima.com";
  $mail->Subject = "Test Mail";
  $mail->Body = "Test Body";
  $mail->AddAddress("jain.akashdeep@gmail.com");
 
  
   if(!$mail->Send())
   {
   echo "Mailer Error: " . $mail->ErrorInfo;
   }
   else
   {
   echo  "your Customer Order Requirement has been received, we will get back to you soon. ";
   }
   
   */
   
   
   
  $mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "ssl://smtp.gmail.com"; // specify main and backup server
$mail->Port = 465; // set the port to use
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "site.feedback.mail@gmail.com"; // your SMTP username or your gmail username
$mail->Password = "feedback@123*"; // your SMTP password or your gmail password
$from = "site.feedback.mail@gmail.com"; // Reply to this email
$to="jain.akashdeep@gmail.com"; // Recipients email ID
$name="Akashdeep Jain"; // Recipient's name
$mail->From = $from;
$mail->FromName = "Imaima"; // Name to indicate where the email came from when the recepient received
$mail->AddAddress($to,$name);
$mail->AddReplyTo($from,"Webmaster");
$mail->WordWrap = 50; // set word wrap
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Sending Email From Php Using Gmail";
$mail->Body = "This Email Send through phpmailer, This is the HTML BODY "; //HTML Body
$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}
  
   ?>