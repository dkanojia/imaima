<?php

include('includes/db.inc.php');
include("includes/shoppingcart.php"); 
include('includes/common_post.php');

if(!isset($_REQUEST["id"]) && (!isset($_REQUEST["umaincatname"]) && !isset($_REQUEST["ucatname"])  && !isset($_REQUEST["uproname"])))
{
header("location:".$glob['rootRel']);
return;
}

if(isset($_REQUEST["id"]))
{
$url_proid = $_REQUEST["id"];
$cat = new mysql();
	
	$query = "select a.catid as url_catid,d.catid as url_maincatid,d.url_name as url_maincatname,c.url_name as url_catname from tblproduct a inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid  where  a.bstatus=1 and a.blockstatus='active' and a.productid=".$url_proid;
	
	$cat->stmt =$query;
	$cat->execute();
	if($cat_result = $cat->fetch_array())
	{
		extract($cat_result);	
	}
}
else
{
	$cat = new mysql();
	
	$query = "select a.catid as url_catid,a.catname as url_catname,b.catid as url_maincatid,b.catname as url_maincatname from tblcategory a inner join tblcategory b on a.parentid=b.catid where a.url_name='".$_REQUEST['ucatname']."' and b.url_name='".$_REQUEST['umaincatname']."' and a.blockstatus='active' and a.bstatus=1";
	
	$cat->stmt =$query;
	$cat->execute();
	if($cat_result = $cat->fetch_array())
	{
		extract($cat_result);
		$query = "select productid as url_proid from tblproduct where catid='".$url_catid."' and prourl_name='".$_REQUEST["uproname"]."' and blockstatus='active' and bstatus=1";
		$cat->stmt =$query;
		$cat->execute();
		if($cat_result = $cat->fetch_array())
		{
			extract($cat_result);
		}
	}
	else
	{
		header("location:".$glob['rootRel']);
		return;
	}


}





$recent_usernid=0;
if(isset($_SESSION['user_nid']))
{
	$recent_usernid=$_SESSION['user_nid'];
}	


if(isset($_POST['submit_add']))
{
	
	$productid=$_POST['productid'];
	//$qty=$_POST['quantity'];
	$qty=1;
	$productname = $_POST['productname'];
	$productcode = $_POST['productcode'];
	$imagefullname = $_POST['imagename'];
	$sizeid = $_POST['dsize'];
	$color = $_POST['hidcolor'];
	$cart_price = $_POST['price'];
	$cart_saleprice = $_POST['sale_price'];	
	$totalprice = $cart_saleprice*$qty;	
	$catname = $_POST['catname'];
	$subcatname = $_POST['subcatname'];
	$stock = $_POST['stock'];
	$productpriceid = $_POST['productpriceid'];
	
	
		if($qty > $stock) {
		$_SESSION["addmsg"]= "This product is out of stock.";
		
		}else{
			if($totalprice>0)
			{		
		$scart = new shoppingcart();
		$scart->uniqueid=$subcatname ."-" . $productid."-" . $sizeid;
		$scart->qty=$qty;
		$scart->productid=$productid;
		$scart->sizeid=$sizeid;
		$scart->color=$color;
		$scart->price=$cart_price;
		$scart->sale_price=$cart_saleprice;
		$scart->total=$totalprice;		
		$scart->productfullname=$productname;
		$scart->imagefullname=$imagefullname;
		$scart->productcode=$productcode;
		$scart->cart_catname=$catname;	
		$scart->cart_subcatname=$subcatname;
		$scart->productpriceid=$productpriceid;		
		$scart->productpath="https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$scart->addtocart();
		$_SESSION["addmsg"]= " Hey! We have added ". $_POST['proname']." ".$subcatname." to your shopping bag. <br /><br /> 	<input type='button' value='I want to shop more'  onclick='gotoindex();' class='alert_popup_button'  /> &nbsp;&nbsp; <input type='button' value='I want to pay' class='alert_popup_button' onclick='gotocart();'   />";
		
		}	
	}				
}
else
{
	/*
Insert into recent view
*/
$orderdatewithtime = date('Y-m-d H:i:s');
$objrecent =  new mysql();
$objrecent->stmt = "delete from tblrecent_view where userid=".$recent_usernid." and  productid=".$url_proid;
$objrecent->execute();
$objrecent->stmt = "insert into tblrecent_view(userid,productid,viewdate)values(".$recent_usernid.",".$url_proid.",'".$orderdatewithtime."')";
$objrecent->execute();
$objrecent->stmt = "select count(*) as recentcount,min(nid) as minrecentnid from tblrecent_view where userid=".$recent_usernid;
$objrecent->execute();
$objrecent_result = $objrecent->fetch_array();
extract($objrecent_result);
if($recentcount>=7)
{
$objrecent->stmt = "delete from tblrecent_view where userid=".$recent_usernid." and nid = ".$minrecentnid;
$objrecent->execute();
}

}







