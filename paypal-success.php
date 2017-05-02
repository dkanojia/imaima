<?php 
include('includes/db.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php 
include('includes/links.php');
?>


<title>:: Welcome to iimaima.com ::</title>

</head>
<body>
    <?php 
include('includes/toptext.php');
include('includes/header.php');
?>
<div style="width:97%; margin:0px auto;">


<div id="pageWrap">
	<section id="content" class="contact">
            	
                <div id="contactForm">
                	
                    
                 <div class="regi_contents_bg">
				 <div class="order_history_part">				 
				 
				<?
				 
				 $orderdetail = new mysql();
				 $query = "select a.* from tbluser a where a.nid='".$_REQUEST["id"]."'";
				 $orderdetail->stmt = $query;
				$orderdetail->execute();
				if($orderdetail_result =$orderdetail->fetch_array())
				{				
				extract($orderdetail_result);
				}
				 
				?>
				 
				  <h1 style="font-size:18px;">
				 Hi <?=$firstname?> <?=$lastname?>,                
				 </h1>
				 <br><br>
				 
	
	<div class="checkout-comp-thank-text1" style="width:100%">
					<!--		Congratulations! We have booked your order.<br>
							<span class="purchaseCompletionInfo">Your
								Your payment has been completed , we will contact you soon .
										<span class="viewInfoUnderMyAccount">
											You can also view this after login in your customer account from link : "<a href="<?=$glob['rootRel']?>login.php" style="text-decoration:underline;">Click here </a>".<br>
							</span>
							<br><br>
							Sincerely,<br>Your iimaima Team
				  </span>-->
                  <?
				  $leftsubcat = new mysql();
		$query = "select * from tblpage_content where pageid=15";
		
		$leftsubcat->stmt = $query;
		$leftsubcat->execute();
		while($leftsubcat_result =$leftsubcat->fetch_array())
		{
		 extract($leftsubcat_result);	
		 ?>
         <div style="width:100%; min-height:400px; float:left;">
         <?=$pagecontent?> 
         </div>
         <?
		
		}
				  ?>
				</div>
				 
				 <div class="clr"></div>
				 </div>
				 <div class="clr"></div>
				 </div>   
                <div class="clr"></div>
				</div>
            </section>
	
    
    <!--content End-->
    <div class="clear"></div>
  </div>
   <?
  $amountofsale = $subtotal - $discountamount
  ?>
  <img src="https://shareasale.com/sale.cfm?currency=<?=strtoupper($currency_code)?>&amount=<?=$amountofsale?>&tracking=<?=$orderid?>&transtype=sale&merchantID=71589" width="1" height="1">
</div>


<?php 
include('includes/footer.php');
?>

