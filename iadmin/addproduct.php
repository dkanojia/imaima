<?php
include("../FCKeditor/fckeditor.php");
if(!isset($_REQUEST["catid"]))
{
header("location:products.php");
}

include("include/header.inc.php");
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");


//$product_brand="0";
$product_color=$_POST["drpcolor"];
$product_tag="0";
$related_category="0";
$procolor_depend="0";
$prosize_depend="0";
if(isset($_REQUEST["btnupdate"]) || isset($_POST["btnsave"]))
{


/*for($i=0;$i<count($_POST["chkbrand"]);$i++)
{
	$product_brand = $product_brand.",".$_POST["chkbrand"][$i];
}*/
/*for($i=0;$i<count($_POST["chkcolor"]);$i++)
{
	$product_color = $product_color.",".$_POST["chkcolor"][$i];
}*/

for($i=0;$i<count($_POST["chktag"]);$i++)
{
	$product_tag = $product_tag.",".$_POST["chktag"][$i];
}

for($i=0;$i<count($_POST["chkrelated"]);$i++)
{
	$related_category = $related_category.",".$_POST["chkrelated"][$i];
}


//if(isset($_POST["chkcolor_depend"]))
//$procolor_depend="1";

if(isset($_POST["chksize_depend"]))
$prosize_depend="1";

}
$img1="";
$img2="";
$img3="";
$img4="";
$colorimg="";
if(isset($_REQUEST["btnupdate"]))
{
	
	
	$cat = new mysql();
	if($_FILES["img1"]["error"] == 0)
	{
		if($_FILES["img1"]["type"]== "image/jpeg" || $_FILES["img1"]["type"]== "image/jpg" || $_FILES["img1"]["type"]== "image/pjpeg")
		{
			$img1=date('YmdHis')."-".$_FILES["img1"]["name"];
			 move_uploaded_file($_FILES["img1"]["tmp_name"],"../image/product/big/".$img1);
			 $cat->stmt = "update tblproduct set image1='".$img1."' where productid=".$_POST["proid"];
			 $cat->execute();
		}
	}

	if($_FILES["img2"]["error"] == 0)
	{
		if($_FILES["img2"]["type"]== "image/jpeg" || $_FILES["img2"]["type"]== "image/jpg" || $_FILES["img2"]["type"]== "image/pjpeg")
		{
			$img2=date('YmdHis')."-".$_FILES["img2"]["name"];
			 move_uploaded_file($_FILES["img2"]["tmp_name"],"../image/product/big/".$img2);
			 $cat->stmt = "update tblproduct set image2='".$img2."' where productid=".$_POST["proid"];
			 $cat->execute();
		}
	}
	if($_FILES["img3"]["error"] == 0)
	{
		if($_FILES["img3"]["type"]== "image/jpeg" || $_FILES["img3"]["type"]== "image/jpg" || $_FILES["img3"]["type"]== "image/pjpeg")
		{
			$img3=date('YmdHis')."-".$_FILES["img3"]["name"];
			 move_uploaded_file($_FILES["img3"]["tmp_name"],"../image/product/big/".$img3);
			 $cat->stmt = "update tblproduct set image3='".$img3."' where productid=".$_POST["proid"];
			 $cat->execute();
		}
	}
	if($_FILES["img4"]["error"] == 0)
	{
		if($_FILES["img4"]["type"]== "image/jpeg" || $_FILES["img4"]["type"]== "image/jpg" || $_FILES["img4"]["type"]== "image/pjpeg")
		{
			$img4=date('YmdHis')."-".$_FILES["img4"]["name"];
			 move_uploaded_file($_FILES["img4"]["tmp_name"],"../image/product/big/".$img4);
			 $cat->stmt = "update tblproduct set image4='".$img4."' where productid=".$_POST["proid"];
			 $cat->execute();
		}
	}
	
	if($_FILES["imgcolorimage"]["error"] == 0)
	{
		if($_FILES["imgcolorimage"]["type"]== "image/jpeg" || $_FILES["imgcolorimage"]["type"]== "image/jpg" || $_FILES["imgcolorimage"]["type"]== "image/pjpeg" || $_FILES["imgcolorimage"]["type"]== "image/png")
		{
			$colorimg=date('YmdHis')."-".$_FILES["imgcolorimage"]["name"];
			 move_uploaded_file($_FILES["imgcolorimage"]["tmp_name"],"../image/color/".$colorimg);
			 $cat->stmt = "update tblproduct set colorimage='".$colorimg."' where productid=".$_POST["proid"];
			 $cat->execute();
		}
	}

	$saveproduct = new mysql();
	$query = "update tblproduct set  catid='".$_POST["drpcategory"]."',productname='".$_POST["txtproname"]."',prourl_name='".$_POST["txturl_name"]."',sno='".$_POST["txtsno"]."',productcode='".$_POST["txtprocode"]."',productdesc='".$_POST["txtprodesc"]."',product_care='".$_POST["txtprocare"]."',product_discount='".$_POST["txtdiscount"]."',product_brand='".$_POST['txtbrand']."',product_colorid='".$product_color."',styleid='".$_POST['txtstyle']."',product_tag='".$product_tag."',related_categories='".$related_category."',blockstatus='".$_POST["rdstatus"]."',offerurl='".$_POST["offerurl"]."',offerlink='".$_POST["offerlink"]."',color_depend=".$procolor_depend.",size_depend=".$prosize_depend.",shortdesc='".$_POST["txtshortdesc"]."',searchkeyword='".$_POST["txtkeyword"]."',colorname='".$_POST["txtcolorname"]."' where productid=".$_POST["proid"];
	$saveproduct->stmt = $query;
	$saveproduct->execute();
	$msg = "Product Updated Successfully";
	
	header("location:productprice.php?proid=".$_REQUEST['proid']);
}

