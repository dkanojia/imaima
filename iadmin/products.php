<?php
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
require_once 'pagging/Pagination.class.php';
if(isset($_REQUEST["btnsubmit"]))
{
$saveproduct = new mysql();
	$query = "update tblproduct set  sno='".$_POST["txtsno"]."' where productid=".$_POST["hidproid"];
	$saveproduct->stmt = $query;
	$saveproduct->execute();
}




?>
 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">
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
echo "<tr class='tablerow'><td colspan='6'>".$_SESSION["opmsg"]."</td></tr>";
unset($_SESSION["opmsg"]);
}
?>
			<tr class="tablerow">
				<td colspan="8">
					<script language="javascript" type="text/javascript">
					function getsubcategory()
					{
					var catid = document.getElementById("drpcategory").value;
					location.href="products.php?catid="+catid;
					/*var xmlHttp;
					xmlHttp=GetXmlHttpObject();
					if (xmlHttp==null)
					{
						alert ("Your browser does not support AJAX!");
						return;
					}
					
					var url='ajax/ajaxforsubcat.php?catid='+catid;
					
					   xmlHttp.onreadystatechange=function(){	
					   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 					
									if(xmlHttp.responseText!='')
									{		
										document.getElementById("divsubcat").innerHTML = xmlHttp.responseText;
									}
								}
						}
						xmlHttp.open("GET",url,true);
						xmlHttp.send(null);	*/
						return false;
					}
					
					function getproducts()
					{
						var subcatid = document.getElementById("drpsubcategory").value;
						var catid = document.getElementById("drpcategory").value;
						if(subcatid==0)
						return false;
						else
						location.href="products.php?catid="+catid+"&subcatid="+subcatid;						
					}
				
					function confirmfunction()
					{
					return confirm("Are you sure to delete this product");
					}
					
					function getsnoform(i,catid,sno,productid)
					{
					var formstring = "<form name='productform' method='post' action='products.php?catid="+catid+"'>";
					formstring = formstring + "<input type='text' name='txtsno' value='"+sno+"' width='80' />";
					formstring = formstring + "<input type='hidden' name='hidproid' value='"+productid+"' /><br />";
					formstring = formstring + "<input type='submit' name='btnsubmit' value='Save' /></form>";
					document.getElementById("tdsno"+i).innerHTML = formstring;
					return false;
					}
					
					</script>
					
					<?php
					$maincatid=1;
					if(isset($_REQUEST["catid"]))
						$maincatid=$_REQUEST["catid"];
					
					if(isset($_REQUEST["subcatid"]))
					{
						$subcatdetail = new mysql();
						$query = "select * from tblcategory where catid=".$_REQUEST["subcatid"]." and bstatus=1 order by catname";
						$subcatdetail->stmt = $query;
						$subcatdetail->execute();
						$subcatdetail_result =$subcatdetail->fetch_array();
						extract($subcatdetail_result);
						$subcatid = $_REQUEST["subcatid"];
					}
					
					
					?>
					
					<select id="drpcategory" name="drpcategory" onchange="getsubcategory();">						
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
					</select>
					&nbsp;&nbsp;
					<span id="divsubcat">
					<select id="drpsubcategory" name="drpsubcategory" onchange="getproducts();">
						<option value="0" <?php  if(!isset($_REQUEST["subcatid"])) { echo "selected='true'"; } ?>>--Sub Category--</option>
						<?php
							if(isset($_REQUEST["subcatid"]) || $maincatid!=0)
							{
								$subcat = new mysql();
								$query = "select * from tblcategory where parentid=".$maincatid." and bstatus=1 order by catname";
								$subcat->stmt = $query;
								$subcat->execute();
								while($subcat_result =$subcat->fetch_array())
								{
									extract($subcat_result);
									if($_REQUEST["subcatid"]==$catid)
										echo "<option value='".$catid."' selected='true'>".$catname."</option>";
									else
										echo "<option value='".$catid."'>".$catname."</option>";	
									
								}
							}
						?>
					</select>
					</span>
                    <span style="float:right;">
              
                    <form action="" method="post">
                    <input type="text" name="txtsearch" id="txtsearch" placeholder="Search" />
                    <input type="button" value="search" onclick="return searchpagegroup();" />
                    </form>
                    </span>
				</td>
			</tr>
            
            
            
		
			<?php
			
				$product = new mysql();
				$cat = new mysql();
				
					?>
					
					<tr class="tableheading" style="font-weight:bold;">
						<?php
						echo "<td colspan='6' align='left'><a href='addproduct.php?catid=".$maincatid."'>Add New Product</a></td>"; ?>
					</tr>
					
					<tr class='tableheading' style='font-weight:bold;'>
					<td>Sno</td>
						<td>Image</td>
						<td>Product Name</td>
						<td>Product Code</td>		
						<td>Status</td>				
						<td>Command</td>
					</tr>
					
					<?php
					$query = "select * from tblproduct where bstatus=1 ";
					if(isset($_REQUEST["subcatid"]))
					{
					$query .=" and 	catid=".$_REQUEST["subcatid"] ;
					
					}
					else
					{
					$query .=" and 	catid in (select catid from tblcategory where parentid=".$maincatid.")";
					
					}
					if(isset($_REQUEST['srch']))
					{
					$query .=" and productcode like '%".$_REQUEST['srch']."%'";
					
					$query .=" or productname like '%".$_REQUEST['srch']."%'";
					}
					$cat->stmt = $query;
					$cat->execute();
					$count = $cat->getNumRows();
					$query1 =$query." order by sno,productname limit ".$start.",".$limit;
					$product->stmt = $query1;
					$product->execute();
					echo $rowheading;
					$i = $start + 1;
					while($product_result =$product->fetch_array())
					{
						extract($product_result);	
						echo "<tr class='tablerow'>";
						echo "<td id='tdsno".$i."'>";
						if(isset($_REQUEST["proid"]) && $_REQUEST["proid"]==$productid)
						{
							?>
								<form name="productform" method="post" action="products.php?catid=<?=$maincatid?>">
									<input type="text" name="txtsno" value="<?=$sno?>" width="80" />
									<input type="hidden" name="hidproid" value="<?=$productid?>" />
									<br />
									<input type="submit" name="btnsubmit" value="Save" />
								</form>
							<?
						}
						else
						{
							echo $sno."<br><a name=".$i." href='products.php?catid=".$maincatid."&proid=".$productid."#".$i."' onclick='return getsnoform(".$i.",".$maincatid.",".$sno.",".$productid.");'>Edit</a>";
						}
						echo "</td>";
						echo "<td><a href='addproduct.php?proid=".$productid."&catid=".$maincatid."'><img src='../image/product/big/".$image1."' width='100' border='0' /></a></td>";
						echo "<td><a href='addproduct.php?proid=".$productid."&catid=".$maincatid."'>".$productname."</a></td>";
						echo "<td>".$productcode."</td>";				
						echo "<td>".$blockstatus."</td>";					
						echo "<td><a href='addproduct.php?proid=".$productid."&catid=".$maincatid."'>Edit</a><br /><a href='productprice.php?proid=".$productid."'>Price List</a><br /><a href='metacontent.php?metatypeid=".$productid."&metatype=product'>Meta Content</a><br /><a href='productdelete.php?id=".$productid."&catid=".$maincatid."&subcatid=".$catid."' onclick='return confirmfunction();'>Delete</a>
						</td>";
						echo "</tr>";
						$i++;
					
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
<script type="text/javascript">

						
function searchpagegroup()
{

var srchtxt = document.getElementById("txtsearch").value;
var catid = document.getElementById("drpcategory").value;
var subcatid = document.getElementById("drpsubcategory").value;
if(subcatid==0 && catid==0){
location.href = "products.php?srch="+srchtxt;
}
if(subcatid==0 && catid!=0){
location.href = "products.php?catid="+catid+"&srch="+srchtxt;
}
if(subcatid!=0 && catid!=0){
location.href = "products.php?catid="+catid+"&subcatid="+subcatid+"&srch="+srchtxt;
}
}
</script>

<?php
include("include/footer.inc.php");
?>