<?php
//session_start();

class shoppingcart
{
  var $uniqueid;
  var $qty;
  var $productid;
  var $total;
  var $productfullname;
  var $imagefullname;
  var $productcode;
  var $price;
  var $sale_price;
  var $cart_catname;
  var $cart_subcatname;
  var $color;
  var $productpath;
  var $productpriceid;
  var $sizeid;
  
  function shoppingcart()
  {
  $this->uniqueid="";  
  $this->qty="0";
  $this->productid="";
  $this->total="0";
  $this->productfullname="";
  $this->imagefullname="";
  $this->productcode="";
  $this->price="0";
  $this->sale_price="0";
  $this->cart_catname="";
  $this->cart_subcatname="";
  $this->color="";
  $this->productpath="";
  $this->productpriceid=0;
  $this->sizeid=0;
  }
  
  function addtocart()
  {
	  if(isset($_SESSION['cart']))
		{
				
			$cartcount=0;
			  foreach($_SESSION['cart'] as $cartItems)
			  {
				//If we have the product already				
				  if ($cartItems['uniqueid'] == $this->uniqueid)
				  { 
					 $_SESSION['cart'][$this->uniqueid] = array(
				   								"uniqueid" => $cartItems['uniqueid'],
												 "qty" => $cartItems['qty'],
												   "productid" => $cartItems['productid'],
												   "productname" =>$cartItems['productname'],
												   "imagename" =>$cartItems['imagename'],
												   "productcode" => $cartItems['productcode'],
												   "price" => $cartItems['price'],
												   "sale_price" => $cartItems['sale_price'],
												   "total" => $cartItems['total'],
												   "cart_catname" => $cartItems['cart_catname'],
												   "cart_subcatname" => $cartItems['cart_subcatname']	,			
												   "color" => $cartItems['color'],
												   "productpath" => $cartItems['productpath'],
												   "productpriceid" => $cartItems['productpriceid'],
												   "sizeid" => $cartItems['sizeid']
												 
												);
				  $cartcount=1;
				  }				 
			  }
			   if($cartcount==0)
				  {
					 $_SESSION['cart'][$this->uniqueid] = array(
					                               "uniqueid" => $this->uniqueid,
												   "qty" => $this->qty,
												   "productid" => $this->productid,
												   "productname" =>$this->productfullname,
												   "imagename" =>$this->imagefullname,
												   "productcode" => $this->productcode,
												   "price" => $this->price,
												   "sale_price" => $this->sale_price,
												   "total" => $this->total,
												   "cart_catname" => $this->cart_catname,
												   "cart_subcatname" => $this->cart_subcatname,
												   "color" => $this->color,
												   "productpath" => $this->productpath,
												   "productpriceid" => $this->productpriceid,
												    "productpriceid" => $this->productpriceid,
													"sizeid" => $this->sizeid
												);
				  }
		}
		else
		{	
			$_SESSION['cart'][$this->uniqueid] = array(
											  		"uniqueid" => $this->uniqueid,
												   "qty" => $this->qty,
												   "productid" => $this->productid,
												   "productname" =>$this->productfullname,
												   "imagename" =>$this->imagefullname,
												   "productcode" => $this->productcode,
												   "price" => $this->price,
												   "sale_price" => $this->sale_price,
												   "total" => $this->total,
												   "cart_catname" => $this->cart_catname,
												   "cart_subcatname" => $this->cart_subcatname,
												   "color" => $this->color,
												   "productpath" => $this->productpath,
												   "productpriceid" => $this->productpriceid,
												   "sizeid" => $this->sizeid
												   
											);
											
		}
  }
  
  
  
  
  function removefromcart()
  {
	  	     foreach($_SESSION['cart'] as $cartItems)
			  {		
			  	$i++;	 
			  	if($cartItems['uniqueid'] == $this->uniqueid)
				{
				unset($_SESSION['cart'][$this->uniqueid]);
				$i--;
				}
			  }
			  if($i==0)
			  {
			  unset($_SESSION['cart']);			 
			  }
  }
  
  function updateincart()
  {
               foreach($_SESSION['cart'] as $cartItems)
			  {		 
			  	if($cartItems['uniqueid'] == $this->uniqueid)
				{
				$_SESSION['cart'][$this->uniqueid] = array(
					                             "uniqueid" => $this->uniqueid,
												   "qty" => $this->qty,
												   "productid" => $this->productid,
												   "productname" =>$this->productfullname,
												   "imagename" =>$this->imagefullname,
												   "productcode" => $this->productcode,
												   "price" => $this->price,
												   "sale_price" => $this->sale_price,
												   "total" => $this->total,
												   "cart_catname" => $this->cart_catname,
												   "cart_subcatname" => $this->cart_subcatname,
												    "color" => $this->color,
												   "productpath" => $this->productpath,
												   "productpriceid" => $this->productpriceid,
												   "sizeid" => $this->sizeid
												);
				}
			  } 
  }
  
}
?>