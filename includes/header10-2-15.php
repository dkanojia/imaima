<link href="images/cart.png" rel="icon">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/stylesheet.css">

<link rel="stylesheet" type="text/css" href="css/font.css">

<link href="css/css.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="css/pavproducts.css" media="screen">


<link rel="stylesheet" type="text/css" href="css/pavblog.css" media="screen">


<link rel="stylesheet" type="text/css" href="css/typo.css" media="screen">


<link rel="stylesheet" type="text/css" href="css/pavproductcarousel.css" media="screen">


<link rel="stylesheet" type="text/css" href="css/colorbox.css" media="screen">


<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.css">


<link rel="stylesheet" type="text/css" href="css/font-awesome.css">


<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">

<link rel="stylesheet" type="text/css" href="css/theme-responsive.css">






<script type="text/javascript" src="js/jquery-1.js"></script>


<script type="text/javascript" src="js/jquery-ui-1.js"></script>


<script type="text/javascript" src="js/jquery_002.js"></script>


<script type="text/javascript" src="js/common.js"></script>


<script type="text/javascript" src="js/common_002.js"></script>


<script type="text/javascript" src="js/bootstrap.js"></script>


<script type="text/javascript" src="js/common_002.js"></script>


<script type="text/javascript" src="js/jquery_004.js"></script>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>


<script type="text/javascript" src="js/jquery_003.js"></script>


<script type="text/javascript" src="js/tabs.js"></script>


<script src="HAYA_files/js.htm" type="”text/javascript”"></script>


   <script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>

<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<script src="js/jquery.flexslider.js"></script>



</head>

<body class="fs12 page-home ">

	<div id="page-container">

	<header id="header">

		<div class="container">

			<div class="container-inner">

				
					<div id="logo"><a href="index.php"><img src="images/haya-ENG.png" title="Haya Zone" alt="Haya Zone" style="width:170px;"></a></div>

				
				<div id="headertop">

					
							<div class="box-style free-shipping">
<h4>Free shipping</h4>

<p>&nbsp;</p>
</div>

<div class="box-style time-delivery">
<h4>On time delivery</h4>

<p>&nbsp;</p>
</div>

<div class="box-style best-services">
<h4>Best services</h4>

<p>&nbsp;</p>
</div>
     <?php
session_start();
	
	//include("shoppingcart.php");
 if(isset($_POST['checkoutformhead']))
{
		
	if(isset($_SESSION['cart']))
	{
	  if(isset($_SESSION['user_loginid']) && isset($_SESSION['user_nid']))	
		{
			$order = new mysql();
			$orderdate = date('Y-m-d');
			$orderdatewithtime = date('Y-m-d H:i:s');
			$orderno = date('Ymd');
		 	  $query = "insert into tblorder (orderdate,orderdatewithtime,userid,subtotal,shipping,grandtotal,orderstatus,bstatus) values
			('".$orderdate."','".$orderdatewithtime."','".$_SESSION['user_nid']."','".$_POST['subtotalammount']."','".$_POST['shipping_charges']."','".$_POST['grandtotal']."','pending','1')";
				
			$order->stmt = $query;
			$order->execute();
			
		    $order = new mysql();
			
			$query = "select max(orderid) as currentorderid from tblorder";
			$order->stmt = $query;
			$order->execute();
			$order_result=$order->fetch_array();
			extract($order_result);
			$orderid = $currentorderid;
			
			if($orderid<10)
			$orderno = $orderno ."000".$orderid;
			elseif($orderid<100)
			$orderno = $orderno ."00".$orderid;
			elseif($orderid<10000)
			$orderno = $orderno ."0".$orderid;
			else
			$orderno = $orderno .$orderid;
			
			//$itemtotal = 0;	
			//$subtotal = 0;			
			foreach($_SESSION['cart'] as $cartItems)
			{
			  $query = "insert into tblorder_detail (orderid,productid,product_cost,product_qty,totalamount,productfullname,productcode,cost1,imagepath,productpath,sizeid,productpriceid,color) values
			(".$orderid.",'".$cartItems["productid"]."','".$cartItems["sale_price"]."','".$cartItems["qty"]."','".$cartItems["total"]."','".$cartItems["productname"]."','".$cartItems["productcode"]."','".$cartItems["sale_price"]."','".$cartItems["imagename"]."','".$cartItems["productpath"]."','".$cartItems["sizeid"]."','".$cartItems["productpriceid"]."','".$cartItems["color"]."')";
			$order_detail = new mysql();
			$order_detail->stmt = $query;
			$order_detail->execute();
			
			 //$itemtotal = $itemtotal + $cartItems["total"];
			}
			//$subtotal = $itemtotal + $subtotal;
			//$subtotal = $itemtotal - $_POST["hiddiscount"];
			//$shipping = $_POST["hidshipvalue"];
			//$grandtotal = $subtotal + $shipping;
			$query = "update tblorder set orderno='".$orderno."' where orderid=".$orderid;
			$order->stmt = $query;
			$order->execute();
			$_SESSION["orderid"] = $orderid;
			header("location:checkout.php");
			}
		else	
		{
			header("location:login.php");
		}
	 }
}

 ?>
