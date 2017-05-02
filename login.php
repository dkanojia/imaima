<?php
include('includes/db.inc.php');
if(isset($_POST["hidfacebookid"]))
{
	$facebookid=$_POST['hidfacebookid'];	
	$login = new mysql();	
	$query = "select * from tbluser where facebook_id='".$facebookid."' and bstatus=1 and blockstatus='active' ";	
	$login->stmt = $query;
	$login->execute();
	$count = $login->getNumRows();
	if($count > 0 )
	{
	$login_result =$login->fetch_array();
		extract($login_result);	
		
	$_SESSION['user_loginid'] = $loginid;
	$_SESSION['user_nid'] = $nid;
	$_SESSION['user_email'] = $emailid;
	$_SESSION['user_name'] = $firstname;
	
	if(isset($_SESSION['cart']))
	{	
	header("location:".$glob['rootRel']."cart.html");
	return;
	}
	else
	{	
	header("location:".$glob['rootRel']);
	return;
	}
	}
include('includes/facebook_submit.php');
}

if(isset($_POST['btnlogin'])){



	
//$email=mysql_real_escape_string($_POST['email']);
//$password=mysql_real_escape_string($_POST['password']);	

$loginid = str_replace("'","''",$_POST["email"]);
$pass = str_replace("'","''",$_POST["password"]);
	//echo $_POST['email'];
	$login = new mysql();	
	
	 $query = "select * from tbluser where (loginid='".$loginid."' or emailid='".$loginid."') and password='".$pass."' and bstatus=1 and blockstatus='active' ";	
	$login->stmt = $query;
	$login->execute();
	$count = $login->getNumRows();
	if($count > 0 )
	{
	$login_result =$login->fetch_array();
		extract($login_result);	
		
		
		
	
		
	
		
		
	$_SESSION['user_loginid'] = $loginid;
	$_SESSION['user_nid'] = $nid;
	$_SESSION['user_email'] = $emailid;
	$_SESSION['user_name'] = $firstname;
	
	if(isset($_SESSION['cart']))
	{
	//header("location:".$glob['rootRel']."cart.html");
	header("location:".$glob['rootRel']."cart.html");
	}
	else
	{
	//header("location:".$glob['rootRel']."myaccount.html");
	header("location:".$glob['rootRel']);
	
	}
	}else{ 
	$_SESSION["addmsg"]= "Sorry, You have Entered an Invalid login or password"; }
}

