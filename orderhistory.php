<?php 
include('includes/db.inc.php');
if(!isset($_SESSION['user_nid']))
{
	header("location:login.php");
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
<?php
$meta = new mysql();
$query = "select metacontent from tblmeta where metaid=4 and typeid='".$_REQUEST['id']."'";
$meta->stmt = $query;
$meta->execute();
while($meta_result =$meta->fetch_array())
{
extract($meta_result);
echo "<meta  content='".$metacontent."' />";
}
?>
</head>
<body>
<?php 
include('includes/toptext.php');
include('includes/header.php');
?>
<div style="width:97%; margin:0px auto; min-height:400px;">
  <section id="content" class="contact">
    <div id="contactForm">
      <div class="regi_contents_bg">
        <div class="order_history_part">
          <table style="font-size:12px; border-color:#aaa; text-align:center; border-collapse:collapse; line-height:30px; margin:20px 0 20px 0;" border="1" bordercolor="#aaaaaa" cellpadding="4" cellspacing="0" width="100%">
            <tr style="background:#dfdfdf; color:#000;">
              <th scope="col" >S. no</th>
              <th scope="col">Order Id</th>
              <th scope="col" >Order Date</th>
              <th scope="col" >Total </th>
              <th scope="col" >Status</th>
              <th scope="col" >Tracking</th>
            </tr>
            <?php
$cat = new mysql();
$query = "select a.*,b.loginid,c.trackingurl from tblorder a left outer join tbluser b on a.userid=b.nid
			left outer join tblcourier c on a.shipping_compid=c.nid where a.bstatus=1  and a.userid='".$_SESSION["user_nid"]."'";

$query .=" order by a.orderid desc ";
$cat->stmt = $query;
$cat->execute();
$sno = 0;
	while($cat_result =$cat->fetch_array())
	{
	$sno = $sno + 1;
	extract($cat_result);
	if($orderstatus!='pending')
	{
	echo "<tr class='tablerow'>";
	echo "<td >".$sno."</td>";	
	echo "<td ><a href='".$glob['rootRel']."orderhistory.php?orderid=".$orderid."'>".$orderno."</a></td>";
	echo "<td >".$orderdate."</td>";		
	echo "<td >".$grandtotal."</td>";	
    echo "<td >".$orderstatus."</td>";
	
	if(strtolower($orderstatus)=="shipped" || strtolower($orderstatus)=="delivered")
	{		
	$trackurl = $trackingurl;
	$trackurl = str_replace("#track_no#",$shipping_trackno,$trackurl);
	echo "<td style='padding:2px 6px; text-align:center;'><a href='".$trackurl."' target='_blank'>".$shipping_trackno."</a></td>";	
	}
	else
	echo "<td>&nbsp;</td>";
	
    echo "</tr>";
    }
	}
?>
          </table>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <?php
				if(isset($_REQUEST["orderid"]))
				{
				$cat = new mysql();
					$query = "select a.*,b.loginid,b.emailid,b.phone1,b.firstname,b.lastname from tblorder a left outer join tbluser b on a.userid=b.nid where a.bstatus=1 and  a.userid='".$_SESSION["user_nid"]."' and a.orderid='".$_REQUEST["orderid"]."'";
					
					
					
					$cat->stmt = $query;
					$cat->execute();					
					if($cat_result =$cat->fetch_array())
					{
					extract($cat_result);
					
					?>
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
				$query = "select a.*,b.sizename from tblorder_detail a inner join tblsize b on a.sizeid=b.sizeid where a.orderid='".$_REQUEST["orderid"]."'";
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
                      <? if($discountamount>0) { ?>
                      <tr>
                        <td align="right" height="24" width="200"> Discount ( Code : <?=$discountcode?> ) </td>
                        <td align="right"> <?=$orderdetail->get_currency_symbol($currency_code)?> <span id="shipping-charges">
                          <?=$discountamount?>
                          </span> </td>
                      </tr>
                      <? } ?>
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
    </div>
  </section>
</div>
<?php 
include('includes/footer.php');
?>
