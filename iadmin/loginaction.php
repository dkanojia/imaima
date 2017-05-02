<?php
include("../includes/db.inc.php");
if(isset($_POST['btnsubmit']))
{
$login = new mysql();
$username = mysql_real_escape_string($_POST['txtusername']);
$password = mysql_real_escape_string($_POST['txtpass']);
$query = "select * from tbladmin where bstatus=1 and activestatus='active' and loginid='".$username."' and password='".$password."'";
echo $query;
$login->stmt = $query;
$login->execute();
	if($login_result =$login->fetch_array())
	{
	extract($login_result);
	session_start();
		$_SESSION["username"] = $loginid;		
		header("location:adminhome.php");
	}
	else
	{
	header("location:index.php?msg=fail");
	}
}
?>