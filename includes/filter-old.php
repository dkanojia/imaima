
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
								   if(isset($_REQUEST["c"]))
									{
									$req_color =$_REQUEST["c"];
									}
									 if(isset($_REQUEST["s"]))
									{
									$req_sort =$_REQUEST["s"];
									}
									 if(isset($_REQUEST["st"]))
									{
									$req_style =$_REQUEST["st"];
									}
									 if(isset($_REQUEST["sz"]))
									{
									$req_size =$_REQUEST["sz"];
									}
								   ?>
 <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Colour</a>
                                            </h4>
                                        </div>
                                        <div id="collapse4" class="panel-collapse collapse">
                                            <ul class="list-group">
                                            <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>','','<?=$req_sort?>','<?=$req_style?>','<?=$req_size?>');">-All-</a></li>
                                            <?
											$objcolor = new mysql();
											$query="select colorid,colorname from tblcolor where colorid in (select distinct product_colorid from tblproduct where 1=1";
											if(isset($_REQUEST["catid"]))
											{
											$query = $query . " and catid=".$_REQUEST["catid"];
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
                            <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>',<?=$colorid?>,'<?=$req_sort?>','<?=$req_style?>','<?=$req_size?>');"><?=$colorname?></a></li>
                            
							<?
							}
											?>
                                            	
                                              
                                            </ul>
                                       
                                        </div>
                                    </div>
                                    
                                     <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Style</a>
                                            </h4>
                                        </div>
                                        <div id="collapse5" class="panel-collapse collapse">
                                            <ul class="list-group">
                                            <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','<?=$req_sort?>','','<?=$req_size?>');">-All-</a></li>
                                            <?
											$objcolor = new mysql();
											$query="select styleid,stylename from tblstyle where styleid in (select distinct styleid from tblproduct where 1=1";
											if(isset($_REQUEST["catid"]))
											{
											$query = $query . " and catid=".$_REQUEST["catid"];
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
                            <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>',<?=$req_color?>,'<?=$req_sort?>','<?=$styleid?>','<?=$req_size?>');"><?=$stylename?></a></li>
                            
							<?
							}
											?>
                                            	
                                              
                                            </ul>
                                        </div>
                                    </div>
                                    
                                     <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Size</a>
                                            </h4>
                                        </div>
                                        <div id="collapse6" class="panel-collapse collapse">
                                            <ul class="list-group">
                                            <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','<?=$req_sort?>','<?=$req_style?>','');">-All-</a></li>
                                            <?
											$objcolor = new mysql();
											$query="select sizeid,sizename from tblsize where sizeid in (select distinct b.sizeid  from tblproduct a inner join tblproduct_price b on a.productid=b.productid where 1=1";
											if(isset($_REQUEST["catid"]))
											{
											$query = $query . " and a.catid=".$_REQUEST["catid"];
											} 
											if(isset($_REQUEST["tid"]))
											{
											$query = $query . " and FIND_IN_SET(".$_REQUEST["tid"].",a.product_tag)";
											} 
											$query = $query . ")";
											$objcolor->stmt=$query;
							$objcolor->execute();	
							while($objcolor_result = $objcolor->fetch_array())
							{
							extract($objcolor_result);
							?>
                            <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','<?=$req_sort?>','<?=$req_style?>','<?=$sizeid?>');"><?=$sizename?></a></li>
                            
							<?
							}
											?>
                                            	
                                              
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" id="sorting" href="#Divsorting">Sort</a>
                                            </h4>
                                        </div>
                                        <div id="Divsorting" class="panel-collapse collapse ">
                                            <ul class="list-group">
                                                <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','sale_price','<?=$req_style?>','<?=$req_size?>');">By Price, low to high</a></li>
                                                <li class="list-group-item" style="color:#333333; font-size:16px;" ><a href="#" onClick="return searchproduct('<?=$_REQUEST["catid"]?>','<?=$_REQUEST["tid"]?>','<?=$req_color?>','sale_pricebydesc' ,'<?=$req_style?>','<?=$req_size?>');">By Price, high to low</a></li>
                                            </ul>
                                        </div>

                                    </div>