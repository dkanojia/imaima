<?php
if(!isset($_REQUEST["proid"]))
{
header("location:products.php");
}
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">
<script language="javascript" type="text/javascript">
function confirmfunction()
{
return confirm("Are you sure to delete this Price");
}

function getproductprice()
{
var proid = document.getElementById("drpproducts").value;
location.href="productprice.php?proid="+proid;
}

</script>
<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<?php
if(isset($_REQUEST['action'])){
$setprice = new mysql();
$query="update tblproduct set default_priceid='".$_REQUEST['nid']."' where productid='".$_REQUEST['proid']."'"	;
$setprice->stmt = $query;
$setprice->execute();
?>
<script type="text/javascript">
alert('Default Price Add Successfully');
document.location.href ="productprice.php?proid="+<?php echo $_REQUEST['proid']?>;
</script>
<?php

 }

if(isset($_SESSION["opmsg"]))
{
echo "<tr class='tablerow'><td colspan='4'>".$_SESSION["opmsg"]."</td></tr>";
unset($_SESSION["opmsg"]);
}

$subcat = new mysql();
$query = "select a.catid,b.catname,a.productname as product_name,a.color_depend as procolor_depend,a.size_depend as prosize_depend,a.default_priceid as def_priceid from tblproduct a inner join tblcategory b on a.catid=b.catid where productid= ".$_REQUEST["proid"];
$subcat->stmt = $query;
$subcat->execute();
$subcat_result =$subcat->fetch_array();
extract($subcat_result);


?>
<tr class="tableheading" style="font-weight:bold;">
<td colspan="6" align="left">
					<span id="divsubcat">
					<select id="drpproducts" name="drpproducts" onchange="getproductprice();">						
						<?php
						
							$subcat = new mysql();
							$query = "select * from tblproduct where catid=$catid and bstatus=1 order by productname ";
							$subcat->stmt = $query;
							$subcat->execute();
							while($subcat_result =$subcat->fetch_array())
							{
								extract($subcat_result);
								if($_REQUEST["proid"]==$productid)
									echo "<option value='".$productid."' selected='true'>".$productname."</option>";
								else
									echo "<option value='".$productid."'>".$productname."</option>";	
								
							}
							
						?>
					</select>
					</span>




</td>
<td colspan="4" align="right">
<a href='addproduct_price.php?proid=<?=$_REQUEST["proid"]?>'>Add New Price</a>
</td>

</tr>

<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Category</td>
<td>Product Name</td>
<? if($procolor_depend==1) { echo "<td> Color </td>"; }
if($prosize_depend==1) { echo "<td> Size </td>"; }
?>
<td>Stock</td>
<td>Price</td>
<td>Sale Price</td>
<td>is Default</td>
<td>Block Status</td>
<td>Command</td>
</tr>



<?php

$cat = new mysql();
$query = "select a.*,b.sizename,a.nid as priceid from tblproduct_price a left outer join tblsize b on a.sizeid=b.sizeid where a.bstatus=1 and a.productid=".$_REQUEST["proid"]." order by a.sizeid";
$cat->stmt = $query;
$cat->execute();
$i=1;
	while($cat_result =$cat->fetch_array())
	{
	extract($cat_result);
	echo "<tr class='tablerow'>";
	echo "<td>".$i."</td>";
   echo "<td>".$catname."</td>";
   echo "<td>".$product_name."</td>";
   if($procolor_depend==1) {
   echo "<td><img src='../image/product/color/".$color_imagename."' width='12' /></td>";
   }
   if($prosize_depend==1) {
   echo "<td>".$sizename."</td>";
   }
    echo "<td>".$stock."</td>";
   echo "<td>".$price."</td>";
   echo "<td>".$sale_price."</td>";
   if($priceid==$def_priceid)
    echo "<td>Yes</td>";
	else
	echo "<td></td>";
   echo "<td>".$blockstatus."</td>";   
   echo "<td><a href='productprice.php?proid=".$productid."&nid=".$priceid."&action=dfprice'>Set Default Price</a> | <a href='productprice.php?proid=".$productid."&nid=".$priceid."'>Edit</a> | <a href='deleteproduct_price.php?proid=".$productid."&nid=".$priceid."' onclick='return confirmfunction();'>Delete</a></td>";
    echo "</tr>";
    $i = $i + 1;
	}
?>

