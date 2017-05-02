<script language="javascript">

function searchsite_product()
{
var srchtxt = document.getElementById("txtsearch").value;
location.href = "<?=$glob['rootRel']?>search.html?srch="+srchtxt;
}

function check_key(e)
{
	var key = e.keyCode;
	if(key==13)
	{
		searchsite_product();
	}
}

function changewishlist_image(id,src)
{
document.getElementById(id).src=src;
}

  function submit_wishlist(i)
{
var frm = document.getElementById('frmwishlist'+i);
frm.submit();
}

function gotoindex()
{
location.href="<?=$glob['rootRel']?>";
}

function gotocart()
{
location.href="<?=$glob['rootRel']?>cart.html";
}

</script>

<?php
	if(!isset($_SESSION["currency"]))
	{
		$_SESSION["currency"] = "eur";
	}
	$objcurr = new mysql();
    $objcurr->currency_value = $objcurr->get_currency_value($_SESSION["currency"]);
	$_SESSION["current_url"] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="headerHome"> 
	<a href="<?=$glob['rootRel']?>" class="site-logo mobile-header-item" id="header-logo">
   <img src="<?=$glob['rootRel']?>img/logo.png" alt="imaima logo">
  </a>
 <ul class="inline-list" style="margin-top: 3px !important;">
                <li id="header-main-nav-search">
                   
                        <input type="text" style=" width:270px; padding-left:10px;" name="txtsearch" id="txtsearch" onkeyup="check_key(event);" placeholder="" value="<? if(isset($_REQUEST["srch"])){echo $_REQUEST["srch"]; } ?>"><img src="<?=$glob['rootRel']?>images/search_bar_icons.jpg" style="position: absolute; margin-left: -27px; margin-top: 3px; cursor:pointer;" onclick="searchsite_product();"  /></i>
                    
                </li>

                <li class="dropdown dropdown-small">
                
                
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key"></span><span class="value"><?=strtoupper($_SESSION["currency"])?> </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="setcurrency.php?curr=eur">EUR</a></li>
                                  <li><a href="setcurrency.php?curr=usd">USD</a></li>
                                  <li><a href="setcurrency.php?curr=gbp">GBP</a></li>
                                  <li><a href="setcurrency.php?curr=inr">INR</a></li>
                                </ul>
                         
                
                  
                </li>
                <li>
                    <a href="<?=$glob['rootRel']?>wishlist.html"><i class="fa fa-heart"></i><span class="mylist">My Wishlist</span></a>
                </li>
                <li class="dropdown dropdown-small">
                <?php
				if(!isset($_SESSION['user_nid']))
{
				?>
                    <a href="<?=$glob['rootRel']?>signin.html"><i class="fa fa-user"></i><span class="mylist">SIGN IN</span></a>
                    <? } 
                    else
                    {
					?>
                    	<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-user"></i>Hi <div style="width:25px; height:25px; background-color:#444444; font-weight:bold; color:#ffffff; border-radius:12px; float: right;
margin-left: 6px;
margin-top: 7px;
padding-left: 9px;"><div style="margin-top:-8px;"><?=substr($_SESSION['user_name'], 0, 1);?></div></div></a>
 									<ul class="dropdown-menu" style="left:auto; right:0;">
                                      <li><a href="<?=$glob['rootRel']?>myaccount.html">My Profile</a></li>
                                      <li><a href="<?=$glob['rootRel']?>orderhistory.html">Order History</a></li>
                                    <li><a href="<?=$glob['rootRel']?>logout.html">SignOut</a></li>
                                    </ul>
                    <?
					}
					?>
                </li>
                <li id="header-main-nav-basket">
                    <a class="#" href="<?=$glob['rootRel']?>cart.html" data-label="basket">
                        <div class="basket-wrap">
                            
                            	<div style="width:30px; height:30px; text-align:center; margin-top:-20px; background-image:url(<?=$glob['rootRel']?>img/cartbg.png)">
                                
                                 <?php
				$item = 0;
				$unit = 0;
				$total = 0;
				if(isset($_SESSION['cart']))
					{
						  foreach($_SESSION['cart'] as $cartItems)
						  {
							$item = $item + 1;	
							$unit = $unit + $cartItems['qty'];
							$total = $total + $cartItems['total'];
						 }
					}		
					echo $unit;
				?>	
                                </div>
                              
                                
                           
                        </div>
                    </a>
                </li>



            </ul>
</div>
