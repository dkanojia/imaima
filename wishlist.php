<?php

include('includes/db.inc.php');
if(!isset($_SESSION['user_nid']))
{
	header("location:".$glob['rootRel']."signin.html");
}	


if(isset($_POST["btnremove_wishlist"]))
{
$objwishlist = new mysql();			
			
			$query = "delete from tblwishlist where nid=".$_POST['wishlistid']." and userid=".$_SESSION['user_nid'];
			$objwishlist->stmt = $query;
			$objwishlist->execute();
			$_SESSION["addmsg"]= $_POST["hidwishlist_proname"]." has been removed from your wistlist.  <br /><br /> 	<input type='button' value='No Problem' class='alert_popup_button' onclick='closealert_box();'   />";
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
<div class="leftproduct_menu_inner" style="float:left;">
<?php
include('includes/leftpart.php');
?>
</div>
<div class="rightproduct_menu_inner" style="float:left;">

<div class="content-block sale-promo-wrapper products-carousel" style="padding-top:0px;"> 
  <div id="products-carousel">
  
  <?
  $leftsubcat = new mysql();
	$query = "select * from tblpage_content where pageid=31";
	
	$leftsubcat->stmt = $query;
	$leftsubcat->execute();
	while($leftsubcat_result =$leftsubcat->fetch_array())
	{
	extract($leftsubcat_result);	
	}
  ?>
 <div class="col-md-12 col-sm-12 col-xs-12" style=" margin-bottom:15px; width:90%; color:#000000;">
    	
        <?=$pagecontent?>
      
    </div>
    
    <div class="js-slider slick-initialized slick-slider" style="width:100%;">
     <h1 class="title-category">My Wish List</h1>
      <ul class='productlist_ul_padding' style="min-height:500px;">
    

   


 <?php 
	$checkwishlist=new mysql();
	$query = "select a.*,b.image1,b.image2,b.prourl_name,b.productname as productname,b.productcode as productcode,b.shortdesc,c.sale_price,e.url_name as url_maincatname,d.url_name as url_catname from tblwishlist a inner join tblproduct b on a.productid=b.productid inner join tblproduct_price c on b.default_priceid=c.nid inner join tblcategory d on b.catid=d.catid inner join tblcategory e on d.parentid=e.catid where a.userid='".$_SESSION['user_nid']."' and b.bstatus=1";
	$checkwishlist->stmt = $query;
	$checkwishlist->execute();	
	$i=1;
	while($checkwishlist_result = $checkwishlist->fetch_array())
	{
	extract($checkwishlist_result);
	$prourl = $glob['rootRel'].$checkwishlist->geturlstring($url_maincatname)."/".$checkwishlist->geturlstring($url_catname)."/".$checkwishlist->geturlstring($prourl_name).".html";
	 ?>
   <li style="width:300px; height:555px; overflow:hidden;"> <div  style="width:275px; height:410px; overflow:hidden;"> <a href="<?=$prourl?>"> <img width="275px;" src="image/product/big/<?=$image1?>"> <span><img width="275px;" src="image/product/big/<?=$image2?>"</span></a>
                            
                              <img id="imgf<?=$i?>" src="images/friend0.png" style="position:absolute; width:20px; z-index:98; top:5px; left:243px;" onMouseOver="changewishlist_image(this.id,'images/friend1.png')"  onMouseOut="changewishlist_image(this.id,'images/friend0.png')"  onClick="invitepopup('<?=$productid?>','<?=$productname?>');">
                             </div>
                              <div class="product-block__details" style="padding:10px 0px;">
                               <form name="fromremove_wishlist" method="post" action="">
                                <p class="product-block__title text-white" style="height:110px; width:275px; text-align:center;"><strong><?=$productname?></strong><br>
                                
                                  <?=$shortdesc?><br>
                                  <?=$objcurr->currency_symbol;?> <?=$objcurr->get_currency_amount($sale_price);?>    <br>                            
                                 <!-- <div style="text-align:center; width:275px;">-->
                                 
                                  	<input type="hidden" id="wishlistid" name="wishlistid" value="<?=$nid?>" >
                                   
                                    <input type="hidden" id="hidwishlist_proname" name="hidwishlist_proname" value="<?=$productname?>" >
                                  	<input type="submit" id="btnremove_wishlist" name="btnremove_wishlist" value="Drop" style="padding:5px 10px; font-size:12px;"/>
                                 
                                  <!--</div>-->
                                  
                                   </p>
                                    </form>
                              </div>
                             </li>
                            <?php
							$i=$i+1;
							}
	  ?>
        
    
</ul>
      
    </div>
  </div>
</div>
</div>
</div>
<?php 
include('includes/footer.php');
?>
