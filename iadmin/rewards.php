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

<script type="text/javascript">

function searchpagegroup()
{

var srchtxt = document.getElementById("txtsearch").value;

location.href = "rewards.php?srch="+srchtxt;
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
<td colspan="8">


<form action="" method="post">

<input type="text" name="txtsearch" id="txtsearch" placeholder="Search" />
<input type="button" name="btnsearch"  value="search" onClick="return searchpagegroup();" />

</form>
</td>
</tr>

<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>First Name</td>
<td>Last Name </td>
<td>Email id</td>
<td>Point dr </td>
<td>Point cr</td>
<td>Rewards Point</td>
<!--<td>Delete</td>-->
</tr>

<?php
$cat = new mysql();
$query = "select distinct a.firstname as firstname,a.lastname as lastname,a.emailid as emailid,a.nid as nid from tbluser a inner join tblpoint_transaction b on a.nid=b.userid where blockstatus='active' and bstatus=1 and firstname like '%".$_REQUEST['srch']."%'";

	$query .=" or";
    $query .=" lastname like '%".$_REQUEST['srch']."%'";
	
	$query .=" or";
	 $query .=" emailid like '%".$_REQUEST['srch']."%'";
	
	$cat->stmt = $query;
	$cat->execute();
$sno = 0;
while($cat_result =$cat->fetch_array())
	{
	$sno = $sno + 1;
	extract($cat_result);

$reward = new mysql();
 $query = "select distinct sum(point_dr) as pointdr,sum(point_cr) as pointcr from tblpoint_transaction  where userid='$nid'";
$reward->stmt = $query;
$reward->execute();

	$reward_result =$reward->fetch_array();
	extract($reward_result);
	$rewardpoint = $pointdr-$pointcr;
	
	echo "<tr class='tablerow'>";
	echo "<td>".$sno."</td>";
	echo "<td>".$firstname."</td>";
	echo "<td>".$lastname."</td>";
	echo "<td>".$emailid."</td>";	
	echo "<td>".$pointdr."</td>";
	echo "<td>".$pointcr."</td>";
	echo "<td>".$rewardpoint."</td>";	
	//echo "<td><a href='deleteorder.php?orderid=".$orderid."' onclick='return confirmdelete();'>Delete</a></td>";
    echo "</tr>";
    
	}
?>

</table>

</section>


<?php
include("include/footer.inc.php");
?>