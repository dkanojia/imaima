<?php 
include('includes/db.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php 
include('includes/links.php');
?>
<script type="text/javascript" src="zoom/Event.js" ></script>
<link rel="stylesheet" href="zoom/magnifier.css" type="text/css" />
<script type="text/javascript" src="zoom/Magnifier.js" />



<title>:: Welcome to iimaima.com ::</title>
<?php
$meta = new mysql();
$query = "select metacontent from tblmeta where metaid=4 and typeid='".$_REQUEST['id']."'";
$meta->stmt = $query;
$meta->execute();
while($meta_result =$meta->fetch_array())
{
extract($meta_result);
echo "<meta  content='".$metacontent."' />";
}
?>
</head>
<body>
    <?php 
include('includes/toptext.php');
include('includes/header.php');
?>
<div style="width:97%; margin:0px auto; min-height:400px;" >


	<div>
    <a class="magnifier-thumb-wrapper" href="http://en.wikipedia.org/wiki/File:Starry_Night_Over_the_Rhone.jpg">
        <img id="thumb" src="http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Starry_Night_Over_the_Rhone.jpg/200px-Starry_Night_Over_the_Rhone.jpg"
        data-large-img-url="http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Starry_Night_Over_the_Rhone.jpg/400px-Starry_Night_Over_the_Rhone.jpg"
        data-large-img-wrapper="preview">
    </a>
    <div class="magnifier-preview" id="preview" style="width: 200px; height: 133px">Starry Night Over The Rhone<br>by Vincent van Gogh</div>
</div>



</div>


<?php 
include('includes/footer.php');
?> 


<script type="text/javascript">
var evt = new Event(),
    m = new Magnifier(evt);
	
	m.attach({
    thumb: '#thumb',
    large: 'http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Starry_Night_Over_the_Rhone.jpg/400px-Starry_Night_Over_the_Rhone.jpg',
    largeWrapper: 'preview'
});
</script>
