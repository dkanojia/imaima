<?=include('include/header.inc.php');
require_once 'pagging/Pagination.class.php';
?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?=include('include/left.inc.php');?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <?=include('include/contentheader.inc.php');?>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                <?php
                                $ordcat = new mysql();
								$query = "select count(orderid) as orderid from tblorder where bstatus=1";
								$ordcat->stmt = $query;
								$ordcat->execute();
								$ordcat_result = $ordcat->fetch_array();
								extract($ordcat_result);
								?>
                                    <h3>
                                        <?=$orderid?>
                                    </h3>
                                    <p>
                                        Total Orders
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="orders.php?status=all" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                    
                            <div class="small-box bg-green">
                                <div class="inner">
                                <?php
		 						$ordstats = new mysql();
								$query = "select count(orderid) as orderid from tblorder where bstatus=1 and orderstatus='success'";
								$ordstats->stmt = $query;
								$ordstats->execute();
								$ordstats_result = $ordstats->fetch_array();
								extract($ordstats_result);
                             ?>
                                    <h3>
                                      <?=$orderid?>
                                    </h3>
                                    <p>
                                       Payment Complete 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="orders.php?status=Success" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                     
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                 <?php
                                $ordcat = new mysql();
								$query = "select count(nid) as nid from tbluser where bstatus=1 and blockstatus='active'";
								$ordcat->stmt = $query;
								$ordcat->execute();
								$ordcat_result = $ordcat->fetch_array();
								extract($ordcat_result);
								?>
                                    <h3>
                                        <?=$nid?>
                                    </h3>
                                    <p>
                                      Total  User Registrations
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="users.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <!--<div class="col-lg-3 col-xs-6">
                           
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        65
                                    </h3>
                                    <p>
                                        Unique Visitors
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>-->
                    </div>

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <!--<section class="col-lg-7 connectedSortable">                            


                            
                            <div class="nav-tabs-custom">
                       
                                <div class="tab-content no-padding">
                                  
                                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                                </div>
                            </div>

                     
                            

                        </section>--><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable"> 

                            
                            <div class="box box-solid bg-light-blue-gradient">
                                <div class="box-header">
                                    
                                    <div class="pull-right box-tools">
                                        <!--<button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>-->
                                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        Last 7 Days Orders
                                    </h3>
                                      </div>
                                <div class="box-body">
                                    <?php
$page = isset($_GET['p']) ? ((int) $_GET['p']) : 1;
			$limit=20;
			if($page){ 
			$start = ($page - 1) * $limit; //first item to display on this page
			}else{
			$start = 0;
	}
	?>
                                    <table class="tablebox"  width="100%" border="1" cellpadding="4" cellspacing="0">

<tr class="tableheading" style="font-weight:bold;">

</tr>

<tr class="tableheading" style="font-weight:bold;">
<td>Sno</td>
<td>Order No</td>
<td>Order Date </td>
<td>Login Id</td>
<td>Country </td>
<td>Item Total </td>
<td>Discount </td>
<td>Shipping </td>
<td>Grand Total </td>
<td>Status</td>
<td>Delete</td>
</tr>

<?php
$cat = new mysql();
$total = new mysql();
$query = "select a.*,b.loginid from tblorder a left outer join tbluser b on a.userid=b.nid where a.bstatus=1 and a.orderstatus<>'Pending' and a.orderdate = DATE_SUB(CURDATE(), INTERVAL 7 DAY)";


$cat->stmt=$query;
$cat->execute();
$count = $cat->getNumRows();

$query1 =$query." order by a.orderid desc limit ".$start.",".$limit;
$total->stmt = $query1;
$total->execute();

$sno = $start + 1;
	while($total_result =$total->fetch_array())
	{
	
	extract($total_result);
	echo "<tr class='tablerow'>";
	echo "<td>".$sno."</td>";
	echo "<td><a href='vieworder.php?id=".$orderid."'>".$orderno."</a></td>";
	echo "<td>".$orderdate."</td>";
	echo "<td><a href='editusers.php?id=".$userid."'>".$loginid."</a></td>";
	echo "<td>".$ship_country."</td>";
	echo "<td>".$subtotal."</td>";	
	echo "<td>".$discountamount."</td>";
	echo "<td>".$shipping."</td>";
	echo "<td>".$grandtotal."</td>";	
    echo "<td>".$orderstatus."</td>";
	echo "<td><a href='deleteorder.php?orderid=".$orderid."' onclick='return confirmdelete();'>Delete</a></td>";
    echo "</tr>";
    $sno++;
	}
?>

</table>
<?php
					$pagination = (new Pagination());
					$pagination->setCurrent($page);
					$pagination->setTotal($count);
					 
					  echo $markup = $pagination->parse();
			?>
                              
                                    <div id="world-map" ></div>
                                </div>
                                <div class="box-footer no-border">
                                    <!--<div class="row">
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <div id="sparkline-1"></div>
                                            <div class="knob-label">Visitors</div>
                                        </div>
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                           <div id="sparkline-2"></div>
                                            <div class="knob-label">Online</div>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <div id="sparkline-3"></div>
                                            <div class="knob-label">Exists</div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                                                

                        </section>
                    </div>

                </section><!-- /.content -->
            <?=include('include/footer.inc.php');?>