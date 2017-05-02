<?php
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
?>

<script language="javascript" type="text/javascript">


function searchtemplate()
{
var srchtxt = document.getElementById("txtsearch").value;
location.href="mailtemplate.php?srch="+srchtxt;
}
</script>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">

<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr class="tablerow">
<td colspan="4" align="left">
Search &nbsp; <input type="text" id="txtsearch" /> 
<input type="button" value="Search" class="btn" onclick="searchtemplate();" />
</td>
</tr>
<tr class="tableheading" style="font-weight:bold;">
<td>Template Name</td>
<td>Template Subject</td>
<td>Status</td>
<td>Command</td>
</tr>

<?php
$cat = new mysql();
$query = "select * from tbltemplate where blockstatus='active'  and (templatename like '%".$_REQUEST["srch"]."%' or subject like '%".$_REQUEST["srch"]."%')";
$cat->stmt = $query;
$cat->execute();
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
    echo "<td><a href='edittemplate.php?id=".$nid."'>".$templatename."</a></td>";
    echo "<td>".$subject."</td>";
    echo "<td>".$blockstatus."</td>";
    echo "<td><a href='edittemplate.php?id=".$nid."'>Edit</a></td>";
    echo "</tr>";

	}

?>

</table>


</section>


<?php
include("include/footer.inc.php");
?>