<div class="as-banner">
  <div class="as-banner__title">
<?php
$objpage = new mysql();

$query = "select * from tblpage_content where pageid=26 and blockstatus='active' and bstatus=1";
$objpage->stmt = $query;
$objpage->execute();
$objpage_result = $objpage->fetch_array();
extract($objpage_result);

echo "$pagecontent";




$objsetting = new mysql();

$query = "select * from tbladmin_setting ";
$objsetting->stmt = $query;
$objsetting->execute();
$objsetting_result = $objsetting->fetch_array();
extract($objsetting_result);
	
 ?>
   </div>
</div>
<header>
	<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '1670987029874485'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=1670987029874485&ev=PageView
&noscript=1"/>
</noscript>
</header>