<?php
if(!isset($_REQUEST["proid"]))
{
header("location:productprice.php");
}
include("include/header.inc.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");

if(isset($_POST["btnsave"]))
{
	
	$pro_sizeid = '0';
	$pro_colorid = '0';
	if(isset($_POST["drpsize"]))
	{
		$pro_sizeid =$_POST["drpsize"];
	}
	if($_FILES["img1"]["type"]== "image/jpeg" || $_FILES["img1"]["type"]== "image/jpg" || $_FILES["img1"]["type"]== "image/pjpeg")	
	{
		$pro_colorid =$_FILES["img1"]["name"];
	}


	if(!isset($_REQUEST["nid"]))
	{
		$savereview = new mysql();
		$query = " select a.* from tblproduct_price a where a.productid=".$_REQUEST["proid"]." and a.sizeid=".$pro_sizeid." and a.color_imagename='".$pro_colorid."' and a.bstatus=1";
		
		$savereview->stmt = $query;
		$savereview->execute();
		if($rv_result =$savereview->fetch_array())
		{
		$msg = "Price Already Added";
		}
		else
		{
		
		
			if($_FILES["img1"]["type"]== "image/jpeg" || $_FILES["img1"]["type"]== "image/jpg" || $_FILES["img1"]["type"]== "image/pjpeg")
			{
				 move_uploaded_file($_FILES["img1"]["tmp_name"],"../image/product/color/".$_FILES["img1"]["name"]);	
			}	 
				 $query = "insert into tblproduct_price set productid='".$_REQUEST["proid"]."',sizeid='".$pro_sizeid."',color_imagename='".$pro_colorid."',price='".$_POST["txtprice"]."',sale_price='".$_POST["txtsaleprice"]."',stock='".$_POST["txtstock"]."',blockstatus='".$_POST["rdstatus"]."' , bstatus=1";
		$savereview->stmt = $query;
		$savereview->execute();
		
		
		$product = new mysql();
	$query= "SELECT max(nid) as maxid,count(*) as pricecount FROM tblproduct_price where bstatus=1 and productid='".$_REQUEST["proid"]."'";
	
																	
	$product->stmt = $query;
	$product->execute();
	$product_result =$product->fetch_array();
	extract($product_result);
	if($pricecount==1)
	{
		$setprice = new mysql();
		$query="update tblproduct set default_priceid='".$maxid."' where productid='".$_REQUEST['proid']."'"	;
		$setprice->stmt = $query;
		$setprice->execute();
	}
		
	
		
		
		$msg = "Price  Added Successfully";			
		header("location:productprice.php?proid=".$_REQUEST['proid']);
			
		}	
	}
	else
	{
		$savereview = new mysql();
		if($_FILES["img1"]["error"] == 0)
		{
			if($_FILES["img1"]["type"]== "image/jpeg" || $_FILES["img1"]["type"]== "image/jpg" || $_FILES["img1"]["type"]== "image/pjpeg")
			{
				 move_uploaded_file($_FILES["img1"]["tmp_name"],"../image/product/color/".$_FILES["img1"]["name"]);
				 $savereview->stmt = "update tblproduct_price set color_imagename='".$_FILES["img1"]["name"]."' where nid=".$_REQUEST["nid"];
				 $savereview->execute();
			}
		}
	
		
		
		$query = "update tblproduct_price set productid='".$_REQUEST["proid"]."',sizeid='".$pro_sizeid."',stock='".$_POST["txtstock"]."',color_imagename='".$pro_colorid."',price='".$_POST["txtprice"]."',sale_price='".$_POST["txtsaleprice"]."',blockstatus='".$_POST["rdstatus"]."' , bstatus=1  where nid=".$_REQUEST["nid"];		
		$savereview->stmt = $query;
		$savereview->execute();
		$msg = "Price  Added Successfully";
		header("location:productprice.php?proid=".$_REQUEST['proid']);
	}
	
}


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
	
	



?>
     
 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
	<section class="content">
		<form name="addreview" action="" enctype="multipart/form-data" method="post">
			<table width="98%" border="0" cellpadding="0" cellspacing="0" style="padding-left:10px">
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
</section>
	
	
<?php
include("include/footer.inc.php");
?>