$cat = new mysql();
$query = "select a.productid,b.catname as pro_catname,b.catid as pro_catid ,a.productname as proname,a.title as product_title from tblproduct a inner join tblcategory b on a.catid=b.catid  where a.productid='".$url_proid."' and a.blockstatus='active' and a.bstatus=1";
$cat->stmt =$query;
$cat->execute();
$cat_result = $cat->fetch_array();
extract($cat_result);


$prelink = '#';
$nextlink = '#';
$objlink = new mysql();
$query = " select a.prourl_name as left_name,d.url_name as left_maincatname,c.url_name as left_catname from tblproduct a inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid where a.catid=".$pro_catid." and a.productid>".$url_proid." and a.blockstatus='active' and a.bstatus=1 order by a.productid desc limit 0,1";
$objlink->stmt =$query;
$objlink->execute();
if($objlink_result = $objlink->fetch_array())
{
extract($objlink_result);
$prelink = $glob['rootRel'].$objlink->geturlstring($left_maincatname)."/".$objlink->geturlstring($left_catname)."/".$objlink->geturlstring($left_name).".html";
}

$objlink = new mysql();
$query = " select a.prourl_name as right_name,d.url_name as right_maincatname,c.url_name as right_catname from tblproduct a inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid where a.catid=".$pro_catid." and a.productid<".$url_proid." and a.blockstatus='active' and a.bstatus=1 order by a.productid desc limit 0,1";
$objlink->stmt =$query;
$objlink->execute();
if($objlink_result = $objlink->fetch_array())
{
extract($objlink_result);
$nextlink = $glob['rootRel'].$objlink->geturlstring($right_maincatname)."/".$objlink->geturlstring($right_catname)."/".$objlink->geturlstring($right_name).".html";

}



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>
<?=$product_title?>
</title>
<?php 
include('includes/links.php');
?>
<link rel="stylesheet" href="<?=$glob['rootRel']?>css/easyzoom.css" />
<!--<link rel="stylesheet" href="zoom/multizoom.css" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script type="text/javascript" src="zoom/multizoom.js">-->
<?php /*?><script language="javascript" type="text/javascript"  src="<?=$glob['rootRel']?>js/featuredimagezoomer.js"></script><?php */?>
<?php
$meta = new mysql();
$query = "select a.metaname,b.metacontent from tblmeta_master a inner join tblmeta b on a.metaid=b.metaid where a.activestatus='active' and a.bstatus=1 and b.activestatus='active' and b.bstatus=1 and b.metatype='product' and b.typeid=".$url_proid;
$meta->stmt = $query;
$meta->execute();
while($meta_result =$meta->fetch_array())
{
extract($meta_result);
echo "<meta name='".$metaname."' content='".$metacontent."' />";
}
?>
<script language="javascript">
function showcolorname(name)
{
document.getElementById("hcolorname").innerHTML=name;
}