if(isset($_POST["btnsave"]))
{
	
	if($_FILES["img1"]["error"] == 0)
	{
		if($_FILES["img1"]["type"]== "image/jpeg" || $_FILES["img1"]["type"]== "image/jpg" || $_FILES["img1"]["type"]== "image/pjpeg")
		{
			$img1=date('YmdHis')."-".$_FILES["img1"]["name"];
			 move_uploaded_file($_FILES["img1"]["tmp_name"],"../image/product/big/".$img1);
		}
	}

	if($_FILES["img2"]["error"] == 0)
	{
		if($_FILES["img2"]["type"]== "image/jpeg" || $_FILES["img2"]["type"]== "image/jpg" || $_FILES["img2"]["type"]== "image/pjpeg")
		{
			$img2=date('YmdHis')."-".$_FILES["img2"]["name"];
			 move_uploaded_file($_FILES["img2"]["tmp_name"],"../image/product/big/".$img2);		
		}
	}
	if($_FILES["img3"]["error"] == 0)
	{
		if($_FILES["img3"]["type"]== "image/jpeg" || $_FILES["img3"]["type"]== "image/jpg" || $_FILES["img3"]["type"]== "image/pjpeg")
		{
			$img3=date('YmdHis')."-".$_FILES["img3"]["name"];
			 move_uploaded_file($_FILES["img3"]["tmp_name"],"../image/product/big/".$img3);			
		}
	}
	if($_FILES["img4"]["error"] == 0)
	{
		if($_FILES["img4"]["type"]== "image/jpeg" || $_FILES["img4"]["type"]== "image/jpg" || $_FILES["img4"]["type"]== "image/pjpeg")
		{
			$img4=date('YmdHis')."-".$_FILES["img4"]["name"];
			 move_uploaded_file($_FILES["img4"]["tmp_name"],"../image/product/big/".$img4);			
		}
	}
	
	if($_FILES["imgcolorimage"]["error"] == 0)
	{
		if($_FILES["imgcolorimage"]["type"]== "image/jpeg" || $_FILES["imgcolorimage"]["type"]== "image/jpg" || $_FILES["imgcolorimage"]["type"]== "image/pjpeg" || $_FILES["imgcolorimage"]["type"]== "image/png")
		{
			$colorimg=date('YmdHis')."-".$_FILES["imgcolorimage"]["name"];
			 move_uploaded_file($_FILES["imgcolorimage"]["tmp_name"],"../image/color/".$colorimg);			
		}
	}
	
	
	$saveproduct = new mysql();
	$query = "insert into tblproduct set  catid='".$_POST["drpcategory"]."',productname='".$_POST["txtproname"]."',prourl_name='".$_POST["txturl_name"]."',sno='".$_POST["txtsno"]."',productcode='".$_POST["txtprocode"]."',productdesc='".$_POST["txtprodesc"]."',product_care='".$_POST["txtprocare"]."',product_discount='".$_POST["txtdiscount"]."',product_brand='".$_POST['txtbrand']."',product_colorid='".$product_color."',styleid='".$_POST['txtstyle']."',product_tag='".$product_tag."',related_categories='".$related_category."',blockstatus='".$_POST["rdstatus"]."',image1='".$img1."',image2='".$img2."',image3='".$img3."',image4='".$img4."',colorimage='".$colorimg."',offerurl='".$_POST["offerurl"]."',offerlink='".$_POST["offerlink"]."',shortdesc='".$_POST["txtshortdesc"]."',color_depend=".$procolor_depend.",size_depend=".$prosize_depend.",searchkeyword='".$_POST["txtkeyword"]."',colorname='".$_POST["txtcolorname"]."'";
	$saveproduct->stmt = $query;
	$saveproduct->execute();
	$msg = "Product Added Successfully";
	
	
	$product = new mysql();
	$query= "SELECT max(productid) as maxid FROM tblproduct where bstatus=1 and catid='".$_POST["drpcategory"]."'";																	
	$product->stmt = $query;
	$product->execute();
	$product_result =$product->fetch_array();
	extract($product_result);
	
	header("location:productprice.php?proid=".$maxid);
}

