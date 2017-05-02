<?php
include('includes/db.inc.php');
if(!isset($_SESSION['user_nid']))
{
	header("location:login.php");
}	

if(!isset($_SESSION['user_loginid']))
{
header("location:login.php");
}

if(!isset($_SESSION['orderid']))
{
header("location:cart.php");
}
else
{$order = new mysql();
	$query = "select * from tblorder where orderid='".$_SESSION['orderid']."'";
	$order->stmt = $query;
	$order->execute();
	$order_result =$order->fetch_array();	
	extract($order_result);	
	if($_SESSION["currency"]!=$currency_code)
	header("location:cart.php");
	
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php 
include('includes/links.php');
?>


<title>:: Welcome to iimaima.com ::</title>

<script language="javascript" type="text/javascript">
function searchproduct(catid,color,sortby)
{
	var url = "products.php?catid="+catid;
	if(color!="")
	url = url + "&c="+color;
	if(sortby!="")
	url = url + "&s="+sortby;
	location.href=url;
	return false;
}
</script>

</head>
<body>
    <?php 
include('includes/toptext.php');
include('includes/header.php');
?>

<div style="width:97%; margin:0px auto; min-height:400px;">
	
    
    <section id="columns"><div class="container"><div class="container-inner"><div class="row-fluid">

<link rel="stylesheet" type="text/css" href="Checkout_files/onecheckout.htm" media="screen">
<div class="container" style="background-color:#fff;padding:20px;border:none;">
	<div class="row-fluid">
     
  <div class="span12">
    <div class="warning" id="errormsg" style="display:none"></div>
  <h1 style="padding-left:21px;">Checkout</h1>
  

  
  <?php
   

if(isset($_POST['checkout_submit'])){

//print_r($_POST);
		
 	$signup = new mysql();
	$query= "update tbluser set ship_fname='".$_POST["firstname"]."',ship_lname='".$_POST["lastname"]."',ship_address1='".$_POST["address_1"]."',ship_address2='".$_POST["address_2"]."',ship_city='".$_POST["city"]."',ship_state='".$_POST["customer_state"]."',ship_country='".$_POST["country_id"]."',ship_zip='".$_POST["postcode"]."',ship_phone='".$_POST["mobible_no"]."' where loginid='".$_SESSION['user_loginid']."'";
	$signup->stmt = $query;
	$signup->execute();
	
	
	
	
	
	$order = new mysql();
	
	$query= "update tblorder set subtotal='".$_POST['hidrwdtotal']."', grandtotal='".$_POST['hidrwdgrdtotal']."',orderstatus='Payment Incomplete',ship_fname='".$_POST["firstname"]."',ship_lname='".$_POST["lastname"]."',ship_address1='".$_POST["address_1"]."',ship_address2='".$_POST["address_2"]."',ship_city='".$_POST["city"]."',ship_state='".$_POST["customer_state"]."',ship_country='".$_POST["country_id"]."',ship_zip='".$_POST["postcode"]."',ship_phone='".$_POST["mobible_no"]."',currency_code='".$_SESSION["currency"]."',paymentmethod='".$_POST["paymentmethod"]."' where userid='".$_SESSION['user_nid']."' and orderid='".$_SESSION['orderid']."'";
	
	$order->stmt = $query;
	$order->execute();	
	
	
	if($_POST['paymentmethod']=='Paypal'){
	
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
	//session_unregister('cart');
	//session_unregister('orderid');
	 ?>
  <script type="text/javascript">
	location.href="ordersuccess.php?oid=<?=$oid?>";
  </script>
  <?php  
 
}
 	

 }
?>
<?php

	$shipping = new mysql();
	$query = "select * from tbluser where loginid='".$_SESSION['user_loginid']."'";
	$shipping->stmt = $query;
	$shipping->execute();
	$shipping_result =$shipping->fetch_array();	
	extract($shipping_result);	
	
	if(!isset($_SESSION["current_ship_country"]))
	{
	$_SESSION["current_ship_country"] = $country;
	}
	
	?>
  <form action="" method="post" onSubmit="return validate(this);" name="checkoutform">
  
  
    <div class="onecheckout span45">
        <div id="payment-address">
      <div class="onecheckout-heading" style="margin-bottom:20px;"><span style="font-size: 17px;font-weight: bold;margin-left: 20px;">Shipping Details</span></br></br>
      <span style="margin-left: 20px;">Verify your shipping information for product delivery</span></div>
	  <div class="onecheckout-content"> 


</div>

    </div>
       <div id="shipping-address">
       <div class="onecheckout-content"><table class="form">
  <tbody><tr>
    <td><span class="required">*</span> First Name:</td>
    <td><input name="firstname" id="firstname" class="large-field" value="<?=ucwords(strtolower($ship_fname))?>" type="text" onBlur="removeborder(this.id)"><br></td>
  </tr>
  <tr>
    <td><span class="required">*</span> Last Name:</td>
    <td><input name="lastname" id="lastname" class="large-field" value="<?=ucwords(strtolower($ship_lname))?>" type="text" onBlur="removeborder(this.id)"><br></td>
  </tr>
  <tr>
    <td><span class="required">*</span> Phone No.:</td>
    <td><input name="mobible_no" id="mobible_no" class="large-field" value="<?=$ship_phone ?>" type="text" onBlur="removeborder(this.id)"><br></td>
  </tr>
  <tr>
    <td><span class="required">*</span> Email:</td>
    <td><input name="email" id="email" class="large-field" value="<?=$emailid ?>" type="text" onBlur="removeborder(this.id)"><br></td>
  </tr>
  <tr>
    <td><span class="required">*</span> Street Address</td>
    <td><input name="address_1" id="address_1" value="<?=ucwords(strtolower($ship_address1))?>" class="large-field" type="text" onBlur="removeborder(this.id)"><br></td>
  </tr>
  <tr>
    <td></td>
    <td><input name="address_2" id="address_2" value="<?=ucwords(strtolower($ship_address2))?>" class="large-field" type="text"></td>
  </tr>
  <tr>
    <td><span class="required">*</span> City:</td>
    <td><input name="city" id="city" value="<?=ucwords(strtolower($ship_city))?>" class="large-field" type="text" onBlur="removeborder(this.id)"><br></td>
  </tr>
  <tr>
    <td><span id="shipping-postcode-required" class="required">*</span> Post Code:</td>
    <td><input name="postcode" id="postcode" value="<?=$ship_zip ?>" class="large-field" type="text" onBlur="removeborder(this.id)"><br></td>
  </tr>
   <tr>
    <td><span class="required">*</span> Region / State:</td>
    <td><input type="text" name="customer_state" id="customer_state" class="large-field" value="<?=ucwords(strtolower($state))?>" onBlur="removeborder(this.id)" />
     </td>
  </tr>
  <tr>

    <td><span class="required">*</span> Country:</td>
    <td>    
    	<select name="country_id" id="country_id" class="large-field" onChange="changeshipping(this.id);">
    		<option value=""> --- Please Select --- </option>
           <?php
  $objcountry = new mysql();
 $query  ="select * from tblshipping where blockstatus='active' order by country";
  $objcountry->stmt = $query;
  $objcountry->execute();
  while($country_result =$objcountry->fetch_array())
 {
	extract($country_result);		
	?>
    	
    <option <?php if(isset($_SESSION["current_ship_country"]) && $_SESSION["current_ship_country"] == $country) {?> selected="selected" <?php } ?>  value=<?=$country?> ><?=ucwords(strtolower($country))?></option>
	<?php }
					?>
                    </select>
    <br></td>
  </tr>
 
</tbody></table>
<br>
</div>
</div>
</div>
  
  <div class="onecheckout span4">
    <div id="confirm">
    <div class="onecheckout-heading" style="font-size: 16px; font-weight: bold; margin-bottom: 63px;">Order Summary</div>
   <div class="onecheckout-content" style="display:block;">
   
   
   <div style="margin: 0 0 10px;">
 
  
<br>


<div id="hiddiv"></div>

<input type="hidden" name="rdovalue" id="rdovalue" value="No" />

</div>

   <div class="onecheckout-product">
  <table style="border: 1px solid;margin-bottom: 14px;margin-top:7px;width: 300px;text-align:center;">
  	<?php $orderdetail = new mysql();
	$query1 = "select count(*) as itemcount from tblorder_detail where orderid='".$_SESSION['orderid']."'";
	$orderdetail->stmt = $query1;
	$orderdetail->execute();
	$orderdetail_result =$orderdetail->fetch_array();	
	extract($orderdetail_result);	
	
	$subtotal =0;
	$order = new mysql();
	$query = "select totalamount as inrtotalamount from tblorder_detail where orderid='".$_SESSION['orderid']."'";
	$order->stmt = $query;
	$order->execute();
	while ($order_result =$order->fetch_array())
	{
	extract($order_result);	
	$subtotal +=  $objcurr->get_currency_amount($inrtotalamount);
	}
	
	$order = new mysql();
	$query = "select orderid,orderdate,itemtotal,discountamount,subtotal,shipping,grandtotal from tblorder where orderid='".$_SESSION['orderid']."'";
	$order->stmt = $query;
	$order->execute();
	$order_result =$order->fetch_array();	
	extract($order_result);	
	
	
	
	
	$grandtotal = $subtotal - $discountamount + $shipping;
	?>
    <tr style="background-color:#d3d3d3;"><td style="text-align:center;">Shopping <?=$itemcount?> Items</td>
    <td ><a href="cart.php">Back to cart</a></td>
    </tr>
      
       <tr>
        <td class="total">Subtotal</td>        
       <td class="total" id="rewsub"><?=$objcurr->currency_symbol;?> <?=$subtotal;?>
       </td>
       
       <input type="hidden" name="hidrwdtotal" id="hidrwdtotal" value='<?=number_format($subtotal,2, '.', '')?>' />
      </tr>
       <tr>
        <td class="total">Discount</td>        
       <td class="total" id="rewsub"><?=$objcurr->currency_symbol;?> <?=$discountamount;?>
       </td>
       
       <input type="hidden" name="hidrwdtotal" id="hidrwdtotal" value='<?=number_format($subtotal,2, '.', '')?>' />
      </tr>
       <tr>
        <td class="total">Shipping Amount</td>
        <td class="total" ><?=$objcurr->currency_symbol;?> <?=$shipping;?></td>
      </tr>
        <tr>
        <td class="total" >Grand Total</td>
        <td class="total" id="rewgrdsub"><?=$objcurr->currency_symbol;?> <?=$grandtotal;?></td>
       <input type="hidden" name="hidrwdgrdtotal" id="hidrwdgrdtotal" value="<?=number_format($grandtotal,2, '.', '')?>" />
      </tr>
      	<input type="hidden" name="grandtotal" value="<?=$grandtotal?>"/>
        <input type="hidden" name="countrycode" id="countrycode" value="<?=ucwords(strtolower($setcountrycode))?>"/>
        
               <!-- </tbody>-->
      
  </table>
  </div>
  
<div>
<h4>Payment Method</h4>
<input type="radio" name="paymentmethod" checked="checked" value="Paypal" id="paymentpaypal" class="radio" style="float:left;"/> <span style="margin-left:10px; float:left;" >PayPal</span>
<input type="radio" name="paymentmethod" checked="checked" value="ccavenue" id="paymentccavenue" class="radio" style="float:left;"/> <span style="margin-left:10px; float:left;" >Credit card / Debit Cart / Net Banking</span>

</div>
  
  
</div>


<div class="buttons" style="border:0px !important; width:100%; float:left; margin-top:20px;">  
  <div class="right divclear">
    <input type="submit" name="checkout_submit"  class="button"  value="Confirm Order" />
  </div>
</div>
</div>
    </div>
  </div>
   
  </form>
  
  
  
  
  </div>
  <div id="confirmorder" style="clear:both">
  </div>
  
  </div>
  
  

   

<!--<script type="text/javascript" src="Checkout_files/jquery.htm"></script>
<link rel="stylesheet" type="text/css" href="Checkout_files/colorbox.htm" media="screen"> -->
 
</div></div></div></div></section>
    
    
 </div>

<?php 
include('includes/footer.php');
?>

<script type="text/javascript">

var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i 

var phoneno = /^\d{10}$/;
//var postcode = /^\d{10}$/;

function validate(form){
	
var firstname = form.firstname.value;
var lastname = form.lastname.value;
var email = form.email.value;
var phone = form.mobible_no.value;
var address1 = form.address_1.value;
var city = form.city.value;
var postcode = form.postcode.value;
var country = form.country_id.value;
var state = form.customer_state.value;
var paymentcash = form.paymentmethod.value;
var txtpoint = form.txtpoint.value;


if (!ck_name.test(firstname)) {
	 	 document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your First Name";
		document.getElementById("firstname").style.border = "1px solid red";
		document.getElementById("firstname").focus();
        return false;
  }
  if (!ck_name.test(lastname)) {
	 	 document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your Last Name";
		document.getElementById("lastname").style.border = "1px solid red";
		document.getElementById("lastname").focus();
        return false;
  }
  
 if (!ck_email.test(email)) {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Valid Email Address";
		document.getElementById("email").style.border = "1px solid red";
		document.getElementById("email").focus();
        return false;
 }
 
  if (!phoneno.test(phone)) {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Valid Phone Number";
		document.getElementById("mobible_no").style.border = "1px solid red";
		document.getElementById("mobible_no").focus();
        return false;
 }
 
   if (address1=='') {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your Address";
		document.getElementById("address_1").style.border = "1px solid red";
		document.getElementById("address_1").focus();
        return false;
 }
    
 
   if (city=='') {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your City";
		document.getElementById("city").style.border = "1px solid red";
		document.getElementById("city").focus();
        return false;
 }
 if (postcode=='') {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your Post Code";
		document.getElementById("postcode").style.border = "1px solid red";
		document.getElementById("postcode").focus();
        return false;
 }
 
  if (state=='') {
  		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your Address";
		document.getElementById("customer_state").style.border = "1px solid red";
		document.getElementById("customer_state").focus();
        return false;
 }
 if (country==0) {
		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Enter Your Country";
		document.getElementById("country_id").style.border = "1px solid red";
	
        return false;
	 }
 if (paymentcash=='') {
		document.getElementById('errormsg').style.display="block";
		document.getElementById("errormsg").innerHTML = "Please Select Paymentmethod";
		document.getElementById("paymentcash").style.border = "1px solid red";
	
        return false;
	 }
	
	  return true;
}	  
function removeborder(id){
	document.getElementById(id).style.border = "";
}

function changeshipping(id)
{
var ship_country = document.getElementById(id).value;
location.href="setshipping.php?country="+ship_country;
}

</script>