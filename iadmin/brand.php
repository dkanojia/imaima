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
					
					function getproducts()
					{
						var catid = document.getElementById("drpcategory").value;
						if(catid==0)
						return false;
						else
						location.href="brand.php?catid="+catid;
						
					}
				
					function confirmfunction()
					{
					return confirm("Are you sure to delete this Brand");
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
			<td colspan="1">
			<?php

					if(isset($_REQUEST["catid"]))
						$maincatid=$_REQUEST["catid"];
					
					
					
					?>
					
					<?php /*?><select id="drpcategory" name="drpcategory" onchange="getproducts();">
						<option value="0">--Main Category--</option>
						<?php
							$maincat = new mysql();
							$query = "select * from tblcategory where parentid=0 and bstatus=1 order by catname ";
							$maincat->stmt = $query;
							$maincat->execute();
							while($maincat_result =$maincat->fetch_array())
							{
								extract($maincat_result);
								if($maincatid!=0)
								{
									if($maincatid==$catid)
									echo "<option value='".$catid."' selected='true'>".$catname."</option>";
									else
									echo "<option value='".$catid."'>".$catname."</option>";
								}
								else
								echo "<option value='".$catid."'>".$catname."</option>";
							}
						?>
					</select><?php */?>
</td>
						
					<td colspan='4' align='left'><a href='addbrand.php'>Add New Brand</a></td>
					</tr>
<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<!--<td>Category</td>
--><td>Brand</td>
<td>Description</td>
<td>Active Status</td>
<td>Command</td>
</tr>

<?php
$cat = new mysql();
$total = new mysql();
//$query = "select a.*,b.catname from tblbrand a left outer join tblcategory b on a.catid=b.catid where a.bstatus=1 ";
$query = "select a.* from tblbrand a where a.bstatus=1 ";
if(isset($_REQUEST["catid"]))
$query = $query . " and a.catid=".$_REQUEST["catid"];
$total->stmt = $query;
$total->execute();
$count = $total->getNumRows();

$query1 = $query. " order by a.brandname limit ".$start.",".$limit;
$cat->stmt = $query1;
$cat->execute();
$i = $start + 1;
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	
	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";	
	//echo "<td>".$catname."</td>";	
    echo "<td><a href='addbrand.php?id=".$brandid."'>".$brandname."</a></td>";
    echo "<td>".$branddesc."</td>";
    echo "<td>".$blockstatus."</td>";
    echo "<td><a href='addbrand.php?id=".$brandid."'>Edit</a><br /></td>";
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