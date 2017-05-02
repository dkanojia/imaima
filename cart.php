<?php 
include('includes/db.inc.php');
include("includes/shoppingcart.php"); 
unset($_SESSION['addmsg']);
//print_r($_POST);
if(isset($_POST["btndiscountcode"]))
{
	$discountcode = $_POST["txtdiscount"];
	$objdiscount = new mysql();
	$query = "select * from tbloffer where blockstatus='active' and bstatus=1 and offercode='".$discountcode."'";
	$objdiscount->stmt= $query;
	$objdiscount->execute();
	if($objdiscount_result=$objdiscount->fetch_array())
	{
		extract($objdiscount_result);
		$_SESSION["discountcode"] = $discountcode;
		
		$_SESSION["discounttype"]=$offertype;
		if($offertype=="discount")
		{
		$_SESSION["discountmsg"] ="Discount Applied : ".$offervalue." %";
		$_SESSION['discountvalue'] = $offervalue;
		}
		else
		{
		$_SESSION["discountmsg"] ="Discount Applied : Shipping Free";
		unset($_SESSION['discountvalue']);
		}
		
	}
	else
	{	
		unset($_SESSION['discountvalue']);
		unset($_SESSION['discountmsg']);
		unset($_SESSION['discountcode']);
		unset($_SESSION["discounttype"]);
	}
	header("location:cart.php");
}


 if(isset($_POST['checkoutform']))
 {
	 if(!isset($_SESSION['user_loginid']) || !isset($_SESSION['user_nid']))	
		{
			header("location:".$glob['rootRel']."signin.html");
		}
}

if(isset($_POST["btndecrease"]))
{
	
		if(isset($_SESSION['cart']))
		{		
		    $qty = $_POST['quantity'] -1;
			if($qty==0)
			{
				$scart = new shoppingcart();
			    $scart->uniqueid=$_POST['hiduniqueid'];
				$scart->removefromcart();
				$_SESSION["addmsg"]= "Product has been removed from your Cart.<br /><br /> 	 	<input type='button' value='Not an issue' class='alert_popup_button' onclick='closealert_box();'   />";
			}
			else
			{
			$scart = new shoppingcart();
			$scart->productid=$_POST['hidproductid'];
			$scart->productfullname=$_POST['hidproductname'];
			$scart->imagefullname=$_POST['hidimagename'];
			$scart->productcode=$_POST['hidproductcode'];
		    $scart->qty=$qty;
			$scart->price=$_POST['hidprice'];
			$scart->sale_price=$_POST['hidsaleprice'];
			$scart->total=$qty * $_POST['hidsaleprice'];
		    $scart->uniqueid=$_POST['hiduniqueid'];
		    $scart->productpath=$_POST['hidpropath'];
			$scart->color=$_POST['hidcolor'];
			$scart->sizeid=$_POST['hidsizeid'];
			$scart->productpriceid=$_POST['hidproductpriceid'];
			$scart->updateincart();	
			header("location:".$glob['rootRel']."cart.html");
			}	
		}	

}
	
if(isset($_POST["btnincrease"]))
{
	
		if(isset($_SESSION['cart']))
		{		
		    $qty = $_POST['quantity'] +1;
			
			$scart = new shoppingcart();
			$scart->productid=$_POST['hidproductid'];
			$scart->productfullname=$_POST['hidproductname'];
			$scart->imagefullname=$_POST['hidimagename'];
			$scart->productcode=$_POST['hidproductcode'];
		    $scart->qty=$qty;
			$scart->price=$_POST['hidprice'];
			$scart->sale_price=$_POST['hidsaleprice'];
			$scart->total=$qty * $_POST['hidsaleprice'];
		    $scart->uniqueid=$_POST['hiduniqueid'];
		    $scart->productpath=$_POST['hidpropath'];
			$scart->color=$_POST['hidcolor'];
			$scart->sizeid=$_POST['hidsizeid'];
			$scart->productpriceid=$_POST['hidproductpriceid'];
			$scart->updateincart();	
			header("location:".$glob['rootRel']."cart.html");
		}	

}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php 
include('includes/links.php');
?>


<title>:: Shopping Cart ::</title>
</head>

<body>
    <?php 
