<?php
include("../../includes/db.inc.php");
$retmsg = "<select id='drpsubcategory' name='drpsubcategory' onchange='getproducts();'><option value='0'>--Sub Category--</option>";
if(isset($_REQUEST["catid"]))
{

if($_REQUEST["catid"]!="0")
{
$ajaxcat = new mysql();
$query = "select * from tblcategory where parentid=".$_REQUEST["catid"]." and bstatus=1 order by catname";
$ajaxcat->stmt = $query;
$ajaxcat->execute();
while($ajaxcat_result =$ajaxcat->fetch_array())
{
extract($ajaxcat_result);
$retmsg = $retmsg . "<option value='".$catid."'>".$catname."</option>";
}

}
}
$retmsg = $retmsg . "</select>";
echo $retmsg;
?>