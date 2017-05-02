<?php
include("include/header.inc.php");
include("../FCKeditor/fckeditor.php");

if(isset($_POST["btnupdate"]))
{
$pagecontent = str_replace("'","''",$_POST["txtdesc"]);
$meta = new mysql();
$query = "update tbltemplate set subject='".$_POST["txtsubject"]."',templatecontent='".$pagecontent."',blockstatus='".$_POST["rdstatus"]."' where nid=".$_REQUEST["id"];
$meta->stmt = $query;
$meta->execute();
$msg = "Template Information Updated Successfully";
}



?>
<div class="wrapper row-offcanvas row-offcanvas-left">

<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>


<?php
if(isset($_REQUEST["id"]))
{
$page = new mysql();
$query = "select * from tbltemplate where nid=".$_REQUEST["id"];
$page->stmt = $query;
$page->execute();
$page_result =$page->fetch_array();	
extract($page_result);
}
?>


<form name="metaform" action="" method="post">
<section class="content">
<table style="text-align:left;" class="formbox" width="800" border="0" cellpadding="0" cellspacing="0">	
	<tr>
		<td>
		Template Name
		</td>
		<td>
		<input disabled="true" type="text" class="txtBox" name="txtname" value="<?php echo $templatename ?>" />
		</td>
	</tr>
	<tr>
		<td>
		Subject
		</td>
		<td>
		<input type="text" class="txtBox" name="txtsubject" value="<?php echo $subject ?>" />
		</td>
	</tr>
	
	<tr >
		<td >
		Block Status
		</td>
		<td >
		<input type="radio" class='btnradio' name="rdstatus" <?php if($blockstatus=='active') echo "checked='checked'"; ?> value="active" />Active
		<span style="padding-left:42px"><input type="radio" class='btnradio' name="rdstatus" <?php if($blockstatus=='block') echo "checked='checked' "; ?> value="block" />Block</span>
		</td>
	</tr>
	
	
	

<tr >
<td colspan="2">
		Body Description
		<br />
		<?php
		$oFCKeditor = new FCKeditor('txtdesc');
		$oFCKeditor->BasePath = '../FCKeditor/' ;		
			$oFCKeditor->Value = $templatecontent;	
			$oFCKeditor->Height = "800px";	
		$oFCKeditor->Create();
?>	
		</td>

</tr>

<tr>
<td colspan="2" style="padding:10px 10px 10px 200px;" >

<input type="submit" class="btn" name="btnupdate" value="Save" style="width:43px"/>

<input type="button" class="btn" name="btncancel" value="Cancel" onclick='location.href="mailtemplate.php"' />
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