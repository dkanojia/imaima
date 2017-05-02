<?php 
//print_r($_POST);
//print_r($_REQUEST);
//die();
include('includes/db.inc.php');
include('Crypto.php');
if(!isset($_POST["orderNo"]) || !isset($_POST["encResp"]))
{
	header("location:index.php");
}

$workingKey='2369D3A417DDB5538270BDAA2C60113E';		//Working Key should be provided here.
$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
$order_status="";
$decryptValues=explode('&', $rcvdString);
$dataSize=sizeof($decryptValues);

if(isset($_POST["orderNo"]))
{
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		//print_r($information);
		if($i==3)	$order_status=$information[1];
	}
	
	  $update_table = new mysql(); 
       $query="UPDATE tblorder SET orderstatus='".$order_status."' WHERE orderid='".$_POST['orderNo']."' and orderstatus in ('Payment Incomplete','pending')";
      $update_table->stmt = $query;
      $update_table->execute();
	  
	   $orderdetail = new mysql();
	  $query = "select * from tblorder where orderid='".$_POST['orderNo']."'";
	$orderdetail->stmt = $query;
		$orderdetail->execute();
		if($orderdetail_result =$orderdetail->fetch_array())
		{				
		extract($orderdetail_result);
		$orderdetail->ordermail($_POST['orderNo'],$userid);
		 header("Location:cc_success.php?id=".$orderid);
		}
}
//print_r($_POST);
?>
