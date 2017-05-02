<?php 
include('includes/db.inc.php');
include('includes/common_post.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">



<title>Imaima – Women’s Fashion Brand</title>
<meta name="description" content="IMAIMA is a women’s fashion brand. Our designs are stories of the women of the world. Explore our hand embroidered collection along with blouses, tops, skirts, jackets, coats and jumpsuits. ">
<meta name="google-site-verification" content="28kctYIwEAoHw1nY-MVc3_rEdhMfe4NPmxKHNKpdZmE" />
<meta name="robots" content="noodp"/>
<link rel="canonical" href="https://www.iimaima.com/" />
<meta name="rating" content="safe for kids" />
<meta name="googlebot" content=" index, follow " />
<meta name="yahooSeeker" content=" index, follow " />
<meta name="msnbot" content=" index, follow " />
<meta name="allow-search" content="yes" />
<meta name="revisit-after" content="3 days" />
<meta name="distribution" content="global" />
<meta name="Rating" content="General" />
<meta name="Expires" content="never" />
<meta property="og:type" content="website" />
<meta property="og:title" content="IMAIMA" />
<meta property="og:description" content=" IMAIMA is a women’s fashion brand. Our designs are stories of the women of the world. Explore our hand embroidered collection along with blouses, tops, skirts, jackets, coats and jumpsuits. " />
<meta property="og:url" content="https://www.iimaima.com/"/> 
<meta name="twitter:card" value="summary"/>
<meta name="twitter:site" value="@iimaimaofficial"/>
<meta name="twitter:title" value="ÏMAIMA"/>
<meta name="twitter:description" value="We are a fashion brand, for the new generation of young women. Our designs are stories of a woman’s life, her identity and her love for her culture."/>
<meta property="fb:page_id" content="iimaimaofficial" />

<?php 
include('includes/links.php');
?>

</head>
<body>

    <?php 
include('includes/toptext.php');
include('includes/header.php');

$admin = new mysql();
$query = "select * from tbladmin_setting where bstatus=1";
$admin->stmt = $query;
$admin->execute();
$admin_result =$admin->fetch_array();	
extract($admin_result);
?>
<?php /*?><div id="wrap"  style="background: url(image/backimage/<?=$banner1?>);background-size: 100% 100%; background-repeat:no-repeat;"><?php */?>
<div id="wrap">

<?php
include('includes/leftpart.php');
?>
<a href="<?=$banner1_link?>"><img src="image/backimage/<?=$banner1?>" width="100%" alt="<?=$banner1_alt?>" /></a>
</div>

<?php /*?><div id="wrap"  style=" background: url(image/backimage/<?=$banner2_image?>);  background-size: 100% 100%; background-repeat:no-repeat;"><?php */?>
<div id="wrap">

<? if($banner2_url!="") 
{
?>
<a href="<?=$banner2_link?>"><div style="position:relative;height:0;padding-bottom:56.25%">   <iframe allowfullscreen="" frameborder="0" height="360" src="<?=str_replace("watch?v=","embed/",$banner2_url);?>" style="position:absolute;width:100%;height:100%;left:0" width="640"></iframe></div></a>
<?php
}
else
{
?>
<a href="<?=$banner2_link?>"><img src="image/backimage/<?=$banner2_image?>" width="100%" alt="<?=$banner2_alt?>" /></a>
<?
}

?>
</div>


<div class="content-block sale-promo-wrapper products-carousel">
  <h2 style="padding: 5px;margin: 20px auto 10px auto;background-color: #ededed;">Best Sellers</h2>
  <p style="text-align:center; padding-bottom:20px;">Discover the must-have investments for enduring style, season after season.</p>
  <div id="products-carousel">
     <div class="js-slider slick-initialized" style="width:100%; text-align:center;">
      <ul class="ul_bestseller" style="display:inline-block;">
      
      <?php
	  	$btag = new mysql();
							$query = "select a.productid,a.productname,a.productcode,a.productdesc,a.image1,a.image2,b.sale_price,a.shortdesc from tblproduct a inner join  tblproduct_price b on a.default_priceid=b.nid where FIND_IN_SET(9,product_tag) and a.bstatus=1 and a.blockstatus='active' order by rand() limit 4 ";		
							
							$btag->stmt=$query;
							$btag->execute();	
							while($btag_result = $btag->fetch_array())
							{
							extract($btag_result);
							
							?>
                             <li style="width:300px; height:555px; overflow:hidden; float:left;"> <div  style="width:275px; height:410px; overflow:hidden;"> <a href="productdetail.php?id=<?=$productid?>"> <img width="275px;" src="image/product/big/<?=$image1?>"> <span><img width="275px;" src="image/product/big/<?=$image2?>"></span></a></div>
                              <div class="product-block__details" style="padding:10px 0px;">
                                <p class="product-block__title text-white" style="height:90px; width:275px; text-align:center;"><strong><?=$productname?></strong><br>
                                
                                  <?=$shortdesc?><br>
                                  <?=$objcurr->currency_symbol;?> <?=$objcurr->get_currency_amount($sale_price);?> </p>
                              </div>
                             </li>
                            <?php
							
							}
	  ?>
       
      </ul>
    </div>
  </div>
</div>
<?php 
include('includes/footer.php');
?>
