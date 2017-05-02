<?php
include("include/header.inc.php");
include("../FCKeditor/fckeditor.php");


if(isset($_POST["btnupdate"]))
{



		$signup = new mysql();
	$query= "update tbluser set firstname='".$_POST["txtfname"]."',lastname='".$_POST["txtlname"]."',company='".$_POST["txtcompany"]."', address='".$_POST["txtaddress1"]."',address2='".$_POST["txtaddress2"]."',city='".$_POST["txtcity"]."',state='".$_POST["txtstate"]."',country='".$_POST["drpcountry"]."',zip='".$_POST["txtzip"]."',phone1='".$_POST["txtphone"]."',ship_fname='".$_POST["txtsfname"]."',ship_lname='".$_POST["txtslname"]."',ship_company='".$_POST["txtscompany"]."', ship_address1='".$_POST["txtsaddress1"]."',ship_address2='".$_POST["txtsaddress2"]."',ship_city='".$_POST["txtscity"]."',ship_state='".$_POST["txtsstate"]."',ship_country='".$_POST["drpscountry"]."',ship_zip='".$_POST["txtszip"]."',ship_phone='".$_POST["txtsphone"]."',productupdate='".$_POST["chkproduct"]."',newsletter='".$_POST["chknewsletter"]."',blockstatus='".$_POST["rdstatus"]."' where nid='".$_REQUEST["id"]."'";
	
	$signup->stmt = $query;
	$signup->execute();		
$msg = " Information Updated Successfully";
}



?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php

include("include/left.inc.php");
?>

 <aside class="right-side">
  <?php include("include/contentheader.inc.php"); ?>

    <?php
if(isset($_REQUEST["id"]))
{
$page = new mysql();
$query = "select * from tbluser where  nid=".$_REQUEST["id"];
$page->stmt = $query;
$page->execute();
if($page_result =$page->fetch_array())
{
extract($page_result);
}
else
{
header("location:users.php");
}
}
?>

  <script language="javascript" type="text/javascript">
  function checkform()
{
    var err = "";
	
	
	
	if(document.getElementById("txtfname").value=="")
	{
	err +="Please Enter First Name\n";
	}
	if(document.getElementById("txtlname").value=="")
	{
	err +="Please Enter Last Name\n";
	}
	
	
	if(document.getElementById("drpcountry").value=="--Select--")
    {
    err += "Please Select Country name\n";  
    }
	
	if(document.getElementById("txtphone").value=="")
    {
    err += "Please Enter Phone\n";   
    }
	
	if(document.getElementById("txtsfname").value=="")
	{
	err +="Please Enter Shipping First Name\n";
	}
	if(document.getElementById("txtslname").value=="")
	{
	err +="Please Enter Shipping Last Name\n";
	}
	
	
	if(document.getElementById("drpscountry").value=="--Select--")
    {
    err += "Please Select Shipping Country name\n";  
    }
	
	if(document.getElementById("txtsphone").value=="")
    {
    err += "Please Enter Shipping Phone\n";   
    }
	
	
	if(err!="")
	{
	alert(err);
	return false;
	}
}

  </script>      
            

    <form name="metaform" action="" method="post" enctype="multipart/form-data">
    <section class="content">
        <table width="70%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="480" valign="top"><table style="text-align:left;" class="formbox" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td> First Name: </td>
                  <td> <input class="txtBox"  type="text" name="txtfname" id="txtfname" value="<?=$firstname ?>"/>
                  </td>
                </tr>
                <tr>
                  <td> Last Name: </td>
                  <td> <input class="txtBox"  type="text" name="txtlname" id="txtlname" value="<?=$lastname ?>"/>
                  </td>
                </tr>
                <tr>
                  <td> Company Name: </td>
                  <td> <input class="txtBox"  type="text" name="txtcompany" id="txtcompany" value="<?=$company ?>"/>
                  </td>
                </tr>
                <tr>
                  <td> Address Line 1: </td>
                  <td> <input class="txtBox"  type="text" name="txtaddress1" id="txtaddress1" value="<?=$address ?>"/>
                  </td>
                </tr>
				<tr>
                  <td> Address Line 2: </td>
                  <td> <input class="txtBox"  type="text" name="txtaddress2" id="txtaddress2" value="<?=$address2 ?>"/>
                  </td>
                </tr>
				<tr>
                  <td> City: </td>
                  <td> <input class="txtBox"  type="text" name="txtcity" id="txtcity" value="<?=$city ?>"/>
                  </td>
                </tr>
				<tr>
                  <td>  State / Province: </td>
                  <td>  <input class="txtBox"  type="text" name="txtstate" id="txtstate" value="<?=$state ?>"/>
                  </td>
                </tr>
				<tr>
                  <td> Country: </td>
                  <td>  <select class="txtBox_dr" id="drpcountry" name="drpcountry">
					<option value="--Select--">--Select--</option>
					<?php
						
				$countrylist = new mysql();
				$query = "select distinct countryname as countryname from tblcountrycode where bstatus=1 and enable=1 order by countryname";
				$countrylist->stmt = $query;
				$countrylist->execute();
				while($countrylist_result =$countrylist->fetch_array())
				{
				extract($countrylist_result);
				if(strtolower($countryname)==strtolower($country))
				echo "<option value='".$countryname."' selected='true'>".$countryname."</option>";
				else
				echo "<option value='".$countryname."'>".$countryname."</option>";
				}
				?>
				
                </select>
                  </td>
                </tr>
				<tr>
                  <td>  ZIP / Postal Code: </td>
                  <td> <input class="txtBox" type="text" name="txtzip" id="txtzip" value="<?=$zip ?>"/>
                  </td>
                </tr>
				<tr>
                  <td>  Phone Number: </td>
                  <td>  <input class="txtBox" type="text" name="txtphone" id="txtphone" value="<?=$phone1 ?>"/>
                  </td>
                </tr>
				<tr>
				<td colspan="2">
				<strong>Shipping Information</strong>
				</td>
				</tr>
				<tr>
                  <td>   First Name: </td>
                  <td>  <input class="txtBox"  type="text" name="txtsfname" id="txtsfname"  value="<?=$ship_fname ?>"/>
                  </td>
                </tr>
				<tr>
                  <td>  Last Name: </td>
                  <td>   <input class="txtBox"  type="text" name="txtslname" id="txtslname"  value="<?=$ship_lname ?>"/>
                  </td>
                </tr>
				
				<tr>
                  <td>  Company Name: </td>
                  <td>  <input class="txtBox"  type="text" name="txtscompany" id="txtscompany"  value="<?=$ship_company ?>"/>
                  </td>
                </tr>
				<tr>
                  <td> Address Line 1: </td>
                  <td>    <input class="txtBox"  type="text" name="txtsaddress1" id="txtsaddress1"  value="<?=$ship_address1 ?>"/>
                  </td>
                </tr>
				<tr>
                  <td>  Address Line 2: </td>
                  <td>   <input class="txtBox"  type="text" name="txtsaddress2" id="txtsaddress2"  value="<?=$ship_address2 ?>"/>
                  </td>
                </tr>
				<tr>
                  <td>  City: </td>
                  <td>   <input class="txtBox"  type="text" name="txtscity" id="txtscity"  value="<?=$ship_city ?>"/>
                  </td>
                </tr>
				<tr>
                  <td>  State / Province:  </td>
                  <td>    <input class="txtBox"  type="text" name="txtsstate" id="txtsstate"  value="<?=$ship_state ?>"/>
                  </td>
                </tr>
				<tr>
                  <td>  Country: </td>
                  <td>  <select class="txtBox_dr" id="drpscountry" name="drpscountry">
                        <option value="--Select--">--Select--</option>
				<?php
					
