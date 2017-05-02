<script language="javascript" type="text/javascript">
 function openpopup() { 
 			blankreview();			
            document.getElementById("divaddnew").style.display = "block";
            document.getElementById("popupdiv").style.display = "block";
            var docwidth = document.body.offsetWidth;
            var balance = (docwidth - 520) / 2;
            balance = balance + 50;
            document.getElementById("divaddnew").style.left = balance + 'px';
			var ht=400;
			 var tp = posTop() + ((pageHeight() - ht) / 2) - 12;          
			document.getElementById("divaddnew").style.top=(tp < 0 ? 0 : tp) + "px";
			return false;
        }
        function closediv() {
		blankreview();	
            document.getElementById("popupdiv").style.display = "none";
            document.getElementById("divaddnew").style.display = "none";
        }
		
		
		    function pageHeight() {

        return window.innerHeight != null ? window.innerHeight : document.documentElement && document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body != null ? document.body.clientHeight : null;
    }
    
    function posTop() {

        return typeof window.pageYOffset != 'undefined' ? window.pageYOffset : document.documentElement && document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ? document.body.scrollTop : 0;
    }
	
	function changecolor(spno)
	{
	    
		removeallstar(spno);
		var i=1;
		while (i<=spno)
		{
		document.getElementById("spstar"+i).className="reviewstar_on";
		i++;
		}		
	}
	
	function origcolor()
	{
		var stno = 1;
		if(document.getElementById("hidrating").value!="")
		{
			stno = parseInt(document.getElementById("hidrating").value);
			var i = 1;
			while (i<=stno)
			{
			document.getElementById("spstar"+i).className="reviewstar_on";
			i++;
			}	
		stno = stno + 1;
		}		
		removeallstar(stno);
	}

	function removeallstar(spno)
	{	   
		while (spno<6)
		{
		document.getElementById("spstar"+spno).className="reviewstar";
		spno++;
		}
	}
	
	function setcolor(spno)
	{
		document.getElementById("hidrating").value=spno;
	}
   
   function blankreview()
	{
	document.getElementById("txtnickname").value="";
	document.getElementById("txtlocation").value="";
	document.getElementById("txtemail").value="";
	document.getElementById("txttitle").value="";
	document.getElementById("txtreview").value="";
	document.getElementById("hidrating").value="";
	removeallstar(1);
	}   
	
	
   function checkreview()
   {
     var str ="";
	 if(document.getElementById("txtnickname").value=="")
	 {
	 str +="Enter Nick Name \n";
	 }
	 if(document.getElementById("txtlocation").value=="")
	 {
	 str += "Enter Location\n";
	 }
	 if(document.getElementById("txtemail").value=="")
	 {
	 str += "Enter Email Id \n";
	 }

	 else
	{
		if(!CheckEmail(document.getElementById("txtemail").value))
		{
		str +="Please Enter valid Emailid\n";
		}
	}
	 if(document.getElementById("txttitle").value=="")
	 {
	 str +="Enter Title \n";
	 }
	 if(document.getElementById("txtreview").value=="")
	 {
	 str +="Enter Review \n";
	 }
	 if(document.getElementById("hidrating").value=="")
	 {
	 str +="Select Rating \n";
	 }
	 
	 if(str!="")
	 {
	 alert(str);
	 return false;
	 }
	/* else
	{
	document.getElementById("reviewform").submit();
	}*/

   }

		
</script>

<?php
	
	$gemsbead = new mysql();
	
	if(isset($_POST["reviewsubmit"]))
	{
	if($origproid=="")
	 $origproid=0;
		$review = new mysql();
		$query = "insert into tblreview set name='".$_POST["txtnickname"]."', emailid='".$_POST["txtemail"]."', reviewtitle='".$_POST["txttitle"]."', reviewdesc='".$_POST["txtreview"]."', country='".$_POST["txtlocation"]."', rating='".$_POST["hidrating"]."', catname='".$maincatname."', subcatname='".$origcatname."', proname='".$origproname."', productid=".$origproid.",date=curdate(), bstatus=1";
		$review->stmt = $query;
		$review->execute();
		
		$_SESSION["addmsg"]="Review Submitted Successfully";
	}
