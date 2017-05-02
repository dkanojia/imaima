<?php
include("include/header.inc.php");?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
require_once 'pagging/Pagination.class.php';
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>


<script language="javascript" type="text/javascript">
					
				
				
					function confirmfunction()
					{
					return confirm("Are you sure to delete this Rule");
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
		
						
					<td colspan='4' align='left'><a href='addredirection.php'>Add New Rule</a></td>
					</tr>
<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<!--<td>Category</td>
--><td>Imaima Url</td>
<td>Redirection Url</td>
<td>Command</td>
</tr>

<?php
$cat = new mysql();
$total = new mysql();
//$query = "select a.*,b.catname from tblbrand a left outer join tblcategory b on a.catid=b.catid where a.bstatus=1 ";
$query = "select a.* from tblredirection a where a.bstatus=1 ";

$total->stmt = $query;
$total->execute();
$count = $total->getNumRows();

$query1 = $query. " order by a.imaima_url limit ".$start.",".$limit;
$cat->stmt = $query1;
$cat->execute();
$i = $start + 1;
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";	
	//echo "<td>".$catname."</td>";	
    echo "<td><a href='".$imaima_url."' target='_blank'>".$imaima_url."</a></td>";
	 echo "<td><a href='".$redirect_url."'  target='_blank'>".$redirect_url."</a></td>";    
    echo "<td><a href='addredirection.php?id=".$nid."'>Edit</a><br /></td>";
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