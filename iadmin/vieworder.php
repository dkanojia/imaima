<?php
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");

if(isset($_REQUEST["btnupdate"]))
{
	$savereview = new mysql();
	$query = "update tblorder set  orderstatus='".$_POST["selstatus"]."',shipping_compid='".$_POST["selshipby"]."',shipping_trackno='".$_POST["txttrackingno"]."' where orderid=".$_REQUEST["id"];	
	$savereview->stmt = $query;
	$savereview->execute();
	
	
	if($_POST["selstatus"]!=$_POST["hidoldstatus"])
	{
		$savereview = new mysql();
		$query = "insert into tblorder_status_tracking set  orderid=".$_REQUEST["id"].",oldstatus='".$_POST["hidoldstatus"]."',newstatus='".$_POST["selstatus"]."',updationdate='".date('m/d/Y h:i:s a', time())."'";
		$savereview->stmt = $query;
		$savereview->execute();
	}
	
	
	$msg = "Order Status Updated Successfully";
}
?>




<?php
if(!isset($_REQUEST["id"])){
	
header("location:orders.php?status=all");
}
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">
	
	<?php
				if(isset($_REQUEST["id"]))
				{
				$cat = new mysql();
					$query = "select a.*,b.loginid,b.emailid,b.phone1,b.firstname,b.lastname from tblorder a left outer join tbluser b on a.userid=b.nid where a.bstatus=1  and a.orderid='".$_REQUEST["id"]."'";
					
					$cat->stmt = $query;
					$cat->execute();					
					if($cat_result =$cat->fetch_array())
					{
					extract($cat_result);
					?>
	
	
	
		<form name="addreview" action="" enctype="multipart/form-data" method="post">
			<table width="98%" border="0" cellpadding="0" cellspacing="0" style="padding-left:70px">
				<tr>
					<td width="700" valign="top">
						<table border="0" class="formbox" width="700" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">
						
							<tr >
								<td>
								Current Order Statsus
								</td>
								
								<td >
									<?=$orderstatus?>
									<input type="hidden" id="hidoldstatus" name="hidoldstatus" value="<?=$orderstatus?>"  />
								</td>
							</tr>
							<tr >
								<td>
								Update Status
								</td>
								
								<td >
								<select id="selstatus" name="selstatus" >
								<option value="Payment Incomplete" <?php if(strtolower($orderstatus)=='payment incomplete') echo "selected='true' " ?>>Payment Incomplete</option>
								<option value="Processing" <?php if(strtolower($orderstatus)=='processing') echo "selected='true' " ?>>Processing</option>
								<option value="Shipped" <?php if(strtolower($orderstatus)=='shipped') echo "selected='true' " ?>>Shipped</option>
								<option value="Delivered" <?php if(strtolower($orderstatus)=='delivered') echo "selected='true' " ?>>Delivered</option>
								</select>								
									
								</td>
							</tr>
							
							<tr >
								<td >
								Ship By
								</td>
								
								<td >
								<select id="selshipby" name="selshipby" >
								<option value="0" <?php if($shipping_compid=='0') echo "selected='true' " ?>>--Select Shipping--</option>
								<?php
								$cat = new mysql();
									$query = "select nid as shipid,companyname from tblcourier where bstatus=1 and blockstatus='active' order by sno desc ";
									$cat->stmt = $query;
									$cat->execute();
									
										while($cat_result =$cat->fetch_array())
										{
										extract($cat_result);
										?>
										<option value="<?=$shipid?>" <?php if($shipping_compid==$shipid) echo "selected='true' " ?>><?=$companyname?></option>
										
								<?php		
										}
								?>
								</select>
								</td>
							</tr>
							
							<tr >
								<td >
								Tracking No.
								</td>
								
								<td >
								<input type="text" class="txtBox" name="txttrackingno" id="txttrackingno" value="<?php echo $shipping_trackno ?>" />
								</td>
							</tr>	
								<tr >
									<td colspan="2"  style="padding:10px 10px 10px 310px;" >
									<input type='submit' name='btnupdate' value='Save' style='width:43px' />
									&nbsp;&nbsp;&nbsp;
									<input type="button" name="btncancel" value="Cancel" onclick="location.href='reviews.php'" />
									</td>
								</tr>	
						</table>
					</td>
				</tr>
				<tr >
					<td colspan="2">
					<?php echo $msg; ?>
					</td>
				</tr>
			</table>
		</form>
		
		
	<div style="width:100%;" class="order_history_part">
        <div class="pay_pal_main_heading" style="border-bottom:solid 1px black;">Order Detail</div>
        <section class="shoppingCart">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #CCCCCC;">
            <tbody>
              <tr>
                <td style="padding-left:30px;" width="50%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td class="cusinfo" style="border-right:1px dotted #ccc; padding:15px 0;" valign="top" width="50%"><span class="cusadd"> <strong>Order No. &nbsp;&nbsp;&nbsp;&nbsp;: </strong>
                          <?=$orderno?>
                          </span> <br>
                          <span class="cusadd"> <strong>Order Date : </strong>
                          <?=$orderdate?>
                          </span> <br>
                        </td>
                      </tr>
                    </tbody>
                  </table></td>
                <td style="padding:15px 25px 15px 0px;" class="segoe totalprice" align="right" valign="top" width="50%"><table border="0" cellpadding="0" cellspacing="0" width="938">
                    <tbody>
                      <tr>
                        <td align="right" height="24" width="150"><strong>Order Status</strong> </td>
                        <td align="left" width="150"> :
                          <?=$orderstatus?>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" height="24"><strong>Payment Method</strong> </td>
                        <td align="left"> :
                          <?=$paymentmethod?>
                        </td>
                      </tr>
                    </tbody>
                  </table></td>
              </tr>
            </tbody>
          </table>
          <table class="proTab" cellpadding="0" width="100%" cellspacing="0" style="text-align:center">
            <tbody>
              <tr class='tablerow' style="background:#d5d5d5;">
                <td class="image" style="width:15%">Product</td>
                <td class="name" style="width:30%;">Name</td>
                <td class="model" style="width:10%">Size</td>
                <td class="model" style="width:10%">Color</td>
                <td style="width:15%">Quantity</td>
                <td class="price" style="width:10%">Unit Price</td>
                <td class="total" style="width:10%">Total</td>
              </tr>
              <?php
				
				$orderdetail = new mysql();
				$query = "select a.*,b.sizename from tblorder_detail a inner join tblsize b on a.sizeid=b.sizeid where a.orderid='".$_REQUEST["id"]."'";
				$orderdetail->stmt = $query;
				$orderdetail->execute();
				while($orderdetail_result =$orderdetail->fetch_array())
				{				
				extract($orderdetail_result);
				$sno = 1;						
					?>
              <tr class='tablerow'>
                <td class="proImg"><a href="productdetail.php?id=<?=$productid?>"><img src="<?=$imagepath?>" width="60%"></a></td>
                <td class="proInfo"><a href="<?=$productpath?>" class="pink_wish">
                  <?=$productfullname?>
                  </a></td>
                <td class="unitTab">
                  <?=$sizename?>
                 </td>
                <td class="unitTab">
                  <?=$color?></td>
                  <td class="unitTab">
                  <?=$product_qty?></td>
                    <td class="unitTab">
                  <?=$product_cost?></td>
                <td class="totalTab pink_wish"><?=$orderdetail->get_currency_symbol($currency_code)?>
                  <?=$totalamount?></td>
              </tr>
              <?
					$sno = $sno + 1;	
					}
					?>
            </tbody>
          </table>
          <table class="shopTab" cellpadding="0" cellspacing="0">
            <tbody>
              <tr class="dgrey">
                <td class="tab1"></td>
                <td class="bspac">&nbsp;</td>
                <td class="tab2"></td>
                <td class="tab3"></td>
              </tr>
            </tbody>
          </table>
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #CCCCCC;">
            <tbody>
              <tr>
                <td style="padding-left:30px;" width="60%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td class="cusinfo" style="border-right:1px dotted #ccc; padding:10px 0;" valign="top" width="50%"><span class="fnt-tahoma"><strong>Customer Information</strong>: </span><br>
                          <br>
                          <span class="cusadd"><strong>
                          <?=$firstname?>
                          <?=$lastname?>
                          </strong><br>
                          Email:
                          <?=$emailid?>
                          <br>
                          Mobile:
                          <?=$phone1?>
                          <br>
                          </span> </td>
                        <td class="cusinfo" style="padding:10px 10px; border-right:1px dotted #ccc; " width="50%"><span class="fnt-tahoma"><strong>Shipping Information</strong>: </span><br>
                          <br>
                          <span class="cusadd"><strong>
                          <?=$ship_fname?>
                          <?=$ship_lname?>
                          </strong><br>
                          <?=$ship_address1?>
                          <br>
                          <?=$ship_address2?>
                          <br>
                          <?=$ship_city?>
                          -
                          <?=$ship_zip?>
                          <br>
                          <?=$ship_state?>
                          <br>
                          <?=$ship_country?>
                          </span> </td>
                      </tr>
                    </tbody>
                  </table></td>
                <td style="padding:10px 25px 15px 0px;" class="segoe totalprice" align="right" valign="top" width="40%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td align="right" height="24" width="200"> Total Amount </td>
                        <td align="right" width="100"> <?=$orderdetail->get_currency_symbol($currency_code)?> <span id="deal-total-selling-price">
                          <?=$subtotal?>
                          </span> </td>
                      </tr>
                      <tr>
                        <td align="right" height="24" width="200"> Shipping Charges </td>
                        <td align="right"> <?=$orderdetail->get_currency_symbol($currency_code)?> <span id="shipping-charges">
                          <?=$shipping?>
                          </span> </td>
                      </tr>
                       <tr>
                        <td align="right" height="24" width="200"> Discount ( Code : <?=$discountcode?> ) </td>
                        <td align="right"> <?=$orderdetail->get_currency_symbol($currency_code)?> <span id="shipping-charges">
                          <?=$discountamount?>
                          </span> </td>
                      </tr>
                      
                      <tr>
                        <td colspan="2" style="border-top:1px solid #ccc;"></td>
                      </tr>
                      <tr>
                        <td style="font-size:15px;" align="right" height="24" width="200"><?
					if(strtolower($orderstatus)=="payment incomplete")
					{
					?>
                          <strong>Payable Amount</strong>
                          <?
					}
					else
					{
					?>
                          <strong>Paid Amount</strong>
                          <?
					}
					?>
                        </td>
                        <td style="font-size:15px;" align="right"><span id="total-payable-amount" style="font-weight: bold;"><?=$orderdetail->get_currency_symbol($currency_code)?>
                          <?=$grandtotal?>
                          </span> </td>
                      </tr>
                      <?
					if(strtolower($orderstatus)=="payment incomplete_fdsdffd")
					{
					?>
                      <tr>
                        <td colspan="2"><form name="frmcheckout" method="post" action="">
                            <input type="hidden" name="orderid" value="<?=$orderid;?>"/>
                            <table cellpadding="0" cellspacing="0" style="margin-top:25px; margin-left:25px;">
                              <tr>
                                <td>&nbsp;</td>
                                <td><input id="btncheckout" type="submit" value="Checkout" style="width:187px; height:42px; margin:8px 0px 0px 0px;" name="btncheckout">
                                </td>
                              </tr>
                            </table>
                          </form></td>
                      </tr>
                      <?
					}
					?>
                    </tbody>
                  </table></td>
              </tr>
            </tbody>
          </table>
          <div class="otherAction"> </div>
        </section>
      </div>
	
				
				
					<?php
					}
					
				}
				?>
				
</section>
	
	
<?php
include("include/footer.inc.php");
?>