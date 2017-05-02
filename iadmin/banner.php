<?php
include("include/header.inc.php");?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include("include/left.inc.php");?>
<aside class="right-side">
<?php
if($_REQUEST['action']=='delete'){
	
$delete = new mysql();
$query = "update tblbanner set bstatus=0 where bannerid='".$_REQUEST['id']."' ";	
$delete->stmt = $query;
$delete->execute();
?>

<script type="text/javascript">
alert('Your Banner Successfully Deleted');
location.href ='banner.php';
</script>
<?php } ?>


<?php include("include/contentheader.inc.php"); ?>
<section class="content">

<table class="tablebox"  width="98%" border="1" cellpadding="4" cellspacing="0">
<tr class="tableheading" style="font-weight:bold;">
						<?php
						echo "<td colspan='7' align='left'><a href='addbanner.php'>Add New Banner</a></td>"; ?>
					</tr>
<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Image</td>
<td>Banner Name</td>
<td>Banner Title</td>
<td>Banner Link</td>
<td>Active Status</td>
<td>Command</td>
</tr>

<?php
$banner = new mysql();
$query = "select * from tblbanner where blockstatus='Active' and bstatus=1 ";
$banner->stmt = $query;
$banner->execute();
$count = $banner->getNumRows();
if($count>0){
$i =1;
	while($banner_result =$banner->fetch_array())
	{
	extract($banner_result);
	if($banner_image==''){
		$banner_image='noimage.jpg';
	} ?>
<tr class='tablerow'>
<td><?=$i?></td>
	<td><img src='../image/banner/<?=$banner_image?>' width='100' border='0' /></td>
    <td><?=$banner_name?></td>
	<td><?=$title?></td>
    <td><?=$link?></td>
	<td><?=$blockstatus?></td>
    <td><a href='addbanner.php?id=<?=$bannerid?>'>Edit</a><br /><a href='banner.php?id=<?=$bannerid?>&action=delete' onclick='return confirm("Are you sure, you want to Delete This Banner");'>Delete</a></td>
    </tr>
    <?php
    $i = $i + 1;
	}

}else{ ?>
		<tr class='tablerow'>
        <td colspan="7">No Banner </td>
        </tr>
    
	<?php } ?>
</table>


</section>


<?php
include("include/footer.inc.php");
?>