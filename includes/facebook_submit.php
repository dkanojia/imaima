<?
if(isset($_POST['hidfacebookid'])){


$signup = new mysql();

$firstname = str_replace("'","''",$_POST["hidfname"]);
$lastname = str_replace("'","''",$_POST["hidlname"]);
$email = str_replace("'","''",$_POST["hidemailid"]);
$facebookid = str_replace("'","''",$_POST["hidfacebookid"]);
$password='imaima';

	$query = "select * from tbluser where loginid='".$email."' and bstatus='1' and blockstatus='active'";
	$signup->stmt = $query;
	$signup->execute();
	if($signup_result=$signup->fetch_array())
	{ 
		$_SESSION["addmsg"]= "Email Id Already Registered.";
	}
	else
	{
		$query = "select * from tbluser where emailid='".$email."' and bstatus='1' and blockstatus='active'";
		$signup->stmt = $query;
		$signup->execute();
		if($signup_result=$signup->fetch_array())
		{ 
		$_SESSION["addmsg"]= "Email Id Already Registered."; 
		}
		else
		{	

		$signupSql="INSERT INTO `tbluser`(`loginid`, `emailid`, `facebook_id`, `password`, `firstname`, `lastname`, `ship_fname`, `ship_lname`, `blockstatus`, `bstatus`, `creationdate`) values ('".$email."','".$email."','".$facebookid."','".$password."','".$firstname."','".$lastname."','".$firstname."','".$lastname."','active','1','".date('y-m-d H:i:s')."')";
		$signup->stmt = $signupSql;
		$signup->execute();
		
			$name = $firstname." ".$lastname;
			$mailid= $email;
			
			$mail = new mysql();
			$query ="select * from tbltemplate where templatename='User_Registration'";
			$mail->stmt=$query;
			$mail->execute();
			$mail_result=$mail->fetch_array();
			extract($mail_result);
			
			$msg1 = str_replace('#name#',$name, $templatecontent);
			$msg2 = str_replace('#emailid#',$email, $msg1);
			$msg3 = str_replace('#password#',$password, $msg2);
			
			
			//$subject = "User Registration";
			
			/*$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <info@iimaima.com>' . "\r\n";
			$headers .= 'Cc:<info@iimaima.com> ' . "\r\n";
			mail($mailid,$subject,$msg3,$headers);
			*/
			
			$reg = new mysql();
			$reg->subject = $subject;
			$reg->message = $msg3;
			$reg->to = $mailid;
			$reg->phpmailer();	
			
			
			$_SESSION['user_loginid'] = $email;
			$_SESSION['user_nid'] = $userid;
			$_SESSION['user_email'] = $email;
			$_SESSION['user_name'] = $firstname;
			if(isset($_SESSION['cart']))
			{			
				header("location:cart.php");
			
			}
			else
			{
				$_SESSION["addmsg"]= "Congratulation, Your Registration with iimaima done, Let's Start Shopping.";
				header("location:index.php");
			}
	}		
}
}
 ?>