?>
 <div id="popupdiv">
            </div>
            <div style="display: none; color: #535353; width: 480px;" id="divaddnew" class="newpopupdiv">
				<form  action="" method="post" name="reviewform" id="reviewform">
              	  <table style="text-align:left; margin-left:15px; margin-bottom:20px;" width="95%" align="center" border="0" cellpadding="5" cellspacing="0">
                    <tr>
                        <td colspan="4" align="right" style="border-bottom: solid 2px #50718B">
                            <div style="float: left; text-align: left; width: 80%; font-weight: bold; 
                                font-size: 14px; padding:3px;">
                                Write a Product Review
                            </div>
                            <div style="float: right;">
                                <img src="<?=$glob['rootRel']?>images/erase.png" onclick="closediv();" width="20" style="cursor: pointer;" /></div>
                        </td>
                    </tr>
                    <tr style="height: 15px;">
                        <td colspan="4">&nbsp;
                            
                        </td>
                    </tr>
					
                    <tr style="height: 30px;">
                        <td width="100">
                           Nick Name
                        </td>
                        <td width="120">
                            <input type="Text" id="txtnickname" name="txtnickname" style="height:20px; width:100px;" />
                        </td>
						<td width="100" style="padding-left:15px;">
                           Location
                        </td>
                        <td width="120">
                            <input type="Text" id="txtlocation" name="txtlocation"  style="height:20px; width:100px;" />
                        </td>
                    </tr>
					 <tr style="height: 30px;">
                        <td>
                           Email
                        </td>
                        <td colspan="3">
                            <input type="Text" id="txtemail" name="txtemail"  style="width:375px; margin:0px; padding:0px; height:20px;" />
                        </td>						
                    </tr>
					 <tr style="height: 30px;">
                        <td>
                           Your Rating
                        </td>
                        <td colspan="3" style="background-color:#ddd;">
							<div id="spstar1"onmouseover="changecolor(1);" onmouseout="origcolor();" onclick="setcolor(1);" class="reviewstar"></div>
							<div id="spstar2"onmouseover="changecolor(2);" onmouseout="origcolor();" onclick="setcolor(2);" class="reviewstar"></div>
							<div id="spstar3"onmouseover="changecolor(3);" onmouseout="origcolor();" onclick="setcolor(3);" class="reviewstar"></div>
							<div id="spstar4"onmouseover="changecolor(4);" onmouseout="origcolor();" onclick="setcolor(4);" class="reviewstar"></div>
							<div id="spstar5"onmouseover="changecolor(5);" onmouseout="origcolor();" onclick="setcolor(5);" class="reviewstar"></div>
							<input type="hidden" name="hidrating" id="hidrating" value="" />
                        </td>						
                    </tr>
					<tr>
					<td align="left">
					Your Review
					</td>
					</tr>
                    <tr style="height: 30px;">
                        <td>
                           Title
                        </td>
                        <td colspan="3">
                            <input type="Text" id="txttitle" name="txttitle" style="width:375px; height:20px;" />
							
                        </td>						
                    </tr>
					<tr style="height: 30px;">
                        <td>
                           Review
                        </td>
                        <td colspan="3">
						    <textarea id="txtreview" name="txtreview" rows="4" cols="40"></textarea>
                        </td>						
                    </tr>
                    <tr>
                        <td style="height: 5px; text-align: center; padding-top: 20px;" colspan="4">
                           <input type="submit" name="reviewsubmit" value="" class="submitreview" onclick="return checkreview();" />
                        </td>
                    </tr>                   
                </table>
				</form>
            </div>