<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Login</title>
<link href="admin-style.css" rel="stylesheet"  type="text/css"/>
<script language="javascript" type="text/javascript">
function checkform()
{
if(document.getElementById("txtusername").value=="" || document.getElementById("txtpass").value=="")
{
alert("Enter Proper Login Detail");
return false;
}
}
</script>
</head>


<body>
<div id="login">
	<div id="loginWrapper">
    	<div id="logo"><img src="images/logo.png" alt="Jewel Ground" width="150" /></div>
        <div id="title">Admin Login</div>
        <div id="loginForm">
        	<form method="post" action="loginaction.php">
            <p><label>Login Id <span>*</span></label> <input name="txtusername" type="text" maxlength="20"/></p> 
        	<p><label>Password <span>*</span></label><input name="txtpass" type="password" maxlength="20"/></p>
        	<p class="forgot"><a href="#">Forgot Your Password</a></p>
			<p>
			<?php
			if(isset($_REQUEST["msg"]) && $_REQUEST["msg"]=="fail")
			{
			echo "Incorrect Username Password";
			}
			?>
</p>
            <p><label></label><input type="submit" value="" class="submit" name="btnsubmit" onclick="return checkform();"/></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
