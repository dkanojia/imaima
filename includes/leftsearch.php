
<div class="box">
  <h3 class="box-heading"><span>Refine Search</span></h3>
  <div class="box-content">
  
  <form name="search" action="" method="post">
    <ul class="box-filter">
    
    
            <li><span id="filter-group3">Brands</span>
        <ul style="max-height:180px; overflow:auto;">
        <?php 
		$brand = new mysql();		
		$query = "select distinct a.brandid,a.brandname  from tblbrand a inner join tblproduct b on a.brandid=b.product_brand where b.catid='".$_REQUEST['id']."' and a.blockstatus='active' and a.bstatus=1 and b.blockstatus='active' and b.bstatus=1 order by a.brandname";		
		$brand->stmt=$query;
		$brand->execute();
		while($brand_result = $brand->fetch_array())
		{
		extract($brand_result);	
		if(isset($_REQUEST['bid'])){
            	$bid = explode(',',$_REQUEST['bid']);
				
            }
		?>	
        	
     <li><input name='brandname[]'  <?php if(isset($_REQUEST['bid']) && in_array($brandid, $bid) ){ ?> checked='checked' <?php } ?>  value=<?=$brandid?> id='brandname'  type='checkbox'>&nbsp;<label for='filter[]'><?=$brandname?></label>
       </li>
             <!-- echo "<li><input name='brandname[]'  if(isset($_REQUEST['bid']) && $_REQUEST['bid']==$brandid){ checked='checked' }  value='$brandid' id='brandname'  type='checkbox'>"." "."<label for='filter[]'>".$brandname."</label>";
            echo "</li>";-->
		  <?php }
		  ?>
                            </ul>
      </li>
            <li><span id="filter-group1">color</span>
       <ul style="max-height:180px; overflow:auto;">
        
          <?php 
		$color = new mysql();
		
		$query = "select a.*,b.*  from tblcolor a inner join tblcategory b on a.catid=b.parentid where b.catid='".$_REQUEST['id']."' and a.blockstatus='active' and a.bstatus=1";
		
		$color->stmt=$query;
		$color->execute();
		while($color_result = $color->fetch_array())
		{
		extract($color_result);	
		if(isset($_REQUEST['cid'])){
            	$cid = explode(',',$_REQUEST['cid']);
				
            }
			?>
	   <li><input name='colorname[]'  <?php if(isset($_REQUEST['cid']) && in_array($colorid, $cid) ){ ?> checked='checked' <?php } ?>  value=<?=$colorid?> id='colorname'  type='checkbox'>&nbsp;<label for='filter[]'><?=$colorname?></label>
       </li>
		<!--echo "<li><input if(isset($_REQUEST['cid']) && $_REQUEST['cid']==$colorid){ checked='checked'  } name='colorname[]' value='$colorid' id='colorname'   type='checkbox'>"." "."<label for='filter[]'>".$colorname."</label>";
		
		  echo "</li>";-->
	
		<?php
        
		   }
		  ?>
                            </ul>
      </li>
    
      
      <li><span id="filter-group3">Size</span>
        <ul style="max-height:180px; overflow:auto;">
        <?php 
		$size = new mysql();
		$query = "select distinct a.sizeid,a.sizename  from tblsize a inner join tblproduct_price b on a.sizeid=b.sizeid inner join tblproduct c on b.productid=c.productid where c.catid='".$_REQUEST['id']."' and b.blockstatus='active' and b.bstatus=1 order by a.sizename";

		$size->stmt=$query;
		$size->execute();
		while($size_result = $size->fetch_array())
		{
		extract($size_result);
		
		     	if(isset($_REQUEST['sid'])){
            	$sid = explode(',',$_REQUEST['sid']);
				
            }
			?>
	   <li><input name='sizename[]'  <?php if(isset($_REQUEST['sid']) && in_array($sizeid, $sid) ){ ?> checked='checked' <?php } ?>  value=<?=$sizeid?> id='sizename'  type='checkbox'>&nbsp;<label for='filter[]'><?=$sizename?></label>
       </li>
              <!--echo "<li><input name='sizename[]' value='$sizeid' id='sizename' type='checkbox'>"." "."<label for='filter[]'>".$sizename."</label>";
              
          echo "</li>";-->
		  <?php
		  }
		  ?>
                            </ul>
      </li>
          </ul>
            <input type="submit" name="leftsearch_submit"  value="Refine Search" id="button-filter" class="button">
          </form>
  
  </div>
</div>