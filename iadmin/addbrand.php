<?php
include("include/header.inc.php");
if(isset($_POST["btnupdate"]) && isset($_REQUEST["id"]))
{

$cat = new mysql();


$query= "update tblbrand set catid='0',brandname='".$_POST["txtsizename"]."', branddesc='".$_POST["txtsizedesc"]."', blockstatus='".$_POST["rdstatus"]."' where brandid=".$_REQUEST["id"];

$cat->stmt = $query;
$cat->execute();
$msg = "Brand Updated Sccessfully";
}

if(isset($_POST["btnsave"]) && !isset($_REQUEST["id"]))
{

$cat = new mysql();

$query= "insert into tblbrand set catid='0',brandname='".$_POST["txtsizename"]."',branddesc='".$_POST["txtsizedesc"]."',blockstatus='".$_POST["rdstatus"]."',bstatus=1";

$cat->stmt = $query;
$cat->execute();

$msg = "Brand Added Sccessfully";
}



?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); 
?>
<script language="javascript" type="text/javascript">
function checkform()
{
var name = document.getElementById("txtsizename").value;

if(name=="")
{
alert("Enter Brand Name ");
return false;
}
}
</script>
<form name="editcategory" action="" enctype="multipart/form-data" method="post">
<section class="content">

<?php
$parentid = 0;
if(isset($_REQUEST["id"]))
{
$cat = new mysql();
$query = "select * from tblbrand where brandid=".$_REQUEST["id"];
$cat->stmt = $query;
$cat->execute();
	if($cat_result =$cat->fetch_array())
	{
	extract($cat_result);	
	}
}	
?>



<table width="98%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="480" valign="top">

<table border="0" class="formbox" width="470" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">
<?php /*?><tr>
								<td>
								category Name 
								</td>
								
								<td>
								<select name="drpcategory" id="drpcategory" style="width:210px">
								<option value="0">--Category--</option>
								<?php
								
								
									$product = new mysql();
									$query= "SELECT catid,catname,parentid FROM tblcategory WHERE parentid = 0 and bstatus=1";
									$product->stmt = $query;
									$product->execute();
									while($product_result =$product->fetch_array())
									{
										extract($product_result);
										if($brandcategoryid==$catid)
										echo "<option selected='true' value='".$catid."'>".$catname."</option>";
										else
										echo "<option value='".$catid."'>".$catname."</option>";
									}
								
								?>
								</select> 
								</td>
							</tr>
<tr><?php */?>
<td>
Brand Name
</td>
<td>
<input type="text" class="txtBox" name="txtsizename" id="txtsizename" value="<?php echo $brandname ?>" />
</td>
</tr>

<tr >
<td >
Brand Description
</td>
<td >
<input type="text" class="txtBox" name="txtsizedesc"  value="<?php echo $branddesc ?>" />
</td>
</tr>

<tr >
<td >
Block Status
</td>
<td >
<input type="radio" class='btnradio' name="rdstatus" <?php if(strtolower($blockstatus)=='active') echo "checked='checked'  " ?> value='active' />Active
<span style="padding-left:42px"><input type="radio" class='btnradio' name="rdstatus" <?php if(strtolower($blockstatus)!='active') echo "checked='checked'  " ?> value='block'/>Block</span>
</td>
</tr>




</table>
</td>

</tr>


<tr >
<td style="padding:10px 10px 10px 200px;" >

<?php 
					if(isset($_REQUEST["id"]))
					echo "<input type='submit' name='btnupdate' value='Save' style='width:43px' onclick='return checkform();'/>";
					else
					echo "<input type='submit' name='btnsave' value='Save' style='width:43px'  onclick='return checkform();'/>" 
					?>
					&nbsp;&nbsp;&nbsp;
<input type="button" name="btncancel" value="Cancel" onclick='location.href="brand.php"' />
</td>
</tr>
<tr >
					<td >
					<?php echo $msg; ?>
					</td>
				</tr>



</table>

</section>
</form>

<?php
include("include/footer.inc.php");
?>