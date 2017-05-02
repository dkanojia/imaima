<?php

if(isset($_POST['btnstock_submit']))
{$objwishlist = new mysql();	
		$wdatewithtime = date('Y-m-d H:i:s');			
		$query = "insert into tblproduct_stock_requirement(productid,sizename,emailid,status,bstatus,creationdate)values('".$_POST['hid_stock_product']."','".$_POST['hid_stock_size']."','".$_POST['txtstock_email']."','new',1,'".$wdatewithtime."')";
		$objwishlist->stmt = $query;
		$objwishlist->execute();
		$_SESSION["addmsg"]= "We have received your request , we will contact you whenever stock will be available.";
}


if(isset($_POST['btninvite_submit']))
{
	$fromname=$_POST["txtinvite_name"];
	$invitename = $_POST["txtfriend_name"];
	 $emailid=$_POST["txtinvite_email"];
	$customermessage =$_POST["txtinvite_message"];
	 $prourl = "http://iimaima.com/productdetail.php?id=".$_POST["hidinvite_prourl"];
	 $mail = new mysql();
	$query ="select * from tbltemplate where templatename='tell_a_friend'";
	$mail->stmt=$query;
	$mail->execute();
	$mail_result=$mail->fetch_array();
	extract($mail_result);
		
	$msg= str_replace('#name1#',$fromname, $templatecontent);
	$msg = str_replace('#name2#',$fromname, $msg);
	 $msg = str_replace('#path0#',$prourl, $msg);
	  $msg = str_replace('#path1#',$prourl, $msg);
	   $msg = str_replace('#path2#',$prourl, $msg);
	    $msg = str_replace('#path3#',$prourl, $msg);
		 $msg = str_replace('#path4#',$prourl, $msg);
	 
	 $query ="select * from tblproduct where productid=".$_POST["hidinvite_prourl"];
	$mail->stmt=$query;
	$mail->execute();
	$mail_result=$mail->fetch_array();
	extract($mail_result); 
	  $msg = str_replace('#image0#',"http://iimaima.com/image/product/big/".$image1, $msg);
		 $msg = str_replace('#image1#',"http://iimaima.com/image/product/big/".$image2, $msg);
		 $msg = str_replace('#image2#',"http://iimaima.com/image/product/big/".$image3, $msg);
		 $msg = str_replace('#image3#',"http://iimaima.com/image/product/big/".$image4, $msg);
	 
	         $mailid = "support@iimaima.com";
			$subject="Invitation On IIMAIMA ".$custname;
					
			$message = $msg;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			$headers .= 'From: <'.$mailid.'>' . "\r\n";
			
	      //mail($emailid,$subject,$message,$headers);
		
		 
		    $reg = new mysql();
			$reg->subject = $subject;
			$reg->message = $msg;
			$reg->to = $emailid;
			$reg->phpmailer();	
		 
		$_SESSION["addmsg"]= "Your Invitation has been sent successfully on Email:".$emailid;
}

if(isset($_POST['btnwishlist_login_submit'])){



	
//$email=mysql_real_escape_string($_POST['email']);
//$password=mysql_real_escape_string($_POST['password']);	

$loginid = str_replace("'","''",$_POST["txtwishlist_email"]);
$pass = str_replace("'","''",$_POST["txtwishlist_password"]);
	//echo $_POST['email'];
	$login = new mysql();	
	
	 $query = "select * from tbluser where (loginid='".$loginid."' or emailid='".$loginid."') and password='".$pass."' and bstatus=1 and blockstatus='active' ";	
	$login->stmt = $query;
	$login->execute();
	$count = $login->getNumRows();
	if($count > 0 )
	{
	$login_result =$login->fetch_array();
	extract($login_result);	
		
	$_SESSION['user_loginid'] = $loginid;
	$_SESSION['user_nid'] = $nid;
	$_SESSION['user_email'] = $emailid;
	$_SESSION['user_name'] = $firstname;
	
	$objwishlist = new mysql();	
	
	$objwishlist->stmt = " select a.productname,b.catname from tblproduct a inner join tblcategory b on a.catid=b.catid where a.productid=".$_POST['hidwishlist_prourl'];
	$objwishlist->execute();
	$objwishlist_result = $objwishlist->fetch_array();							
	extract($objwishlist_result);
	$query = "select * from tblwishlist where userid=".$_SESSION['user_nid']." and productid=".$_POST['hidwishlist_prourl'];
	$objwishlist->stmt = $query;
	$objwishlist->execute();	
		if($objwishlist->getNumRows()>0)
		{
			$_SESSION["addmsg"]= "We have already added ".$productname." ".$catname." to Your Wishlist" ;
		}
		else
		{
				$wdatewithtime = date('Y-m-d H:i:s');			
				$query = "insert into tblwishlist(userid,productid,createdate)values(".$_SESSION['user_nid'].",".$_POST['hidwishlist_prourl'].",'".$wdatewithtime."')";
				$objwishlist->stmt = $query;
				$objwishlist->execute();
				
				$_SESSION["addmsg"]= "We have added ".$productname." ".$catname." to Your Wishlist" ;
		}
	
	}
	else
	{ 
	$_SESSION["addmsg"]= "Sorry, You have Entered an Invalid login or password"; 
	}
}

?>