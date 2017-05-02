
<div class="box box-produce special bg-title">
  <h3 class="box-heading"><span>Bestsellers</span></h3>
  <div class="box-content">
    <div class="box-product">
			  								  <div class="row-fluid">
                                              
                                              
                                              
                                              
                      <?php 
							
							$btag = new mysql();
							$query = "select a.productid,a.productname,a.productcode,a.productdesc,a.image1,b.price,b.sale_price from tblproduct a inner 
							join tblproduct_price b on a.default_priceid=b.nid where FIND_IN_SET(2,product_tag) and a.bstatus=1 and a.blockstatus='active' and  b.bstatus=1 and b.blockstatus='active' order by rand() limit 3 ";			
							$btag->stmt=$query;
							$btag->execute();	
							while($btag_result = $btag->fetch_array())
							{
							$bproduct_discount = 0;
							extract($btag_result);
							if($price!=$sale_price && $sale_price > 0 ){					
								$bproduct_discount = number_format((($price-$sale_price)/$price)*100);
							}
							?>
		<div class="span3 product-block">
    	<div class="product-inner">
            <div class="image">
	    			<!--<span class="product-label-special label">Sale</span>-->
		
		<a href="product.php?id=<?php echo $productid?>"><img src="image/product/big/<?php echo $image1?>" alt="<?php echo $alt?>"></a>

      </div>
           
      <div class="product-meta">
      <div class="name"><a href="product.php?id=<?php echo $productid?>"><?php echo $productname?></a></div>
 
	  <?php
					if($bproduct_discount > 0) {
					?>	
            <div class="price">
        				<span class="price-old"><?php echo $price?></span> <span class="price-new"><br />Rs. <?php echo $sale_price?></span>	
				        </div>
      <?php }else{ ?>
      <div class="price">
						Rs. <?php echo $price?>
					</div>
                    <?php } ?>
    	<!--<div class="group-action">
	      	<div class="cart">
				<input value="Add to Cart" onClick="addToCart('97');" class="button" type="button">
			</div>-->
			<!--<div class="wishlist"> <a onClick="addToWishList('97');" title="Add to Wish List">Add to Wish List</a></div>
			<div class="compare"><a onClick="addToCompare('97');" title="Add to Compare">Add to Compare</a></div>
		</div>-->
      </div>
      </div>
    </div>
	  
                             <?php
                       }
						   ?>
					 </div>
							
			  
    </div>
  </div>
   </div>