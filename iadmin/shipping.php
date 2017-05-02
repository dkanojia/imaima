<?php
include("include/header.inc.php");?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
require_once 'pagging/Pagination.class.php';
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>

                    <?php
$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
			$limit=50;
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
<td>Country</td>
<td>Shipping Rate</td>
<td>Command</td>
</tr>

<?php
$cat = new mysql();
$total = new mysql();
$query = "select * from tblshipping ";

$total->stmt = $query;
$total->execute();
$count = $total->getNumRows();

$query1 = $query. " order by country limit ".$start.",".$limit;
$cat->stmt = $query1;
$cat->execute();
$i = $start + 1;
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";	
	//echo "<td>".$catname."</td>";	
    echo "<td><a href='editshipping.php?id=".$nid."'>".$country."</a></td>";
    echo "<td>".$shipping."</td>";  
    echo "<td><a href='editshipping.php?id=".$nid."'>Edit</a><br /></td>";
    echo "</tr>";
    $i = $i + 1;
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