<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");

if(isset($_REQUEST["id"]))
{
$meta = new mysql();
$query = "update tbluser set bstatus=0 where nid=".$_REQUEST["id"];
$meta->stmt = $query;
$meta->execute();
$_SESSION["opmsg"] = "User Deleted Successfully";
header("location:users.php");
}
?>