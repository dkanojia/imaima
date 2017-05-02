<?php

if(!isset($_REQUEST["catid"]) && !isset($_REQUEST["tid"]) && !isset($_REQUEST["catname"]))
header("location:".$glob['rootRel']);

include('includes/db.inc.php');
include('includes/common_post.php');


$urlcatid="0";
$pagetitle="Imaima Collection";
$metatype = 'subcat';
$metatypeid ="0";
if(isset($_REQUEST["catname"]))
{
	$leftsubcat = new mysql();
	$leftsubcat->stmt = "select *,catdescription as currentpagecontent from tblcategory where url_name='".$_REQUEST["catname"]."'";
	$leftsubcat->execute();
	if($leftsubcat_result =$leftsubcat->fetch_array())
	{
	extract($leftsubcat_result);
	$urlcatid=$catid;	
	$pagetitle=$title;
	$metatypeid =$catid;	
	}
}

if(isset($_REQUEST["catid"]))
{
	$leftsubcat = new mysql();
	$leftsubcat->stmt = "select *,catdescription as currentpagecontent from tblcategory where catid=".$_REQUEST["catid"];
	$leftsubcat->execute();
	if($leftsubcat_result =$leftsubcat->fetch_array())
	{
	extract($leftsubcat_result);	
	$urlcatid=$catid;	
	$pagetitle=$title;
	$metatypeid =$catid;
	}
}

if(isset($_REQUEST["tid"]))
{
	$leftsubcat = new mysql();
	$query = "select *,pagecontent as currentpagecontent from tblpage_content where pageid=(select pageid from tblproduct_tag where tagid=".$_REQUEST["tid"].")";
	
	$leftsubcat->stmt = $query;
	$leftsubcat->execute();
	while($leftsubcat_result =$leftsubcat->fetch_array())
	{
	extract($leftsubcat_result);
	$metatype='page';	
	$metatypeid =$_REQUEST["tid"];
	}
}
		
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php 
include('includes/links.php');
?>


<title><?=$pagetitle?></title>

<?php
$meta = new mysql();
$query = "select a.* from tblmeta a inner join tblmeta_master b on a.metaid=b.metaid where a.metatype='".$metatype."' and a.activestatus='active' and a.bstatus=1 and b.activestatus='active' and b.bstatus=1 and a.typeid='".$metatypeid."'";

$meta->stmt = $query;
$meta->execute();
while($meta_result =$meta->fetch_array())
{
extract($meta_result);
echo "<meta  content='".$metacontent."' />";
}
?>

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
  
   <div class="col-md-12 col-sm-12 col-xs-12" style=" margin-bottom:15px; width:100%; color:#000000;">
    	
        <?=$currentpagecontent?>
      
    </div>
     
 
   
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="filter">
          <!--  <h3>Filter :</h3>-->
            <div class="panel-group" id="accordion" style="display: block; border-bottom: solid 1px #7f7f7f; width:100%;">
               
              
               <? include('includes/filter.php'); ?>
            </div>
        </div>
    </div>                       
                 
    <div class="js-slider slick-initialized slick-slider" style="width:100%;">
      
      
      <?php
	  
	  		$sizesubquery = " select distinct n.productid  from tblproduct m inner join tblproduct_price n on m.productid=n.productid where m.blockstatus='active' and m.bstatus=1 and n.bstatus=1 and n.blockstatus='active'";
							if($urlcatid!="0")
							{
							$sizesubquery = $sizesubquery . " and m.catid=".$urlcatid;
							} 
							if(isset($_REQUEST["tid"]))
							{
							$sizesubquery = $sizesubquery . " and FIND_IN_SET(".$_REQUEST["tid"].",m.product_tag)";
							}
							if(isset($_REQUEST["sz"]))
							{
							$sizesubquery = $sizesubquery ." and ( n.sizeid=".$_REQUEST["sz"]." or n.alias_sizeid=".$_REQUEST["sz"]." )";	 
							}
							
											
											
	  	$btag = new mysql();
							$query = "select a.prourl_name,a.productid,a.productname,a.productcode,a.productdesc,a.image1,a.image2,b.sale_price,a.shortdesc,d.url_name as url_maincatname,c.url_name as url_catname from tblproduct a inner join  tblproduct_price b on a.default_priceid=b.nid inner join tblcategory c on a.catid=c.catid inner join tblcategory d on c.parentid=d.catid  where a.bstatus=1 and a.blockstatus='active'";
							
							if($urlcatid!="0")
							{
							$query = $query . " and a.catid=".$urlcatid;
							} 
							if(isset($_REQUEST["tid"]))
							{
							$query = $query . " and FIND_IN_SET(".$_REQUEST["tid"].",product_tag)";
							} 
											
							if(isset($_REQUEST["c"]))
							{
							$query = $query ." and a.product_colorid=".$_REQUEST["c"];		 
							}
							
							if(isset($_REQUEST["st"]))
							{
							$query = $query ." and a.styleid=".$_REQUEST["st"];		 
							}
							
							if(isset($_REQUEST["sz"]))
							{
							$query = $query ." and a.productid in (".$sizesubquery.")";		 
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
							$i=1;
							while($btag_result = $btag->fetch_array())
							{
							extract($btag_result);
							$prourl = $glob['rootRel'].$btag->geturlstring($url_maincatname)."/".$btag->geturlstring($url_catname)."/".$btag->geturlstring($prourl_name).".html";
							if($i==1)
							{
							echo "<ul class='productlist_ul_padding' style=' min-height:500px;'>";
							}
							?>
                             <li style="width:300px; height:555px; overflow:hidden;"> <div  style="width:275px; height:410px; overflow:hidden;"> <a href="<?=$prourl?>"> <img width="275px;" src="image/product/big/<?=$image1?>"> <span><img width="275px;" src="image/product/big/<?=$image2?>"</span></a>
                             <form method="post" action="" name="frmwishlist" id="frmwishlist<?=$i?>">
                             <img id="imgw<?=$i?>" src="images/wishlist0.png" style="position:absolute; width:20px; z-index:98; top:5px; left:243px;" onMouseOver="changewishlist_image(this.id,'images/wishlist1.png')"  onMouseOut="changewishlist_image(this.id,'images/wishlist0.png')" onClick="submit_wishlist(<?=$i?>);">
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
							
							echo "</ul>";
							
	  ?>
       
      
      
      <?
	  if($i==1)
	  {
		$leftsubcat = new mysql();
		$query = "select * from tblpage_content where pageid=16";
		
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
	  }
	  ?>
      
    </div>
  </div>
</div>
</div>
</div>
<?php 
include('includes/footer.php');
?>
