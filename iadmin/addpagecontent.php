<?php
include("include/header.inc.php");
include("../FCKeditor/fckeditor.php");
if(isset($_POST["btnsave"]))
{
$pagecontent = str_replace("'","''",$_POST["txtpagecontent"]);
$meta = new mysql();
$query = "insert into tblpage_content set groupname='".$_POST["drpgroup"]."',pagename='".$_POST["txtpagename"]."',linkname='".$_POST["txtlinkname"]."',pagetitle='".$_POST["txtpagetitle"]."',pagecontent='".$pagecontent."',bannerdesc='".$_POST["txtbannerdesc"]."',pagelink='".$_POST["txtpagelink"]."',pagetarget='".$_POST["rdpagetarget"]."',pagetype='".$_POST["rdpagetype"]."',blockstatus='".$_POST["rdstatus"]."',bstatus=1";
$meta->stmt = $query;
$meta->execute();
$msg = "New Page Saved Successfully";
}

if(isset($_POST["btnupdate"]))
{
$pagecontent = str_replace("'","''",$_POST["txtpagecontent"]);
$meta = new mysql();
$query = "update tblpage_content set groupname='".$_POST["drpgroup"]."',pagename='".$_POST["txtpagename"]."',linkname='".$_POST["txtlinkname"]."',pagetitle='".$_POST["txtpagetitle"]."',pagecontent='".$pagecontent."',bannerdesc='".$_POST["txtbannerdesc"]."',pagelink='".$_POST["txtpagelink"]."',pagetarget='".$_POST["rdpagetarget"]."',pagetype='".$_POST["rdpagetype"]."',blockstatus='".$_POST["rdstatus"]."' where pageid=".$_REQUEST["pageid"];
$meta->stmt = $query;
$meta->execute();
$msg = "Page Information Updated Successfully";
}



?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="../ckeditor/adapters/jquery.js"></script>

    <script type="text/javascript">
        $(function() {
            CKEDITOR.replace( 'txtpagecontent',
			{
			startupFocus : true,			
			filebrowserUploadUrl : '../image/upload.php' // you must write path to filemanager where you have copied it.
			});    
        });
    </script>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>


<?php
if(isset($_REQUEST["pageid"]))
{
$page = new mysql();
$query = "select * from tblpage_content where pageid=".$_REQUEST["pageid"];
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
		<td width="200">
		Group Name
		</td>
		<td width="600">
		<select id="drpgroup" class="txtBox" name="drpgroup" onchange="searchgroup();">
<option value="0" <?php if($groupname=="0") echo "selected='true'"; ?> >Select Group</option>
<option value="Header" <?php if($groupname=="Header") echo "selected='true'"; ?>>Header</option>
<option value="Footer" <?php if($groupname=="Footer") echo "selected='true'"; ?>>Footer</option>
<option value="Footer-Help" <?php if($groupname=="Footer-Help") echo "selected='true'"; ?>>Footer-Help</option>

<option value="Other" <?php if($groupname=="Other") echo "selected='true'"; ?>>Other</option>
n>
</select>
		</td>
	</tr>
	<tr>
		<td>
		Page Name (For URL)
		</td>
		<td>
		<input type="text" class="txtBox" name="txtpagename" value="<?php echo $pagename ?>" />
		</td>
	</tr>
	<tr>
		<td>
		Link Name (To Show on Page)
		</td>
		<td>
		<input type="text" class="txtBox" name="txtlinkname" value="<?php echo $linkname ?>" />
		</td>
	</tr>
	<tr>
		<td>
		Page Title
		</td>
		<td>
		<input type="text" class="txtBox" name="txtpagetitle" value="<?php echo $pagetitle ?>" />
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
		<td >
		Page Target
		</td>
		<td >
		<input type="radio" class='btnradio' name="rdpagetarget" <?php if($pagetarget=='self') echo "checked='checked'"; ?> value="self" />Self
		<span style="padding-left:54px"><input type="radio" class='btnradio' name="rdpagetarget" <?php if($pagetarget=='blank') echo "checked='checked' "; ?> value="blank" />Blank</span>
		</td>
	</tr>
	<tr >
		<td >
		Page Type
		</td>
		<td >
		<input type="radio" class='btnradio' name="rdpagetype" <?php if($pagetype=='standard') echo "checked='checked'"; ?> value="standard" />Standard
		<span style="padding-left:25px"><input type="radio" class='btnradio' name="rdpagetype" <?php if($pagetype=='custom') echo "checked='checked' "; ?> value="custom" />Custom</span>
		</td>
	</tr>
	
	<tr>
		<td>
		Page Link
		</td>
		<td>
		<input type="text" class="txtBox" name="txtpagelink" value="<?php echo $pagelink ?>" />
		</td>
	</tr>
 

<tr style="display:none;" >
<td colspan="2">
		Banner Description
		<br />
		<?php
		$oFCKeditor = new FCKeditor('txtbannerdesc');
		$oFCKeditor->BasePath = '../FCKeditor/' ;		
			$oFCKeditor->Value = $bannerdesc;	
			$oFCKeditor->Height = "250px";	
		$oFCKeditor->Create();
?>	
		</td>

</tr>
	
	<tr>
		<td colspan="2">
		Page Content
		<br />
        <textarea id="txtpagecontent" name="txtpagecontent"><?=$pagecontent?></textarea>
		<?php
		/*$oFCKeditor = new FCKeditor('txtpagecontent');
		$oFCKeditor->BasePath = '../FCKeditor/' ;		
			$oFCKeditor->Value = $pagecontent;	
			$oFCKeditor->Height = "400px";	
		$oFCKeditor->Create();*/
?>	
		</td>
	</tr>

<tr>
<td colspan="2" style="padding:10px 10px 10px 200px;" >
<?php
if(isset($_REQUEST["pageid"]))
{
?>
<input type="submit" class="btn" name="btnupdate" value="Save" style="width:43px"/>
<?php } else { ?>
<input type="submit" class="btn" name="btnsave" value="Save" style="width:43px"/>
<?php } ?>
&nbsp;&nbsp;&nbsp;
<input type="button" class="btn" name="btncancel" value="Cancel" onclick='location.href="pagelist.php"' />
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