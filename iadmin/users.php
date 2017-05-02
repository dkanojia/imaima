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


<script language="javascript" type="text/javascript">

function confirmdelete()
{
return confirm("Are you sure to delete this User");
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
<section class="content">
<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Login Id</td>
<td>Email Id</td>
<td>Name</td>
<td>Password </td>
<td>Country </td>
<td>Status</td>
<td>Command</td>
</tr>

<?php
$cat = new mysql();
$total = new mysql();
$refferal = new mysql();
$query = "select * from tbluser where bstatus=1";
$cat->stmt = $query;
$cat->execute();
$count = $cat->getNumRows();

	$query1 =$query." order by nid desc limit ".$start.",".$limit;
	$total->stmt = $query1;
	$total->execute();

$sno = $start + 1;
	while($total_result =$total->fetch_array())
	{

	extract($total_result);
	echo "<tr class='tablerow'>";
	echo "<td>".$sno."</td>";
	echo "<td><a href='editusers.php?id=".$nid."'>".$loginid."</a></td>";
	echo "<td><a href='editusers.php?id=".$nid."'>".$emailid."</a></td>";
	echo "<td><a href='editusers.php?id=".$nid."'>".$firstname." ".$lastname."</a></td>";
    echo "<td>".$password."</td>";
	echo "<td>".$country."</td>";
	
    echo "<td>".$blockstatus."</td>";
    echo "<td><a href='deleteusers.php?id=".$nid."' onclick='return confirmdelete();'>Delete</a></td>";
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