?>
<script type="text/javascript" language="javascript">
function checkform()
{
	var message="";
	var status=0;
	if(document.getElementById("drpcategory").value==0)
	{	
		status=1;
		message=message+"Please Select Category\n";
	}
	if(document.getElementById("txtproname").value=="")
	{
		status=1;
		message=message+"Please Enter Product Name\n";
	}
	if(document.getElementById("txturl_name").value=="")
	{
		status=1;
		message=message+"Please Enter Product URL Name\n";
	}
	if(document.getElementById("txtprocode").value=="")
	{
		status=1;
		message=message+"Please Enter Product Code\n";
	}
	
	if(status==1)
	{
		alert(message);
		return false;
	}
	 
}



</script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
        $(function() {
            CKEDITOR.replace( 'txtprodesc',
			{
			startupFocus : true,			
			filebrowserUploadUrl : '../image/upload.php' // you must write path to filemanager where you have copied it.
			});    
        });
		
		 $(function() {
            CKEDITOR.replace( 'txtprocare',
			{
			startupFocus : true,			
			filebrowserUploadUrl : '../image/upload.php' // you must write path to filemanager where you have copied it.
			});    
        });
    </script>
<aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>
<section class="content">
  <?php
		$maincatid=$_REQUEST["catid"];		
		$productcatid=0;
		if(isset($_REQUEST["proid"]))
		{
			$productdetail = new mysql();
			$query = "select *,colorname as pro_colorname from tblproduct where productid='".$_REQUEST["proid"]."' and bstatus=1 ";
			$productdetail->stmt = $query;
			$productdetail->execute();
			if($productdetail_result =$productdetail->fetch_array())
			{
				extract($productdetail_result);		
				
				$productcatid=$catid;	
						
			}
		}
		
		?>
  <form name="addbeadproduct" action="" enctype="multipart/form-data" method="post">
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="480" valign="top"><table border="0" class="formbox" width="470" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">
            <tr>
              <td> category Name </td>
              <td><select name="drpcategory" id="drpcategory" class="txtBox"  style="width:210px" >
                  <option value="0">--Category--</option>
                  <?php
								
								
									$product = new mysql();
									$query= "SELECT a.catid,concat(b.catname,' - ',a.catname) as catname,a.parentid FROM tblcategory a inner join tblcategory b on a.parentid=b.catid WHERE a.parentid <> 0 and a.bstatus=1 and a.blockstatus='active'";									
									$query .=" and a.parentid=".$maincatid;
									$query .=" order by a.catname";									
									$product->stmt = $query;
									$product->execute();
									while($product_result =$product->fetch_array())
									{
										extract($product_result);
										
										if($productcatid==$catid)
										echo "<option selected='true' value='".$catid."'>".$catname."</option>";
										else
										echo "<option value='".$catid."'>".$catname."</option>";
									}
								
								?>
                </select>
              </td>
            </tr>
            <tr >
              <td > Product Name </td>
              <td ><input type="hidden" name="proid" value="<?php echo $productid ?>" />
                <input type="text" class="txtBox" name="txtproname" id="txtproname"  value="<?php echo $productname ?>" />
              </td>
            </tr>
             <tr >
              <td > URL Name </td>
              <td >
                <input type="text" class="txtBox" name="txturl_name" id="txturl_name"  value="<?php echo $prourl_name ?>" />
              </td>
            </tr>
            <tr >
              <td > Product Code </td>
              <td ><input type="text" class="txtBox" name="txtprocode" id="txtprocode" value="<?php echo $productcode ?>" />
              </td>
            </tr>
            <tr style="display:none;" >
              <td > Product Discount </td>
              <td ><input type="text" class="txtBox" name="txtdiscount" id="txtdiscount" value="<?php echo $product_discount ?>" />
              </td>
            </tr>
            <tr >
              <td > Product Sno </td>
              <td ><input type="text" class="txtBox" name="txtsno" id="txtsno" value="<?php echo $sno ?>" />
              </td>
            </tr>
            <?php /*?><tr >
								<td >
								Color Dependent
								</td>
								
								<td >
									<input type="checkbox" class="btnradio" name="chkcolor_depend" id="chkcolor_depend" <?php if($color_depend==1) echo "checked='checked' " ?>  value='1' />
								</td>
							</tr>	<?php */?>
            <tr >
              <td > Size Dependent </td>
              <td ><input type="checkbox" class="btnradio" name="chksize_depend" id="chksize_depend" <?php if($size_depend==1) echo "checked='checked' " ?>  value='1' />
              </td>
            </tr>
            <tr >
              <td > Block Status </td>
              <td ><input type="radio" name="rdstatus" class="btnradio" <?php if($blockstatus==active) echo "checked='checked' " ?>  value='active' />
                Active <span style="padding-left:42px">
                <input type="radio" class="btnradio" name="rdstatus" <?php if($blockstatus!=active) echo "checked='checked'  " ?> value='block'/>
                Block</span> </td>
            </tr>
            <tr >
              <td > Upload Image1 </td>
              <td ><input type="file"  name="img1" style="width:200px;" />
              </td>
            </tr>
            <tr >
              <td > Upload Image2 </td>
              <td ><input type="file" name="img2" style="width:200px;" />
              </td>
            </tr>
            <tr >
              <td > Upload Image3 </td>
              <td ><input type="file" name="img3" style="width:200px;" />
              </td>
            </tr>
            <tr >
              <td > Upload Image4 </td>
              <td ><input type="file" name="img4" style="width:200px;" />
              </td>
            </tr>
            <tr style="display:none;" >
              <td > Offer Url </td>
              <td ><input type="text" class="txtBox" name="offerurl" id="offerurl" value="<?php echo $offerurl ?>" />
              </td>
            </tr>
            <tr style="display:none;" >
              <td > Offer Link </td>
              <td ><input type="text" class="txtBox" name="offerlink" id="offerlink" value="<?php echo $offerlink ?>" />
              </td>
            </tr>
            <tr >
              <td > Short Description </td>
              <td ><textarea id="txtshortdesc" name="txtshortdesc" class="txtBox" rows="3"><?=$shortdesc?>