include('includes/toptext.php');
include('includes/header.php');
	 ?>
        
   
	<div style="width:97%; margin:0px auto;">
		
				<div class="cart-info">
					<table>
						<thead class="hidden-phone">
							<tr>
								<td class="image" style="width:15%">Product</td>
								<td class="name" style="width:30%;">Name</td>
								<td class="model" style="width:10%">Size</td>
                                <td class="model" style="width:10%">Color</td>
								<td style="width:15%">Quantity</td>
								<td class="price" style="width:10%">Unit Price</td>
								<td class="total" style="width:10%">Total</td>
							</tr>
						</thead>
                          	 <?php 
							 $subtotal=0;
			 if(isset($_SESSION['cart']))
				{
					$subtotal=0;
					 foreach($_SESSION['cart'] as $cartItems)
					  {
					  $uniqueid=$cartItems['uniqueid'];  
					  $prodid=$cartItems['productid'];
					  $qty=$cartItems['qty'];
					  $price=$cartItems['price'];
					  $sale_price=$cartItems['sale_price'];					  
					  $total=$cartItems['total'];
					  $productname=$cartItems['productname'];
					  $productcode=$cartItems['productcode'];
					  $imagename=$cartItems['imagename'];
					  $propath=$cartItems['productpath'];
					  $color=$cartItems['color'];
					  $sizeid=$cartItems['sizeid'];
					  $productpriceid=$cartItems['productpriceid'];
					  
					   $subtotal = $subtotal+($qty*$objcurr->get_currency_amount($sale_price)); 
					  
					  ?>
					<form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="hiduniqueid" value="<?=$uniqueid?>"  />
					<input type="hidden" name="hidimagename" value="<?=$imagename?>"  />
					<input type="hidden" name="hidproductname" value="<?=$productname?>"  />
					<input type="hidden" name="hidproductcode" value="<?=$productcode?>"  />
					<input type="hidden" name="hidproductid" value="<?=$prodid?>"  />
					<input type="hidden" name="hidprice" value="<?=$price?>"  />
					<input type="hidden" name="hidsaleprice" value="<?=$sale_price?>"  />
                    <input type="hidden" name="hidpropath" value="<?=$propath?>"  />
                     <input type="hidden" name="hidcolor" value="<?=$color?>"  />
                      <input type="hidden" name="hidsizeid" value="<?=$sizeid?>"  />
                       <input type="hidden" name="hidproductpriceid" value="<?=$productpriceid?>"  />
                    	<tbody>
								<tr>
								<td class="image">
						<a href="productdetail.php?id=<?=$prodid?>"><img src="<?php echo $imagename ?>" alt="<?php echo $productname ?>" title="<?php echo $productname?>" width="60%" ></a>
																	</td>
								
								<td class="name">
									<span class="phone hidden-desktop hidden-tablet"><?php echo $productname?></span>
										
								</td>
                                
                                <td class="name">
                                <div class="avg-right">										
                                        <?php
										if($sizeid!=0){
									$getsizename = new mysql();		
									$sizenameSql = "select sizename from tblsize where sizeid='".$sizeid."'";	
									$getsizename->stmt=$sizenameSql;
									$getsizename->execute();
									$sizname = $getsizename->fetch_array();					
									extract($sizname);
											?>
										
                                        <div>
                                       		<span><?=$sizename?></span>
                                         </div>
                                        <? } ?>
										</div>
                                </td>

								<td class="name">
                                    <div class="avg-right">	
                                       <span><?=$color?></span>
                                    </div>
								</td>
                                        
								<td>									
									
									<span class="avg-right">
                            
                          
                       <input id="btndecrease" name="btndecrease" type="submit" value=" - " style="padding:0px 5px;background-color:#7f7f7f; color:#ffffff; font-weight:bold; font-size:16px;" />
                            &nbsp;        
           				 <input name="quantity" style="padding:4px;" value="<?php echo $qty?>" size="1" type="text">						
               			&nbsp;
                       <input id="btnincrease" name="btnincrease" type="submit" value=" + " style="padding:0px 5px;background-color:#7f7f7f; color:#ffffff; font-weight:bold; font-size:16px;"/>
                        
						</span>
								</td>
								<td class="price">									
									<span class="avg-right"><?=$objcurr->currency_symbol;?> <?=$objcurr->get_currency_amount($sale_price);?> </span>
								</td>
								<td class="total">								
									<span class="avg-right"><?=$objcurr->currency_symbol;?> <?=$qty*$objcurr->get_currency_amount($sale_price);?> </span>
								</td>
							</tr>
																					</tbody>
                       </form>                                   
                    <?php } } ?>
						</table>
					</div>
					<div class="cart-total clearfix">
                    
                      
                    
                    <table id="total" style="width:100%;">
												<tbody>
                                                
              
                                                <tr>
							<td style="text-align: right;padding-right: 10px;" class="right"><span style="font-size:11px; padding-left:10px; color:red;"><?=$_SESSION["discountmsg"]?></span></td>
							<td class="right" style="width:400px; text-align:right; padding-right:15px;"><form name="frmdiscountcode" method="post" action="" >
				  OFFER CODE &nbsp; <input id="txtdiscount" name="txtdiscount" style="padding:5px;" type="text" value="<?=$_SESSION["discountcode"]?>"/> <input id="btndiscountcode" name="btndiscountcode" type="submit" value="Apply" class="form_button"/>
                   
				  </form>   </td>
						</tr>
                        </tbody>
                    </table>
                    
                    <table id="total" style="width:100%;">
												<tbody>
                                                
              
                                                <tr>
                                                <td></td>
							<td style="width:155px;" class="right"><b>Sub-Total:</b></td>
							<td class="right" style="width:150px; text-align:right; padding-right:20px;"> <?=$objcurr->currency_symbol;?> <?=$subtotal;?>    </td>
						</tr>
                        </tbody>
                    </table>
                    
                    
                    
                   <? 
				   $discount = 0;
				   if($subtotal>0)
				   {
				   ?> 
                    <table style="float:left; width:100%">
                    <tr class="dgrey">
            	  <td class="tab1 right">
				 
				 
				 
				  </td>
                   <td class="bspac">&nbsp;</td>
            	 <td class="right" style="width:150px;"><b>Discount:</b></td>
				  <?php 
				  	
					if(isset($_SESSION["discountvalue"]))
					{
					$discount = round(floatval($subtotal * $_SESSION["discountvalue"]/100),0);
					//$discount = 0;
					}
					
				  ?>
            	  <td class="tab3" style="width:155px; text-align:right; padding-right:20px;"><?=$objcurr->currency_symbol;?> <?=$discount?>
				  <input type="hidden" id="hiddiscount" name="hiddiscount" value="<?=$discount?>">
				  </td>
          	  </tr>
                    </table>
                    <?
					}
					else
					{
					unset($_SESSION['discountvalue']);
					unset($_SESSION['discountmsg']);
					unset($_SESSION['discountcode']);
					unset($_SESSION["discounttype"]);
					}
					?>
					<table id="total">
												<tbody>
                                                
              
                        <?php
						
						$shipping_charges=0;
						if( isset($_SESSION['user_loginid']))
						{
							if(!isset($_SESSION["current_ship_country"]))
							{
								$shipping = new mysql();
								$query = "select * from tbluser where loginid='".$_SESSION['user_loginid']."'";
								$shipping->stmt = $query;
								$shipping->execute();
								$shipping_result =$shipping->fetch_array();	
								extract($shipping_result);	
								$_SESSION["current_ship_country"] = $country;
							}
							if(!isset($_SESSION["discounttype"]) ||  $_SESSION["discounttype"]!="shipping" )
							{
							
							$shipcharge = new mysql();
							$queryShip = "select shipping as shipping_charges from tblshipping where country='".$_SESSION["current_ship_country"]."'";
							$shipcharge->stmt = $queryShip;
							$shipcharge->execute();
							$shipping_chargeresult =$shipcharge->fetch_array();	
							extract($shipping_chargeresult);	
							$shipping_charges = $objcurr->get_currency_amount($shipping_charges);
							}
						}
						
						$_SESSION["discount_amount"] = $discount;						
							$_SESSION["subtotal"]  = $subtotal;
						$_SESSION["shipping_charges"]  = $shipping_charges;
						$_SESSION["grandtotal"]  = $grandtotal;
						$_SESSION["discount"]  = $discount;
						$grandtotal = $subtotal-$discount+$shipping_charges;
						 ?>
                         <tr>
                          <td style="width:155px; vertical-align:top;" class="right"><b>Shipping Charge For <? if(isset($_SESSION["current_ship_country"])){ echo $_SESSION["current_ship_country"];}?>:</b></td>
                          <td class="right" style="text-align:right;padding-right:20px;width:150px;vertical-align:top;"> <?=$objcurr->currency_symbol;?> <?=$shipping_charges;?> </td>
                        </tr>
						<tr>
							
                        	<td class="right"><b>Total:</b></td>
							<td class="right" style="text-align:right;padding-right:20px;"><?=$objcurr->currency_symbol;?> <?=$grandtotal;?></td>
						</tr>
											</tbody></table>
				</div>
				<div class="buttons clearfix">
                	<div class="left" style="float:left;"> <input type="button" name="btncontinue" class="form_button" value="Continue Shopping" onClick="location.href='index.php';" /></div>
                    <?php
                   if(!isset($_SESSION['user_loginid']) || !isset($_SESSION['user_nid']))	
					{	
					?>
					<div class="right" style="float:left; margin-left:30px;">
                    <form action="" method="post">
                    
                     <input type="submit" name="checkoutform" class="form_button" value="checkout" />
                    </form>
                     </div>
                     <?
					 }
                    ?> 
					
				</div>
                
                
                
              <!--  Checkout Section Start From Here -->
                <?
				if(isset($_SESSION['user_nid']) && isset($_SESSION['user_loginid']) && $subtotal>0 && isset($_SESSION['cart']) )
				{
					$_SESSION["subtotal"]  = $subtotal;
					$_SESSION["shipping_charges"]  = $shipping_charges;
					$_SESSION["grandtotal"]  = $grandtotal;
					$_SESSION["discount"]  = $discount;
				
					include('includes/checkout.php');
				}
				?>
                
                 
				</div>	
            		
					

<?php include('includes/footer.php'); ?>
