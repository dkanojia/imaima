
<script language="javascript" type="text/javascript">
	  $(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});
</script>
<section id="slideshow" class="pav-slideshow">
<div class="container">
		<div class="container-inner">			
		<div class="layerslider-wrapper" style="max-width:940px;">
        <div class="flexslider">
  <ul class="slides">       
       	<?php
		//print_r($_REQUEST);
		$banner = new mysql();
		$banner_sql= "select * from tblcategory where catid in ( select parentid from tblcategory where catid='".$_REQUEST['id']."') and blockstatus='active' and bstatus=1";
		$banner->stmt = $banner_sql;
		$banner->execute();
		while($banner_result =$banner->fetch_array())
			{
				extract($banner_result);
			//print_r($banner_result);
				
		  	?>
         <li><img src="image/category/small/<?php echo $bannerimage ?>" /></li>
         
        <?php /*?>  <li><a href="<?=$link?>"><img src="image/category/small/<?php echo $bannerimage?>" /></a></li><?php */?>
          

    <?php } ?>
    
  </ul>
</div>
			
 </div>
 
		</div>
	</div>
</section>