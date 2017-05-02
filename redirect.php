<?
include('includes/db.inc.php');

if(!isset($_REQUEST["name"]))
header("location:".$glob['rootRel']);


$imaima_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$meta = new mysql();
$query = "select * from tblredirection where bstatus=1 and imaima_url='".$imaima_url."'";

$meta->stmt = $query;
$meta->execute();
if($meta_result =$meta->fetch_array())
{
extract($meta_result);
header("location:".$redirect_url);
}

?>