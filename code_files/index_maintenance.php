<?php

    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="GeeksLabs">
    <link rel="shortcut icon" href="img/GNPC.jpg">

    <title>GNPC Information Management System</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <script src = "jquery-1.11.1.min.js"></script>
    <script type = "text/javascript" src = "functions.js"></script>
    <script src = "bootbox.min.js"></script>
    <script src = "js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container">
      <form method="POST" action="index_json_response.php?cmd=1" class="login-form">
        
        <div class="row">
            <!-- <div class="col-lg-4">
            </div> -->
            <div class="col-lg-12">
                <!-- <div id="status"></div> -->
                <center><img style="width:150px; height:100px" src="img/gnpc.png"></center>
                <center><h3 style="color:black;">We're sorry the <br><b>Information Management System</b><br>is currently under maintenance</h3></center>
                <br>
                <center><img style="width:250px; height:200px" src="img/cons.png"></center>
            </div>
            <!-- <div class="col-lg-4">
            </div> -->
        </div>  
        <div class="login-wrap">
            <!-- <p class="login-img"><i class="icon_lock_alt"></i></p> -->
            <!-- <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" name="username" id="username" placeholder="username" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="password">
            </div>
            <button class="btn btn-primary btn-lg btn-block" id="" type="submit">Login</button>
            <br> -->
            <!-- <font style="color:red; size:16px;"><center>We're sorry</center></font> -->
        </div>
      </form>

      <br><br>
      <div class="row">
            <div class="col-md-12">
                <center><font style="color:black">Powered by GNPC IT Department &copy; 2015</font></center>
            </div>
        </div>
    </div>
  </body>
</html>
