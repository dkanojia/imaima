<?php
include("include/header.inc.php");
if(isset($_POST["btnsave"]))
{
$meta = new mysql();
$query = "insert into tblmeta_master (metaname,activestatus,bstatus)values('".$_POST["txtmetatype"]."','".$_POST["rdstatus"]."',1)";
$meta->stmt = $query;
$meta->execute();
$msg = "Meta Type Added Successfully";
}

if(isset($_POST["btnupdate"]))
{
$meta = new mysql();
$query = "update tblmeta_master set metaname='".$_POST["txtmetatype"]."',activestatus='".$_POST["rdstatus"]."',bstatus=1 where metaid=".$_REQUEST["metaid"];
$meta->stmt = $query;
$meta->execute();
$msg = "Meta Type Updated Successfully";
}



?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php

include("include/left.inc.php");
?>

<aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>


<?php
if(isset($_REQUEST["metaid"]))
{
$meta = new mysql();
$query = "select * from tblmeta_master where metaid=".$_REQUEST["metaid"];
$meta->stmt = $query;
$meta->execute();
$meta_result =$meta->fetch_array();	
extract($meta_result);
}
?>


<form name="metaform" action="" method="post">
<section class="content">
<table class="formbox" width="450" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		Meta Type
		</td>
		<td>
		<input type="text" class="txtBox" name="txtmetatype" value="<?php echo $metaname ?>" />
		</td>
	</tr>
	<tr >
		<td >
		Block Status
		</td>
		<td >
		<input type="radio" class='btnradio' name="rdstatus" <?php if($activestatus=='active') echo "checked='checked'"; ?> value="active" />Active
		<span style="padding-left:42px"><input type="radio" name="rdstatus" class='btnradio' <?php if($activestatus=='block') echo "checked='checked' "; ?> value="block" />Block</span>
		</td>
	</tr>

<tr>
<td colspan="2" style="padding:10px 10px 10px 200px;" >
<?php
if(isset($_REQUEST["metaid"]))
{
?>
<input type="submit" class="btn" name="btnupdate" value="Save" style="width:43px"/>
<?php } else { ?>
<input type="submit" class="btn" name="btnsave" value="Save" style="width:43px"/>
<?php } ?>
&nbsp;&nbsp;&nbsp;
<input type="button" class="btn" name="btncancel" value="Cancel" onclick='location.href="metamaster.php"' />
</td>
</tr>

<tr >
<td colspan="2">
<?php echo $msg; ?>
</td>
</tr>

</table>
</section>
</form>




<?php
include("include/footer.inc.php");
?>