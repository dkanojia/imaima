<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");

if(isset($_REQUEST["id"]))
{
$meta = new mysql();
$query = "update tblcategory set bstatus=0 where catid=".$_REQUEST["id"];
$meta->stmt = $query;
$meta->execute();
$_SESSION["opmsg"] = "Sub-Category Deleted Successfully";

$cat = new mysql();
$query = "select * from tblcategory where catid=".$_REQUEST["id"];
$cat->stmt = $query;
$cat->execute();
$cat_result =$cat->fetch_array();
extract($cat_result);
header("location:subcategory.php?catid=".$parentid."&srch=");
}
?>