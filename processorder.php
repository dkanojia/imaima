<?
include('includes/db.inc.php');
if(!isset($_SESSION["currency"]))
{
	header("location.cart.php");
}
$objcurr = new mysql();
$objcurr->currency_value = $objcurr->get_currency_value($_SESSION["currency"]);

if(isset($_POST['checkout_submit']))
{

	if(isset($_SESSION['user_nid']) && isset($_SESSION['user_loginid']) && isset($_SESSION['cart']) )
	{


		if(isset($_SESSION['orderid']))
		{
		$deletoid = new mysql();
		$query = "delete from tblorder where orderid='".$_SESSION["orderid"]."'";
		$deletoid->stmt= $query;
		$deletoid->execute();
		
		$deloteail = new mysql();
		$query = "delete from tblorder_detail where orderid='".$_SESSION["orderid"]."'";
		$deloteail->stmt= $query;
		$deloteail->execute();		
		unset($_SESSION["orderid"]);
		}
		
		if(isset($_SESSION['cart']))
		{
	 
			$order = new mysql();
			$orderdate = date('Y-m-d');
			$orderdatewithtime = date('Y-m-d H:i:s');
			$orderno = date('Ymd');
			//echo $orderdate;
			$discountcode="";
			$discounttype="";
			$discountmsg="";
			$discount="0";
			$shipping_charges = $_SESSION["shipping_charges"];
			if(isset($_SESSION['discountcode']))
			{
				$discountcode=$_SESSION['discountcode'];
				$discounttype=$_SESSION['discounttype'];
				$discountmsg=$_SESSION['discountmsg'];
				$discount=$_SESSION['discount_amount'];
			}
			
		 	$query = "insert into tblorder (orderdate,orderdatewithtime,userid,subtotal,shipping,grandtotal,orderstatus,bstatus,currency_code,discountamount,discountcode,discounttype,discountmsg) values
			('".$orderdate."','".$orderdatewithtime."','".$_SESSION['user_nid']."','".$_SESSION["subtotal"]."','".$shipping_charges."','".$_SESSION["grandtotal"]."','pending','1','".$_SESSION["currency"]."','".$discount."','".$discountcode."','".$discounttype."','".$discountmsg."')";
		
			$order->stmt = $query;
			$order->execute();
		    $order = new mysql();
			$query = "select max(orderid) as currentorderid from tblorder";
			$order->stmt = $query;
			$order->execute();
			$order_result=$order->fetch_array();
			extract($order_result);
			$orderid = $currentorderid;
			
			if($orderid<10)
			$orderno = $orderno ."000".$orderid;
			elseif($orderid<100)
			$orderno = $orderno ."00".$orderid;
			elseif($orderid<10000)
			$orderno = $orderno ."0".$orderid;
			else
			$orderno = $orderno .$orderid;
			 
			//$itemtotal = 0;	
			//$subtotal = 0;			
			foreach($_SESSION['cart'] as $cartItems)
			{
			$cart_subtotal = $cartItems["qty"]*$objcurr->get_currency_amount($cartItems["sale_price"]);
			
			 $query = "insert into tblorder_detail (orderid,productid,product_cost,product_qty,totalamount,productfullname,productcode,cost1,imagepath,productpath,sizeid,productpriceid,color) values
			(".$orderid.",'".$cartItems["productid"]."','".$objcurr->get_currency_amount($cartItems["sale_price"])."','".$cartItems["qty"]."','".$cart_subtotal."','".$cartItems["productname"]."','".$cartItems["productcode"]."','".$cartItems["sale_price"]."','".$cartItems["imagename"]."','".$cartItems["productpath"]."','".$cartItems["sizeid"]."','".$cartItems["productpriceid"]."','".$cartItems["color"]."')";
			$order_detail = new mysql();
			$order_detail->stmt = $query;
			$order_detail->execute();			
			}
			$query = "update tblorder set orderno='".$orderno."' where orderid=".$orderid;
			$order->stmt = $query;
			$order->execute();
			$_SESSION["orderid"] = $orderid;
			
			
			
			$signup = new mysql();
	$query= "update tbluser set `firstname`='".$_POST["b_firstname"]."',`lastname`='".$_POST["b_lastname"]."', `address`='".$_POST["address_1"]."', `address2`='".$_POST["b_address_2"]."', `city`='".$_POST["b_city"]."', `country`='".$_POST["b_country_id"]."', `state`='".$_POST["b_customer_state"]."', `zip`='".$_POST["postcode"]."', `phone1`='".$_POST["b_mobible_no"]."', ship_fname='".$_POST["firstname"]."',ship_lname='".$_POST["lastname"]."',ship_address1='".$_POST["address_1"]."',ship_address2='".$_POST["address_2"]."',ship_city='".$_POST["city"]."',ship_state='".$_POST["customer_state"]."',ship_country='".$_POST["country_id"]."',ship_zip='".$_POST["postcode"]."',ship_phone='".$_POST["mobible_no"]."' where loginid='".$_SESSION['user_loginid']."'";
	$signup->stmt = $query;
	$signup->execute();
	
	
	$order = new mysql();
	
	$query= "update tblorder set orderstatus='Payment Incomplete',ship_fname='".$_POST["firstname"]."',ship_lname='".$_POST["lastname"]."',ship_address1='".$_POST["address_1"]."',ship_address2='".$_POST["address_2"]."',ship_city='".$_POST["city"]."',ship_state='".$_POST["customer_state"]."',ship_country='".$_POST["country_id"]."',ship_zip='".$_POST["postcode"]."',ship_phone='".$_POST["mobible_no"]."',currency_code='".$_SESSION["currency"]."',paymentmethod='".$_POST["paymentmethod"]."' where userid='".$_SESSION['user_nid']."' and orderid='".$_SESSION['orderid']."'";
	
	$order->stmt = $query;
	$order->execute();	
	
	   
		//$order->ordermail($_SESSION['orderid'],$_SESSION['user_nid']);
		
		
		if($_POST['paymentmethod']=='Paypal')
		{	
		include('includes/paypalform.php');	
		}
		else if($_POST['paymentmethod']=='ccavenue')
		{
			include('includes/ccavenueform.php');
		}
		else
		{
		$query= "update tblorder set orderstatus='Payment Incomplete' where userid='".$_SESSION['usernid']."' and orderid='".$_SESSION['orderid']."'";
		$orderupdate->stmt = $query;
		$orderupdate->execute();
		
		$oid = $_SESSION['orderid'];
			unset($_SESSION['cart']);
			unset($_SESSION['orderid']);
			unset($_SESSION['discountvalue']);
			unset($_SESSION['discountmsg']);
			unset($_SESSION['discountcode']);
			unset($_SESSION["discounttype"]);
			unset($_SESSION["current_ship_country"]);
			header("location:ordersuccess.php");
 
		}
			
	 	}
	 
	 }

}
?>
