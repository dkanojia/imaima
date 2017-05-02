<?php
include('includes/db.inc.php');

if(isset($_POST["btnsubmit"]))
{

	$msg = "<table border='1' cellpadding='3' cellspacing='0' width='600'>";
	$msg .="<tr><td width='150'>Name</td><td>".$_POST["txtname"]."</td></tr>";
	$msg .="<tr><td width='150'>Subject</td><td>".$_POST["txtsubject"]."</td></tr>";
	$msg .="<tr><td>Email</td><td>".$_POST["txtemail"]."</td></tr>";
	$msg .="<tr><td>Telephone No.</td><td>".$_POST["txtphone"]."</td></tr>";
	$msg .="<tr><td>Message</td><td>".$_POST["txtmessage"]."</td></tr>";
	$msg .="</table>";
	$objcontact = new mysql();
	$mailid = $objcontact->adminmail;
	
	//$mailid = "jain.akashdeep@gmail.com";
	
	$subject = "Contact Us Enquiry : IIMAIMA";
	
	/*
	Normal Method
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <info@iimaima.com>' . "\r\n";
	$headers .= 'Cc:<info@iimaima.com> ' . "\r\n";
	mail($mailid,$subject,$msg,$headers);
	
	*/
	
	
	// using phpmailer  for ssl. 
	$objcontact->subject = $subject;
	$objcontact->message = $msg;
	$objcontact->to = $mailid;
	$objcontact->phpmailer();	
	//$_SESSION["addmsg"] = "your Messag has been received, we will get back to you soon. ";
	
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php 
include('includes/links.php');
?>


<title>:: Welcome to iimaima.com ::</title>
</head>
<body>
    <?php 
include('includes/toptext.php');
include('includes/header.php');
?>
<div style="width:97%; margin:0px auto; min-height:400px;">
<div class="leftproduct_menu_inner" style="float:left;">
<?php
include('includes/leftpart.php');
?>
</div>
<div class="rightproduct_menu_inner" style="float:left;">
   <div class="content-block sale-promo-wrapper products-carousel" style="padding-top:0px;"> 
  <div id="products-carousel">
    <div class="col-md-12 col-sm-12 col-xs-12" style=" margin-bottom:15px; width:100%; color:#000000;">

  

   
    <div class="col-md-6 col-sm-6 col-xs-6 loginbox">
      <?php
$cat = new mysql();


		  $query = "select * from tblpage_content where pageid='5' and  blockstatus='active' and bstatus=1";
		  $cat->stmt = $query;
		  $cat->execute();
		 $cat_result = $cat->fetch_array();
		 extract($cat_result);
		 echo "$pagecontent";
	

	
 ?>
     
    </div>
     
     <?php
     if(isset($_POST['btnsubmit']))
	 {
	 $custname=$_POST["txtname"];
	 $emailid=$_POST["txtemail"];
	 $msg = "<table cellpadding='4' cellspacing='4' style='width:100%; '><tr><td>".$_POST["txtenquiry"]."</td></tr>
	</table>";
	 
	 $mail = new mysql();
	$query ="select * from tbltemplate where subject='contact_us'";
	$mail->stmt=$query;
	$mail->execute();
	$mail_result=$mail->fetch_array();
	extract($mail_result);
		
	$msg1 = str_replace('#customername#',$custname, $templatecontent);
	$msg2 = str_replace('#customeremailid#',$emailid, $msg1);
	$msg3 = str_replace('#customermsg#',$msg, $msg2);
	 
	         $mailid = 'info@iimaima.com';
			$subject="Contact Form";
					
			$message = $msg3;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			$headers .= 'From: <'.$emailid.'>' . "\r\n";
			
	      mail($mailid,$subject,$message,$headers);
	?>
			<script>
		document.getElementById('successmsg').style.display="block";
		document.getElementById("successmsg").innerHTML = "success: Your Message has been Submitted Successfully.";
		document.getElementById("successmsg").focus();
	</script>
	<?php
	 }
	 
	 ?>
      
      <div class="col-md-6 col-sm-6 col-xs-6 registerbox" style="font-size:14px;">
     <h3 style="font-size:18px;" >Send us a Message</h3>
  <form name="form1" method="post" action="">
             
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" id="txtname" name="txtname" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                     <div class="control-group form-group">
                        <div class="controls">
                            <label>Subject:</label>
                            <input type="text" class="form-control" id="txtsubject" name="txtsubject" required data-validation-required-message="Please enter your Subject.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="tel" class="form-control" id="txtphone" name="txtphone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" id="txtemail" name="txtemail" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="5" cols="100" class="form-control" id="txtmessage" name="txtmessage" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <input class="form_button" style="color:#ffffff;"  type="submit" id="btnsubmit" name="btnsubmit" value="Send Message"  onClick="return checkform();"/>
                    
                     
                </form>
    </div>

</div></div></div>


</div>
</div>

<?php 
include('includes/footer.php');
?>

<script>

function checkform()
{
var msg ="";
if(document.getElementById("txtname").value=="")
{
msg +="Please Enter Name\n";
}
if(document.getElementById("txtemail").value=="")
{
msg +="Please Enter Email\n";
}
else
{
        if(!CheckEmail(document.getElementById("txtemail").value))
		{
		msg +="Please Enter valid Emailid\n";
		}
}
if(document.getElementById("txtmessage").value=="")
{
msg +="Please Enter Message\n";
}

if(msg!="")
{
alert(msg);
return false;
}
}

</script>
