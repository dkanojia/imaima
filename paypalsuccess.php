<?php 

include("includes/db.inc.php");

	  
$userid=0;
   //  if(isset($_REQUEST["PHPSESSID"])  && isset($_REQUEST["payer_id"]) && isset($_REQUEST['id'])){
    if(isset($_REQUEST['id'])){
      $update_table = new mysql();
 
       $query="UPDATE tblorder SET orderstatus='Success',paypal_payer_id='$_REQUEST[payer_id]',paypal_id='$_REQUEST[PHPSESSID]' WHERE orderid='".$_REQUEST['id']."'";
      $update_table->stmt = $query;
      $update_table->execute();
	  
	  $orderdetail = new mysql();
	  $query = "select * from tblorder where orderid='".$_REQUEST['id']."'";
	$orderdetail->stmt = $query;
		$orderdetail->execute();
		if($orderdetail_result =$orderdetail->fetch_array())
		{				
		extract($orderdetail_result);
		$orderdetail->ordermail($_REQUEST['id'],$userid);
		}
	
                                 
    }
	else
	{
	 header("Location:index.php");
	 return;
	 
	}
  header("Location:paypal-success.php?id=".$userid);
  ?>

