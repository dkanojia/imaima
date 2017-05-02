
        
   <div class="footer-top-area" style="margin-top:105px;">
            
            <div class="container" style="width:100%">
                <div class="row">
                
               <div class="social">
                
                <div class="col-md-6 col-sm-12">
                        <div class="footer-menu" style="float:right; padding-right:15px;">
                            <ul>
                                <li>
                                    <a href="<?=$glob['rootRel']?>">Help &amp; Support</a>
                                    <ul class="sub-menu-bottom">
                                    
                                     <?php 
									  $cat = new mysql();
									  $query = "select * from tblpage_content where groupname='Footer-Help' and blockstatus='active' and bstatus=1 order by pageid ";
									  $cat->stmt = $query;
									  $cat->execute();
						  				while($cat_result = $cat->fetch_array())						  
		 							 {
		  						      extract($cat_result); 
									  if($pagetype=='standard') 
					  			{       
							 echo "<li><a href='".$glob['rootRel']."content-".$cat->geturlwithspacestring($pagename).".html' title='".$pagetitle."'>".$pagename."</a>";
							 
								echo "</li>"; 
								}
								else if($pagetype=='custom') 
								{
								 echo "<li><a href='$pagelink' title='".$pagetitle."'>".$pagename."</a>";
							 
								echo "</li>";
								}
								
						
							}
							?>                                    </ul>
                                </li>
                                
                                 <?php 
									  $cat = new mysql();
									  $query = "select * from tblpage_content where groupname='Footer' and blockstatus='active' and bstatus=1 order by pageid ";
									  $cat->stmt = $query;
									  $cat->execute();
						  				while($cat_result = $cat->fetch_array())						  
		 							 {
		  						      extract($cat_result); 
									  if($pagetype=='standard') 
					  			{       
							 echo "<li><a href='".$glob['rootRel']."content-".$cat->geturlwithspacestring($pagename).".html' title='".$pagetitle."'>".$pagename."</a>";
							 
								echo "</li>"; 
								}
								else if($pagetype=='custom') 
								{
								 echo "<li><a href='$pagelink' title='".$pagetitle."'>".$pagename."</a>";
							 
								echo "</li>";
								}
								
						
							}
							?>
                                
                                
                                
                                <li><a href="<?=$glob['rootRel']?>" target="_blank">&copy; IIMAIMA <span class="footer_year"> 2017</span></a></li>
                            </ul>
                        </div>
                    </div>
                
                </div> 
                
                    





                   
                   <div class="link">
                    
                    
                    <div class="col-md-6 col-sm-12">
                    
                    <div class="footer-about-us">

                            <div class="footer-social"><a href="https://www.facebook.com/iimaimaofficial/" target="_blank"><i class="fa fa-facebook"></i></a>
                                
                                 <a href="<?=$s_instagram?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                <a href="<?=$s_pintrest?>" target="_blank"><i class="fa fa-pinterest"></i></a>
                                 <a href="<?=$s_twitter?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                 <a href="<?=$s_linkedin?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                <a href="<?=$s_googleplus?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                             <!-- <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>-->
                               
                            </div>
                        </div>
                    
                    
                    
                    
                        
                    </div>
                    
                    </div> 
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>     
        
        



 <script src="<?=$glob['rootRel']?>js/navigation.js"></script>
  <!-- Latest jQuery form server -->
      

        <!-- Bootstrap JS form CDN -->
       <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->

        <!-- jQuery sticky menu -->
        <script src="<?=$glob['rootRel']?>js/owl.carousel.min.js"></script>
        <script src="<?=$glob['rootRel']?>js/jquery.sticky.js"></script>

        <!-- jQuery easing -->
        <script src="<?=$glob['rootRel']?>js/jquery.easing.1.3.min.js"></script>

        <!-- Main Script -->
        <script src="<?=$glob['rootRel']?>js/main.js"></script>

        <!-- Slider -->
        <script type="text/javascript" src="<?=$glob['rootRel']?>js/bxslider.min.js"></script>
        <script type="text/javascript" src="<?=$glob['rootRel']?>js/script.slider.js"></script>

       

        <script type="text/javascript">
            $(".accordion > div").hide().parent().hover(function (event) {
                $(this).children("div").slideToggle(event.type === "mouseenter");
            });
        </script>
        
        <script language="javascript" type="text/javascript">
		

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92890330-1', 'auto');
  ga('send', 'pageview');