</textarea>
              </td>
            </tr>
            <tr >
              <td > Search Keyword </td>
              <td ><textarea id="txtkeyword" name="txtkeyword" class="txtBox" rows="3"><?=$searchkeyword?>
</textarea>
              </td>
            </tr>
            <tr>
              <td > Select Style </td>
              <td><?php
							
								$objsize = new mysql();
										$query = "select styleid as stid,stylename from tblstyle where catid=".$maincatid." and bstatus=1 and blockstatus='active' order by stylename";									
										$objsize->stmt = $query;
										$objsize->execute();
										
											?>
                <select class="txtBox" name="txtstyle" id="txtstyle" style="width:210px">
                  <option value="0">select Style</option>
                  <?php
                                            while($size_result =$objsize->fetch_array())
										{
										
										   
											extract($size_result);
											if($stid==$styleid)
											echo "<option selected='true' value='".$stid."'>".$stylename."</option>";
											else
											echo "<option value='".$stid."'>".$stylename."</option>";
										
										}
								?>
                </select>
             
              </td>
            </tr>
            <tr>
              <td > Select Brand </td>
              <td><?php
							
								$objsize = new mysql();
										$query = "select brandid,brandname from tblbrand where  bstatus=1 and blockstatus='active' order by brandname";									
										$objsize->stmt = $query;
										$objsize->execute();
										
											?>
                <select class="txtBox" name="txtbrand" id="txtbrand" style="width:210px">
                  <option value="0">select Brand</option>
                  <?php
                                            while($size_result =$objsize->fetch_array())
										{
										
										   
											extract($size_result);
											if($brandid==$product_brand)
											echo "<option selected='true' value='".$brandid."'>".$brandname."</option>";
											else
											echo "<option value='".$brandid."'>".$brandname."</option>";
										
										}
								?>
                </select>
             
              </td>
            </tr>
           
            <tr>
              <td>Select Color
              </td>            
              <td ><select name="drpcolor" id="drpcolor" class="txtBox"  style="width:210px" >
                  <option value="0">--Color--</option>
                  <?php
								$sizearray = explode(',',$product_color);								
								$count = 0;
								$objsize = new mysql();
										$query = "select colorid,colorname from tblcolor where catid=".$maincatid." and bstatus=1 and blockstatus='active' order by colorname";									
										$objsize->stmt = $query;
										$objsize->execute();
										while($size_result =$objsize->fetch_array())
										{
										    $count++;
											extract($size_result);
											
											if($colorid==$product_colorid)	
											echo "<option selected='true' value='".$colorid."'>".$colorname."</option>";
											else
											echo "<option value='".$colorid."'>".$colorname."</option>";
																					
                                           
										}
								?>
                </select>
              </td>
            </tr>
              <tr >
              <td > Color Name </td>
              <td ><input type="text" class="txtBox" name="txtcolorname" id="txtcolorname" value="<?php echo $pro_colorname ?>" />
              </td>
            </tr>
              <tr>
              <td > Color Image </td>
              <td ><input type="file" name="imgcolorimage" style="width:200px;" /> &nbsp; &nbsp;<img src="../image/color/<?=$colorimage?>" style="width:24px; height:24px;" />
              </td>
            </tr>
            <tr>
              <td colspan="2"><hr style="width:100%;" />
              </td>
            </tr>
            <tr>
              <td colspan="2"><strong>Available Tags</strong>
              <td>
            </tr>
            <tr>
              <td colspan="2"><?php
								$sizearray = explode(',',$product_tag);								
								$count = 0;
								$objsize = new mysql();
										$query = "select tagid,tagname from tblproduct_tag where blockstatus='active' order by tagname";									
										$objsize->stmt = $query;
										$objsize->execute();
										while($size_result =$objsize->fetch_array())
										{
										    $count++;
											extract($size_result);
											$checked=0;
											for($i=0; $i<count($sizearray); $i++)
											{
											  if($sizearray[$i]==$tagid)
											  $checked=1;
											}
											if($checked==0)											
                                            echo "  <input type='checkbox' class='btnradio' name='chktag[]' value='".$tagid."' />  ".$tagname;											
											else
											echo "  <input type='checkbox' class='btnradio' name='chktag[]' value='".$tagid."' checked='checked' />  ".$tagname;										
											
											echo "</br>";
										}
								?>
              </td>
            </tr>
             <tr>
              <td colspan="2"><hr style="width:100%;" />
              </td>
            </tr>
            <tr>
              <td colspan="2"><strong>Related Categories ( Style With It)</strong>
              <td>
            </tr>
            <tr>
              <td colspan="2"><?php
								$sizearray = explode(',',$related_categories);								
								$count = 0;
								$objsize = new mysql();
								
										$query= "SELECT a.catid,concat(b.catname,' - ',a.catname) as catname,a.parentid FROM tblcategory a inner join tblcategory b on a.parentid=b.catid WHERE a.parentid <> 0 and a.bstatus=1 and a.blockstatus='active'";									
									$query .=" and a.parentid=".$maincatid;
									$query .=" order by a.catname";			
															
										$objsize->stmt = $query;
										$objsize->execute();
										while($size_result =$objsize->fetch_array())
										{
										    $count++;
											extract($size_result);
											$checked=0;
											for($i=0; $i<count($sizearray); $i++)
											{
											  if($sizearray[$i]==$catid)
											  $checked=1;
											}
											if($checked==0)											
                                            echo "  <input type='checkbox' class='btnradio' name='chkrelated[]' value='".$catid."' />  ".$catname;											
											else
											echo "  <input type='checkbox' class='btnradio' name='chkrelated[]' value='".$catid."' checked='checked' />  ".$catname;										
											
											echo "</br>";
										}
								?>
              </td>
            </tr>
          
          </table></td>
        <td valign="top"><table border="0" class="formbox" width="250" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">
            <tr>
              <td colspan="2"><img src="../image/product/big/<?php echo $image1 ?>" width="150" /> </td>
            </tr>
            <tr>
              <td colspan="2"><img src="../image/product/big/<?php echo $image2 ?>" width="150" /> </td>
            </tr>
            <tr>
              <td colspan="2"><img src="../image/product/big/<?php echo $image3 ?>" width="150" /> </td>
            </tr>
            <tr>
              <td colspan="2"><img src="../image/product/big/<?php echo $image4 ?>" width="150" /> </td>
            </tr>
          </table></td>
      </tr>
      <tr >
        <td colspan="2"><strong>Product Detail</strong> <br />
          <textarea id="txtprodesc" name="txtprodesc"><?=$productdesc?>
