<?php 
include('includes/db.inc.php');
$page = new mysql();
$urlpageid="0";
if(isset($_REQUEST['id']))
{
$urlpageid = $_REQUEST['id'];
}



$query = "select pagecontent as currentpagecontent,pagetitle as currentpagetitle from tblpage_content where pageid='".$urlpageid."' and blockstatus='active' and bstatus=1";

$page->stmt = $query;
$page->execute();
if($page_result = $page->fetch_array())
{
	extract($page_result);
}
else
{
	header("location:".$glob['rootRel']);
	return;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?=$currentpagetitle?></title>
<?php 
include('includes/links.php');
?>
 <link rel="stylesheet" href="<?=$glob['rootRel']?>css/meet-the-maker.css">


<?php
$meta = new mysql();
$query = "select a.* from tblmeta a inner join tblmeta_master b on a.metaid=b.metaid where a.metatype='page' and a.activestatus='active' and a.bstatus=1 and b.activestatus='active' and b.bstatus=1 and a.typeid='".$urlpageid."'";
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
<div style="width:97%; margin:0px auto; min-height:400px;">
<div class="leftproduct_menu_inner" style="float:left;">
<?php
include('includes/leftpart.php');
?>
</div>
<div class="rightproduct_menu_inner" style="float:left;">

	<div class="content-block sale-promo-wrapper products-carousel" style="padding-top:0px; "> 
  
    <div class="js-slider slick-initialized slick-slider" style="width:100%; vertical-align:top; text-align:left; overflow-x:auto;">
    	<?=$currentpagecontent?>
    </div></div>
</div>
</div>


<?php 
include('includes/footer.php');
?>