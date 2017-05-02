<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");

if(isset($_REQUEST["nid"]))
{
$meta = new mysql();
$query = "update tblproduct_price set bstatus=0 where nid=".$_REQUEST["nid"];
$meta->stmt = $query;
$meta->execute();
$_SESSION["opmsg"] = "Price Deleted Successfully";


header("location:productprice.php?proid=".$_REQUEST["proid"]);
}
?>