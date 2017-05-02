<?php
include("include/header.inc.php");
if(isset($_POST["btnupdate"]) && isset($_REQUEST["id"]))
{

$cat = new mysql();


$query= "update tbloffer set offername='".$_POST["txtoffername"]."',offercode='".$_POST["txtoffercode"]."',offertype='".$_POST["rdoffertype"]."', offervalue='".$_POST["txtoffervalue"]."', blockstatus='".$_POST["rdstatus"]."' where offerid=".$_REQUEST["id"];

$cat->stmt = $query;
$cat->execute();
$msg = "Offer Updated Sccessfully";
}

if(isset($_POST["btnsave"]) && !isset($_REQUEST["id"]))
{

$cat = new mysql();

$query= "insert into tbloffer set offername='".$_POST["txtoffername"]."',offercode='".$_POST["txtoffercode"]."',offertype='".$_POST["rdoffertype"]."', offervalue='".$_POST["txtoffervalue"]."', blockstatus='".$_POST["rdstatus"]."',bstatus=1";

$cat->stmt = $query;
$cat->execute();

$msg = "Offer Added Sccessfully";
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
var name = document.getElementById("txtoffercode").value;

if(name=="")
{
alert("Enter Offer Code ");
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
$query = "select * from tbloffer where offerid=".$_REQUEST["id"];
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

<tr>
<td>
Offer Name
</td>
<td>
<input type="text" class="txtBox" name="txtoffername" id="txtoffername" value="<?php echo $offername ?>" />
</td>
</tr>

<tr>
<td>
Offer Code
</td>
<td>
<input type="text" class="txtBox" name="txtoffercode" id="txtoffercode" value="<?php echo $offercode ?>" />
</td>
</tr>

<tr >
<td >
Offer Type
</td>
<td >
<input type="radio" class='btnradio' name="rdoffertype" <?php if(strtolower($offertype)=='shipping') echo "checked='checked'  " ?> value='shipping' />Shipping
<span style="padding-left:42px"><input type="radio" class='btnradio' name="rdoffertype" <?php if(strtolower($offertype)!='shipping') echo "checked='checked'  " ?> value='discount'/>Discount</span>
</td>
</tr>

<tr>
<td>
Offer Value
</td>
<td>
<input type="text" class="txtBox" name="txtoffervalue" id="txtoffervalue" value="<?php echo $offervalue ?>" />
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
<input type="button" name="btncancel" value="Cancel" onclick='location.href="offers.php"' />
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