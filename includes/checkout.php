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

<form action="processorder.php" method="post" onSubmit="return validate(this);" name="checkoutform">
  <div class="col-md-12 col-sm-12 col-xs-12" style=" margin-bottom:15px; width:100%; color:#000000; margin-top: 15px;
border-top: solid 1px #7f7f7f;
padding-top: 15px;">
    <div class="col-md-6 col-sm-6 col-xs-6 span6 loginbox" style="border-right:solid 1px #cccccc;" >
      <div class="onecheckout span45">
        <div id="payment-address">
          <div class="onecheckout-heading" style="margin-bottom:20px;"><span style="font-size: 17px;font-weight: bold;margin-left: 20px;">Profile Details</span></br>
            </br>
          </div>
          <div class="onecheckout-content"> </div>
        </div>
        <div id="shipping-address">
          <div class="onecheckout-content">
            <table class="form">
              <tbody>
                <tr>
                  <td style="width:30%;"><span class="required">*</span> First Name:</td>
                  <td><input name="b_firstname" id="b_firstname" class="large-field" value="<?=ucwords(strtolower($firstname))?>" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Last Name:</td>
                  <td><input name="b_lastname" id="b_lastname" class="large-field" value="<?=ucwords(strtolower($lastname))?>" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Phone No.:</td>
                  <td><input name="b_mobible_no" id="b_mobible_no" class="large-field" value="<?=$phone1 ?>" type="text" onBlur="removeborder(this.id)" style="width:90%;" onKeyPress="blockNonNumbers(this, event, true, false);" onBlur="extractNumber(this,0,false);" onKeyUp="extractNumber(this,0,false);" >
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Email:</td>
                  <td><input name="b_email" id="b_email" class="large-field" disabled="disabled" value="<?=$emailid ?>" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Street Address</td>
                  <td><input name="b_address_1" id="b_address_1" value="<?=ucwords(strtolower($address))?>" class="large-field" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input name="b_address_2" id="b_address_2" value="<?=ucwords(strtolower($address2))?>" class="large-field" type="text" style="width:90%;"></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> City:</td>
                  <td><input name="b_city" id="b_city" value="<?=ucwords(strtolower($city))?>" class="large-field" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span id="shipping-postcode-required" class="required">*</span> Post Code:</td>
                  <td><input name="b_postcode" id="b_postcode" value="<?=$zip ?>" class="large-field" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Region / State:</td>
                  <td><input type="text" name="b_customer_state" id="b_customer_state" class="large-field" value="<?=ucwords(strtolower($state))?>" onBlur="removeborder(this.id)" style="width:90%;" />
                  </td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Country:</td>
                  <td><select name="b_country_id" id="b_country_id" class="large-field" style="width:90%;">
                      <option value=""> --- Please Select --- </option>
                      <?php
  $objcountry = new mysql();
 $query  ="select country as b_countryname from tblshipping where blockstatus='active' order by country";
  $objcountry->stmt = $query;
  $objcountry->execute();
  while($country_result =$objcountry->fetch_array())
 {
	extract($country_result);		
	?>
                      <option <?php if($country == $b_countryname) {?> selected="selected" <?php } ?>  value=<?=$b_countryname?> >
                      <?=ucwords(strtolower($b_countryname))?>
                      </option>
                      <?php }
					?>
                    </select>
                    <br></td>
                </tr>
              </tbody>
            </table>
            <br>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 span6 registerbox" >
      <div class="onecheckout span45">
        <div id="payment-address">
          <div class="onecheckout-heading" style="margin-bottom:20px;"><span style="font-size: 17px;font-weight: bold;margin-left: 20px;">Shipping Details</span></br>
            </br>
            <span style="margin-left: 20px;">Verify your shipping information for product delivery</span></div>
          <div class="onecheckout-content"> </div>
        </div>
        <div id="shipping-address">
          <div class="onecheckout-content">
            <table class="form">
              <tbody>
                <tr>
                  <td style="width:30%;"><span class="required">*</span> First Name:</td>
                  <td><input name="firstname" id="firstname" class="large-field" value="<?=ucwords(strtolower($ship_fname))?>" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Last Name:</td>
                  <td><input name="lastname" id="lastname" class="large-field" value="<?=ucwords(strtolower($ship_lname))?>" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Phone No.:</td>
                  <td><input name="mobible_no" id="mobible_no" class="large-field" value="<?=$ship_phone ?>" type="text" onBlur="removeborder(this.id)" style="width:90%;" onKeyPress="blockNonNumbers(this, event, true, false);" onBlur="extractNumber(this,0,false);" onKeyUp="extractNumber(this,0,false);">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Email:</td>
                  <td><input name="email" id="email" class="large-field" value="<?=$emailid ?>" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Street Address</td>
                  <td><input name="address_1" id="address_1" value="<?=ucwords(strtolower($ship_address1))?>" class="large-field" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input name="address_2" id="address_2" value="<?=ucwords(strtolower($ship_address2))?>" class="large-field" type="text" style="width:90%;"></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> City:</td>
                  <td><input name="city" id="city" value="<?=ucwords(strtolower($ship_city))?>" class="large-field" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span id="shipping-postcode-required" class="required">*</span> Post Code:</td>
                  <td><input name="postcode" id="postcode" value="<?=$ship_zip ?>" class="large-field" type="text" onBlur="removeborder(this.id)" style="width:90%;">
                    <br></td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Region / State:</td>
                  <td><input type="text" name="customer_state" id="customer_state" class="large-field" value="<?=ucwords(strtolower($state))?>" onBlur="removeborder(this.id)" style="width:90%;"/>
                  </td>
                </tr>
                <tr>
                  <td><span class="required">*</span> Country:</td>
                  <td><select name="country_id" id="country_id" class="large-field" onChange="changeshipping(this.id);" style="width:90%;">
                      <option value=""> --- Please Select --- </option>
                      <?php
  $objcountry = new mysql();
 $query  ="select country as s_country from tblshipping where blockstatus='active' order by country";
  $objcountry->stmt = $query;
  $objcountry->execute();
  while($country_result =$objcountry->fetch_array())
 {
	extract($country_result);		
	?>
                      <option <?php if(isset($_SESSION["current_ship_country"]) && $_SESSION["current_ship_country"] == $s_country) {?> selected="selected" <?php } ?>  value=<?=$s_country?> >
                      <?=ucwords(strtolower($s_country))?>
                      </option>
                      <?php }
					?>
                    </select>
                    <br></td>
                </tr>
              </tbody>
            </table>
            <br>
          </div>
        </div>
      </div>
    </div>
    <div class="onecheckout span4">
      <div id="confirm">
        <div class="onecheckout-heading" style="font-size: 16px; font-weight: bold; margin-bottom: 15px;">Payment Method</div>
        <div>
        	<?
			if(strtoupper($_SESSION["currency"])!="INR")
			{
			?>
          <input type="radio" name="paymentmethod" checked="checked" value="Paypal" id="paymentpaypal" class="radio" style="float:left;margin:0px;"/>
          <span style="margin-left:10px; float:left; " >PayPal / Credit card / Debit Cart / Net Banking</span><br /><br />
           <? }
		   else
		   { ?>
          <input type="radio" name="paymentmethod" checked="checked" value="ccavenue" id="paymentccavenue" class="radio" style="float:left;margin:0px;"/>
          <span style="margin-left:10px; float:left;" >Credit card / Debit Cart / Net Banking</span> 
          <?
		  }?>
          </div>
      </div>
      <div class="buttons" style="border:0px !important; width:100%; float:left; margin-top:20px;">
        <div class="right divclear">
          <input type="hidden" name="countrycode" id="countrycode" value="<?=ucwords(strtolower($setcountrycode))?>"/>
          
          <input type="hidden" name="subtotalammount" value="<?=$_SESSION["subtotal"]?>"/>
                    <input type="hidden" name="shipping_charges" value="<?=$_SESSION["shipping_charges"]?>"/>
                    <input type="hidden" name="grandtotal" value="<?=$_SESSION["grandtotal"]?>"/>
                     <input type="hidden" name="discount" value="<?=$_SESSION["$discount"]?>"/>
					 <input type="hidden" name="hidrwdgrdtotal" value="<?=$_SESSION["grandtotal"]?>"/>
          
          <input type="submit" name="checkout_submit"  class="form_button"  value="Proceed To Payment >>" />
        </div>
      </div>
    </div>
  </div>
 
</form>
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
