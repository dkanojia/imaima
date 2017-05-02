<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");

if(isset($_REQUEST["metaid"]))
{
$meta = new mysql();
$query = "update tblmeta_master set bstatus=0 where metaid=".$_REQUEST["metaid"];
$meta->stmt = $query;
$meta->execute();
$_SESSION["opmsg"] = "Meta Type Deleted Successfully";
header("location:metamaster.php");
}
?>