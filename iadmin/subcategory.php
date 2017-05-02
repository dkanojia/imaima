<?php
include("include/header.inc.php");?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
?>

<aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">

<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr class="tablerow">
<td colspan="3">

<script language="javascript" type="text/javascript">


function searchproduct()
{
var catid = document.getElementById("drpcategory").value;
var srchtxt = document.getElementById("txtsearch").value;
if(catid==0)
location.href="subcategory.php";
else
location.href="subcategory.php?catid="+catid+"&srch="+srchtxt;

}

function confirmfunction()
					{
					return confirm("Are you sure to delete this category");
					}

</script>


<select id="drpcategory" name="drpcategory" onchange="searchproduct();">
<option value="0">Select Category</option>
<?php
$maincat = new mysql();
$query = "select * from tblcategory where parentid=0 and bstatus=1 ";
$maincat->stmt = $query;
$maincat->execute();
$searchcatid = "0";
$i=1;
while($maincat_result =$maincat->fetch_array())
{
extract($maincat_result);
	if(isset($_REQUEST["catid"]))
	{
	    $searchcatid =$_REQUEST["catid"];
		if($_REQUEST["catid"]==$catid)
		echo "<option value='".$catid."' selected='true'>".$catname."</option>";
		else
		echo "<option value='".$catid."'>".$catname."</option>";
	}
	else if($i==1)
	{
	echo "<option value='".$catid."' selected='true'>".$catname."</option>";
	$searchcatid =$catid;
	}
	else
	echo "<option value='".$catid."'>".$catname."</option>";
	$i= $i + 1;
}
?>
</select>

</td>
<td colspan="3" align="right">
Search &nbsp; <input type="text" id="txtsearch" /> 
<input type="button" value="Search" class="btn" onclick="searchproduct();" />
</td>
</tr>
<tr class="tableheading" style="font-weight:bold;">
						<?php
						echo "<td colspan='6' align='left'><a href='editcategory.php'>Add New Subcategory</a></td>"; ?>
					</tr>
<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Image</td>
<td>Category Name</td>
<td>Description</td>
<td>Active Status</td>
<td>Command</td>
</tr>

<?php
if($searchcatid!="0")
{
$cat = new mysql();
$query = "select * from tblcategory where parentid=".$searchcatid." and bstatus=1 and (catname like '%".$_REQUEST["srch"]."%' or catdescription like '%".$_REQUEST["srch"]."%') order by catname";



$cat->stmt = $query;
$cat->execute();
$i = 1;
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";
	echo "<td><img src='../image/category/small/".$imagename."' width='100' border='0' /></td>";
    echo "<td><a href='editcategory.php?catid=".$catid."'>".$catname."</a></td>";
    echo "<td>".$catdescription."</td>";
    echo "<td>".$blockstatus."</td>";
    echo "<td><a href='products.php?subcatid=".$catid."'>View Products</a><br /><a href='metacontent.php?metatypeid=".$catid."&metatype=Subcat'>Meta Content</a><br /><a href='deletecategory.php?id=".$catid."' onclick='return confirmfunction();'>Delete</a></td>";
    echo "</tr>";
    $i = $i + 1;
	}
}
?>

</table>

</section>

<?php
include("include/footer.inc.php");
?>