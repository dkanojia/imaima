<?
 echo "Method-1 : Using Gmail smtp <br /><br />";
		include("includes/mailer/class.phpmailer.php");
	$mail = new PHPMailer(); // create a new object
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465; // or 587
  //$mail->IsHTML(true);  
  $mail->Username = "support@iimaima.com";
  $mail->Password = "imaima@123";
  //$mail->Username = "site.feedback.mail@gmail.com";
  //$mail->Password = "feedback@123*";
   $mail->SetFrom("support@iimaima.com", 'Sajal Dewan');
   
    $mail->FromName = "Imaima";
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
   
  die(); 
   
   echo "<br /><br /><br />Method-2 : using vps smtp<br /><br />";
   
   // method - 2
   $mail->IsHTML(true);
  $mail->SMTPSecure = 'tls';
  $mail->IsSMTP(); 
  $mail->SMTPDebug = 1; 
  $mail->SMTPAuth = true;
   $mail->Username = "info@iimaima.com";
  $mail->Password = "iim@2017"; 
  $mail->Host = "192.198.88.195";
  $mail->Port = 25;
  $mail->SetFrom("info@iimaima.com", 'Imaima');
  
  
   $mail->FromName = "Imaima";
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
   
   
   echo "<br /><br /><br />Method-3 : using vps without smtp<br /><br />";
   $mail->IsHTML(true);
  $mail->SMTPSecure = 'ssl';  
   $mail->FromName = "Imaima";
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
   
   
    echo "<br /><br /><br />Method-3 : using simple mail function <br /><br />";
	$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			$headers .= 'From: <support@iimaima.com>' . "\r\n";
	mail("jain.akashdeep@gmail.com","Test Mail","Test Message",$headers);
   
   ?>
