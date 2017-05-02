<?php
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
?>
<?php

if(isset($_POST["btnsubmit"]))
{
	$title = new mysql();
	$query = $_POST["hidtitlequery"];
	$query = str_replace("#metatitle#",$_POST["txttitle"],$query);
	$title->stmt = $query;
	$title->execute();
}


if(isset($_POST["btnsave"]))
{
$page = new mysql();
$query = "select * from tblmeta where typeid=".$_REQUEST["metatypeid"]." and metatype='".$_REQUEST["metatype"]."' and metaid=".$_POST["hidmetaid"];
$page->stmt = $query;
$page->execute();
if($page_result =$page->fetch_array())
	{
	 $query = "update tblmeta set metacontent='".$_POST["txtdescription"]."' where typeid=".$_REQUEST["metatypeid"]." and metatype='".$_REQUEST["metatype"]."' and metaid=".$_POST["hidmetaid"];
	 $page->stmt = $query;
     $page->execute();
	}
	else
	{
	$query = "insert into tblmeta set metacontent='".$_POST["txtdescription"]."',typeid=".$_REQUEST["metatypeid"].",metatype='".$_REQUEST[ "metatype"]."' ,metaid=".$_POST["hidmetaid"].",activestatus='active',bstatus=1";
	 $page->stmt = $query;
     $page->execute();
	}
}
?>



 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">

<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr class="tablerow">
<td colspan="6">
<?php
$titleupdatequery ="";
$metatypeval = $_REQUEST["metatype"];
switch($_REQUEST["metatype"])
{
case "Cat" : $metatypeval = "Main Category"; 
$query = "select catname as metaval,title as metatitle from tblcategory where catid=".$_REQUEST["metatypeid"];
$titleupdatequery = "update tblcategory set title='#metatitle#' where catid=".$_REQUEST["metatypeid"];
break;

case "Subcat" : $metatypeval = "Sub Category"; 
$query = "select CONCAT(a.catname,' - ',b.catname) as metaval,a.title as metatitle from tblcategory a,tblcategory b where a.parentid=b.catid and a.catid=".$_REQUEST["metatypeid"];
$titleupdatequery = "update tblcategory set title='#metatitle#' where catid=".$_REQUEST["metatypeid"];
break;

case "Page" : $metatypeval = "Content Page"; 
$query = "select pagename as metaval,pagetitle as metatitle from tblpage_content where pageid=".$_REQUEST["metatypeid"];
$titleupdatequery = "update tblpage_content set pagetitle='#metatitle#' where pageid=".$_REQUEST["metatypeid"];
break;

case "product" : $metatypeval = "Product";
$query = "select productname as metaval,title as metatitle from tblproduct where productid=".$_REQUEST["metatypeid"];
$titleupdatequery = "update tblproduct set title='#metatitle#' where productid=".$_REQUEST["metatypeid"];
break;


}

$meta = new mysql();
$meta->stmt = $query;
$meta->execute();
$meta_result =$meta->fetch_array();
extract($meta_result);
?>
Meta content for : <?php echo $metaval." ( ".$metatypeval." )"; ?>
<?php
$page = new mysql();
$query = "select a.metaid as metamasterid,a.metaname,b.* from tblmeta_master a left outer join (select * from tblmeta where typeid=".$_REQUEST["metatypeid"]." and metatype='".$_REQUEST["metatype"]."') b on a.metaid=b.metaid where a.activestatus='active' and a.bstatus=1 order by a.metaname";
$page->stmt = $query;
$page->execute();
?>


</td>
</tr>

<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Meta Name</td>
<td>Meta Description</td>
<td>Meta Type</td>
<td>Meta Status</td>
<td>Command</td>
</tr>

<?php
if(isset($_REQUEST["metatypeid"]))
{
    $i = 1;
	while($page_result =$page->fetch_array())
	{
	extract($page_result);
    if(isset($_REQUEST["meta"]) && $_REQUEST["meta"]==$metamasterid)
	{
	?>
	<form method="post" action="metacontent.php?metatypeid=<?php echo $_REQUEST["metatypeid"];?>&metatype=<?php echo $_REQUEST["metatype"];?>">
    <tr class='tablerow'><td><?php echo $i; ?></td>
    <td><?php echo $metaname; ?></td>";
	<td width="200">
	<input type="hidden" id="hidmetaname" name="hidmetaname" value="<?php echo $metaname; ?>"  />	
	<input type="hidden" id="hidmetaid" name="hidmetaid" value="<?php echo $metamasterid; ?>"  />	
	<textarea id="txtdescription" name="txtdescription" rows="2" cols="25"><?php echo $metacontent; ?></textarea>
	</td>
	<?php
	echo "<td>".$metatype."</td>";
	echo "<td>".$activestatus."</td>";
    echo "<td><input type='submit' name='btnsave' value='Save'></td></tr></form>";
	}
	else
	{
	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";
    echo "<td>".$metaname."</a></td>";
    echo "<td>".$metacontent."</td>";
	echo "<td>".$metatype."</td>";
	echo "<td>".$activestatus."</td>";
    echo "<td><a href='metacontent.php?metatypeid=".$_REQUEST["metatypeid"]."&metatype=".$_REQUEST["metatype"]."&meta=".$metamasterid."'>Edit</a></td>";
    echo "</tr>";
	}
    
    echo "</tr>";
    $i = $i + 1;
	}
}
?>

</table>

<br />
<br />



<form name="titleform" method="post" action="">


<input type="hidden" id="hidtitlequery" name="hidtitlequery" value="<?=$titleupdatequery?>" />

<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr>
<td width="100">
Title
</td>
<td>
<input type="text" id="txttitle" name="txttitle" style="width:600px;" value="<?=$metatitle?>" />
</td>
<td  width="100">
<input type="submit" id="btnsubmit" name="btnsubmit" value="Save" />
</td>
</tr>
<tr>
<td colspan="3">
<?php
if(isset($_POST["btnsubmit"]))
{
echo "Title Updated Successfully";
}
?>
</td>
</tr>
</table>
</form>

</section>

<?php
include("include/footer.inc.php");
?>