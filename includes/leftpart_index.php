
    <div class="homePageNav">
    
    
    <nav class="navbar navbar-default">
                        <div class="container-fluid"> 
                        
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                          </div>
                       
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
    
        <ul class="gw-nav gw-nav-list" style="background-color:transparent;">
        <?php
		 $leftcat = new mysql();
		$query = "select catname as leftcatname,catid as leftmaincatid from tblcategory where parentid=0 and bstatus=1 and cattype='product' and blockstatus='active' order by sno,catname";
		$leftcat->stmt = $query;
		$leftcat->execute();		
	while($leftcat_result =$leftcat->fetch_array())
	{
	extract($leftcat_result);
	
	?>
    	 <li>        
	<a href="javascript:void(0)" style="color:#000;width: 250px;"><?=$leftcatname?></a>
                         <ul class="gw-submenu" style="background-color:transparent;">
                         
                         <?php
						  $leftsubcat = new mysql();
	$query = "select catid as leftsubcatid,catname as leftsubcatname from tblcategory where parentid=".$leftmaincatid." and bstatus=1 and cattype='product' and blockstatus='active' order by sno,catname";
	
	$leftsubcat->stmt = $query;
	$leftsubcat->execute();
	while($leftsubcat_result =$leftsubcat->fetch_array())
			{
			extract($leftsubcat_result);	
			?>	 <li>
			 <a href="products.php?catid=<?=$leftsubcatid?>" ><?=$leftsubcatname?>  </a></li>
             <?php
			}
						 ?>
                         
                         
	
     </ul>
     </li>
    
    <?php
	}
	?>
        
        
        <?php
		 $leftcat = new mysql();
		$query = "select tagid,tagname from tblproduct_tag where blockstatus='active' and tagid not in (9) ";
		$leftcat->stmt = $query;
		$leftcat->execute();		
	while($leftcat_result =$leftcat->fetch_array())
	{
	extract($leftcat_result);
	?>
     <li>
      <a href="products.php?tid=<?=$tagid?>" style="color:#000;width: 250px;"><?=$tagname?>  </a></li>
    <?
	}
	?>
        
        	 <li>
      <a href="pagecontent.php?id=29" style="color:#000;width: 250px;">MEET THE MAKERS  </a></li>
         </ul>
         
           </div>
                          </div>
                          
                        
                      
                        
                      </nav>
    </div>   




