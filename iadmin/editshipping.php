<?php
include("include/header.inc.php");
if(isset($_POST["btnupdate"]) && isset($_REQUEST["id"]))
{

$cat = new mysql();


$query= "update tblshipping set  shipping='".$_POST["txtshipping"]."' where nid=".$_REQUEST["id"];

$cat->stmt = $query;
$cat->execute();
$msg = "Shipping Price Updated Sccessfully";
}





?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); 
?>

<form name="editcategory" action="" enctype="multipart/form-data" method="post">
<section class="content">

<?php
$parentid = 0;
if(isset($_REQUEST["id"]))
{
$cat = new mysql();
$query = "select * from tblshipping where nid=".$_REQUEST["id"];
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

<td>
Country Name
</td>
<td>
<input type="text" class="txtBox" name="txtsizename" id="txtsizename" disabled="disabled" value="<?php echo $country ?>" />
</td>
</tr>

<tr >
<td >
Shipping Rate
</td>
<td >
<input type="text" class="txtBox" name="txtshipping"  value="<?php echo $shipping ?>" />
</td>
</tr>


</table>
</td>

</tr>


<tr >
<td style="padding:10px 10px 10px 200px;" >

<?php 
					if(isset($_REQUEST["id"]))
					echo "<input type='submit' name='btnupdate' value='Save' style='width:43px' />";
					 
					?>
					&nbsp;&nbsp;&nbsp;
<input type="button" name="btncancel" value="Cancel" onclick='location.href="shipping.php"' />
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