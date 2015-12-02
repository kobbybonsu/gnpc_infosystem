<?php
include '../../../index_json_response.php';
include 'leave_action.php';
    session_start();
    ob_start();
    if(!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        header("Location: ../../../");
    }

    $inactive = 1800; // Set timeout period in seconds

    if (isset($_SESSION['timeout'])) {
        $session_life = time() - $_SESSION['timeout'];
        if ($session_life > $inactive) {
            session_destroy();
            header("Location: ../../../logout.php");
        }
    }
    $_SESSION['timeout'] = time();

?>
<html>
    <!-- <meta http-equiv="refresh" content="1800;url=../../index.php" /> -->
	<header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
            </div>

            <!--logo start-->
            <a href="index.php" class="logo">GNPC <span class="lite">Leave Management System</span></a>
            <!--logo end-->

            <div class="nav search-row" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">                    
                    <li>
                        <!-- <form action='search_device.php' method="POST" class="navbar-form">
                            <input type="text" style="min-width:350px;" class="form-control" 
                            placeholder="Search by device model, name or serial no...." type="text" name="search" id="search">
                        </form> -->
                    </li>
                    
                </ul>
                <!--  search form end -->                
            </div>

            <div class="top-nav notification-row"> 

                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <!-- <span class="profile-ava">
                                <img alt="" src="img/GNPC.jpg">
                            </span> -->
                            <span class="username">Welcome, 
								<?php 
                                echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li>
                                <a href="../#systems"><i class="icon_house_alt"></i> Return to Systems Page</a>
                            </li>
                            <li>
                                <a href="../../../"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->
</html>