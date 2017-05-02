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
<div class="as-banner">
  <p class="as-banner__title">
    <?php 
include('includes/toptext.php');
?>
  </p>
</div>
  <?php 
include('includes/header.php');
?>
<div id="wrap" style="height: 500px;">
<?php
include('includes/leftpart.php');
?>
</div>

<div class="content-block sale-promo-wrapper products-carousel">
  <h2>Best Sellers</h2>
  <p>Discover the must-have investments for enduring style, season after season.</p>
  <div id="products-carousel">
    <div class="js-slider slick-initialized slick-slider">
      <ul>
      
      <?php
	  	$btag = new mysql();
							$query = "select a.productid,a.productname,a.productcode,a.productdesc,a.image1 from tblproduct a where FIND_IN_SET(1,product_tag) and a.bstatus=1 and a.blockstatus='active' order by rand() limit 4 ";		
							
							$btag->stmt=$query;
							$btag->execute();	
							while($btag_result = $btag->fetch_array())
							{
							extract($btag_result);
							
							?>
                             <li style="width:250px; height:350px; overflow:hidden;"> <div  style="width:225px; height:300px; overflow:hidden;"> <img width="225px;" src="image/product/big/<?=$image1?>"> <span>Shop Now</span></div>
                              <div class="product-block__details">
                                <p class="product-block__title text-white"><?=$productname?></p>
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
