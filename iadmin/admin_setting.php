<?php
include("include/header.inc.php");


if(isset($_POST["btnsave"]))
{
$admin = new mysql();
	if($_FILES["txtimage"]["error"] == 0)
	{
		if($_FILES["txtimage"]["type"]== "image/jpeg" || $_FILES["txtimage"]["type"]== "image/jpg" || $_FILES["txtimage"]["type"]== "image/pjpeg" || $_FILES["txtimage"]["type"]== "image/png")
		{
			 move_uploaded_file($_FILES["txtimage"]["tmp_name"],"../image/backimage/".$_FILES["txtimage"]["name"]);
			 $admin->stmt = "update tbladmin_setting set banner1='".$_FILES['txtimage']['name']."' where nid='".$_POST['hidid']."'";
			 $admin->execute();
		}
	}
	
	if($_FILES["txtimage2"]["error"] == 0)
	{
		if($_FILES["txtimage2"]["type"]== "image/jpeg" || $_FILES["txtimage2"]["type"]== "image/jpg" || $_FILES["txtimage2"]["type"]== "image/pjpeg"|| $_FILES["txtimage"]["type"]== "image/png")
		{
			 move_uploaded_file($_FILES["txtimage2"]["tmp_name"],"../image/backimage/".$_FILES["txtimage2"]["name"]);
			 $admin->stmt = "update tbladmin_setting set banner2_image='".$_FILES['txtimage2']['name']."' where nid='".$_POST['hidid']."'";
			 $admin->execute();
		}
	}


$query = "update tbladmin_setting set  normal_min_shipping='".$_POST["txtnormal_min_shipping"]."',ship_charge='".$_POST["txt_ship_charge"]."',banner2_url='".$_POST["txturl"]."', modificationdate='".date("d/m/Y")."',usd_rate='".$_POST["txtusd_rate"]."',gbp_rate='".$_POST["txtgbp_rate"]."',eur_rate='".$_POST["txteur_rate"]."',s_facebook='".$_POST["txtfacebook"]."',s_instagram='".$_POST["txtinstagram"]."',s_pintrest='".$_POST["txtpintrest"]."',s_linkedin='".$_POST["txtlinkedin"]."',s_googleplus='".$_POST["txtgoogleplus"]."',s_twitter='".$_POST["txttwitter"]."',banner1_link='".$_POST["txtbanner1_link"]."',banner2_link='".$_POST["txtbanner2_link"]."',banner1_alt='".$_POST["txtbanner1_alt"]."',banner2_alt='".$_POST["txtbanner2_alt"]."',stock_minvalue1='".$_POST["txtstock_minvalue1"]."',stock_minmsg1='".$_POST["txtstock_minmsg1"]."',stock_minvalue2='".$_POST["txtstock_minvalue2"]."',stock_minmsg2='".$_POST["txtstock_minmsg2"]."',stock_minvalue3='".$_POST["txtstock_minvalue3"]."',stock_minmsg3='".$_POST["txtstock_minmsg3"]."' where nid=".$_POST["hidid"];
$admin->stmt = $query;
$admin->execute();


$msg = "Admin Setting Saved Successfully";
}



?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
<?php include("include/contentheader.inc.php"); ?>


<?php

$admin = new mysql();
$query = "select * from tbladmin_setting where bstatus=1";
$admin->stmt = $query;
$admin->execute();
$admin_result =$admin->fetch_array();	
extract($admin_result);

?>