</script>

 <script type="text/javascript">
        function alertpopup() {
            $("#alert_dialog").show();
        }
        function closealert_box() {
            $("#alert_dialog").hide();

        }
		
		function invitepopup(proid,productname) {
		document.getElementById("txtinvite_proname").disabled=false;
		document.getElementById("txtinvite_proname").value=productname;
		document.getElementById("txtinvite_proname").disabled=true;
		document.getElementById("hidinvite_prourl").value=proid;
            $("#invite_dialog").show();
        }
		
        function closeinvite_box() {
            $("#invite_dialog").hide();
        }
		
		function wishlist_login_popup(proid) {
		
		document.getElementById("hidwishlist_prourl").value=proid;
            $("#wishlist_login_dialog").show();
        }
        function closewishlist_box() {
            $("#wishlist_login_dialog").hide();

        }
    </script>

    
		

<div id="invite_dialog" class="modal" style="padding-bottom: 20px;" >
        <!-- Modal content -->
        <div class="modal-content alert_width" style="border-radius: 5px; border: solid 1px #666666;">
            
            <p style="font-size: 20px; font-weight: bold; border-bottom:solid 1px #666666; padding-bottom:5px;">
                Let's take another opinion
                <span class="close" onclick="closeinvite_box();">X</span>
           
            </p>
            <br />
            <form name="frminvite" method="post" action="">
            <table border="0" cellpadding="5" cellspacing="0" width="100%" style="text-align:left; font-size:12px;">
            	<tr>
                	<td width="25%">Your Name </td>
                    <td ><input type="text" id="txtinvite_name" name="txtinvite_name" <? if(isset($_SESSION['user_nid'])) {?> value="<?=$_SESSION['user_name']?>" disabled="disabled"  <? } ?> style="width:90%; height:35px;font-size:12px;" /></td>
                </tr>
            	<tr>
                	<td width="25%">Product </td>
                    <td ><input type="text" id="txtinvite_proname" name="txtinvite_proname" style="width:90%; height:35px;font-size:12px;" />
                    <input type="hidden" id="hidinvite_prourl" name="hidinvite_prourl" />
                    </td>
                </tr>
                 <tr>
                	<td width="25%">Friend's Name</td>
                    <td><input type="text" id="txtfriend_name" name="txtfriend_name" style="width:90%; height:35px;" /></td>
                </tr>
                <tr>
                	<td width="25%">Friend's Email</td>
                    <td><input type="text" id="txtinvite_email" name="txtinvite_email" style="width:90%; height:35px;" /></td>
                </tr>
                 <tr>
                	<td width="25%">Message </td>
                    <td><textarea id="txtinvite_message" name="txtinvite_message"  style="width:90%; height:60px;"></textarea></td>
                </tr>
                 <tr>
                	<td colspan="2" align="center"><input type="submit" id="btninvite_submit" name="btninvite_submit" value="Lets Ask" /></td>
                   
                </tr>
            </table>
            </form>
        </div>
    </div>
    
    <div id="wishlist_login_dialog" class="modal" style="padding-bottom: 20px;" >
        <!-- Modal content -->
        <div class="modal-content alert_width" style=" border-radius: 5px; border: solid 1px #666666;">
            
            
            <p style="font-size: 14px; font-weight: bold; border-bottom:solid 1px #666666; padding-bottom:5px;">
                Please Login to Add the products in Wishlist.  <span class="close" onclick="closewishlist_box();">X</span>
            </p>
            <br />
            <form name="frmlogin" method="post" action="">
            <table border="0" cellpadding="5" cellspacing="0" width="100%" style="text-align:left; font-size:12px;">
            	<tr>
                	<td width="25%">Email Id </td>
                    <td ><input type="text" id="txtwishlist_email" name="txtwishlist_email"  style="width:90%; height:35px;font-size:12px;" /></td>
                </tr>
            	<tr>
                	<td width="25%">Password </td>
                    <td ><input type="password" id="txtwishlist_password" name="txtwishlist_password" style="width:90%; height:35px;font-size:12px;" />
                    <input type="hidden" id="hidwishlist_prourl" name="hidwishlist_prourl" />
                    </td>
                </tr>
                
                 <tr>
                	<td colspan="2" align="center"><input type="submit" id="btnwishlist_login_submit" name="btnwishlist_login_submit" value="Let's Shop" /></td>
                   
                </tr>
                <tr>
                	<td colspan="2" style="text-align:center;"><a href="register.php">Click Here For New Registration</a> </td>
                </tr>
            </table>
            </form>
        </div>
    </div>

 