</table>
<?php
	$review = new mysql();
	if(isset($_REQUEST["nid"]))
	{
		$query = "select a.*,a.sizeid as product_sizeid,b.productname,b.color_depend as procolor_depend,b.size_depend as prosize_depend,c.catname,c.catid,c.parentid as maincatid from tblproduct_price a inner join tblproduct b on a.productid=b.productid inner join tblcategory c on b.catid=c.catid where a.bstatus=1 and a.productid=".$_REQUEST["proid"]." and a.nid=".$_REQUEST["nid"];
	}
	else
	{
		$query = "select b.productname,b.color_depend as procolor_depend,b.size_depend as prosize_depend,c.catname,c.catid,c.parentid as maincatid from tblproduct b inner join tblcategory c on b.catid=c.catid where  b.productid=".$_REQUEST["proid"];
	}
	
	

	$review->stmt = $query;
	$review->execute();
	$review_result =$review->fetch_array();
	extract($review_result);
	
	


if(isset($_REQUEST["nid"]))
{
?>


<form name="addreview" action="" enctype="multipart/form-data" method="post">
			<table width="98%"  border="0" cellpadding="0" cellspacing="0" style="padding-left:10px;margin-left: 27px;
    margin-top: 54px;">
				<tr>
					<td width="450" valign="top">
						<table border="0" class="formbox" width="450" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">
						<tr >
								<td >
								  Cateogory
								</td>
								
								<td >
									<?=$catname?>
								</td>
							</tr>	
							<tr >
								<td >
								Product Name
								</td>
								
								<td >
									<?=$productname?>
								</td>
							</tr>	
							
							<?php
							if($prosize_depend==1)
							{
							?>
							
							<tr>
								<td>
								Category Size
								</td>
								
								<td>							
								<select name="drpsize" id="drpsize" class="txtBox"  style="width:210px" >
								<option value="0">--Select Size--</option>
								<?php
								
								
									$product = new mysql();
									$query= "SELECT sizeid,sizename FROM tblsize WHERE catid=".$maincatid." and bstatus=1 and blockstatus='active'";	
									$query .=" order by sizename";									
									$product->stmt = $query;
									$product->execute();
									while($product_result =$product->fetch_array())
									{
										extract($product_result);
										if($product_sizeid==$sizeid)
										echo "<option selected='true' value='".$sizeid."'>".$sizename."</option>";
										else
										echo "<option value='".$sizeid."'>".$sizename."</option>";
									}
								
								?>
								</select> 
								</td>
							</tr>
							
							<?
							}
							?>
							
							
							<tr >
								<td >
								Price
								</td>
								
								<td >
									<input type="text" class="txtBox" name="txtprice" id="txtprice" value="<?=$price?>" />
								</td>
							</tr>
                            <tr >
								<td >
								Sale Price
								</td>
								
								<td >
									<input type="text" class="txtBox" name="txtsaleprice" id="txtsaleprice" value="<?=$sale_price?>" />
								</td>
							</tr>	
							 <tr >
								<td >
								Stock
								</td>
								
								<td >
									<input type="text" class="txtBox" name="txtstock" id="txtstock" value="<?=$stock?>" />
								</td>
							</tr>	
							<tr >
								<td >
								Block Status
								</td>
								
								<td >
									<input type="radio" class='btnradio' name="rdstatus" <?php if($blockstatus==active) echo "checked='checked' " ?>  value='active' />Active
									<span style="padding-left:42px"><input type="radio" class='btnradio' name="rdstatus" <?php if($blockstatus!=active) echo "checked='checked'  " ?> value='block'/>Block</span>
								</td>
							</tr>	
							
							<?php
							if($procolor_depend==1)
							{
							?>
							<tr >
								<td >
								Upload Color
								</td>
								
								<td >
								<input type="file" name="img1" style="width:120px;" /> : <img src="..image/product/color/<?=$color_imagename?>" width="12" />
								</td>
							</tr>
							<?
							}
							?>
						</table>
					</td>
				</tr>
	
				<tr >
					<td style="padding:10px 10px 10px 310px;" >
				
					<input type='submit' name='btnsave' value='Save' style='width:43px' onclick='return checkform();'/>
					&nbsp;&nbsp;&nbsp;
					<input type="button" name="btncancel" value="Back" onclick="location.href='productprice.php?proid=<?=$_REQUEST["proid"]?>'" />
					</td>
				</tr>
				
				<tr >
					<td colspan="2">
					<?php echo $msg; ?>
					</td>
				</tr>
			</table>
		</form>
        <?php
        }
		?>

</section>

<?php
include("include/footer.inc.php");
?>