if(isset($_POST['forgot_password'])){
	//print_r($_POST);
//$forgotemail=mysql_real_escape_string($_POST['forgotemail']);
 $forgotemail=str_replace("'","''",$_POST["forgotemail"]);
$forgotpassword = new mysql();	
	 $query = "select * from tbluser where emailid='".$forgotemail."' and bstatus=1 and blockstatus='active' ";	
	$forgotpassword->stmt = $query;
	$forgotpassword->execute();
	$count = $forgotpassword->getNumRows();
	if($count > 0 )
		{
		$forgotpassword_result=$forgotpassword->fetch_array();
		extract($forgotpassword_result);	
		$name = $firstname." ".$lastname;
		$mailid= $_POST["forgotemail"];
		
		
			$mail = new mysql();
			$query ="select * from tbltemplate where templatename='Forgot_Password'";
			$mail->stmt=$query;
			$mail->execute();
			$mail_result=$mail->fetch_array();
			extract($mail_result);
			
			$msg = str_replace('#password#',$password, $templatecontent);
			
			$reg = new mysql();
			$reg->subject = $subject;
			$reg->message = $msg;
			$reg->to = $mailid;
			$reg->phpmailer();	
		
			$_SESSION["addmsg"]= "Psst! We will remind you the password soon.";
	 }else{ 
	 $_SESSION["addmsg"]= "The E-Mail Address was not found in our records, please try again!";
	 }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>:: Login ::</title>
<?php 
include('includes/links.php');
?>


</head>
<body>
    <?php 
include('includes/toptext.php');
include('includes/header.php');
?>
<div style="width:90%; margin:0px auto; margin-bottom:30px;">

<div id="content"> 
       
  <div class="login-content content">
		<div class="row-fluid">
        	<div class="span6 loginbox">
				<div class="inner">
				  <h2 style="font-size:18px; padding-left:20px;">Welcome back !</h2>
				  <form action="" method="post" enctype="multipart/form-data" onSubmit="return validate(this);" name="loginform">
					<div class="content" style=" padding-left:20px;">
					 <!-- <p>I am a returning customer</p>-->
					  <b>E-Mail Address:</b><br>
					  <input name="email" id="email" type="text" onBlur="removeborder(this.id)" style="width:100%;">
					  <br>
					  <br>
					  <b>Password:</b><br>
					  <input name="password"  id="password" value="" type="password" onBlur="removeborder(this.id)" style="width:100%;">
					  <br>
					  <a href="#" onClick="return showforgot()">Forgotten Password</a><br>
					  <br>
					  <input value="Let's Shop" class="form_button" name="btnlogin" type="submit">
					  <input name="redirect" value="" type="hidden">
					  </div>
				</form>
					<div class="content" id="forgotdiv" style="display:none; border-top:solid 1px #aaaaaa; margin-top:20px; padding-bottom:20px; padding-top:10px; padding-left:20px;">
					<h2 style="font-size:18px;">Forgot Your Password?</h2>
					<form action="" method="post" onSubmit="return forgotvalidate(this);" name="forgotform">
					<p>Enter the e-mail address associated with your account. Click submit to have your password e-mailed to you</p>
					 <b>E-Mail Address:</b><br>
					 <input name="forgotemail" id="forgotemail" type="text" style="width:300px;">
					 <input value="Send Email" class="form_button" name="forgot_password" type="submit">
					 </form>
					</div>
				</div>
			</div>
			<div class="span6 registerbox">
				<div class="inner">
				  <h2 style="font-size:18px; padding-left:10px;">Never seen you before !</h2>
				  <div class="content registerbox_leftborder" style="padding-left:10px;">
					<!--<p><b>Register Account</b></p>-->
					<!--<p>
                    <strong>Let’s get acquainted.</strong>
                    <br /><br />
                    Create an account with us and you will be able to shop faster, along with a long list of benefits.<br>
<ul>
	<li>Save your address</li>
    <li>Create a wishlist</li>
    <li>View your order history</li>
    <li>Use your PayPal account</li>
    <li>Stay upto date with your current orders</li>
    <li>Join our mailing list</li>
    <li>Be amongst the first few to receive the latest information on new arrivals, promotions and sale.</li>   
</ul>

<br />
Doesn’t it sound tempting ?</p>
					-->
                    
                     <?php
$cat = new mysql();
		  $query = "select * from tblpage_content where pageid='17' and  blockstatus='active' and bstatus=1";
		  $cat->stmt = $query;
		  $cat->execute();
		 $cat_result = $cat->fetch_array();
		 extract($cat_result);
		 echo "$pagecontent";
	

	
 ?>
                    
					</div>
                    <div class="content" style="margin-top:26px;padding-left:10px;">
                    <input value="Join us Now !" class="form_button" name="btnregister" type="submit" onClick="location.href='register.php';" style="float:left; margin-right:20px;">
                    &nbsp;&nbsp;
                     <?php 
					if(!isset($_POST["btn_facebook_registerform"]))
					{
					include('includes/loginwithfacebook.php');
					}

?>
                    </div>
                    <!-- <div class="content" style="margin-top:26px;padding-left:10px;">
                   
                    </div>-->
				</div>
			</div>
				
		</div>	
  </div>
  </div>
<script type="text/javascript"><!--
$('#login input').keydown(function(e) {
	if (e.keyCode == 13) {
	$('#login').submit();
	}
});
//--></script> 

    
<script type="text/javascript">
var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i 
///Login Form 
function validate(loginform){

var email = loginform.email.value;
var password = loginform.password.value;
 if (!ck_email.test(email)) {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Valid Email Address";
		document.getElementById("email").style.border = "1px solid red";
		document.getElementById("email").focus();
        return false;
 }

 if (password=='') {
		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your Password";
		document.getElementById("password").style.border = "1px solid red";
		document.getElementById("password").focus();
        return false;
	}

 
	 return true;
}

function removeborder(id){
	document.getElementById(id).style.border = "";
}

/////Forgot Password
function showforgot(){
	document.getElementById('forgotdiv').style.display = "block";
	document.getElementById("forgotemail").focus();
	return false;
}

function forgotvalidate(forgotform){	
var email = forgotform.forgotemail.value;
 if (!ck_email.test(email)) {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Valid Email Address";
		document.getElementById("forgotemail").style.border = "1px solid red";
		document.getElementById("forgotemail").focus();
        return false;
 }
	 return true;
}

</script>


</div>
<?php 
include('includes/footer.php');
?>