<?
if(isset($_POST["wishlistpro_id"]))
{
	if(!isset($_SESSION['user_nid']))
	{
	?>
    
    <script language="javascript" type="text/javascript">
	wishlist_login_popup(<?=$_POST['wishlistpro_id']?>);
	</script>
    
    <?
		
	}	
	else
	{
	
		$objwishlist = new mysql();	
		
		echo $objwishlist->stmt = " select a.productname,b.catname from tblproduct a inner join tblcategory b on a.catid=b.catid where a.productid=".$_POST['wishlistpro_id'];
		$objwishlist->execute();
		$objwishlist_result = $objwishlist->fetch_array();							
		extract($objwishlist_result);
		
		$objwishlist = new mysql();	
		$query = "select * from tblwishlist where userid=".$_SESSION['user_nid']." and productid=".$_POST['wishlistpro_id'];
		$objwishlist->stmt = $query;
		$objwishlist->execute();	
		if($objwishlist_result = $objwishlist->fetch_array())
		{
			$_SESSION["addmsg"]= " It seems you love this garment . <br/> We have already added ".$productname." ".$catname." to your wishlist.<br /> <br /> <input type='button' value='Cool !' class='alert_popup_button' onclick='closealert_box();'   />" ;
		}
		else
		{
				$wdatewithtime = date('Y-m-d H:i:s');			
				$query = "insert into tblwishlist(userid,productid,createdate)values(".$_SESSION['user_nid'].",".$_POST['wishlistpro_id'].",'".$wdatewithtime."')";
				$objwishlist->stmt = $query;
				$objwishlist->execute();
				$_SESSION["addmsg"]= "We have added ".$productname." ".$catname." to your wishlist.<br /> <br /> <input type='button' value='Cool !' class='alert_popup_button' onclick='closealert_box();'   />" ;
		}
	
	}
}

?>

<div id="alert_dialog" class="modal" style="padding-bottom: 20px;" >
        <!-- Modal content -->
        <div class="modal-content alert_width" style="border-radius: 5px; border: solid 1px #666666;">           
          
            <p style="font-size: 20px; font-weight: bold;  padding-bottom:5px;">
               <span style="margin-left:40%; border-bottom:solid 1px #606062;"><img src="<?=$glob['rootRel']?>images/logo_popup.png" style="height:27px; margin-bottom:10px;" /></span>
                <span class="close" onclick="closealert_box();">X</span>
            </p>
            <p style="font-size: 14px; text-align:center;">
									<?php
                    if($_SESSION["addmsg"]!="")
                    {
					echo $_SESSION["addmsg"];                   
                    }
                    ?>

                <br />
            </p>
        </div>
    </div>

<script type="text/javascript">		
<?php
if($_SESSION["addmsg"]!="")
{
?>
alertpopup();
<?php
$_SESSION["addmsg"]="";
}
?>



</script>

 </body>
 </html>