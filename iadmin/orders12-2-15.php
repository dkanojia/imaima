<?php
include("include/header.inc.php");
include("include/left.inc.php");
?>

 <div id="adminContent">
<?php include("include/contentheader.inc.php"); ?>
<div id="contentArea" align="center">

<script language="javascript" type="text/javascript">

function confirmdelete()
{
return confirm("Are you sure to delete this Order");
}

function getselectedorder(id)
{
var status = document.getElementById(id).value;
location.href="orders.php?status="+status;
}

</script>


<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<?php
if(isset($_SESSION["opmsg"]))
{
echo "<tr class='tablerow'><td colspan='11'>".$_SESSION["opmsg"]."</td></tr>";
session_unset("opmsg");
}
?>
<tr class="tableheading" style="font-weight:bold;">
<td colspan="11">
<select name="selstatus" id="selstatus" onchange="getselectedorder(this.id);">
	<option value="All" <?php if(strtolower($_REQUEST['status'])=="all") echo "selected='true'"; ?>>All</option>
	
	<?php
	
	$cat = new mysql();
$query = "select distinct a.orderstatus as orderstatus from tblorder a where a.bstatus=1 and a.orderstatus<>'Pending' ";


$query .=" order by a.orderstatus ";
$cat->stmt = $query;
$cat->execute();
	while($cat_result =$cat->fetch_array())
	{	
	extract($cat_result);
	?>
	<option value="<?=$orderstatus?>" <?php if(strtolower($_REQUEST["status"])==strtolower($orderstatus)) echo "selected='true'"; ?>><?=$orderstatus?></option>
	<?php
	}
	?>
</select>
</td>
</tr>

<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Order No</td>
<td>Order Date </td>
<td>Login Id</td>
<td>Country </td>
<td>Item Total </td>
<td>Discount </td>
<td>Shipping </td>
<td>Grand Total </td>
<td>Status</td>
<td>Delete</td>
</tr>

<?php
$cat = new mysql();
$query = "select a.*,b.loginid from tblorder a left outer join tbluser b on a.userid=b.nid where a.bstatus=1 and a.orderstatus<>'Pending' ";
if(strtolower($_REQUEST["status"])!="all")
$query .=" and a.orderstatus='".$_REQUEST['status']."'";

$query .=" order by a.orderid desc ";
$cat->stmt = $query;
$cat->execute();
$sno = 0;
	while($cat_result =$cat->fetch_array())
	{
	$sno = $sno + 1;
	extract($cat_result);
	echo "<tr class='tablerow'>";
	echo "<td>".$sno."</td>";
	echo "<td><a href='vieworder.php?id=".$orderid."'>".$orderno."</a></td>";
	echo "<td>".$orderdate."</td>";
	echo "<td><a href='editusers.php?id=".$userid."'>".$loginid."</a></td>";
	echo "<td>".$ship_country."</td>";
	echo "<td>".$itemtotal."</td>";	
	echo "<td>".$discountamount."</td>";
	echo "<td>".$shipping."</td>";
	echo "<td>".$grandtotal."</td>";	
    echo "<td>".$orderstatus."</td>";
	echo "<td><a href='deleteorder.php?orderid=".$orderid."' onclick='return confirmdelete();'>Delete</a></td>";
    echo "</tr>";
    
	}
?>

</table>



</div>
</div>


<?php
include("include/footer.inc.php");
?>