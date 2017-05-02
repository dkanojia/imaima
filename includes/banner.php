
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
		$banner = new mysql();
		$banner_sql= "select * from tblbanner where blockstatus='Active' and bstatus=1";
		$banner->stmt = $banner_sql;
		$banner->execute();
		while($banner_result =$banner->fetch_array())
			{
				extract($banner_result);
			//print_r($banner_result);
				
		  	if($link==''){?>
         <li><img src="image/banner/<?php echo $banner_image ?>" title="<?=$title ?>" alt="<?=$alt?>"/></li>
         <?php }else{?>
          <li><a href="<?=$link?>"><img src="image/banner/<?php echo $banner_image?>" title="<?=$title?>" alt="<?=$alt?>"/></a></li>
          <?php } ?>
     <!--  <li>
     	 <img src="images/banner-940x360a-940x360a.png"  />
    </li>
      <li>
      <img src="images/Untitled-940x360a.jpg" />
    </li>
      <li>
      <img src="images/548051337_986-940x360a.jpg" />
    </li>-->
    <?php } ?>
    
  </ul>
</div>
			
 </div>
 
		</div>
	</div>
</section>