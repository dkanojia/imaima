<?php
	
			$message = '<html><body>';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10" width="100%">';
			$message .= "<tr><td colspan='2' style='text-align: center;'><strong>".strip_tags('Contact Inquiry')."</strong></td></tr>";
			
			$message .= "</table>";
			$message .= "</body></html>";
			
		 $from =  'khetesh.pcube@gmail.com';
         $to = "bhawani.singh@hostingcentre.in";
         $subject =  ucfirst(strip_tags("Test mail function_exists"));

         echo $message;
         $header = "From:$from \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         $header .= "Cc: myboss@example.com \r\n";

         $retval = mail ($to,$subject,$message,$header);
         
         if($retval == true) {
            echo  "Success";
         }else {
           echo "Error";
         }
		
      ?>
