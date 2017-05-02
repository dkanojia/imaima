<?php
include("include/checkadminsession.php");
include("../includes/db.inc.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
           
        <title>iimaima Administrator</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
       <!-- <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
  
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
            <link href="admin-style.css" rel="stylesheet"  type="text/css"/>            
            <link rel="stylesheet" href="pagging/themes/light.css" />
            <link href="mystyle.css" rel="stylesheet"  type="text/css"/>
             <script src="js/jquery.min.js" type="text/javascript"></script>
              <script src="js/bootstrap.min.js" type="text/javascript"></script>
             
            <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
          <!--  <script language="javascript" type="text/javascript" src="scw.js" ></script>-->
    

             
         
          <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
    
       
<!--<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>-->
     
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        
             
        <!-- jQuery UI 1.10.3 -->
       <!-- <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>-->
        <!-- Bootstrap -->
      

    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="adminhome.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="img/logo-pink.gif" width="150" height="45" />
                <!--AdminLTE-->
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Administrator <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/images1.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        Admin
                                       
                                    </p>
                                </li>
                                <!-- Menu Body -->
                           <!--     <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                  <!--  <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>-->
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>