<?php
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
require_once 'pagging/Pagination.class.php';
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">

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
<?php
$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
			$limit=20;
			if($page){ 
			$start = ($page - 1) * $limit; //first item to display on this page
			}else{
			$start = 0;
	}
	?>

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
<td>Currency </td>
<td>Item Total </td>
<td>Discount </td>
<td>Shipping </td>
<td>Grand Total </td>
<td>Status</td>
<td>Delete</td>
</tr>

<?php
$cat = new mysql();
$total = new mysql();
$query = "select a.*,b.loginid from tblorder a left outer join tbluser b on a.userid=b.nid where a.bstatus=1 and a.orderstatus<>'Pending' ";
if(strtolower($_REQUEST["status"])!="all")
$query .=" and a.orderstatus='".$_REQUEST['status']."'";

$cat->stmt=$query;
$cat->execute();
$count = $cat->getNumRows();

$query1 =$query." order by a.orderid desc limit ".$start.",".$limit;
$total->stmt = $query1;
$total->execute();

$sno = $start + 1;
	while($total_result =$total->fetch_array())
	{
	
	extract($total_result);
	echo "<tr class='tablerow'>";
	echo "<td>".$sno."</td>";
	echo "<td><a href='vieworder.php?id=".$orderid."'>".$orderno."</a></td>";
	echo "<td>".$orderdate."</td>";
	echo "<td><a href='editusers.php?id=".$userid."'>".$loginid."</a></td>";
	echo "<td>".$ship_country."</td>";
	echo "<td>".$currency_code."</td>";	
	echo "<td>".$subtotal."</td>";	
	echo "<td>".$discountamount."</td>";
	echo "<td>".$shipping."</td>";
	echo "<td>".$grandtotal."</td>";	
    echo "<td>".$orderstatus."</td>";
	echo "<td><a href='deleteorder.php?orderid=".$orderid."' onclick='return confirmdelete();'>Delete</a></td>";
    echo "</tr>";
    $sno++;
	}
?>

</table>

<?php
					$pagination = (new Pagination());
					$pagination->setCurrent($page);
					$pagination->setTotal($count);
					 
					  echo $markup = $pagination->parse();
			?>

</section>


<?php
include("include/footer.inc.php");
?>