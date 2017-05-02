<?php
ob_start();
session_start();
if($_SERVER['HTTP_HOST'] == 'localhost')
{
	$glob['dbdatabase'] = 'jewelground_test';
	$glob['dbhost'] = 'localhost';
	$glob['dbpassword'] = '';
	$glob['dbprefix'] = '';
	$glob['dbusername'] = 'root';
	$glob['installed'] = '1';
	$glob['rootDir'] = 'C:/Program Files/xampp/htdocs/francecruises.com/';
	$glob['rootRel'] = 'http://localhost/public_html/';
	$glob['storeURL'] = 'http://localhost/gemsbead/';
	$glob['baseimgpath']='http://localhost/gemsbead/';
	
}else{
	$glob['dbdatabase'] = 'aashicol_garmentdb';
	$glob['dbhost'] = 'mysql501.ixwebhosting.com';
	$glob['dbpassword'] = 'ash@2015';
	$glob['dbprefix'] = '';
	$glob['dbusername'] = 'aashicol_ashusr';
	$glob['installed'] = '1';
	$glob['rootDir'] = '';
	$glob['rootRel'] = 'https://iimaima.com/';
	// $glob['rootRel'] = 'http://localhost/public_html/';
	$glob['storeURL'] = '';
	$glob['baseimgpath']="";
	$glob['secureUrl'] = "#";
	$glob['cookieURL'] = '.www.francecruises.com/';
}
	//$glob['adminmail'] = 'touchsunny@gmail.com';	
        $glob['adminmail'] = 'info@iimaima.com';	
	$GLOBALS['rootDir'] = $glob['rootDir'];
	$GLOBALS['storeURL'] = $glob['storeURL'];
	$GLOBALS['rootRel'] = $glob['rootRel'];
	$glob['cookie_expiretime'] = time()+24*3600*5;
	$glob['session_expiretime'] = time()+1200;
	

	
	class mysql
{
  var $hostName;
  var $userName;
  var $password;
  var $dbName;
  var $conn;

  var $stmt;
  var $query;
  var $result;
  var $attachmentpath;

  function mysql()
  {
  
   $this->hostName = "localhost";
    // $this->userName = "iimaima_dbusr";
    // $this->password = "iim@2017";
    $this->userName = "root";
    $this->password = "";
    $this->dbName   = "iimaima_garmentdb";
	
    $this->conn     = "";
    $this->stmt     = "";
	$this->who      = "studio@iimaima.com";
	$this->subject  = "";
	$this->message  = "";
	$this->from     = "info@iimaima.com";
	$this->adminmail = "info@iimaima.com";
	$this->to = "info@iimaima.com";
	$this->bcc = "info@iimaima.com";
	$this->attachmentpath = "";
    return($this->connect());
	//echo $this->hostname;
  }
  

  function connect()
  {
   // echo $this->hostName;
    $this->conn = mysql_connect($this->hostName,$this->userName,$this->password,$this->dbName) or die(mysql_error());
    if(!$this->conn)
    {
      die('Invalid Connection: ' . mysql_error());
      return false;
    }

    $dbConn = mysql_select_db($this->dbName, $this->conn);

    if(!$dbConn)
    {
       die('Invalid Database: ' . mysql_error());
       return false;
    }

    return true;
  }


  function execute()
  {
     $this->result = mysql_query($this->stmt, $this->conn);

     if (!$this->result)
     {
       die(mysql_error().$this->stmt);
       return false;
     }

     return true;
  }
  
  function getNumRows()
  {
    return(mysql_num_rows(mysql_query($this->stmt, $this->conn)));
  }

  function getNumRowsAffected()
  {
    return(mysql_affected_rows());
  }

  function fetch_array()
  {
    return (@mysql_fetch_assoc($this->result));
  }

  function fetch_row()
  {
    return (@mysql_fetch_row($this->result));
  }

  function close()
  {
    $this->close();
  }
  
  function getLastInsertId()
  {
     return mysql_insert_id();
  }
  
