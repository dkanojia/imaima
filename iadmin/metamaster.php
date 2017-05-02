<?php
include("include/header.inc.php");?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php include("include/left.inc.php");?>

<aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<script language="javascript" type="text/javascript">
function confirmfunction()
{
return confirm("Are you sure to delete this Meta type");
}
</script>
<section class="content">
<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<?php
if(isset($_SESSION["opmsg"]))
{
echo "<tr class='tablerow'><td colspan='4'>".$_SESSION["opmsg"]."</td></tr>";
unset($_SESSION["opmsg"]);
}
?>
<tr class="tableheading" style="font-weight:bold;">
<td colspan="4" align="left"><a href="addmetamaster.php">Add New Meta Type</a></td>
</tr>
<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Meta Type</td>
<td>Status</td>
<td>Command</td>
</tr>



<?php
$cat = new mysql();
$query = "select * from tblmeta_master where bstatus=1 ";
$cat->stmt = $query;
$cat->execute();
$i=1;
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);

	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";
    echo "<td><a href='addmetamaster.php?metaid=".$metaid."'>".$metaname."</a></td>";
    echo "<td>".$activestatus."</td>";
    echo "<td><a href='deletemetamaster.php?metaid=".$metaid."' onclick='return confirmfunction();'>Delete</a></td>";
    echo "</tr>";
    $i = $i + 1;
	}
?>

</table>


</section>


<?php
include("include/footer.inc.php");
?>