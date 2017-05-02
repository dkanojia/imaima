
<section id="sidebar">
              <ul>
              <li <?php if($_SESSION["userpage"]=="myaccount"){ ?> class="active" <?php } ?> > 
			  <a href="<?=$glob['rootRel']?>myaccount.html">My Account</a>
			  </li>
			   <li <?php if($_SESSION["userpage"]=="myprofile"){ ?> class="active" <?php } ?> > 
			  <a href="<?=$glob['rootRel']?>myprofile.html">My Profile</a>
			  </li>
			   <li <?php if($_SESSION["userpage"]=="current-order"){ ?> class="active" <?php } ?> > 
			  <a href="<?=$glob['rootRel']?>current-order.html">Current Order</a>
			  </li>			 
			  <li <?php if($_SESSION["userpage"]=="order-history"){ ?> class="active" <?php } ?> > 
			  <a href="<?=$glob['rootRel']?>order-history.html">Order History</a>
			  </li>
			  <li <?php if($_SESSION["userpage"]=="track-order"){ ?> class="active" <?php } ?> > 
			  <a href="<?=$glob['rootRel']?>customer_service/order-status.html">Track Order</a>
			  </li>
			   <li <?php if($_SESSION["userpage"]=="wishlist"){ ?> class="active" <?php } ?> > 
			  <a href="<?=$glob['rootRel']?>wishlist.html">WishList</a>
			  </li>
			 <?php /*?> <li <?php if($_SESSION["userpage"]=="changepassword"){ ?> class="active" <?php } ?> > 
			  <a href="<?=$glob['rootRel']?>change-password.html">Change Password</a>
			  </li><?php */?>
			  <li> 
			  <a href="<?=$glob['rootRel']?>logout.html">Logout</a>
			  </li>
<li>&nbsp;</li>

          
              </ul>
            </section>