<form name="metaform" enctype="multipart/form-data" action="" method="post">
<section class="content">
<table class="formbox" width="800" border="0" cellpadding="0" cellspacing="0">
	<tr style="display:none;">
		<td>
		Minimum Purchase Amount for Free Shipping
		</td>
		<td>
		<input type="text" class="txtBox" name="txtnormal_min_shipping" value="<?php echo $normal_min_shipping ?>" />
		</td>
	</tr>
	<tr style="display:none;">
		<td>
		Shipping Amount : below minimum purchase amount
		</td>
		<td>
		<input type="text" class="txtBox" name="txt_ship_charge" value="<?php echo $ship_charge ?>" />
		</td>
	</tr>
     <tr>
		<td>
		Facebook : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txtfacebook" style="width:450px;" value="<?php echo $s_facebook ?>" />
		</td>
	</tr>
    <tr>
		<td>
		Instagram : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txtinstagram" style="width:450px;" value="<?php echo $s_instagram ?>" />
		</td>
	</tr>
    <tr>
		<td>
		Pintrest : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txtpintrest" style="width:450px;" value="<?php echo $s_pintrest ?>" />
		</td>
	</tr>
    <tr>
		<td>
		Linked In : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txtlinkedin" style="width:450px;" value="<?php echo $s_linkedin ?>" />
		</td>
	</tr>
    <tr>
		<td>
		Google + : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txtgoogleplus" style="width:450px;" value="<?php echo $s_googleplus ?>" />
		</td>
	</tr>
    <tr>
		<td>
		Twitter : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txttwitter" style="width:450px;" value="<?php echo $s_twitter ?>" />
		</td>
	</tr>
    
    
    <tr>
    	<td colspan="2">
        	<hr style="width:80%"  />
        </td>
    </tr>
    
    <tr>
		<td>
		INR : 
		</td>
		<td>
		Rs. 100 /-
		</td>
	</tr>
    
     <tr>
		<td>
		USD : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txtusd_rate" value="<?php echo $usd_rate ?>" />
		</td>
	</tr>
    
    <tr>
		<td>
		GBP : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txtgbp_rate" value="<?php echo $gbp_rate ?>" />
		</td>
	</tr>
    
    <tr>
		<td>
		EUR : 
		</td>
		<td>
		<input type="text" class="txtBox" name="txteur_rate" value="<?php echo $eur_rate ?>" />
		</td>
	</tr>
     <tr>
    	<td colspan="2">
        	<hr style="width:80%"  />
        </td>
    </tr>
    <tr>
		<td>
		Banner 1 Image
		</td>
		<td>
		<input type="file"  name="txtimage" />
      
		  <?php 
		if($banner1!="")
		{
		?>
        </td>
		<td>
        <img src="../image/backimage/<?=$banner1?>" width="100" height="50" />
        <?php
        }?>
        </td>
	</tr>
 <tr>
		<td>
		Banner 2 Image
		</td>
		<td>
		<input type="file"  name="txtimage2"  />
      
		  <?php 
		if($banner2_image!="")
		{
		?>
        </td>
		<td>
        <img src="../image/backimage/<?=$banner2_image?>" width="100" height="50" />
        <?php
        }?>
        </td>
	</tr>
    <tr>
		<td>
		Banner 2 Youtube Viceo Url
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txturl" value="<?php echo $banner2_url ?>" style="width:450px;"/>
      
		</td> 
	</tr>
    
     <tr>
		<td>
		Banner 1 Link
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txtbanner1_link" value="<?php echo $banner1_link ?>"style="width:450px;" />
      
		</td> 
	</tr>
    
     <tr>
		<td>
		Banner 2 Link
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txtbanner2_link" value="<?php echo $banner2_link ?>" style="width:450px;"/>
      
		</td> 
	</tr>
 <tr>
		<td>
		Banner 1 Alt
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txtbanner1_alt" value="<?php echo $banner1_alt ?>"style="width:450px;" />
      
		</td> 
	</tr>
    
     <tr>
		<td>
		Banner 2 Alt
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txtbanner2_alt" value="<?php echo $banner2_alt ?>" style="width:450px;"/>
      
		</td> 
	</tr>
	 <tr>
    	<td colspan="2">
        	<hr style="width:80%"  />
        </td>
    </tr>
    
     <tr>
		<td>
		Stock Value 1
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txtstock_minvalue1" value="<?php echo $stock_minvalue1 ?>" style="width:150px;"/> 
        &nbsp; &nbsp;
       <input type="text" class="txtBox" name="txtstock_minmsg1" value="<?php echo $stock_minmsg1 ?>" style="width:150px;"/> 
		</td> 
	</tr>
    
    <tr>
		<td>
		Stock Value 2
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txtstock_minvalue2" value="<?php echo $stock_minvalue2 ?>" style="width:150px;"/> 
        &nbsp; &nbsp;
       <input type="text" class="txtBox" name="txtstock_minmsg2" value="<?php echo $stock_minmsg2 ?>" style="width:150px;"/> 
		</td> 
	</tr>
    
    <tr>
		<td>
		Stock Value 3
		</td>
		<td colspan="2">
		<input type="text" class="txtBox" name="txtstock_minvalue3" value="<?php echo $stock_minvalue3 ?>" style="width:150px;"/> 
        &nbsp; &nbsp;
       <input type="text" class="txtBox" name="txtstock_minmsg3" value="<?php echo $stock_minmsg3 ?>" style="width:150px;"/> 
		</td> 
	</tr>

<tr>
<td colspan="2" style="padding:10px 10px 10px 200px;" >

<input type="hidden" id="hidid" name="hidid" value="<?php echo $nid; ?>" />
<input type="submit" class="btn" name="btnsave" value="Save" style="width:43px"/>
&nbsp;&nbsp;&nbsp;
<input type="button" class="btn" name="btncancel" value="Cancel" onclick='location.href="adminhome.php"' />
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