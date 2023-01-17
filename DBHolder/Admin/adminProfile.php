<?php

    require_once '../CompanyManager.php';
    require_once '../ClientManager.php';
    require_once '../AdminManager.php';
    require_once 'adminSynch.php';
    require_once '../Admin 0 /functions.php';
    //require_once 'adminstatistics.php';

    $email = '';
    $password = '';
    /*$_SESSION['email'] = 'abc@gmail.com';
    session_start();
    if(isset($_SESSION['email']))
    {
        
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        
    }else{
        echo 'you dont have permission to login this page';
        echo '<a href="login.php">LOGIN </a>';
        exit();
            
    }*/

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Marktech</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="../jquery.js"></script>
    <script type="text/javascript">
       $(document).ready(function(){
            waitForMsg();
            waitForAnn();
            $('#notificationLink').click(function(){
                window.setTimeout(function(){window.location.href="addition_orders.php";},100);
            });

             $('#ann_not').click(function(event){
                 window.setTimeout(function(){window.location.href="annOrders.php";},100);
             });

        });
    </script>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Header menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html" style="font-size: 30px ; color: darkturquoise">M</a>
                <strong><a href="index.html"><img src="" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a class="has-arrow" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/adminProfile.php">
								   <span class="educate-icon educate-home icon-wrap"></span>
								   <span class="mini-click-non">Main Dashboard</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="Dashboard " href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/adminProfile.php"><span class="mini-sub-pro">Dashboard</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a title="Landing Page" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/events.php" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Event</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/all-professors.php" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">Custumers</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Professors" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/all-professors.php"><span class="mini-sub-pro">All Custumers</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/library-assets.php" aria-expanded="false"><span class="educate-icon educate-library icon-wrap"></span> <span class="mini-click-non">Product</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Library" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/library-assets.php"><span class="mini-sub-pro">Product Assets</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/departments.php" aria-expanded="false"><span class="educate-icon educate-department icon-wrap"></span> <span class="mini-click-non">Company</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Departments List" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/departments.php"><span class="mini-sub-pro">Company List</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/mailbox-compose.php" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Mailbox</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                
                                <li><a title="Compose Mail" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/mailbox-compose.php"><span class="mini-sub-pro">Compose Mail</span></a></li>
                            </ul>
                        </li>
                      
                    
                        <li>
                            <a class="has-arrow" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/data-table.php" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Data Tables</span></a>
                            <ul class="submenu-angle" aria-expanded="false">

                                <li><a title="Data Table" href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/data-table.php"><span class="mini-sub-pro">Data Table</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Header menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
													<i class="educate-icon educate-nav"></i>
												</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item"><a href="http://localhost/phpsandbox/E_commerce/webfonts/home.php" class="nav-link">Home</a>
                                                </li>
                                                <li class="nav-item"><a href="#" class="nav-link">About</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item dropdown">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-message edu-chat-pro" aria-hidden="true"></i><span class="indicator-ms"></span></a>
                                                    <div role="menu" class="author-message-top dropdown-menu animated zoomIn">
                                                        <div class="message-single-top">
                                                            <h1>Message</h1>
                                                        </div>

                                                        <ul class="message-menu">
                                                           
                                                            <li>
                                                                <a href="#">
                                                                    <div class="message-img">
                                                                        <img src="img/contact/1.jpg" alt="">
                                                                    </div>
                                                                    <div class="message-content">
                                                                        <span class="message-date">16 Sept</span>
                                                                        <h2>Advanda Cro</h2>
                                                                        <p>Please done this project as soon possible.</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                          
                                                            
                                                           
                                                        </ul>
                                                    </div>

                                                </li>
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle message-menu"> <i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                                                    <!--Addition notification------------->
                                                    <span id="notification_count" class="noti"></span>
                                                     <a href="#" id="notificationLink" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 10px;font-size: 20px;"></i></a>

                                                     <!--announcement notification--------->
                                                     <span id="ann_count" class="ann"></span>
                                                        <a href="#" id="ann_not" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 5px;font-size: 20px;color:gray;"></i></a>

                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                        
                                                         <div class="notification-single-top">
                                                          <h1>Notifications</h1>
                                                        </div>
                                                        <ul class="notification-menu">
                                                            
                                                            <?php
                                                                $admin = new AdminManager();
                                                                $sql1 = $admin->selectQuery("SELECT * from notification where is_procecced = 0");
                                                                if($sql1!==NULL){
                                                                    for($i = 0; $i<sizeof($sql1); ++$i){
                                                            ?>
                                                            <li id="<?php echo $sql1[$i]['not_id'];?>">
                                                                <a href="#">
                                                                   
                                                                    <div class="notification-content">
                                                                        <span class="notification-date"><?php echo $sql1[$i]['date_of_not'];?></span>
                                                                        <h2><?php echo $sql1[$i]['not_type'];?></h2>
                                                                        <p>product name: <?php echo $sql1[$i]['pro_name'];?><br>
                                                                            applicant name: <?php echo $sql1[$i]['applicant'];?><br>
                                                                            applicant name: <?php echo $sql1[$i]['applicant_name'];?><br>
                                                                            amount: <?php echo  $sql1[$i]['amount'];?><br>cost: <?php echo $sql1[$i]['cost'];?><br></p>
                                                                            
                                                                                <button type="button" class="btn btn-primary accept" id="<?php echo  $sql1[$i]['not_id'];?>">Accept</button><button type="button" class="btn btn-danger refuse" id="<?php echo  $sql1[$i]['not_id'];?>">Refuse</button>
                                                                           
                                                                            
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        <?php } } ?>
                                                        </ul>
                                                        <div class="notification-view">
                                                            <a href="#">View All Notification</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
															<span class="admin-name">For Admin </span>
														</a>
                                                </li>
                                                <li class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-menu"></i></a>

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                            <a data-toggle="tab" href="#Settings" class="btn btn-block">Settings</a> 
                                                        </ul>
                                                            <div id="Settings" class="tab-pane fade">
                                                                <div class="setting-panel-area">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-gears"></i> Settings Panel</h2>
                                                                    </div>
                                                                    <ul class="setting-panel-list">
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Show notifications</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                                                                            <label class="onoffswitch-label" for="example">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																								</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Disable Chat</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                                                                            <label class="onoffswitch-label" for="example3">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																								</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Enable history</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                                                                            <label class="onoffswitch-label" for="example4">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																								</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Show charts</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                                                                            <label class="onoffswitch-label" for="example7">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																								</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Update everyday</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example2">
                                                                                            <label class="onoffswitch-label" for="example2">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																								</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Global search</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example6">
                                                                                            <label class="onoffswitch-label" for="example6">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																								</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Offline users</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example5">
                                                                                            <label class="onoffswitch-label" for="example5">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																								</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                               </ul>
                                          </div>
                                      </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/adminProfile.php">Dashboard </a></li>
                                            </ul>
                                        </li>
                                        <li><a href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/events.php">Event</a></li>
                                        <li><a data-toggle="collapse" data-target="#demoevent" href="#">Custumers <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li><a href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/all-professors.php">All Custumers</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demolibra" href="#">Product <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demolibra" class="collapse dropdown-header-top">
                                                <li><a href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/library-assets.php">Product Assets</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demodepart" href="#">Company <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demodepart" class="collapse dropdown-header-top">
                                                <li><a href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/departments.php">Company List</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/mailbox-compose.php">Compose Mail</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Tablesmob" href="#">Tables <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Tablesmob" class="collapse dropdown-header-top">
                                                <li><a href="http://localhost/phpsandbox/E_commerce/DBHolder/Admin/data-table.php">Data Table</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="analytics-sparkle-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <?php
                                    $client = new AdminManager();
                                    $result1 = $client->selectQuery("SELECT DISTINCT COUNT(client_id) AS cnt1 FROM order_client");
                                    $result2 = $client->selectQuery("SELECT  COUNT(client_id) AS cnt2 FROM client");

                                ?>
                                <h5>Returning customer rate</h5>
                                <h2><span class="counter"><?php echo ($result1[0]['cnt1']);?></span> <span class="tuition-fees">customers that have purchased</span></h2>
                                <h2><span class="counter"><?php echo $result2[0]['cnt2'];?></span> <span class="tuition-fees">Number of client</span></h2>
                                <span class="text-success"><?php echo round($result1[0]['cnt1']/$result2[0]['cnt2']*100, 3);?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($result1[0]['cnt1']/$result2[0]['cnt2']*100, 3);?>%;">  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <?php
                                    $company = new AdminManager();
                                    $result1 = $company->selectQuery("SELECT DISTINCT COUNT(comp_id) AS cnt1 FROM order_comp");
                                    $result2 = $company->selectQuery("SELECT  COUNT(com_id) AS cnt2 FROM company");

                                ?>
                                <h5>Returning company rate</h5>
                                <h2><span class="counter"><?php echo $result1[0]['cnt1'];?></span> <span class="tuition-fees">company that have purchased</span></h2>
                                <h2><span class="counter"><?php echo $result2[0]['cnt2'];?></span> <span class="tuition-fees">Number of company</span></h2>
                                <span class="text-success"><?php echo round($result1[0]['cnt1']/$result2[0]['cnt2']*100, 3);?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($result1[0]['cnt1']/$result2[0]['cnt2']*100, 3);?>%;"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>ROI</h5>
                                <?php 

                                    $tot_cost = $company->selectQuery("SELECT sum(t.tot_cost) As res_t from ( SELECT tot_cost  from order_client union all  SELECT tot_cost  from order_comp ) t ");
                                    $t_cost = $tot_cost[0]['res_t'];
                                    $editedCost = $tot_cost[0]['res_t'] - 0.05*($tot_cost[0]['res_t']);


                                ?>
                                <h2><span class="counter"><?php echo  $t_cost;?></span> $<span class="tuition-fees">Total  cost</span></h2>
                                 <h2><span class="counter"><?php echo  $editedCost;?></span> $<span class="tuition-fees">Net cost</span></h2>
                                <span class="text-info"><?php echo $editedCost/$t_cost*100;?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $editedCost/$t_cost*100;?>%;"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5> Average order value</h5>

                                <?php
                                    $ann = $company->selectQuery("SELECT COUNT(com_id) AS cnt FROM company");
                                    $cnt_ann = $company->selectQuery("SELECT DISTINCT COUNT(type_id) AS num_ann FROM announcement");
                                   
                                ?>
                                <h2><span class="counter"><?php echo $cnt_ann[0]['num_ann'];?></span> <span class="tuition-fees">Number of advertiser</span></h2>
                                <span class="text-inverse"><?php echo round($cnt_ann[0]['num_ann']/$ann[0]['cnt'], 2);?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($cnt_ann[0]['num_ann']/$ann[0]['cnt']);?>%;"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b></b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                            <p>All Earnings are in million $</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline cus-product-sl-rp">
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #006DF0;"></i>Procurement</h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #933EC5;"></i>Accounting</h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #65b12d;"></i>Customer acquisition rate</h5>
                                </li>
                            </ul>
                            <div id="extra-area-chart" style="height: 356px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="traffice-source-area mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info-cs">
                            <h3 class="box-title">Total clients products</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <?php
                                     $num_pro_1 = $client->selectQuery("SELECT DISTINCT COUNT(proclient_id) AS cnt1 FROM proclient");
                                ?>
                                <li class="text-right sp-cn-r"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-success"><span class="counter"><?php echo $num_pro_1[0]['cnt1'];?></span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info-cs res-mg-t-30 table-mg-t-pro-n">
                            <h3 class="box-title">Total company products</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                 <?php
                                     $num_pro_2 = $company->selectQuery("SELECT DISTINCT COUNT(procomp_id) AS cnt1 FROM procomp");
                                ?>
                                <li class="text-right graph-two-ctn"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-purple"><span class="counter"><?php echo $num_pro_2[0]['cnt1'];?></span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info-cs res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                            <h3 class="box-title">Count of sold product client</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash3"></div>
                                </li>
                                <?php
                                     $sold_pro_1 = $client->selectQuery("SELECT  SUM(items_num) AS cnt1 FROM order_client");
                                ?>
                                <li class="text-right graph-three-ctn"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-info"><span class="counter"><?php echo $sold_pro_1[0]['cnt1'];?></span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info-cs res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                            <h3 class="box-title">Count of sold product company</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash4"></div>
                                </li>
                                 <?php
                                     $sold_pro_2 = $company->selectQuery("SELECT  SUM(items_num) AS cnt1 FROM order_comp");
                                ?>
                                <li class="text-right graph-four-ctn"><i class="fa fa-level-down" aria-hidden="true"></i> <span class="text-danger"><span class="counter"><?php echo $sold_pro_2[0]['cnt1'];?></span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div hidden class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b>Adminsion Statistic</b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp actions-graph-rp">
                                            <a href="#" class="btn btn-dark btn-circle active tip-top" data-toggle="tooltip" title="Refresh">
													<i class="fa fa-reply" aria-hidden="true"></i>
												</a>
                                            <a href="#" class="btn btn-blue-grey btn-circle active tip-top" data-toggle="tooltip" title="Delete">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline cus-product-sl-rp">
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #006DF0;"></i>Python</h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #933EC5;"></i>PHP</h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #65b12d;"></i>Java</h5>
                                </li>
                            </ul>
                            <div id="morris-area-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sedules-area mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar">
                            <div class="analysis-progrebar-content">
                                <?php
                                    $tot_profit1 = $client->selectQuery("SELECT SUM(t.cost_with_shipment) AS ship_client1 FROM (SELECT cost_with_shipment FROM order_client UNION ALL SELECT cost_with_shipment from order_comp)  t" );
                                    $tot_profit2 = $client->selectQuery("SELECT SUM(t.admin_pro_with_dis) AS ship_client2 FROM (SELECT admin_pro_with_dis FROM order_client UNION ALL SELECT admin_pro_with_dis from order_comp)  t" );
                                    
                                    $tot_profit3 = $client->selectQuery("SELECT SUM(time_an.cost) aS  ann FROM announcement INNER JOIN time_an ON announcement.time_an_id = time_an.time_an_id" );

                                ?>
                                <h5>Profit from ads</h5>
                                <h2 class="storage-right"><span class="counter"><?php echo round($tot_profit3[0]['ann'] /( $tot_profit1[0]['ship_client1']+$tot_profit2[0]['ship_client2']+$tot_profit3[0]['ann'])*100, 2); ?></span>%</h2>
                                <div class="progress progress-mini ug-1">
                                    <div style="width: <?php echo round($tot_profit3[0]['ann'] /( $tot_profit1[0]['ship_client1']+$tot_profit2[0]['ship_client2']+$tot_profit3[0]['ann'])*100, 2); ?>%;" class="progress-bar"></div>
                                </div>
                                <div class="m-t-sm small">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30 res-mg-t-30 table-mg-t-pro-n">
                            <div class="analysis-progrebar-content">
                                <h5>Profit from orders</h5>
                                <?php
                                    $tot_profit1 = $client->selectQuery("SELECT SUM(t.cost_with_shipment) AS ship_client1 FROM (SELECT cost_with_shipment FROM order_client UNION ALL SELECT cost_with_shipment from order_comp)  t" );
                                    $tot_profit2 = $client->selectQuery("SELECT SUM(t.admin_pro_with_dis) AS ship_client2 FROM (SELECT admin_pro_with_dis FROM order_client UNION ALL SELECT admin_pro_with_dis from order_comp)  t" );
                                 
                                    $tot_profit3 = $client->selectQuery("SELECT SUM(time_an.cost) aS  ann FROM announcement INNER JOIN time_an ON announcement.time_an_id = time_an.time_an_id" );

                                ?>
                                <h2 class="storage-right"><span class="counter"><?php echo round($tot_profit2[0]['ship_client2'] /( $tot_profit1[0]['ship_client1']+$tot_profit2[0]['ship_client2']+$tot_profit3[0]['ann'])*100, 2); ?></span>%</h2>
                                <div class="progress progress-mini ug-2">
                                    <div style="width: <?php echo round($tot_profit2[0]['ship_client2'] /( $tot_profit1[0]['ship_client1']+$tot_profit2[0]['ship_client2']+$tot_profit3[0]['ann'])*100, 2); ?>%;" class="progress-bar"></div>
                                </div>
                                <div class="m-t-sm small">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                            <div class="analysis-progrebar-content">
                                <h5>profit from shipments</h5>
                                <h2 class="storage-right"><span class="counter"><?php echo round($tot_profit1[0]['ship_client1'] /( $tot_profit1[0]['ship_client1']+$tot_profit2[0]['ship_client2']+$tot_profit3[0]['ann'])*100, 2); ?></span>%</h2>
                                <div class="progress progress-mini ug-3">
                                    <div style="width: <?php echo round($tot_profit1[0]['ship_client1'] /( $tot_profit1[0]['ship_client1']+$tot_profit2[0]['ship_client2']+$tot_profit3[0]['ann'])*100, 2); ?>%;" class="progress-bar progress-bar-danger"></div>
                                </div>
                                <div class="m-t-sm small">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar res-tablet-mg-t-30 dk-res-t-pro-30">
                            <div class="analysis-progrebar-content">
                                <h5>Space</h5>
                                <h2 class="storage-right"><span class="counter">40</span>%</h2>
                                <div class="progress progress-mini ug-4">
                                    <div style="width: 28%;" class="progress-bar progress-bar-danger"></div>
                                </div>
                                <div class="m-t-sm small">
                                    <p>Server down since 5:32 pm.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </div>

    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="js/morrisjs/raphael-min.js"></script>
    <script src="js/morrisjs/morris.js"></script>
    <script src="js/morrisjs/morris-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
    <script src="js/tawk-chat.js"></script>
</body>

</html>