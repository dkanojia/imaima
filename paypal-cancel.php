<?php 

include('includes/db.inc.php');

if(isset($_REQUEST["id"]))
{
	  $update_table = new mysql(); 
       $query="UPDATE tblorder SET orderstatus='Cancel' WHERE orderid='".$_REQUEST["id"]."' and orderstatus in ('Payment Incomplete','pending')";
      $update_table->stmt = $query;
      $update_table->execute();
}
else
{
header("location:index.php");
return;
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
				 $query = "select a.*,b.* from tblorder a inner join tbluser b on a.userid=b.nid where a.orderid='".$_REQUEST["id"]."'";
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
							<!--Oops! You have cancelled your order.<br>
							<span class="purchaseCompletionInfo">
								Your payment is not completed.
										<span class="viewInfoUnderMyAccount">
											You can also view this after login in your customer account from link : "<a href="<?=$glob['rootRel']?>login.php" style="text-decoration:underline;">Click here </a>".<br>
							</span>
							<br><br>
							Sincerely,<br>Your iimaima Team
				  </span>-->
                  
                    <?
				  $leftsubcat = new mysql();
		$query = "select * from tblpage_content where pageid=18";
		
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
</div>


<?php 
include('includes/footer.php');
?>

