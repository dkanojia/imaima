<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");

if(isset($_REQUEST["orderid"]))
{
$meta = new mysql();
$query = "update tblorder set bstatus=0 where orderid=".$_REQUEST["orderid"];
$meta->stmt = $query;
$meta->execute();
$_SESSION["opmsg"] = "Order is Deleted Successfully";


header("location:orders.php?status=all");
}
?>