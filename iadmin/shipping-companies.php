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

<script language="javascript" type="text/javascript">

function confirmdelete()
{
return confirm("Are you sure to delete this Company");
}

</script>


<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr class="tableheading" style="font-weight:bold;">
						<?php
						echo "<td colspan='5' align='left'><a href='editship-company.php'>Add New Company </a></td>"; ?>
					</tr>

<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Company Name</td>
<td>Address</td>
<td>Status</td>
<td>Command</td>
</tr>

<?php
$cat = new mysql();
$query = "select * from tblcourier where bstatus=1 order by sno desc ";
$cat->stmt = $query;
$cat->execute();

	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
	echo "<td>".$sno."</td>";
    echo "<td><a href='editship-company.php?id=".$nid."'>".$companyname."</a></td>";	
		echo "<td>".$address."</td>";
    echo "<td>".$blockstatus."</td>";
    echo "<td><a href='deleteship-company.php?id=".$nid."' onclick='return confirmdelete();'>Delete</a></td>";
    echo "</tr>";
    
	}
?>

</table>


</section>


<?php
include("include/footer.inc.php");
?>