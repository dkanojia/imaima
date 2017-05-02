<?php
include('includes/db.inc.php');

if(isset($_POST['submit'])){


$signup = new mysql();
$firstname = str_replace("'","''",$_POST["firstname"]);
$lastname = str_replace("'","''",$_POST["lastname"]);
$email = str_replace("'","''",$_POST["email"]);
$telephone = str_replace("'","''",$_POST["telephone"]);
$address_1 = str_replace("'","''",$_POST["address_1"]);
$address_2 = str_replace("'","''",$_POST["address_2"]);
$city = str_replace("'","''",$_POST["city"]);
$postcode = str_replace("'","''",$_POST["postcode"]);
$state = str_replace("'","''",$_POST["state"]);
$password = str_replace("'","''",$_POST["password"]);



	$query = "select * from tbluser where loginid='".$email."' and bstatus='1' and blockstatus='active'";
	$signup->stmt = $query;
	$signup->execute();
	if($signup_result=$signup->fetch_array())
	{ 
		$_SESSION["addmsg"]= "Email Id Already Registered.";
	}
	else
	{
		$query = "select * from tbluser where emailid='".$email."' and bstatus='1' and blockstatus='active'";
		$signup->stmt = $query;
		$signup->execute();
		if($signup_result=$signup->fetch_array())
		{ 
		$_SESSION["addmsg"]= "Email Id Already Registered."; 
		}
		else
		{	

		$signupSql="INSERT INTO `tbluser`(`loginid`, `emailid`, `password`, `firstname`, `lastname`, `address`, `address2`, `city`, `country`, `state`, `zip`, `phone1`, `referralnid`, `ship_fname`, `ship_lname`, `ship_address1`, `ship_address2`, `ship_city`, `ship_state`, `ship_country`, `ship_zip`, `ship_phone`, `blockstatus`, `bstatus`, `creationdate`) values ('".$email."','".$email."','".$password."','".$firstname."','".$lastname."','".$address_1."','".$address_2."','".$city."','".$_POST['country_id']."','".$state."','".$postcode."','".$telephone."','".$_POST['txtreferral']."','".$firstname."','".$lastname."','".$address_1."','".$address_2."','".$city."','".$state."','".$_POST['country_id']."','".$postcode."','".$telephone."','active','1','".date('y-m-d H:i:s')."')";
		$signup->stmt = $signupSql;
		$signup->execute();
		
			$name = $firstname." ".$lastname;
			$mailid= $email;
			 /*$custormailid ="<span>".$email."</span>";
			 $custorpassword ="<span>".$password."</span>";*/
			/*$msg = "<html>
			<head>
			<title>Member Resgistration</title>
			</head>
			<body>
			<table width='100%' border='0px' align='center'>
				<tr><td><img src='http://www.hayazone.tag-11.com/images/haya-ENG.png'/></td></tr>
			<tr><td style='-moz-border-radius: 10px 10px 10px 10px; -moz-box-shadow: 0px 2px 4px 2px rgba(0,0,0,0.2); border-radius: 10px 10px 10px 10px;'>
			<table style='line-height: 28px; height: 220px;'>
			<tr><td>Hello <span style='font-weight:bold'> ".$name."</span></td></tr>
			<tr><td>We are so glad to see you at HAYAZONE. As a registered member of HAYAZONE, you will enjoy many benefits.</td></tr>
			<tr><td>Here is the account information you might want to save: </td></tr>
			<tr><td><span style='font-weight:bold'>User ID :-</span> " .$email. " </td></tr>						
			<tr><td><span style='font-weight:bold'>Password :-</span> " .$password. " </td></tr>	
			<br>				
		
			<tr><td>If you have questions, please don’t hesitate to give us a call. We’re here to help.</td></tr></table></td></tr>
			<tr><td><span style='color: #8c8b91; font-size:9pt;'>Need help?<a style='color:#73a7d5' href='#' target='_blank'> Contact Us</a>
			<br />at <span style='color: #8c8b91;'> Email: care@hayazone.com</span></span></td></tr></table>
			</body>
			</html>";*/
			
			$mail = new mysql();
			$query ="select * from tbltemplate where templatename='User_Registration'";
			$mail->stmt=$query;
			$mail->execute();
			$mail_result=$mail->fetch_array();
			extract($mail_result);
			
			$msg1 = str_replace('#name#',$name, $templatecontent);
			$msg2 = str_replace('#emailid#',$email, $msg1);
			$msg3 = str_replace('#password#',$password, $msg2);
			
			//$subject = "User Registration";
			
			/*$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <info@iimaima.com>' . "\r\n";
			$headers .= 'Cc:<info@iimaima.com> ' . "\r\n";
			mail($mailid,$subject,$msg3,$headers);
			*/
			
			$reg = new mysql();
			$reg->subject = $subject;
			$reg->message = $msg3;
			$reg->to = $mailid;
			$reg->phpmailer();	
			
			
			$_SESSION['user_loginid'] = $email;
			$_SESSION['user_nid'] = $userid;
			$_SESSION['user_email'] = $email;
			$_SESSION['user_name'] = $firstname;
			if(isset($_SESSION['cart']))
			{			
				header("location:".$glob['rootRel']."cart.html");
				return;
			
			}
			else
			{
				$_SESSION["addmsg"]= "Congratulation, Your Registration with iimaima done, Let's Start Shopping.";
				header("location:".$glob['rootRel']);
				return;
			}
	}		
}
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
<div style="width:97%; margin:0px auto; float:left;">
<div style="max-width:650px; margin:0px auto; padding:10px;" >	
 <h1  class="title-category" style="font-size:18px;">Register Account</h1> 
 </div>
<div id="content" style="max-width:650px; margin:0px auto; border:solid 1px #aaaaaa; border-radius:5px; padding:10px;" >	
    

   
	  <p>If you already have an account with us, please login at the <a href="login.php">login page</a>.</p>
	  <form action="" method="post" enctype="multipart/form-data" onSubmit="return validate(this);" name="signupform">
		<h2 style="font-size:14px; font-weight:bold; border-bottom:solid 1px #aaaaaa;">Your Personal Details</h2>
		<div class="content">
		  <table class="form">
			<tbody><tr>
			  <td width="30%"><span class="required">*</span> First Name:</td>
			  <td><input name="firstname" id="firstname" type="text"  onBlur="removeborder(this.id)" style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> Last Name:</td>
			  <td><input name="lastname" id="lastname" type="text" onBlur="removeborder(this.id)"  style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> E-Mail:</td>
			  <td><input name="email" id="email" type="text" onBlur="removeborder(this.id)"  style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> Telephone:</td>
			  <td><input  name="telephone" id="telephone" type="text" onBlur="removeborder(this.id)"  style="width:90%;" onKeyPress="blockNonNumbers(this, event, true, false);" onBlur="extractNumber(this,0,false);" onKeyUp="extractNumber(this,0,false);" >
				</td>
			</tr>
			
		  </tbody></table>
		</div>
		<h2 style="font-size:14px; font-weight:bold; border-bottom:solid 1px #aaaaaa;">Your Address</h2>
		<div class="content">
		  <table class="form">
			<tbody>
        
			<tr>
			  <td width="30%"><span class="required">*</span> Address 1:</td>
			  <td><input name="address_1" id="address_1" type="text" onBlur="removeborder(this.id)"  style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td>Address 2:</td>
			  <td><input name="address_2" id="address_2"  type="text" style="width:90%;"></td>
			</tr>
			<tr>
			  <td><span class="required">*</span> City:</td>
			  <td><input name="city" id="city"  type="text" onBlur="removeborder(this.id)" style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td><span style="display: none;" id="postcode-required" class="required">*</span> Post Code:</td>
			  <td><input name="postcode" id="postcode" type="text" style="width:90%;">
            <?php if (isset($_GET["id"]))
				{
				?>
			 <input type="hidden" value= '<?php echo $_GET["id"]?>' name="txtreferral" />
			 <?php
			 }
			else
             {
			 ?>
              <input type="hidden" value="0" name="txtreferral" />
              <?php
			  }
			  ?>
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> Country:</td>
			  <td><select name="country_id" id="country_id" style="width:90%; padding:10px;">
				  <option value="0"> --- Please Select --- </option>
                  <?php 
				  	$objcountry = new mysql();
					$countrySql  ="select * from tblshipping where blockstatus='active' order by country";
					$objcountry->stmt= $countrySql;
					$objcountry->execute();
					while($country_result =$objcountry->fetch_array())
					{
					extract($country_result);
				  ?>
				 <option <?php if($country=='India') { ?> selected="selected" <?php } ?> value="<?=$country?>"><?=$country?></option>
                  <?php } ?>
                  </select>
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> Region / State:</td>
               <td><input name="state" id="state" type="text" onBlur="removeborder(this.id)"  style="width:90%;">
			  </td>
			</tr>
		  </tbody></table>
		</div>
		<h2 style="font-size:14px; font-weight:bold; border-bottom:solid 1px #aaaaaa;">Your Password</h2>
		<div class="content">
		  <table class="form">
			<tbody><tr>
			  <td width="30%"><span class="required">*</span> Password:</td>
			  <td><input name="password" id="password" value="" type="password" onBlur="removeborder(this.id)" style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> Password Confirm:</td>
			  <td><input name="confirm_password" id="confirm_password" value="" type="password" onBlur="removeborder(this.id)" style="width:90%;">
				</td>
			</tr>
		  </tbody></table>
          
		</div>	
		
				<div class="buttons">
               
		 
		<input value="Submit" name="submit" class="form_button" type="submit" onClick="return validate();">
		  </div>
		
	</form>
	  </div>
</div>


<script type="text/javascript">


function validate(){
var firstname = document.getElementById("firstname").value;
var lastname = document.getElementById("lastname").value;
var email = document.getElementById("email").value;
var phone = document.getElementById("telephone").value;
var address = document.getElementById("address_1").value;
var city = document.getElementById("city").value;
var country = document.getElementById("country_id").value;
var state = document.getElementById("state").value;
var password = document.getElementById("password").value;
var confirm_password = document.getElementById("confirm_password").value;
var error_msg="";

if (firstname=="") {
		error_msg += "Please Enter Your First Name\n";
		document.getElementById("firstname").style.border = "1px solid red";		
  }
  else
  {
  document.getElementById("firstname").style.border = "1px solid #dddddd";
  }
  
  if (lastname=="") {
	 	 error_msg += "Please Enter Your Last Name\n";
		document.getElementById("lastname").style.border = "1px solid red";
		}
  else
  {
  document.getElementById("lastname").style.border = "1px solid #dddddd";
  }
  
  
  
 if (email=="") {
  		error_msg +=  "Please Enter Valid Email Address";
		document.getElementById("email").style.border = "1px solid red";
		}
  else
  {
  document.getElementById("email").style.border = "1px solid #dddddd";
  }
 
  if (phone=="") {
  		error_msg += "Please Enter Valid Phone Number";
		document.getElementById("telephone").style.border = "1px solid red";
		}
  else
  {
  document.getElementById("telephone").style.border = "1px solid #dddddd";
  }
 
   if (address=='') {
  		error_msg += "Please Enter Your Address";
		document.getElementById("address_1").style.border = "1px solid red";
		}
  else
  {
  document.getElementById("address_1").style.border = "1px solid #dddddd";
 
   if (city=='') {
  		error_msg += "Please Enter Your City";
		document.getElementById("city").style.border = "1px solid red";
		}
  else
  document.getElementById("city").style.border = "1px solid #dddddd";
  }
 
  if (state=='') {
  		error_msg += "Please Enter Your Address";
		document.getElementById("state").style.border = "1px solid red";
		}
  else
  {
  document.getElementById("state").style.border = "1px solid #dddddd";
  }
  
 if (country==0) {
		error_msg += "Please Enter Your Country";
		document.getElementById("country_id").style.border = "1px solid red";	
        return false;
	 }
	 
 if (password=='') {
		error_msg += "Please Enter Your Password";
		document.getElementById("password").style.border = "1px solid red";
		}
  else
  {
  document.getElementById("password").style.border = "1px solid #dddddd";
  }

 if (confirm_password=='') {
		error_msg += "Please Enter Your Confirm Password";
		document.getElementById("confirm_password").style.border = "1px solid red";
		}
  else
  {
  document.getElementById("confirm_password").style.border = "1px solid #dddddd";
  }
 

if(password!=confirm_password){
		error_msg += "Password Not Matched";
		document.getElementById("password").style.border = "1px solid red";
		document.getElementById("password").value = "";
		document.getElementById("confirm_password").value = "";
		document.getElementById("password").focus();
		}
  else
  {
  document.getElementById("password").style.border = "1px solid #dddddd";
  document.getElementById("confirm_password").style.border = "1px solid #dddddd";
  }

 if (error_msg != "") {		
		return false;
	 }
	 return true;
}

function removeborder(id){
	document.getElementById(id).style.border = "1px solid #dddddd";
}
</script>


<?php 
include('includes/footer.php');
?>







	 
	 
	 
    


