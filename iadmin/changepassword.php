<?php
include("include/header.inc.php");


if(isset($_POST["btnsave"]))
{
$username = $_SESSION["username"];
$oldpass = $_POST["txtoldpass"];
$newpass = $_POST["txtnewpass"];

$login = new mysql();
$query = "select * from tbladmin where bstatus=1 and activestatus='active' and loginid='".$username."' and password='".$oldpass."'";
$login->stmt = $query;
$login->execute();
	if($login_result =$login->fetch_array())
	{
	$query = "update tbladmin set password='".$newpass."' where bstatus=1 and activestatus='active' and loginid='".$username."'";
	$login->stmt = $query;
	$login->execute();
	$msg = "Password Updated Successfully";
	}
	else
	{
	$msg = "Incorrect Old password";
	}
}



?>
<div class="wrapper row-offcanvas row-offcanvas-left">

<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>


<script language="javascript" type="text/javascript">
function checkform()
{
var oldpass = document.getElementById("txtoldpass").value;
var newpass = document.getElementById("txtnewpass").value;
var conpass = document.getElementById("txtconpass").value;
if(oldpass == "" || newpass=="" || conpass=="")
{
document.getElementById("tdmsg").innerHTML = "Enter All Values";
return false;
}
if(newpass!=conpass)
{
document.getElementById("tdmsg").innerHTML = "New Password and confirm new password not match";
return false;
}

}
</script>

<form name="metaform" action="" method="post">
<section class="content">
<table class="formbox" width="450" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		Old Password
		</td>
		<td>
		<input type="password" class="txtBox" name="txtoldpass" id="txtoldpass" value="" />
		</td>
	</tr>
	<tr>
		<td>
		New Password
		</td>
		<td>
		<input type="password" class="txtBox" name="txtnewpass" id="txtnewpass" value="" />
		</td>
	</tr>

	<tr>
		<td>
		Confirm New Password
		</td>
		<td>
		<input type="password" class="txtBox" name="txtconpass" id="txtconpass" value="" />
		</td>
	</tr>
	

<tr>
<td colspan="2" style="padding:10px 10px 10px 200px;" >


<input type="submit" class="btn" name="btnsave" value="Save" style="width:43px" onclick="return checkform();"/>
&nbsp;&nbsp;&nbsp;
<input type="button" class="btn" name="btncancel" value="Cancel" onclick='location.href="adminhome.php"' />
</td>
</tr>

<tr >
<td colspan="2" id="tdmsg">
<?php echo $msg; ?>
</td>
</tr>

</table>
</section>
</form>




<?php
include("include/footer.inc.php");
?>