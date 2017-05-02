<?php
$query = "select a.*,b.* from tblorder a inner join tbluser b on a.userid=b.nid where a.orderid='".$_SESSION['orderid']."' and a.orderstatus in ('Payment Incomplete','pending')";
	$order->stmt = $query;
	$order->execute();
	$order_result =$order->fetch_array();	
	extract($order_result);	
	
	$order = new mysql();
	$query = "select count(*) as itemcount from tblorder_detail where orderid='".$_SESSION['orderid']."'";
	$order->stmt = $query;
	$order->execute();
	$order_result =$order->fetch_array();	
	extract($order_result);	
	
	
	$paypal_total = $subtotal - $discountamount;
	
	//$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr/'; 

				?>
            
                 <form method="post" id="customerData" name="customerData" action="ccavRequestHandler.php">
                 
                 <input type="hidden" name="tid" id="tid" value="<?=date('Y-m-d');?>" />
                 <input type="hidden" name="merchant_id" value="124781"/>
                 <input type="hidden" name="order_id" value="<?=$orderid?>"/>
                 <input type="hidden" name="amount" value="<?=$grandtotal?>"/>
                 <input type="hidden" name="currency" value="<?=strtoupper($_SESSION["currency"]);?>"/>
                 <input type="hidden" name="redirect_url" value="https://iimaima.com/ccav_success.php"/>
                 <input type="hidden" name="cancel_url" value="https://iimaima.com/ccav_cancel.php"/>
                 <input type="hidden" name="language" value="EN"/>
                 
                 <!--Billing Information--> 
                 <input type="hidden" name="billing_name" value="<?=$firstname?> <?=$lastname?>"/>
                 <input type="hidden" name="billing_address" value="<?=$address?>"/>
                 <input type="hidden" name="billing_city" value="<?=$city?>"/>
                 <input type="hidden" name="billing_state" value="<?=$state?>"/>
                 <input type="hidden" name="billing_zip" value="<?=$zip?>"/>
                 <input type="hidden" name="billing_country" value="<?=$country?>"/>
                 <input type="hidden" name="billing_tel" value="<?=$phone1?>"/>
                 <input type="hidden" name="billing_email" value="<?=$emailid?>"/>
                 
                <!-- Shipping Information-->
                 <input type="hidden" name="delivery_name" value="<?=$ship_fname?> <?=$ship_lname?>"/>
                 <input type="hidden" name="delivery_address" value="<?=$grandtotal?>"/>
                 <input type="hidden" name="delivery_city" value="<?=$ship_city?>"/>
                 <input type="hidden" name="delivery_state" value="<?=$ship_state?>"/>
                 <input type="hidden" name="delivery_zip" value="<?=$ship_zip?>"/>
                 <input type="hidden" name="delivery_country" value="<?=$ship_country?>"/>
                 <input type="hidden" name="delivery_tel" value="<?=$ship_phone?>"/>
                 
                
					<input class="signup_button" type="hidden" name="custom" value='iimaima'>
                </form>
<?php

		
		$signup = new mysql();
	$query= "update tblorder set orderstatus='Payment Incomplete' where userid='".$_SESSION['usernid']."' and orderid='".$_SESSION['orderid']."'";
	$signup->stmt = $query;
	$signup->execute();
	
	unset($_SESSION['cart']);
	unset($_SESSION['orderid']);
		
  ?>
  <script type="text/javascript">

var frm = document.getElementById('customerData');
frm.submit();
</script>
	
	