  function getTableFldName($tblName)
  {
  	$arr     = array();
	$fields  = mysql_list_fields($this->dbName, $tblName, $this->conn);
	$columns = mysql_num_fields($fields);
	
	for ($i = 0; $i < $columns; $i++) 
	{
	  $arr[$i] = mysql_field_name($fields, $i);
	}
	return $arr;
  }
  
  
  function phpmailer()
  {
  	include("mailer/class.phpmailer.php");
	
	
	// Email Using Google Account
	$mail = new PHPMailer(); // create a new object
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465; // or 587
  $mail->IsHTML(true);  
  $mail->Username = "support@iimaima.com";
  $mail->Password = "imaima@123";
   $mail->SetFrom("support@iimaima.com", 'Imaima');
  //$mail->Timeout = 3600;    
  /*
//  Email Using vps smtp
$mail->IsHTML(true);
  $mail->SMTPSecure = 'tls';
  $mail->IsSMTP(); 
  $mail->SMTPDebug = 1; 
  $mail->SMTPAuth = true;
   $mail->Username = "info@iimaima.com";
  $mail->Password = "iim@2017"; 
  $mail->Host = "mail.iimaima.com";
  $mail->Port = 25;
  $mail->SetFrom("info@iimaima.com", 'Imaima');
  */
  
  $mail->FromName = "Imaima";
  $mail->From =$this->from;
  $mail->Subject = $this->subject;
  $mail->Body =$this->message;
  $mail->AddAddress($this->to);
  $mail->AddAddress($this->who);
  
   if(!$mail->Send())
   {
   $_SESSION["addmsg"] = "Mailer Error: " . $mail->ErrorInfo;
   }
   else
   {
   $_SESSION["addmsg"] =  "your Customer Order Requirement has been received, we will get back to you soon. ";
   }
  
  }
  
 
  function mailer()
  {
   $headers = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= "From: iimaima \r\n Reply-To: ".$this->from."\r\n";
   if($this->bcc!="")
   $headers .= "BCC: ".$this->bcc."\r\n";
    $headers .= "CC: ".$this->who."\r\n";
    mail($this->to, $this->subject, $this->message, $headers);
  }

  
  
  
  function getcontentmenu($grpname,$rootpath,$currentpage)
  {
  $this->stmt = "select * from tblpage_content where groupname='".$grpname."' and blockstatus='active' and bstatus=1";  
  $this->execute();
  $menucontent ="";
  while($menupage_result =$this->fetch_array())
	{
	extract($menupage_result);
	$menucontent.="<li";
	if(strtolower($currentpage)==strtolower($pagename))
	{ 
	$menucontent.=" class='active'";
	}
		
	$menucontent.="><a href='";
	if($pagetype=='standard')
	{
	$menucontent.=$rootpath.$grpname."/".strtolower($pagename).".html'";
	}
	else
	{
	$menucontent.=$pagelink."'";
	}
	
	if($pagetarget=='blank')
	{
	$menucontent.=" target='_blank'";
	}
	
	

	$menucontent .=" >".$linkname."</a></li>";
	}
	return $menucontent;
  }

function get_currency_value($to_Currency) {
 
  $val = 1;
  	try
	{
  		$this->stmt = "select * from tbladmin_setting";
	    $this->execute();
		$c_result =$this->fetch_array();
		extract($c_result);		
		switch($to_Currency)
		{
		case "usd" : $val = $usd_rate/100; $this->currency_symbol="$";  break;
		case "eur" : $val = $eur_rate/100; $this->currency_symbol="&euro;";  break;
		case "gbp" : $val = $gbp_rate/100; $this->currency_symbol="&pound;"; break;
		case "inr" : 1; $this->currency_symbol="&#x20B9;"; break;
		}
	}
	
	catch (Exception $e) {  }
	 
	return $val;	
}

function get_currency_symbol($currency_value)
{
		$symbol ="";
		switch(strtolower($currency_value))
		{
		case "usd" : $symbol="$";  break;
		case "eur" : $symbol="&euro;";  break;
		case "gbp" : $symbol="&pound;"; break;
		case "inr" : $symbol="&#x20B9;"; break;
		}
		return $symbol;
}

function get_currency_amount($amount)
{		
	return round(floatval($this->currency_value*$amount),0);
	//return $amount;
}


	function calculaterating($maincat,$subcat,$proid)
	{
	$rating =0;
	$this->stmt = "select sum(rating) as ratingachieved,count(*) as ratingcount from tblreview where catname='".$maincat."' and subcatname='".$subcat."' and productid='".$proid."' and approvalstatus='approved' and activestatus='active' and bstatus=1";
    //echo $this->stmt;
	$this->execute();
		if($review_result =$this->fetch_array())
		{
			extract($review_result);
			$totalrating = $ratingcount*5;
			if($totalrating>0)
			$rating = $ratingachieved/$ratingcount;
		}
	 return $rating;
	}
  
  	function getratingstar($rating,$basepath)
	{
	    
		$i=0;
		while($i<5)
		{
		   
			if($rating>$i && $rating>=$i+1)
			echo "<img src='".$basepath."images/rating-star.png' alt=''/>";
			elseif($rating>$i && $rating<$i+1)
			echo "<img src='".$basepath."images/halfstar.png' alt=''/>";
			else
			echo "<img src='".$basepath."images/greys.png' alt=''/>";						
			$i++;
		}
		
	}
	
  function geturlstring($origval)
  {  
   $tmp = ltrim($origval);
  $tmp = rtrim($tmp);   
  return strtolower($tmp);
				
  }
  
  function getorigstring($urlval)
  {     
  
  $tmp = ltrim($urlval);
  $tmp = rtrim($tmp);
	  return strtolower($tmp);
	  

  }
  
  function geturlwithspacestring($origval)
  {
  $tmp = str_replace("-", "-to-", $origval);
  $tmp = str_replace("#", "-no", $tmp);
  $tmp = str_replace(" ", "-", $tmp);
  
   $tmp = ltrim($tmp);
  $tmp = rtrim($tmp);   
				return strtolower($tmp);
				
  }
  
