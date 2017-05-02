<?php

include('includes/db.inc.php');
if(isset($_POST['submit'])){

$signup = new mysql();
$firstname = str_replace("'","''",$_POST["firstname"]);
$lastname = str_replace("'","''",$_POST["lastname"]);
$telephone = str_replace("'","''",$_POST["telephone"]);
$address_1 = str_replace("'","''",$_POST["address_1"]);
$address_2 = str_replace("'","''",$_POST["address_2"]);
$city = str_replace("'","''",$_POST["city"]);
$postcode = str_replace("'","''",$_POST["postcode"]);
$state = str_replace("'","''",$_POST["state"]);




$signupSql="update `tbluser` set  `firstname`='".$firstname."', `lastname`='".$lastname."', `address`='".$address_1."', `address2`='".$address_2."', `city`='".$city."', `country`='".$_POST['country_id']."', `state`='".$state."', `zip`='".$postcode."', `phone1`='".$telephone."' where loginid='".$_SESSION['user_loginid']."'";
$signup->stmt = $signupSql;
		$signup->execute();
		$_SESSION["addmsg"]= "Profile Updated Successfully.";

}
if(!isset($_SESSION['user_nid']))
{
	header("location:login.php");
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
 <h1  class="title-category" style="font-size:18px;">My Profile</h1> 
 </div>
<div id="content" style="max-width:650px; margin:0px auto; border:solid 1px #aaaaaa; border-radius:5px; padding:10px;" >	
    
<?
$shipping = new mysql();
	$query = "select * from tbluser where loginid='".$_SESSION['user_loginid']."'";
	$shipping->stmt = $query;
	$shipping->execute();
	$shipping_result =$shipping->fetch_array();	
	extract($shipping_result);	
?>
   
	 
	  <form action="" method="post" enctype="multipart/form-data" onSubmit="return validate(this);" name="signupform">
		<h2 style="font-size:14px; font-weight:bold; border-bottom:solid 1px #aaaaaa;">Your Personal Details</h2>
		<div class="content">
		  <table class="form">
			<tbody>
            <tr>
			  <td><span class="required">*</span> E-Mail:</td>
			  <td><input name="email" id="email" type="text" onBlur="removeborder(this.id)" value="<?=$emailid?>" disabled="disabled"  style="width:90%;">
				</td>
			</tr>
            
            <tr>
			  <td width="30%"><span class="required">*</span> First Name:</td>
			  <td><input name="firstname" id="firstname" type="text"  onBlur="removeborder(this.id)" value="<?=$firstname?>" style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> Last Name:</td>
			  <td><input name="lastname" id="lastname" type="text" onBlur="removeborder(this.id)" value="<?=$lastname?>"  style="width:90%;">
				</td>
			</tr>
			
			<tr>
			  <td><span class="required">*</span> Telephone:</td>
			  <td><input name="telephone" id="telephone" type="text" onBlur="removeborder(this.id)" value="<?=$phone1?>"  style="width:90%;">
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
			  <td><input name="address_1" id="address_1" type="text" onBlur="removeborder(this.id)"  value="<?=$address?>"  style="width:90%;">
				</td>
			</tr>
			<tr>
			  <td>Address 2:</td>
			  <td><input name="address_2" id="address_2"  type="text" style="width:90%;"  value="<?=$address2?>"></td>
			</tr>
			<tr>
			  <td><span class="required">*</span> City:</td>
			  <td><input name="city" id="city"  type="text" onBlur="removeborder(this.id)" style="width:90%;"  value="<?=$city?>">
				</td>
			</tr>
			<tr>
			  <td><span style="display: none;" id="postcode-required" class="required">*</span> Post Code:</td>
			  <td><input name="postcode" id="postcode" type="text" style="width:90%;" value="<?=$zip?>">
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
					$countrySql  ="select country as countryname from tblshipping where blockstatus='active' order by country";
					$objcountry->stmt= $countrySql;
					$objcountry->execute();
					while($country_result =$objcountry->fetch_array())
					{
					extract($country_result);
				  ?>
				 <option <?php if($country==$countryname) { ?> selected="selected" <?php } ?> value="<?=$countryname?>"><?=$countryname?></option>
                  <?php } ?>
                  </select>
				</td>
			</tr>
			<tr>
			  <td><span class="required">*</span> Region / State:</td>
               <td><input name="state" id="state" type="text" onBlur="removeborder(this.id)"  style="width:90%;" value="<?=$state?>">
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