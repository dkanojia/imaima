<?php
include("include/header.inc.php");
if(isset($_POST["btnupdate"]) && isset($_REQUEST["id"]))
{

$cat = new mysql();

if($_FILES["bannerimage"]["error"] == 0)
{
	if($_FILES["bannerimage"]["type"]== "image/jpeg" || $_FILES["bannerimage"]["type"]== "image/jpg" || $_FILES["bannerimage"]["type"]== "image/png" || $_FILES["bannerimage"]["type"]== "image/pjpeg")
	{
		 move_uploaded_file($_FILES["bannerimage"]["tmp_name"],"../image/banner/".$_FILES["bannerimage"]["name"]);
		 $cat->stmt = "update tblbanner set banner_image='".$_FILES["bannerimage"]["name"]."' where bannerid=".$_REQUEST["id"];
		 $cat->execute();
	}
}

$query= "update tblbanner set banner_name='".$_POST["banner_name"]."', title='".$_POST["banner_title"]."', link='".$_POST["banner_link"]."', blockstatus='".$_POST["rdstatus"]."', alt='".$_POST["txtalt"]."' where bannerid=".$_REQUEST["id"];

$cat->stmt = $query;
$cat->execute();
$msg = "Banner Updated Sccessfully";
}

if(isset($_POST["btnsave"]) && !isset($_REQUEST["id"]))
{
if($_FILES["bannerimage"]["error"] == 0)
{
	if($_FILES["bannerimage"]["type"]== "image/jpeg" || $_FILES["imgsmall"]["type"]== "image/jpg" || $_FILES["bannerimage"]["type"]== "image/png" || $_FILES["imgsmall"]["type"]== "image/pjpeg")
	{
		 move_uploaded_file($_FILES["bannerimage"]["tmp_name"],"../image/banner/".$_FILES["bannerimage"]["name"]);
	}
}

$cat = new mysql();

$query= "insert into tblbanner set banner_name='".$_POST["banner_name"]."', title='".$_POST["banner_title"]."',link='".$_POST["banner_link"]."',blockstatus='".$_POST["rdstatus"]."',alt='".$_POST["txtalt"]."',bstatus=1, banner_image='".$_FILES["bannerimage"]["name"]."',date='".date('Y-m-d H:i:s')."'";

$cat->stmt = $query;
$cat->execute();

$msg = "Banner Added Sccessfully";
}



?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); 
?>
<script language="javascript" type="text/javascript">
function checkform()
{
var parentid = document.getElementById("hidparentid").value;
var currentparent = document.getElementById("drpcategory").value;
if(parentid!=0 && currentparent==0)
{
alert("select parent category ");
return false;
}
}
</script>
<form name="bannerform" action="" enctype="multipart/form-data" method="post">


<?php
$parentid=0;
if(isset($_REQUEST["id"]))
{
$banner = new mysql();
$query = "select * from tblbanner where bannerid=".$_REQUEST["id"];
$banner->stmt = $query;
$banner->execute();
	if($banner_result =$banner->fetch_array())
	{
	extract($banner_result);	
	if($banner_image==''){
		$banner_image='noimage.jpg';
	}

	}
}	
?>

<section class="content">

<table width="98%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="480" valign="top">

<table border="0" class="formbox" width="470" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">

<tr>
<td>
Banner Name
</td>
<td>
<input type="text" class="txtBox" name="banner_name" value="<?php echo $banner_name ?>" />
</td>
</tr>

<tr >
<td >
Banner Title
</td>
<td >
<input type="text" class="txtBox" name="banner_title"  value="<?php echo $title ?>" />
</td>
</tr>

<tr >
<td >
Banner Link
</td>
<td >
<input type="text" class="txtBox" name="banner_link"  value="<?php echo $link ?>" />
</td>
</tr>

<tr >
<td >
Block Status
</td>
<td >
<input type="radio" class='btnradio' name="rdstatus" <?php if(isset($blockstatus) && $blockstatus=='Active') echo "checked='checked'  " ?> value='Active' />Active
<span style="padding-left:42px"><input type="radio" class='btnradio' name="rdstatus" <?php if( isset($blockstatus) && $blockstatus=='Block') echo "checked='checked'  " ?> value='Block'/>Block</span>
</td>
</tr>


<tr >
<td >
Upload Banner Image
</td>
<td >
<input type="file" name="bannerimage" style="width:200px;" />
</td>
</tr>


<tr >
<td >
Alt For Banner Image
</td>
<td >
<input type="text" class="txtBox" name="txtalt"  value="<?php echo $alt ?>" />
</td>
</tr>



</table>
</td>
<td  valign="top">

<table class="formbox" width="300" cellpadding="4" cellspacing="0">
<tr >
<td >
Banner Image
</td>
</tr>
<tr>
<td>
<?php if(isset($_REQUEST['id'])) { ?>
<img src="../image/banner/<?php echo $banner_image?>" width="150" />
<?php }else{?>
	<img src="../image/banner/<?php echo $banner_image?>" width="150" />
	<?php }?> 
</td>
</tr>



</table>
</td>
</tr>

<tr >
<td style="padding:10px 10px 10px 200px;" >

<?php 
					if(isset($_REQUEST["id"]))
					echo "<input type='submit' name='btnupdate' value='Update' style='width:57px' onclick='return checkform();'/>";
					else
					echo "<input type='submit' name='btnsave' value='Save' style='width:57px'  onclick='return checkform();'/>" 
					?>
					&nbsp;&nbsp;&nbsp;
<input type="button" name="btncancel" value="Cancel" onclick='location.href="banner.php"' />
</td>
</tr>
<tr >
					<td >
					<?php echo $msg; ?>
					</td>
				</tr>



</table>
</section>


</form>

<?php
include("include/footer.inc.php");
?>