<?php
include("include/header.inc.php");
if(isset($_POST["btnupdate"]) && isset($_REQUEST["catid"]))
{

$cat = new mysql();

if($_FILES["imgsmall"]["error"] == 0)
{
	if($_FILES["imgsmall"]["type"]== "image/jpeg" || $_FILES["imgsmall"]["type"]== "image/jpg" || $_FILES["imgsmall"]["type"]== "image/pjpeg")
	{
		 move_uploaded_file($_FILES["imgsmall"]["tmp_name"],"../image/category/".$_FILES["imgsmall"]["name"]);
		 $cat->stmt = "update tblcategory set imagename='".$_FILES["imgsmall"]["name"]."' where catid=".$_REQUEST["catid"];
		 $cat->execute();
	}
}

if($_FILES["imgbanner"]["error"] == 0)
{
	if($_FILES["imgbanner"]["type"]== "image/jpeg" || $_FILES["imgbanner"]["type"]== "image/jpg" || $_FILES["imgbanner"]["type"]== "image/pjpeg")
	{
		 move_uploaded_file($_FILES["imgbanner"]["tmp_name"],"../image/category/".$_FILES["imgbanner"]["name"]);
		 $cat->stmt = "update tblcategory set bannerimage='".$_FILES["imgbanner"]["name"]."' where catid=".$_REQUEST["catid"];
		 $cat->execute();
	}
}

$query= "update tblcategory set parentid='".$_POST["drpcategory"]."', catname='".$_POST["txtcatname"]."', catdescription='".$_POST["txtcatdesc"]."', blockstatus='".$_POST["rdstatus"]."', alt='".$_POST["txtalt"]."',title='".$_POST["txttitle"]."',url_name='".$_POST["txturl_name"]."',sno='".$_POST["txtsno"]."',bulkdiscount='".$_POST["txtbulkdiscount"]."' where catid=".$_REQUEST["catid"];

$cat->stmt = $query;
$cat->execute();
$msg = "Category Updated Sccessfully";
}

if(isset($_POST["btnsave"]) && !isset($_REQUEST["catid"]))
{
if($_FILES["imgsmall"]["error"] == 0)
{
	if($_FILES["imgsmall"]["type"]== "image/jpeg" || $_FILES["imgsmall"]["type"]== "image/jpg" || $_FILES["imgsmall"]["type"]== "image/pjpeg")
	{
		 move_uploaded_file($_FILES["imgsmall"]["tmp_name"],"../image/category/small/".$_FILES["imgsmall"]["name"]);
	}
}
if($_FILES["imgbanner"]["error"] == 0)
{
	if($_FILES["imgbanner"]["type"]== "image/jpeg" || $_FILES["imgbanner"]["type"]== "image/jpg" || $_FILES["imgbanner"]["type"]== "image/pjpeg")
	{
		 move_uploaded_file($_FILES["imgbanner"]["tmp_name"],"../image/category/small/".$_FILES["imgbanner"]["name"]);
		
	}
}

$cat = new mysql();

$query= "insert into tblcategory set parentid='".$_POST["drpcategory"]."', catname='".$_POST["txtcatname"]."',catdescription='".$_POST["txtcatdesc"]."',blockstatus='".$_POST["rdstatus"]."',alt='".$_POST["txtalt"]."',title='".$_POST["txttitle"]."',url_name='".$_POST["txturl_name"]."',bannerimage='".$_FILES["imgbanner"]["name"]."',bstatus=1,imagename='".$_FILES["imgsmall"]["name"]."',bulkdiscount='".$_POST["txtbulkdiscount"]."',sno='".$_POST["txtsno"]."',cattype='product'";

$cat->stmt = $query;
$cat->execute();

$msg = "Category Added Sccessfully";
}

?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="../ckeditor/adapters/jquery.js"></script>

    <script type="text/javascript">
        $(function() {
            CKEDITOR.replace( 'txtcatdesc',
			{
			startupFocus : true,			
			filebrowserUploadUrl : '../image/upload.php' // you must write path to filemanager where you have copied it.
			});    
        });
    </script>
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
<form name="editcategory" action="" enctype="multipart/form-data" method="post">
<section class="content">

