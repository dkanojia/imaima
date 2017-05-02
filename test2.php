<?php 
include('includes/db.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php 
//include('includes/links.php');
?>
<link rel="stylesheet" type="text/css" href="<?=$glob['rootRel']?>css/mystyle.css">
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" type="text/css" href="<?=$glob['rootRel']?>skin.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400" rel="stylesheet">
    
     <link rel="stylesheet" href="<?=$glob['rootRel']?>css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=$glob['rootRel']?>css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=$glob['rootRel']?>css/owl.carousel.css">
      <link rel="stylesheet" href="<?=$glob['rootRel']?>css/modelbox.css">
    <link rel="stylesheet" href="<?=$glob['rootRel']?>style.css">
    
     <link rel="stylesheet" href="<?=$glob['rootRel']?>css/responsive.css">
     
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=$glob['rootRel']?>homePage.css">
    <link href="<?=$glob['rootRel']?>css/bs_leftnavi.css" rel="stylesheet" />
    
    <script src="<?=$glob['rootRel']?>js/bs_leftnavi.js"></script>
    
    
<link rel="stylesheet" href="zoom/multizoom.css" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script type="text/javascript" src="zoom/multizoom.js">



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


	<script type="text/javascript">

jQuery(document).ready(function($){

	$('#image1').addimagezoom({ // single image zoom
		zoomrange: [3, 10],
		magnifiersize: [300,300],
		magnifierpos: 'right',
		cursorshade: true,
		largeimage: 'hayden.jpg' //<-- No comma after last option!
	})


	$('#image2').addimagezoom() // single image zoom with default options
	
	$('#multizoom1').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description', // description selector (optional - but required if descriptions are used) - new
		speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
		descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
		imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
		magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
		zoomrange: [3, 10],
		magnifiersize: [250,250],
		magnifierpos: 'right',
		cursorshadecolor: '#fdffd5',
		cursorshade: true //<-- No comma after last option!
	});
	
	$('#multizoom2').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
		descArea: '#description2', // description selector (optional - but required if descriptions are used) - new
		disablewheel: true // even without variable zoom, mousewheel will not shift image position while mouse is over image (optional) - new
				//^-- No comma after last option!	
	});
	
})

</script>
</head>
<body>

<h3>Demo 1:</h3>

<img id="image1" border="0" src="zoom/images/haydensmall.jpg" style="width:250px;height:338px">




<h3>Demo 2:</h3>

<img id="image2" border="0" src="zoom/images/listenmusic.jpg" style="width:200px;height:150px">




<h3>Demo 3:</h3>

<div class="targetarea" style="border:1px solid #eee"><img id="multizoom1" alt="zoomable" title="" src="zoom/images/millasmall.jpg"/></div>
<div id="description">Milla Jojovitch</div>
<div class="multizoom1 thumbs">
<a href="zoom/images/millasmall.jpg" data-large="zoom/images/milla.jpg" data-title="Milla Jojovitch"><img src="zoom/images/milla_tmb.jpg" alt="Milla" title=""/></a> 
<a href="zoom/images/saleensmall.jpg" data-lens="false" data-magsize="150,150" data-large="zoom/images/saleen.jpg" data-title="Saleen S7 Twin Turbo"><img src="zoom/images/saleen_tmb.jpg" alt="Saleen" title=""/></a> 
<a href="zoom/images/haydensmall.jpg" data-large="zoom/images/hayden.jpg" data-title="Hayden Panettiere"><img src="zoom/images/hayden_tmb.jpg" alt="Hayden" title=""/></a> 
<a href="zoom/images/jaguarsmall.jpg" data-large="zoom/images/jaguar.jpg" data-title="Jaguar Type E"><img src="zoom/images/jaguar_tmb.jpg" alt="Jaguar" title=""/></a>
</div>




<h3>Demo 4:</h3>

<div class="targetarea diffheight"><img id="multizoom2" alt="zoomable" title="" src="zoom/images/angelinasmall.jpg"/></div>
<div id="description2">Angelina Jolie</div>
<div class="multizoom2 thumbs">
<a href="zoom/images/angelinasmall.jpg" data-large="zoom/images/angelina.jpg" data-title="Angelina Jolie"><img src="zoom/images/angelina_tmb.jpg" alt="Angelina" title=""/></a>
<a href="zoom/images/saleensmall.jpg" data-large="zoom/images/saleen.jpg" data-title="Saleen S7 Twin Turbo"><img src="zoom/images/saleen_tmb.jpg" alt="Saleen" title=""/></a>
<a href="zoom/images/jaguarsmall.jpg" data-large="zoom/images/jaguar.jpg" data-title="Jaguar Type E"><img src="zoom/images/jaguar_tmb.jpg" alt="Jaguar" title=""/></a>
<a href="zoom/images/listenmusic.jpg" data-title="zoom/images/Relaxing Music" data-dims="300, 225"><img src="zoom/images/listen_tmb.jpg" alt="Relaxing Music" title=""/></a>
</div>

</div>



</div>


<?php 
include('includes/footer.php');
?> 