</textarea>
        </td>
      </tr>
      <tr >
        <td colspan="2" style="padding-top:20px;"><strong>Fabric & Care</strong> <br />
          <textarea id="txtprocare" name="txtprocare"><?=$product_care?>
</textarea>
        </td>
      </tr>
      <tr >
        <td style="padding:10px 10px 10px 200px;" ><input type="hidden" id="hidparentid" name="hidparentid" value="<?=$_REQUEST["maincatid"]?>"  />
          <?php 
					if(isset($_REQUEST["proid"]))
					
					echo "<input type='submit' name='btnupdate' value='Save' style='width:43px' onclick='return checkform();'/>";
					
					else
					
					echo "<input type='submit' name='btnsave' value='Save' style='width:43px' onclick='return checkform();'/>" 
					
					?>
          &nbsp;&nbsp;&nbsp;
          <input type="button" name="btncancel" value="Cancel" onclick="location.href='products.php?catid=<?=$_REQUEST["catid"]?>'" />
        </td>
      </tr>
      <tr >
        <td colspan="2"><?php
			if(isset($_POST["btnupdate"]) || isset($_POST["btnsave"]))
			{
			?>
          <script language="javascript" type="text/javascript">
			alert('<?=$msg; ?>');
			</script>
          <?php
			}
			?>
        </td>
      </tr>
    </table>
  </form>
</section>
<?php
include("include/footer.inc.php");
?>
