<?php
if(!isset($_REQUEST["srch"]))
header("location:index.php");

include('includes/db.inc.php');
include('includes/common_post.php');
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
function searchproduct(srch,color,sortby)
{
	var url = "search.php?srch="+srch;
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
<div style="width:97%; margin:0px auto;">
<div class="leftproduct_menu_inner" style="float:left;">
<?php
include('includes/leftpart.php');
?>
</div>
<div class="rightproduct_menu_inner" style="float:left;">



<div class="content-block sale-promo-wrapper products-carousel" style="padding-top:0px;"> 
  <div id="products-carousel">
  
    <div class="js-slider slick-initialized slick-slider" style="width:100%;">
      <ul class='productlist_ul_padding'>
      
      <?php
	  	$btag = new mysql();
							$query = "select a.prourl_name,a.productid,a.productname,a.productcode,a.productdesc,a.image1,a.image2,b.sale_price,a.shortdesc,d.url_name as url_maincatname,c.url_name as url_catname from tblproduct a inner join  tblproduct_price b on a.default_priceid=b.nid inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid  where  a.bstatus=1 and a.blockstatus='active' and (a.productname like '%".$_REQUEST["srch"]."%' or a.shortdesc like '%".$_REQUEST["srch"]."%'  or a.searchkeyword like '%".$_REQUEST["srch"]."%')";
							
							if(isset($_REQUEST["c"]))
							{
							$query = $query ." and a.product_colorid=".$_REQUEST["c"];		 
							}
							
							if(isset($_REQUEST["s"]))
							{
							$query = $query ." order by ".str_replace("by"," ",$_REQUEST["s"]);		 
							}
							else
							{
							$query = $query ." order by a.productname";		 
							}
							
							
							
							$btag->stmt=$query;
							$btag->execute();	
							while($btag_result = $btag->fetch_array())
							{
							extract($btag_result);
							$prourl = $glob['rootRel'].$btag->geturlstring($url_maincatname)."/".$btag->geturlstring($url_catname)."/".$btag->geturlstring($prourl_name).".html";
							?>
                             <li style="width:300px; height:555px; overflow:hidden;"> <div  style="width:275px; height:410px; overflow:hidden;"> <a href="<?=$prourl?>"> <img width="275px;" src="image/product/big/<?=$image1?>"> <span><img width="275px;" src="image/product/big/<?=$image2?>"</span></a>
                             <form method="post" action="" name="frmwishlist" id="frmwishlist">
                             <img id="imgw<?=$i?>" src="images/wishlist0.png" style="position:absolute; width:20px; z-index:98; top:5px; left:243px;" onMouseOver="changewishlist_image(this.id,'images/wishlist1.png')"  onMouseOut="changewishlist_image(this.id,'images/wishlist0.png')" onClick="submit_wishlist();">
                             <input type="hidden" id="wishlistpro_id" name="wishlistpro_id" value="<?=$productid?>" >
                             </form>
                              <img id="imgf<?=$i?>" src="images/friend0.png" style="position:absolute; width:20px; z-index:98; top:40px; left:243px;" onMouseOver="changewishlist_image(this.id,'images/friend1.png')"  onMouseOut="changewishlist_image(this.id,'images/friend0.png')"  onClick="invitepopup('<?=$productid?>','<?=$productname?>');">
                             </div>
                              <div class="product-block__details" style="padding:10px 0px;">
                                <p class="product-block__title text-white" style="height:90px; width:275px; text-align:center;"><strong><?=$productname?></strong><br>
                                
                                  <?=$shortdesc?><br>
                                  <?=$objcurr->currency_symbol;?> <?=$objcurr->get_currency_amount($sale_price);?> </p>
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