  function getorigwithspacestring($urlval)
  {
   $tmp = str_replace("style-no","style#", $urlval);   
    $tmp = str_replace("-", " ", $tmp);  
    $tmp = str_replace("-to-", "-", $tmp);  
  $tmp = str_replace("%", "-", $tmp);  
  $tmp = ltrim($tmp);
  $tmp = rtrim($tmp);
	  return strtolower($tmp);
	  

  }
  
  
  function sendmail($action,$date,$name,$email,$pass)
  {
  		$this->stmt = "select * from tbltemplate where templatename='User_Registration' and blockstatus='active'";  
 		$this->execute();
	  	$menucontent ="";
	  	if($menupage_result =$this->fetch_array())
		{
			extract($menupage_result);
			$mailbody = str_replace("#registrationdate#",$date,$templatecontent);
			$mailbody = str_replace("#customername#",$name,$mailbody);
			$mailbody = str_replace("#customeremailid#",$email,$mailbody);
			$mailbody = str_replace("#customerpassword#",$pass,$mailbody);
			$this->message = $mailbody;
			$this->who = $email;
			$this->subject = $subject;
			$this->bcc  = $this->adminmail;
			$this->mailer();
			
		}  	
  }
  
   function ordermail($orderid,$usernid)
  {
  		$this->stmt = "select * from tbltemplate where templatename='Order_Success' and blockstatus='active'";  
 		$this->execute();
	  	$menucontent ="";
		
	  	if($menupage_result =$this->fetch_array())
		{
			extract($menupage_result);
			
			$cat = new mysql();
					$query = "select a.*,b.loginid,b.emailid,b.phone1,b.firstname,b.lastname from tblorder a left outer join tbluser b on a.userid=b.nid where a.bstatus=1 and  a.userid='".$usernid."' and a.orderid='".$orderid."'";
					$cat->stmt = $query;
					$cat->execute();					
					if($cat_result =$cat->fetch_array())
					{
					extract($cat_result);
					
					$ship_addr = $ship_address1 . " ". $ship_address2 . "<br />".$ship_city." - ".$ship_zip."<br />".$ship_country;
					
					$mailbody = str_replace("#orderdate#",$orderdate,$templatecontent);
					$mailbody = str_replace("#username#",$firstname.' '.$lastname,$mailbody);
					$mailbody = str_replace("#invoiceno#",$orderid,$mailbody);
					$mailbody = str_replace("#ship_address#",$ship_addr,$mailbody);
					$bodymsg='';
					$bodymsg="
					<table class='proTab' cellpadding='0' width='100%' cellspacing='0' style='text-align:center'>
            <tbody>
              <tr class='tablerow' style='background:#d5d5d5;'>
                <td class='image' style='width:15%'>Product</td>
                <td class='name' style='width:30%;'>Name</td>
                <td class='model' style='width:10%'>Size</td>
                <td class='model' style='width:10%'>Color</td>
                <td style='width:15%'>Quantity</td>
                <td class='price' style='width:10%'>Unit Price</td>
                <td class='total' style='width:10%'>Total</td>
              </tr>";
              
				
				
				$query = "select a.*,b.sizename from tblorder_detail a inner join tblsize b on a.sizeid=b.sizeid where a.orderid='".$orderid."'";
				$this->stmt = $query;
				$this->execute();
				while($orderdetail_result =$this->fetch_array())
				{				
				extract($orderdetail_result);
			
				$sno = 1;						
					
             $bodymsg=$bodymsg."<tr class='tablerow'>
                <td class='proImg'><a href='http://iimaima.com/productdetail.php?id=".$productid."'><img src='".$imagepath."' width='60%'></a></td>
                <td class='proInfo'><a href='http://iimaima.com/productdetail.php?id=".$productid."' class='pink_wish'>
                  ".$productfullname."
                  </a></td>
                <td class='unitTab'>
                  ".$sizename."
                 </td>
                <td class='unitTab'>
                  ".$color."</td>
                  <td class='unitTab'>
                  ".$product_qty."</td>
                    <td class='unitTab'>
                  ".$product_cost."</td>
                <td class='totalTab pink_wish'>".$this->get_currency_symbol($currency_code)."
                  ".$totalamount."</td>
              </tr>";
           
					$sno = $sno + 1;	
					}
					
             $bodymsg=$bodymsg."</tbody>
          </table>";
				
			$mailbody = str_replace("#orderbody#",$bodymsg,$mailbody);
			
			$this->subject = $subject;
			$this->message = $mailbody;
			$this->to = $emailid;
			$this->phpmailer();	
			
			/*$this->message = $mailbody;
			$this->who = $emailid;
			$this->subject = $subject;
			$this->bcc  = $this->adminmail;
			$this->mailer();*/
			
		}  	
 		 }
  }
  
  
  
}?>