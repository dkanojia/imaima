<script language="javascript" type="text/javascript">
function searchproduct(catid,tid,color,sortby,style,size)
{

	var url = "products.php";
	if(catid!="")	
	url = url + "?catid="+catid;
	if(tid!="")	
	url = url + "?tid="+tid;
	if(color!="")
	url = url + "&c="+color;
	if(style!="")
	url = url + "&st="+style;
	if(size!="")
	url = url + "&sz="+size;
	if(sortby!="")
	url = url + "&s="+sortby;
	location.href=url;
	return false;
}
</script>


 <?php							
								   $req_color ="";
								   $req_style ="";
								   $req_size ="";
								   $req_sort ="";
								   $req_colorname ="Colour";
								   $req_stylename ="Style";
								   $req_sizename ="Size";
								   $req_sortname ="Sort By";
								   if(isset($_REQUEST["c"]))
									{
									$objcolor = new mysql();
									$req_color =$_REQUEST["c"];									
									$objcolor->stmt="select colorname from tblcolor where colorid='".$_REQUEST["c"]."'";
									$objcolor->execute();	
									$objcolor_result = $objcolor->fetch_array();									
									extract($objcolor_result);
									$req_colorname = $colorname;
									}
									 if(isset($_REQUEST["s"]))
									{
									$req_sort =$_REQUEST["s"];
									}
									 if(isset($_REQUEST["st"]))
									{
									$objcolor = new mysql();
									$req_style =$_REQUEST["st"];									
									$objcolor->stmt="select styleid,stylename from tblstyle where styleid='".$_REQUEST["st"]."'";
									$objcolor->execute();	
									$objcolor_result = $objcolor->fetch_array();									
									extract($objcolor_result);
									$req_stylename = $stylename;
									}
									 if(isset($_REQUEST["sz"]))
									{
									$objcolor = new mysql();
									$req_size =$_REQUEST["sz"];
									$objcolor->stmt="select sizeid,sizename from tblsize where sizeid='".$_REQUEST["sz"]."'";
									$objcolor->execute();	
									$objcolor_result = $objcolor->fetch_array();									
									extract($objcolor_result);
									$req_sizename = $sizename;
									}
								   ?>
                                   <div class="panel" style="float:left;">
                                    <ul class="inline-list" style="margin-top: 3px !important;">
                                    	<li class="dropdown dropdown-small">
                                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key"></span><span class="value"><?=$req_colorname?> </span><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li ><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>','','<?=$req_sort?>','<?=$req_style?>','<?=$req_size?>');">-All-</a></li>
                                          
                                          <?
											$objcolor = new mysql();
											$query="select colorid,colorname from tblcolor where colorid in (select distinct product_colorid from tblproduct where blockstatus='active' and bstatus=1 ";
											if($urlcatid!="0")
											{
											$query = $query . " and catid=".$urlcatid;
											} 
											if(isset($_REQUEST["tid"]))
											{
											$query = $query . " and FIND_IN_SET(".$_REQUEST["tid"].",product_tag)";
											} 
											$query = $query . ")";
											$objcolor->stmt=$query;
											$objcolor->execute();	
											while($objcolor_result = $objcolor->fetch_array())
											{
											extract($objcolor_result);
											?>
                                          
                                           <li><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>',<?=$colorid?>,'<?=$req_sort?>','<?=$req_style?>','<?=$req_size?>');"><?=$colorname?></a></li>
                                         <?
										 }
										 ?>
                                       
                                          
                                          
                                        </ul>
               					 		</li>
                                        
                                        <li class="dropdown dropdown-small">
                                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key"></span><span class="value"><?=$req_stylename?> </span><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li ><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','<?=$req_sort?>','','<?=$req_size?>');">-All-</a></li>
                                          
                                          <?											
											$objcolor = new mysql();
											$query="select styleid,stylename from tblstyle where styleid in (select distinct styleid from tblproduct where blockstatus='active' and bstatus=1 ";
											if($urlcatid!="0")
											{
											$query = $query . " and catid=".$urlcatid;
											} 
											if(isset($_REQUEST["tid"]))
											{
											$query = $query . " and FIND_IN_SET(".$_REQUEST["tid"].",product_tag)";
											} 
											$query = $query . ")";
											$objcolor->stmt=$query;
							$objcolor->execute();	
							while($objcolor_result = $objcolor->fetch_array())
							{
							extract($objcolor_result);
											?>
                                          
                                           <li><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','<?=$req_sort?>','<?=$styleid?>','<?=$req_size?>');"><?=$stylename?></a></li>
                                         <?
										 }
										 ?>
                                       
                                          
                                          
                                        </ul>
               					 		</li>
                                        
                                        
                                        <li class="dropdown dropdown-small">
                                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key"></span><span class="value"><?=$req_sizename?> </span><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li ><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','<?=$req_sort?>','<?=$req_style?>','');">-All-</a></li>
                                          
                                          <?
											$objcolor = new mysql();
											$query="select sizeid,sizename from tblsize where sizeid in (select distinct b.sizeid  from tblproduct a inner join tblproduct_price b on a.productid=b.productid where a.blockstatus='active' and a.bstatus=1 and b.bstatus=1 and b.blockstatus='active'";
											if($urlcatid!="0")
											{
											$query = $query . " and catid=".$urlcatid;
											} 
											if(isset($_REQUEST["tid"]))
											{
											$query = $query . " and FIND_IN_SET(".$_REQUEST["tid"].",a.product_tag)";
											} 
											$query = $query . ")";
											$objcolor->stmt=$query;
											$print_query = $query;
							$objcolor->execute();	
							while($objcolor_result = $objcolor->fetch_array())
							{
							extract($objcolor_result);
											?>
                                          
                                           <li><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','<?=$req_sort?>','<?=$req_style?>','<?=$sizeid?>');"><?=$sizename?></a></li>
                                         <?
										 }
										 ?>
                                       
                                          
                                          
                                        </ul>
               					 		</li>
                                        
                                        <li class="dropdown dropdown-small">
                                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key"></span><span class="value"><?=$req_sortname?> </span><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li ><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','sale_price','<?=$req_style?>','<?=$req_size?>');">By Price, low to high</a></li>
                                          <li ><a href="#" onClick="return searchproduct('<?=$urlcatid?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','sale_pricebydesc' ,'<?=$req_style?>','<?=$req_size?>');">By Price, high to low</a></li>
                                         
                                        </ul>
               					 		</li>
                                        
                                        
                                    </ul>
                               
                                    </div>