<?php
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
?>

<aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">

<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr class="tableheading" style="font-weight:bold;">
						<?php
						echo "<td colspan='6' align='left'><a href='editcategory.php'>Add New Category</a></td>"; ?>
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
$cat = new mysql();
$query = "select * from tblcategory where parentid=0 and bstatus=1 ";
$cat->stmt = $query;
$cat->execute();
$i =1;
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";
	echo "<td><a href='editcategory.php?catid=".$catid."'><img src='../image/category/small/".$imagename."' width='100' border='0' /></a></td>";
    echo "<td><a href='editcategory.php?catid=".$catid."'>".$catname."</a></td>";
    echo "<td>".$catdescription."</td>";
    echo "<td>".$blockstatus."</td>";
    echo "<td><a href='subcategory.php?catid=".$catid."'>View Sub Category</a><br /><a href='metacontent.php?metatypeid=".$catid."&metatype=Cat'>Meta Content</a></td>";
    echo "</tr>";
    $i = $i + 1;
	}
?>

</table>



</section>

<?php
include("include/footer.inc.php");
?>