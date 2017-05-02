<?php
include('includes/db.inc.php');

$shipping_charges=0;
if( isset($_REQUEST['country']))
{
$_SESSION["current_ship_country"]  = $_REQUEST['country'];

	/*if(!isset($_SESSION["discounttype"]) ||  $_SESSION["discounttype"]!="shipping" )
	{
	
	$shipcharge = new mysql();
	 $objcurr = new mysql();
	 $objcurr->currency_value = $objcurr->get_currency_value($_SESSION["currency"]);
	$queryShip = "select shipping as shipping_charges from tblshipping where country='".$_SESSION["current_ship_country"]."'";
	$shipcharge->stmt = $queryShip;
	$shipcharge->execute();
	$shipping_chargeresult =$shipcharge->fetch_array();	
	extract($shipping_chargeresult);	
	$shipping_charges = $objcurr->get_currency_amount($shipping_charges);
	
	echo $shipping_charges;
	$queryShip = "update tblorder set shipping=".$shipping_charges." where orderid='".$_SESSION['orderid']."'";
	$shipcharge->stmt = $queryShip;
	$shipcharge->execute();

	$queryShip = "update tblorder set grandtotal=subtotal-discountamount+shipping where orderid='".$_SESSION['orderid']."'";
	$shipcharge->stmt = $queryShip;
	$shipcharge->execute();

	}*/
	header("location:cart.php");
}
else
header("location:index.php");
?>