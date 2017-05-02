<?php
$query = "select * from tblorder where orderid='".$_SESSION['orderid']."' and orderstatus in ('Payment Incomplete','pending')";
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
	$paypal_url='https://www.paypal.com/cgi-bin/webscr/'; 
				$paypal_id='thankyou@iimaima.com';
				?>
            
                 <form action='<?php  echo $paypal_url;  ?>' method='post' id="frmcheckout" name='frmPayPal1'>
	                <input type='hidden' name='business' value='<?php echo $paypal_id;?>'>
                    <input type='hidden' name='cmd' value="_xclick">
					<input type='hidden' name='image_url' value=''>
					<input type="hidden" name="rm" value="2" /> 
                    <input type='hidden' class="name" name='item_name' value='Garment'>
                    <input type='hidden' name='item_number' value='<?=$itemcount?>'>
                    <input type='hidden' class="price" name='amount' value='<?=$paypal_total?>'>
					<input type='hidden' name='no_shipping' value='5'>
					<input type='hidden' name='no_note' value='8'>
					<input type='hidden' name='handling' value='<?=$shipping?>'>
                    <input type="hidden" name="currency_code" value="<?=strtoupper($_SESSION["currency"]);?>">
					<input type="hidden" name="lc" value="US">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="payer_email" value='<?=$_SESSION['userid']?>'>
					<input type="hidden" name="cbt" value="Return to the my website">
					<input type="hidden" name="bn" value="PP-BuyNowBF"> <!-- -->
					<input type='hidden' name='return' value="<?=$glob['rootRel']?>paypalsuccess.php?id=<?=$orderid?>">
         			 <input type='hidden' name='cancel_return' value="<?=$glob['rootRel']?>paypal-cancel.php?id=<?=$orderid?>">
					<input type="hidden" name="notify_url" value="<?=$glob['rootRel']?>ipn.php" />
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

var frm = document.getElementById('frmcheckout');
frm.submit();
</script>
	
	