$country = new mysql();
$query = "select distinct countryname as countryname from tblcountrycode where bstatus=1 and enable=1 order by countryname";
$country->stmt = $query;
$country->execute();
while($country_result =$country->fetch_array())
{
extract($country_result);
if(strtolower($countryname)==strtolower($ship_country))
echo "<option value='".$countryname."' selected='true'>".$countryname."</option>";
else
echo "<option value='".$countryname."'>".$countryname."</option>";
}
?>
                      </select>
                  </td>
                </tr>
				<tr>
                  <td>  Phone Number: </td>
                  <td>  <input class="txtBox" type="text" name="txtsphone" id="txtsphone"  value="<?=$ship_phone ?>"/>
                  </td>
                </tr>
				<tr >
<td >
Block Status
</td>
<td >
<input type="radio" class='btnradio' name="rdstatus" <?php if($blockstatus==active) echo "checked='checked'  " ?> value='active' />Active
<span style="padding-left:42px"><input type="radio" class='btnradio' name="rdstatus" <?php if($blockstatus!=active) echo "checked='checked'  " ?> value='block'/>Block</span>
</td>
</tr>
				<td colspan="2">
				<strong>Would you like to Receive:</strong>
				</td>
				</tr>
				<tr>
                  <td>  <input id="chkproduct" class='btnradio' name="chkproduct" type="checkbox" >
                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin:0 0 0 15px; color:#535353;">Product Updates</span> </td>
                  <td>    <input type="checkbox" class='btnradio' name="chknewsletter" id="chknewsletter">
                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin:0 0 0 15px; color:#535353;">Our Newsletter</span>
                  </td>
                </tr>
              
              </table></td>
            
          </tr>
         
      
         
          <tr>
            <td colspan="2" style="padding:10px 10px 10px 200px;" >

              <input type="submit" class="btn" name="btnupdate" value="Save" style="width:43px" onClick="return checkform();"/>
            
              <input type="button" class="btn" name="btncancel" value="Cancel" onclick='location.href="users.php"' />
            </td>
          </tr>
          <tr >
            <td colspan="2"><?php echo $msg; ?> </td>
          </tr>
        </table>
      </section>
    </form>
 
<?php
include("include/footer.inc.php");
?>