function showprice(proprice,saleprice,sizeid,productpriceid,showpricevalue,stockvalue)
{
document.getElementById("divs"+document.getElementById("dsize").value).style.border="solid 1px #aaaaaa";
document.getElementById("price").value=proprice;
document.getElementById("stock").value=stockvalue;
document.getElementById("sale_price").value=saleprice;
document.getElementById("productpriceid").value=saleprice;
document.getElementById("dsize").value=sizeid;
document.getElementById("divs"+sizeid).style.border="solid 2px #969898";
document.getElementById("spsale_price").innerHTML=showpricevalue;
}

function selectstock_size(divid,sizename)
{
	oldsizename = document.getElementById("hid_stock_size").value;
	//alert(document.getElementById(divid).style.border);
	if(document.getElementById(divid).style.border=="2px solid rgb(204, 204, 204)")
	{
		document.getElementById(divid).style.border="solid 2px #969898";
		document.getElementById("hid_stock_size").value=oldsizename + sizename + ",";
	}
	else
	{
		document.getElementById(divid).style.border="solid 2px #cccccc";
		oldsizename = oldsizename.replace(sizename+",","");
		document.getElementById("hid_stock_size").value=oldsizename;
	}
	
}



</script>
<script type="text/javascript">


/*jQuery(document).ready(function($){

	$('#multizoom1').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description', // description selector (optional - but required if descriptions are used) - new
		speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
		descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
		imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
		magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
		zoomrange: [2, 8],
		magnifiersize: [400,700],
		magnifierpos: 'right',
		cursorshadecolor: '#fdffd5',
		cursorshade: true //<-- No comma after last option!
	});
	
	
	
})*/


/*function changeimg(src)
{
document.getElementById("multizoom1").src = src;

jQuery(document).ready(function($){
	$('#multizoom1').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description', // description selector (optional - but required if descriptions are used) - new
		speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
		descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
		imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
		magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
		zoomrange: [2, 8],
		magnifiersize: [400,700],
		magnifierpos: 'right',
		cursorshadecolor: '#fdffd5',
		cursorshade: true //<-- No comma after last option!
	});

})

}*/

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

<?
$cat = new mysql();
 $query="select a.*,b.price as pro_price,b.sale_price as pro_saleprice, b.sizeid as defaultsize, b.stock ,b.color_imagename as colorimageselect,c.catname as subcatname,d.catname as catname  from tblproduct a inner join tblproduct_price b on a.default_priceid=b.nid inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid  where  a.productid='".$url_proid."' and a.blockstatus='active' and a.bstatus=1 and b.bstatus=1 and b.blockstatus='active' and c.bstatus=1 and c.blockstatus='active' ";	
$cat->stmt =$query;
$cat->execute();
$cat_result = $cat->fetch_array();
extract($cat_result);

