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
<tr class="tablerow">
<td colspan="3">

<script language="javascript" type="text/javascript">


function searchgroup()
{
var group = document.getElementById("drpgroup").value;
var srchtxt = document.getElementById("txtsearch").value;
if(group==0)
location.href="pagelist.php?srch="+srchtxt;
else
location.href="pagelist.php?group="+group+"&srch="+srchtxt;
}
</script>


<select id="drpgroup" name="drpgroup" onchange="searchgroup();">
<option value="0" <?php if($_REQUEST["group"]=="0") echo "selected='true'"; ?> >Select Group</option>
<option value="Header" <?php if($_REQUEST["group"]=="Header") echo "selected='true'"; ?>>Header</option>
<option value="Footer" <?php if($_REQUEST["group"]=="Footer") echo "selected='true'"; ?>>Footer</option>
<option value="Footer-Help" <?php if($_REQUEST["group"]=="Footer-Help") echo "selected='true'"; ?>>Footer-Help</option>

<option value="Other" <?php if($_REQUEST["group"]=="Other") echo "selected='true'"; ?>>Other</option>
</select>

</td>
<td colspan="2" align="right">
Search &nbsp; <input type="text" id="txtsearch" /> 
<input type="button" value="Search" class="btn" onclick="searchgroup();" />
</td>
</tr>
<tr class="tableheading" style="font-weight:bold;">
						<?php
						echo "<td colspan='5' align='left'><a href='addpagecontent.php'>Add New Page</a></td>"; ?>
					</tr>
<tr class="tableheading" style="font-weight:bold;">
<td>Page Name</td>
<td>Page Title</td>
<td>Page Type</td>
<td>Status</td>
<td>Command</td>
</tr>

<?php
$cat = new mysql();
if(isset($_REQUEST["group"]))
{
$query = "select * from tblpage_content where groupname='".$_REQUEST["group"]."' and bstatus=1 and (pagename like '%".$_REQUEST["srch"]."%' or pagetitle like '%".$_REQUEST["srch"]."%')";
}
else
{
$query = "select * from tblpage_content where    bstatus=1 and (pagename like '%".$_REQUEST["srch"]."%' or pagetitle like '%".$_REQUEST["srch"]."%')";
}
$cat->stmt = $query;
$cat->execute();
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
    echo "<td><a href='addpagecontent.php?pageid=".$pageid."'>".$pagename."</a></td>";
    echo "<td>".$pagetitle."</td>";
    echo "<td>".$pagetype."</td>";
    echo "<td>".$blockstatus."</td>";
    echo "<td><a href='metacontent.php?metatypeid=".$pageid."&metatype=Page'>Meta Content</a></td>";
    echo "</tr>";

	}

?>

</table>


</section>


<?php
include("include/footer.inc.php");
?>