<?php

/*if(isset($_POST["btnremove_x"]))
{
		if(isset($_SESSION['cart']))
		{		
			$i = 0;
			$scart = new shoppingcart();
		    $scart->uniqueid=$_POST['hiduniqueid'];
			$scart->removefromcart();
		?>
		<script type="text/javascript">
		document.getElementById('successmsg').style.display="block";
		document.getElementById("successmsg").innerHTML = "Success: You have modified your Cart!<img src='images/close.png'  class='close'>";
		document.getElementById("successmsg").focus();
		</script>
		<?php		
		}	
}*/
?>

	<div class="pull-right cart-top">
    
    
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
				
				?>	

						<div class="" id="cart">
      <div class="heading">
    		<h4>Shopping Cart</h4>
    <a><span id="cart-total"><?php echo $unit?> - Rs. <?php echo $total?></span></a></div>
    <?php
	
    if(isset($_SESSION['cart']))
	{
	?>
    <div class="content">
        <div class="mini-cart-info">
      <table>
      <?php 
							 $subtotal=0;
			 if(isset($_SESSION['cart']))
				{
					$subtotal=0;
					 foreach($_SESSION['cart'] as $cartItems)
					  {
					  $uniqueid=$cartItems['uniqueid'];  
					  $prodid=$cartItems['productid'];
					  $qty=$cartItems['qty'];
					  $price=$cartItems['price'];
					  $sale_price=$cartItems['sale_price'];					  
					  $total=$cartItems['total'];
					  $productname=$cartItems['productname'];
					  $productcode=$cartItems['productcode'];
					  $imagename=$cartItems['imagename'];
					  $propath=$cartItems['productpath'];
					  $color=$cartItems['color'];
					  $sizeid=$cartItems['sizeid'];
					  $productpriceid=$cartItems['productpriceid'];
					  $subtotal = $subtotal+$total; 
					  
					  ?>
					<!--<form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="hiduniqueid" value="<?=$uniqueid?>"  />
					<input type="hidden" name="hidimagename" value="<?=$imagename?>"  />
					<input type="hidden" name="hidproductname" value="<?=$productname?>"  />
					<input type="hidden" name="hidproductcode" value="<?=$productcode?>"  />
					<input type="hidden" name="hidproductid" value="<?=$prodid?>"  />
					<input type="hidden" name="hidprice" value="<?=$price?>"  />
					<input type="hidden" name="hidsaleprice" value="<?=$sale_price?>"  />
                    <input type="hidden" name="hidpropath" value="<?=$propath?>"  />-->
                   
      
                <tbody><tr>
          <td class="image">            <a href=""><img src="image/product/big/<?php echo $imagename ?>" alt="<?php echo $productname ?>" title="<?php echo $productname?>" width="50"></a>
            </td>
          <td class="name"><a href="product.php?id=<?=$prodid?>"><?php echo $productname?></a>
            <div>
                                        </div></td>
          <td class="quantity">x&nbsp;<?=$qty?></td>
          <td class="total">Rs. <?=$total?></td>
          <td class="remove"><!--<input type="image" title="Click here for delete this item" src="images/remove-small.png" name="btnremove" onClick="return confirm('Are You sure to delete this Product.');" />--></td>
        </tr>
                      </tbody><!--</form>-->
                      
                   <?php
                   }
				   }
				   ?>   
                      
                      
                      </table>
    </div>
    <div class="mini-cart-total">
	<table id="total">
												<tbody><tr>
							<td class="right"><b>Sub-Total:</b></td>
							<td class="right">Rs. <?=number_format($subtotal,2)?></td>
						</tr>
                        <?php
						$shipcharge = new mysql();
						$queryShip = "select normal_min_shipping as min_shipping,ship_charge as shipping_charges from tbladmin_setting";
						$shipcharge->stmt = $queryShip;
						$shipcharge->execute();
						$shipping_chargeresult =$shipcharge->fetch_array();	
						extract($shipping_chargeresult);	
							
						if($subtotal > $min_shipping){
								$shipping_charges=0;
						}
						$grandtotal = $subtotal+$shipping_charges;
						 ?>
                         <tr>
                          <td class="right"><b>Flat Shipping Rate:</b></td>
                          <td class="right">Rs. <?=number_format($shipping_charges,2)?></td>
                        </tr>
						<tr>
							
                        	<td class="right"><b>Total:</b></td>
							<td class="right">Rs. <?=number_format($grandtotal,2)?></td>
						</tr>
											</tbody></table>
    </div>
     <form action="" method="post">
	 				<input type="hidden" name="subtotalammount" value="<?=$subtotal?>"/>
                    <input type="hidden" name="shipping_charges" value="<?=$shipping_charges?>"/>
                    <input type="hidden" name="grandtotal" value="<?=$grandtotal?>"/>
    <div class="checkout"><a href="cart.php">View Cart</a> |  <input type="submit" name="checkoutformhead" class="button" value="Checkout" /></div>
       </form>
      </div>
      
      <?php
	  }
	 
	  else
      
	  {
	   ?>
	  <div class="content">
        <div class="empty">Your shopping cart is empty!</div>
      </div>
      <?php
	  }
	  ?>
      
      
      
      </div>
      
      





					</div>
				</div>



				<div id="headerbottom">
            		
							<div class="links">
								  <a class="account" href="myaccount.php">My Account</a>
								  <a class="wishlist" href="wishlist.php" id="wishlist-total">Wish List (0)</a>
								  <!--<a class="last checkout" href="checkout.php">Checkout</a>-->
						
						      	<?php
							//		print_r($_SESSION);
							  if(isset($_SESSION['user_loginid']))
						  { ?>
                         	<a href="myaccount.php"><?php echo $_SESSION['user_name'] ?> </a>
                            <a href="logout.php">Logout</a></span>
                          	<?php }else { ?> 
                            <a href="login.php">login</a>
                            <a href="register.php">Register</a>
									 <?php } ?>
                                     </div>
                            <?php 
							   
		 /*
		 	 <div class="links">
		 $meta = new mysql();
		  $query = "select * from tblpage_content where groupname='Header' and blockstatus='active' and bstatus=1 ";
		  $meta->stmt = $query;
		  $meta->execute();
	      
				  while($meta_result = $meta->fetch_array())
						  
		 {
		  		     extract($meta_result); 
					  if($pagetype=='standard') 
					  {       
           		  echo "<a href='pagecontent.php?id=".$pageid."' title='".$pagetitle."'>".$pagename."</a>";
          
				}
				else if($pagetype=='custom') 
				{
				 echo "<a href='$pagelink' title='".$pagetitle."'>".$pagename."</a>";
                 
				 }
	
		}
		</div>
		*/
			?>
              
				
				  </div>

				<div id="mainnav">
	
					<nav id="mainmenu" class="pull-left">

						<div class="navbar">

							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">

							  <span class="icon-bar"></span>

							  <span class="icon-bar"></span>

							  <span class="icon-bar"></span>	
                              </a>

							<div class="navbar-inner">

							<div class="nav-collapse collapse">

							  <ul class="nav megamenu">
                              <?php 
							    
		  $meta = new mysql();
		  $query = "select catid as maincatid, catname as maincatname,title from tblcategory where parentid=0 and  blockstatus='active' and bstatus=1 ";
		  $meta->stmt = $query;
		  $meta->execute();
	      
				  while($meta_result = $meta->fetch_array())
						  
		 {
		  		     extract($meta_result); 
				     
             echo "<li class='parent dropdown deeper'><a class='dropdown-toggle' data-toggle='dropdown' href='#' title='".$title."'>".$maincatname."</a>";
			
					
			
             $subcat = new mysql();
			 $query = "select catid as subcatid, catname as subcatname,title from tblcategory where parentid='".$maincatid."' and  blockstatus='active' and bstatus=1 ";
            $subcat->stmt = $query;
			$subcat->execute();
			 if($subcat->getNumRows()>0)
                {
				echo "<ul class='dropdown-menu'>";
				   while($subcat_result =$subcat->fetch_array())
                    { 
					 extract($subcat_result);
					 
					 echo "<li><a href='category.php?id=".$subcatid."' title='".$subcatname."'>".$subcatname."</a>";
					 
								/*	<li class="parent dropdown deeper"><a href="category.php" class="dropdown-toggle" data-toggle="dropdown">Women
									<b class="caret"></b>

						
									</a>*/
					}
						echo "</ul>";
						}
								echo "</li>";
																	
							 }
			?>	
                                  		
								  </ul>
							</div>	
						  </div>		  
						</div>
					</nav>

					<div id="search" class="pull-right">
						
                        
						<?php /*?>	<?php 
											$cat = new mysql();
							echo $query ="select * from tblproduct where blockstatus='active' and bstatus=1 and productname like '%".$_REQUEST["srch"]."%'";
											$cat->stmt = $query;
											$cat->execute();
											while($cat_result = $cat->fetch_array())
											{
											
											extract($cat_result);
											//print_r($cat_result);
											echo "$productname";
											
											}
											
											?><?php */?>
                                           <!-- <form name="search" action="">-->

							<input name="search" id="txtsearch" placeholder="Search" type="text" >
								<input type="button" value="Search" onClick="searchpagegroup();" class="button-search">
							<!--<span class="button-search" value="Search" onClick="searchpagegroup();" >Search</span>-->
                           <!-- </form>	-->				</div>
				</div>
			</div>
		</div>
	</header>
		<script type="text/javascript">


function searchpagegroup()
{

var srchtxt = document.getElementById("txtsearch").value;

location.href="search.php?srch="+srchtxt;
}
</script>