?>
  <div class="content-block products-carousel" style="width:100%; float:left;">
    <div id="products-carousel">
      <div class="js-slider slick-initialized" style="width:100%;">
        <div class="single-product-area">
          <div class="zigzag-bottom"></div>
          <div class="row">
            <div class="col-md-12">
              <div class="product-content-right">
                <div class="product-breadcroumb">
                  <?=$catname?>
                  &nbsp; / &nbsp;<a href="<?=$glob['rootRel']?>imaima-<?=$cat->geturlstring($url_catname)?>.html">
                  <?=$pro_catname?>
                  </a>&nbsp; / &nbsp;
                  <?=$proname?>
                </div>
                <div class="row">
                  <div class="col-sm-7">
                    <div class="product-images">
                      <div class="product-main-img">
                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"> <a href="<?=$glob['rootRel']?>image/product/big/<?=$image1 ?>"> <img src="<?=$glob['rootRel']?>image/product/big/<?=$image1 ?>" alt="" width="100%" /> </a> </div>
                        <?php /*?>  <img id="mainimage" src="image/product/big/<?=$image1 ?>" alt="" onMouseOver="makemainimg(this.src);">  <?php */?>
                        <?php /*?> <div style="border:1px solid #eee; width:500px; height:auto; "><img id="multizoom1" alt="zoomable" title="" 
                                      src="image/product/big/<?=$image1 ?>"/></div>
										<div style="display:none;" id="description"><?=$subcatname?> - <?=$productname?></div><?php */?>
                      </div>
                      <div class="product-gallery" style=" background:#ffffff;">
                        <ul class="thumbnails" style="padding:0px;">
                          <?php     
										  if($image1!=""){
										  ?>
                          <li> <a href="<?=$glob['rootRel']?>image/product/big/<?=$image1 ?>" data-standard="<?=$glob['rootRel']?>image/product/big/<?=$image1 ?>"> <img src="<?=$glob['rootRel']?>image/product/big/<?=$image1 ?>" alt=""  /> </a> </li>
                          <?php
										  }
										  ?>
                          <?php     
										  if($image2!=""){
										  ?>
                          <li> <a href="<?=$glob['rootRel']?>image/product/big/<?=$image2 ?>" data-standard="<?=$glob['rootRel']?>image/product/big/<?=$image2 ?>"> <img src="<?=$glob['rootRel']?>image/product/big/<?=$image2 ?>" alt=""  /> </a> </li>
                          <?php
										  }
										  ?>
                          <?php     
										  if($image3!=""){
										  ?>
                          <li> <a href="<?=$glob['rootRel']?>image/product/big/<?=$image3 ?>" data-standard="<?=$glob['rootRel']?>image/product/big/<?=$image3 ?>"> <img src="<?=$glob['rootRel']?>image/product/big/<?=$image3 ?>" alt=""  /> </a> </li>
                          <?php
										  }
										  ?>
                          <?php     
										  if($image4!=""){
										  ?>
                          <li> <a href="<?=$glob['rootRel']?>image/product/big/<?=$image4 ?>" data-standard="<?=$glob['rootRel']?>image/product/big/<?=$image4 ?>"> <img src="<?=$glob['rootRel']?>image/product/big/<?=$image4 ?>" alt=""  /> </a> </li>
                          <?php
										  }
										  ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="product-inner">
                      <div class="visible_only_desktop" style="background-color:#ffffff; border-bottom:solid 1px #666666;">
                        <table>
                          <tbody>
                            <tr>
                              <td class="prev"><? if($prelink=="#") { ?>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> Previous
                                <? } else { ?>
                                <a href="<?=$prelink?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                                <? } ?>
                              </td>
                              <td class="back-to"></td>
                              <td class="next"><? if($nextlink=="#") { ?>
                                Next <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <? } else { ?>
                                <a href="<?=$nextlink?>">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <? } ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                     
                        <div class="product-inner-price" style="border-bottom:solid 1px #666666; margin-bottom:0px;">
                          <h2 class="product-name">
                            <?=$proname?>
                          </h2>
                          <ins id="lblDiscountPrice">
                          <?=$objcurr->currency_symbol;?>
                          <span id="spsale_price">
                          <?=$objcurr->get_currency_amount($pro_saleprice);?>
                          </span> </ins>
                          <?php if($pro_price>$pro_saleprice) { ?>
                          <del id="lblOriginalPrice">
                          <?=$objcurr->currency_symbol;?>
                          <?=$objcurr->get_currency_amount($pro_price);?>
                          </del>
                          <?php } ?>
                        </div>
                        <div class="select-color" style="border-bottom:solid 1px #666666;">
                        
                        
                         <form action="" method="post">
                        <input type='hidden' name='price' value='<?=$pro_price?>' id='price'/>
                        <input type='hidden' name='sale_price' value='<?=$pro_saleprice?>' id='sale_price'/>
                        <input type='hidden' name='productpriceid' value='<?=$default_priceid?>' id='productpriceid'/>
                        <input type='hidden' name='stock' value='<?=$stock?>' id='stock'/>
                        <input type='hidden' name='productid' value='<?=$productid?>' id='productid'/>
                        <input type='hidden' name='catname' value='<?=$catname?>' id='catname'/>
                        <input type='hidden' name='subcatname' value='<?=$subcatname?>' id='subcatname'/>
                        <input type='hidden' name='productname' value='<?=$subcatname?> - <?=$productname?>' id='productname'/>
                        <input type='hidden' name='proname' value='<?=$productname?>' id='proname'/>
                        <input type='hidden' name='imagename' value='<?=$glob['rootRel']?>image/product/big/<?=$image1 ?>' id='imagename'/>
                          <?php
										
										$prosize=new mysql();
										 $sizequery = "SELECT a.productid as procolorid,a.colorname procolorname,a.colorimage as procolorimage,a.prourl_name as tmp_name,d.url_name as tmp_maincatname,c.url_name as tmp_catname from tblproduct a inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid where a.productcode='".$productcode."' and a.catid=".$catid." and a.bstatus=1 and a.blockstatus='active' order by a.colorname";
									$prosize->stmt=$sizequery;
									$prosize->execute();
											
									?>
                          <div style="margin-bottom:22px;">
                            <h5 style="font-size:10px; margin-bottom:8px;">COLOUR</h5>
                            <ul class="colour-boxs" style="padding:0px;">
                              <?php
							  				
											while($size_result = $prosize->fetch_array()){
												extract($size_result);
												$pro_colorurl = $glob['rootRel'].$prosize->geturlstring($tmp_maincatname)."/".$prosize->geturlstring($tmp_catname)."/".$prosize->geturlstring($tmp_name).".html";
											?>
                              <li> <a href="<?=$pro_colorurl?>"> <img id="<?=$procolorname?>" onMouseOver="showcolorname(this.id);" <?php if($productid==$procolorid){ ?> style='border:solid 2px #969898;' <?php } else { ?>  style='border:solid 1px #aaaaaa;' <? }?>src="<?=$glob['rootRel']?>image/color/<?=$procolorimage?>" width="100%"></a></li>
                              <?php }
											 ?>
                            </ul>
                            <h5 id="hcolorname" style="margin-top:0px;">
                              <?=$colorname?>
                            </h5>
                            <input type="hidden" id="hidcolor" name="hidcolor" value="<?=$colorname?>" >
                            <h5 style="font-size:10px; margin-top:25px; margin-bottom:8px;">SIZE</h5>
                            <?php
										
										$prosize=new mysql();
										 $sizequery = "SELECT b.sizename,a.sizeid,a.nid as pro_priceid,a.sale_price as size_price,a.stock FROM `tblproduct_price` a inner join tblsize b on a.sizeid=b.sizeid where a.productid='".$url_proid."' and a.bstatus=1 and a.blockstatus='active' and b.bstatus=1 and b.blockstatus='active' group by a.sizeid";
									$prosize->stmt=$sizequery;
									$prosize->execute();
											
									?>
                            <ul class="size-boxes" style="padding:0px;">
                              <?
							  				$outofstock_count=0;
											 while($size_result = $prosize->fetch_array()){
												extract($size_result);
												
												// get stock calculation 
												$stockmsg="";
												if($stock<=$stock_minvalue1)
												$stockmsg=$stock_minmsg1;
												else if($stock<=$stock_minvalue2)
												$stockmsg=$stock_minmsg2;
												else if($stock<=$stock_minvalue3)
												$stockmsg=$stock_minmsg3;
												
											?>
                              <li data-toggle="tooltip" data-placement="bottom" <? if($stockmsg!="") { ?> title="<?=$stockmsg?>" <? } ?>                                
							  <?php  if($defaultsize==$sizeid){ ?> style='border:solid 2px #969898; cursor:pointer;'  onClick="showprice('<?=$price?>','<?=$size_price?>','<?=$sizeid?>','<?=$pro_priceid ?>','<?=$objcurr->get_currency_amount($size_price);?>','<?=$stock ?>');" id="divs<?=$sizeid?>"
							  <?php } else if($stock>$stock_minvalue1) { ?>  style='border:solid 1px #aaaaaa; cursor:pointer;' onClick="showprice('<?=$price?>','<?=$size_price?>','<?=$sizeid?>','<?=$pro_priceid ?>','<?=$objcurr->get_currency_amount($size_price);?>','<?=$stock ?>');" id="divs<?=$sizeid?>"
                               <?php } else { $outofstock_count=1; ?>  style='border:solid 1px #cccccc; color:#aaaaaa;' 
							  <? }?>>
                              <?php echo $sizename?>
                              </li>
                              <? } ?>
                            </ul>
                            <input type="hidden" id="dsize" name="dsize" value="<?=$defaultsize?>" >
                          </div>
                          <? if($outofstock_count=="1")
						  {
						  ?>
                           <h5 class="form_button" style="cursor: pointer; width:180px; font-size: 10px;    margin: 0 auto 15px;    padding: 0 10px 15px;" onClick="return showstockpopup();">IS YOUR SIZE OUT OF STOCK ?</h5>
                          <?
						  }
						  ?>
                          <h5 style="cursor:pointer; font-size:12px; border:solid 1px #969898; padding:5px 10px 5px 10px; width:90px; margin:0px auto;" onClick="return showsizepopup();">SIZE GUIDE</h5>
                          <h5 style="margin-top:0px;">&nbsp;</h5>
                          <button class="form_button" type="submit" name="submit_add">Add to cart</button>
                        
                            </form>
                     <div style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; text-align: center; font-size: 12px; margin: 0px auto; width: 265px; padding: 15px 5px 0px; margin-bottom:40px;">
 
                      <div style="float: left;">
                      
                      
                      
                           <form method="post" action="" name="frmwishlist" id="frmwishlist0">
                           	<span style="cursor:pointer; padding:5px 10px 5px 10px; " onClick="submit_wishlist(0);"> <img id="imgproduct_wishlist" src="<?=$glob['rootRel']?>images/wishlist_product.png" style="height:17px; margin-right:3px;margin-top: -3px;" onMouseOver="changewishlist_image(this.id,'<?=$glob['rootRel']?>images/wishlist1.png')"  onMouseOut="changewishlist_image(this.id,'<?=$glob['rootRel']?>images/wishlist_product.png')" /> Add To Wishlist </span> 
                            <input type="hidden" id="wishlistpro_id" name="wishlistpro_id" value="<?=$productid?>" >
                             </form>
                           </div><div style="float: left;"> 
                            &nbsp; &nbsp;  <span style="cursor:pointer; padding:5px 10px 5px 10px; margin-left:10px; " onClick="invitepopup('<?=$productid?>','<?=$productname?>');"> <img id="imgproduct_friend" src="<?=$glob['rootRel']?>images/friend_product.png" style="height:17px; margin-right:3px;margin-top: -3px;" onMouseOver="changewishlist_image(this.id,'<?=$glob['rootRel']?>images/friend1.png')"  onMouseOut="changewishlist_image(this.id,'<?=$glob['rootRel']?>images/friend_product.png')" /> Ask Friend </span> </div>
                           </div> 
                        </div>
                    
                      <div id="tabbingTab" style="border-bottom:solid 1px #666666;">
                        <ul class="tabs">
                          <li class="tab-link current" data-tab="tab-1">DETAILS</li>
                          <li class="tab-link" data-tab="tab-2">FABRIC & CARE</li>
                        </ul>
                        <div id="tab-1" style="  background:#ffffff;" class="tab-content current">
                          <?=$productdesc?>
                        </div>
                        <div id="tab-2" class="tab-content" style=" background:#ffffff;">
                          <?=$product_care?>
                        </div>
                      </div>
                      <div class="social-media" style=" background:#ffffff;">
                        <!--<div id="facebook"> <a href="#"> <i class="fa fa-facebook"></i> <span>Share</span> </a> </div>
                        <div id="twitter"> <a href="#" target="_blank"> <i class="fa fa-twitter"></i> <span>Tweet</span> </a> </div>
                        <div id="google-plus"> <a href="https://www.instagram.com/iimaimaofficial/" target="_blank"> <i class="fa fa-instagram"></i> <span>Instagram</span> </a> </div>
                        <div id="pin-it"> <a href="#"> <i class="fa fa-pinterest"></i> <span>Pintrest</span> </a> </div>-->
                        <div class="addthis_inline_share_toolbox" style="width:300px;" ></div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58d25568fa531825"></script>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<div class="related-products-wrapper" style="width:100%; margin:0px auto; margin-bottom:40px; float:left;">
  <h2 class="related-products-title" style="color:#000000; font-size:16px; background-color:#ededed; padding: 7px 20px; ">Style it With</h2>
  <div class="related-products-carousel" style="width:100%; margin:0px auto;">
    <?php
	  	$btag = new mysql();
							$query = "select a.productid,a.productname,a.productcode,a.productdesc,a.image1 ,a.prourl_name as tmp_name,d.url_name as tmp_maincatname,c.url_name as tmp_catname from tblproduct a inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid where a.catid in (".$related_categories.") and a.bstatus=1 and a.blockstatus='active' and productid<>".$url_proid." order by rand() limit 6 ";		
							
							$btag->stmt=$query;
							$btag->execute();	
							while($btag_result = $btag->fetch_array())
							{
							extract($btag_result);
							$pro_url = $glob['rootRel'].$btag->geturlstring($tmp_maincatname)."/".$btag->geturlstring($tmp_catname)."/".$btag->geturlstring($tmp_name).".html";
							?>
    <div class="single-product">
      <div class="product-f-image"> <a href="<?=$pro_url?>"> <img width="320px;" src="<?=$glob['rootRel']?>image/product/big/<?=$image1?>" alt=""></a>
       
      </div>
      <h2 style="text-align:center; font-size:14px;"><a href="<?=$pro_url?>">
        <?=$productname?>
        </a></h2>
   
    </div>
    <?php
					}
					?>
  </div>
</div>
<div class="related-products-wrapper" style="width:100%; margin:0px auto;  float:left;">
  <h2 class="related-products-title" style="color:#000000; font-size:16px; background-color:#ededed; padding: 7px 20px;" >Recently Viewed</h2>
  <div class="related-products-carousel" style="width:100%; margin:0px auto;">
    <?php
	  	$btag = new mysql();
							$query = "select a.productid,a.productname,a.productcode,a.productdesc,a.image1 ,a.prourl_name as tmp_name,d.url_name as tmp_maincatname,c.url_name as tmp_catname from tblproduct a inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid inner join tblrecent_view b on a.productid=b.productid where b.userid=".$recent_usernid." and a.bstatus=1 and a.blockstatus='active'  order by b.nid desc limit 6 ";		
							
							$btag->stmt=$query;
							$btag->execute();	
							while($btag_result = $btag->fetch_array())
							{
							extract($btag_result);
							$pro_url = $glob['rootRel'].$btag->geturlstring($tmp_maincatname)."/".$btag->geturlstring($tmp_catname)."/".$btag->geturlstring($tmp_name).".html";
							?>
    <div class="single-product">
      <div class="product-f-image"> <a href="<?=$pro_url?>"> <img width="320px;" src="<?=$glob['rootRel']?>image/product/big/<?=$image1?>" alt=""></a>
      
      </div>
      <h2 style="text-align:center;  font-size:14px;"><a href="<?=$pro_url?>">
        <?=$productname?>
        </a></h2>
      
    </div>
    <?php
					}
					?>
  </div>
</div>
<script type="text/javascript">
        function showsizepopup() {
            $("#size_dialog").show();
        }
        function closesize_box() {
            $("#size_dialog").hide();

        }
		
		 function showstockpopup() {
            $("#stock_dialog").show();
        }
        function closestock_box() {
            $("#stock_dialog").hide();

        }
    </script>
<div id="size_dialog" class="modal" style="padding-bottom: 20px;"  onclick="closesize_box();">
  <!-- Modal content -->
  <div class="modal-content" style="width: 800px; height:450px; border-radius: 5px; border: solid 1px #666666; overflow:auto;"> <span class="close" onClick="closesize_box();">X</span> <br />
    <p style="font-size: 20px; font-weight: bold; border-bottom:solid 1px #666666;"> SIZE GUIDE </p>
    <p style="font-size: 16px;">
      <?php
                   $cat = new mysql();
  

		  $query = "select * from tblpage_content where pageid='30' and blockstatus='active' and bstatus=1";
		  $cat->stmt = $query;
		  $cat->execute();
		 $cat_result = $cat->fetch_array();
		 extract($cat_result);
	
		
		 echo "$pagecontent";
                    ?>
      <br />
    </p>
  </div>
</div>
<div id="stock_dialog" class="modal" style="padding-bottom: 20px;">
  <!-- Modal content -->
  <div class="modal-content" style="width: 90%; max-width:450px; border-radius: 5px; border: solid 1px #666666; overflow:auto;">
    <form name="frmstockmail" method="post" action="">
            <table border="0" cellpadding="5" cellspacing="0" width="100%" style="text-align:left; font-size:12px;">
            <tr>
            <td>
            <p style="font-size: 20px; font-weight: bold;  padding-bottom:5px;">
               <span style="margin-left:40%; border-bottom:solid 1px #606062;"><img src="<?=$glob['rootRel']?>images/logo_popup.png" style="height:27px; margin-bottom:10px;" /></span>
                <span class="close" onclick="closestock_box();">X</span>
            </p>
            </td>
            </tr>
             <tr>
                <td style="border-bottom:solid 1px #666666;">
                <?=$productname?>
                </td></tr>
            	<tr>                	
                    <td >Don't miss out again. <br>
                    Be the first to know when your size is back in stock.<br><br>
                    
                        1. Select your size.<br>
                        2. Enter your email address.<br>
                    </td>
                </tr>
               
                <tr>
                <td style="border-bottom:solid 1px #666666; padding-bottom:20px;">
              
              	<?
					$prosize=new mysql();
										 $sizequery = "SELECT b.sizename,a.sizeid,a.nid as pro_priceid,a.sale_price as size_price,a.stock FROM `tblproduct_price` a inner join tblsize b on a.sizeid=b.sizeid where a.productid='".$url_proid."' and a.bstatus=1 and a.blockstatus='active' and b.bstatus=1 and b.blockstatus='active' group by a.sizeid";
									$prosize->stmt=$sizequery;
									$prosize->execute();
									 echo "<ul class='size-boxes' style='padding:0px;'>";
									 while($size_result = $prosize->fetch_array()){
									extract($size_result);
										if($stock<=$stock_minvalue1)
										{
										?>
                                        <li style='border:solid 2px #cccccc; cursor:pointer;' onClick="selectstock_size(this.id,<?php echo $sizename?>);" id="divstock<?=$sizeid?>">  
										  <?php echo $sizename?>
                                          </li>
                                        <?
										}
									}
									echo "</ul>";
				
				?>
                </td></tr>
            	
                <tr>
                	
                    <td>Enter Your Email Here <br>
                    <input type="text" id="txtstock_email" name="txtstock_email" style="width:90%; height:35px;" /></td>
                </tr>
             
                 <tr>
                	<td align="center">
                    	<input type="submit" id="btnstock_submit" class="form_button" name="btnstock_submit" value="Submit" />
                    	<input type="hidden" id="hid_stock_size" name="hid_stock_size" />
                        <input type="hidden" id="hid_stock_product" name="hid_stock_product" value="<?=$url_proid?>" />
                    </td>
                   
                </tr>
            </table>
            </form>
  </div>
</div>
<?php 
include('includes/footer.php');
?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script src="<?=$glob['rootRel']?>js/easyzoom.js"></script>
<script>
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });

        $(function(){
            $(".headerHome .mobi-menu-icon").click(function(){
                $(".headerHome ul.inline-list").slideToggle();
            });
        });
		
	/*	$(".owl_nav div:contains('prev')").html('< Previous');//Replace to Sun
$(".owl_nav div:contains('next')").html('Next >');//Replace to Mon*/

    </script>