<?php
$parentid=0;
if(isset($_REQUEST["catid"]))
{
$cat = new mysql();
$query = "select * from tblcategory where catid=".$_REQUEST["catid"];
$cat->stmt = $query;
$cat->execute();
	if($cat_result =$cat->fetch_array())
	{
	extract($cat_result);	
	}
}	
else
{
$sno = "0";
}
?>



<table width="98%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="480" valign="top">

<table border="0" class="formbox" width="470" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">

<tr>
<td>
Parent Category
</td>
<td>

<select id="drpcategory" class="txtBox" name="drpcategory"  >
<option value="0">Select Category</option>
<?php

$maincat = new mysql();
$query = "select catid as maincatid,catname as maincatname from tblcategory where parentid = 0 and bstatus=1 ";
$maincat->stmt = $query;
$maincat->execute();
while($maincat_result =$maincat->fetch_array())
{
extract($maincat_result);
	if(isset($_REQUEST["catid"]))
	{
		if($parentid==$maincatid)
		echo "<option value='".$maincatid."' selected='true'>".$maincatname."</option>";
		else
		echo "<option value='".$maincatid."'>".$maincatname."</option>";
	}
	else
	echo "<option value='".$maincatid."'>".$maincatname."</option>";
}
?>
</select>

</td>
</tr>





<tr>
<td>
Category Name
</td>
<td>
<input type="text" class="txtBox" name="txtcatname" value="<?php echo $catname ?>" />
</td>
</tr>





<tr >
<td >
Serial No
</td>
<td >
<input type="text" class="txtBox" name="txtsno"  value="<?php echo $sno ?>" />
</td>
</tr>

<tr >
<td >
Block Status
</td>
<td >
<input type="radio" class='btnradio' name="rdstatus" <?php if($blockstatus=='active') echo "checked='checked'  " ?> value='active' />Active
<span style="padding-left:42px"><input type="radio" class='btnradio' name="rdstatus" <?php if(  $blockstatus!='active') echo "checked='checked'  " ?> value='block'/>Block</span>
</td>
</tr>

<tr >
<td >
Title
</td>
<td >
<input type="text" class="txtBox" name="txttitle"  value="<?php echo $title ?>" />
</td>
</tr>

<tr >
<td >
Url Name
</td>
<td >
<input type="text" class="txtBox" name="txturl_name"  value="<?php echo $url_name ?>" />
</td>
</tr>




<tr  style="display:none;">
<td>Bulk Discount</td>
<td><input type="text" class="txtBox" name="txtbulkdiscount"  value="<?php echo $bulkdiscount ?>" /></td>
</tr>

<tr >
<td >
Upload Category Image
</td>
<td >
<input type="file" name="imgsmall" style="width:200px;" />
</td>
</tr>


<tr >
<td >
Alt For Image
</td>
<td >
<input type="text" class="txtBox" name="txtalt"  value="<?php echo $alt ?>" />
</td>
</tr>

<tr style="display:none;">
<td >
Upload Category Banner Image
</td>
<td >
<input type="file" name="imgbanner" style="width:200px;" />
</td>
</tr>


</table>
</td>
<td  valign="top">

<table class="formbox" width="300" cellpadding="4" cellspacing="0">
<tr >
<td >
Category Image
</td>
</tr>
<tr>
<td>
<img src="../image/category/<?php echo $imagename ?>" width="150" />
</td>
</tr>

<tr style="display:none;">
<td >
Category Banner Image
</td>
</tr>
<tr style="display:none;">
<td>
<img src="../image/category/<?php echo $bannerimage ?>" width="150" />
</td>
</tr>


</table>
</td>
</tr>

<tr>
		<td colspan="2">
		Category Description
		<br />
        <textarea id="txtcatdesc" name="txtcatdesc"><?=$catdescription?></textarea>
	
		</td>
	</tr>

<tr >
<td style="padding:10px 10px 10px 200px;" >
<input type="hidden" name="hidparentid" id="hidparentid" value="<?=$parentid?>"  />
<?php 
					if(isset($_REQUEST["catid"]))
					echo "<input type='submit' name='btnupdate' value='Save' style='width:43px' onclick='return checkform();'/>";
					else
					echo "<input type='submit' name='btnsave' value='Save' style='width:43px'  onclick='return checkform();'/>" 
					?>
					&nbsp;&nbsp;&nbsp;
<input type="button" name="btncancel" value="Cancel" onclick='location.href="category.php"' />
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