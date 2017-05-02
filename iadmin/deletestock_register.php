<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");

if(isset($_REQUEST["id"]))
{
$meta = new mysql();
$query = "update tblproduct_stock_requirement set bstatus=0 where nid=".$_REQUEST["id"];
$meta->stmt = $query;
$meta->execute();
$_SESSION["opmsg"] = "Requirement Deleted Successfully";
header("location:stock_register.php");
}
?>