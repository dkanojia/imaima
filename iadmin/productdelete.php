<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");


$query = "update tblproduct set bstatus=0 where productid=".$_REQUEST["id"];   
$meta = new mysql();
$meta->stmt = $query;
$meta->execute();
$_SESSION["opmsg"] = "Product Deleted Successfully";
header("location:products.php?catid=".$_REQUEST["catid"]."&subcatid=".$_REQUEST["subcatid"]);



?>