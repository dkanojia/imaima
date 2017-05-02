<?php
include("include/header.inc.php");
if(isset($_POST["btnupdate"]) && isset($_REQUEST["id"]))
{

$cat = new mysql();


$query= "update tblredirection set imaima_url='".$_POST["txtimaima_url"]."', redirect_url='".$_POST["txtredirect_url"]."' where nid=".$_REQUEST["id"];

$cat->stmt = $query;
$cat->execute();
$msg = "Rules Updated Sccessfully";
}

if(isset($_POST["btnsave"]) && !isset($_REQUEST["id"]))
{

$cat = new mysql();

$query= "insert into tblredirection set imaima_url='".$_POST["txtimaima_url"]."', redirect_url='".$_POST["txtredirect_url"]."',bstatus=1";

$cat->stmt = $query;
$cat->execute();

$msg = "Rules Added Sccessfully";
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
$query = "select * from tblredirection where nid=".$_REQUEST["id"];
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

<table border="0" class="formbox" width="770" style="border-right:solic 1px grey;" cellpadding="4" cellspacing="0">

<td>
Imaima Url
</td>
<td>
<input type="text" class="txtBox" name="txtimaima_url" id="txtimaima_url" value="<?php echo $imaima_url ?>" width="500" />
</td>
</tr>

<tr >
<td >
Redirect Url
</td>
<td >
<input type="text" class="txtBox" name="txtredirect_url"  value="<?php echo $redirect_url ?>" width="500" />
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
<input type="button" name="btncancel" value="Cancel" onclick='location.href="redirection.php"' />
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