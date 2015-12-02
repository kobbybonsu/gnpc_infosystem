<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Dashboard | GLMS</title>
  	<?php include("head_links.html");?>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <?php include("header.php");?>

      <?php include("navigation.php");?>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="icon_house_alt"></i> Dashboard</h3>
					<ol class="breadcrumb">
						<li><i class="icon_house_alt"></i>Dashboard</li> /					  	
					</ol>
				</div>
			</div>
              
            <div class="row">
            	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box dark-bg">
						<i class="fa fa-user"></i>
						<div class="count">0</div>
						<div class="title">Outstanding Leave Days</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
			</div><!--/.row-->
			<br><br>

			<div class="row">
				<div class="col-lg-4">
                        <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="pull-left"><h4>Statistics</h4></div>  
                      <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                      <div class="padd">
                    
                        <div class="form quick-post">
                          Outstanding Leave Days Carried Over:
                          <br><br>
                          Number of Days for the year:
                          <br><br>
                          Days already taken this year:
                          <br><br>

                        </div>
                        </div>
                      </div>
                  </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-default">
		                <div class="panel-heading">
		                  <div class="pull-left"><h4>Quick Report</h4></div>  
		                  <div class="clearfix"></div>
		                </div>
		                <div class="panel-body">
		                  <div class="padd">
                    
                      <div class="form quick-post">
							       <h5><form action='dashboard.php' method='POST' role="form">
                              <div class="checkbox">
                                <label>
                                  <input name="warranty_devices" id="warranty_devices" type="checkbox"> All Leave Requests for this year
                                </label>
                              </div><br>
								<div class="form-group">
									<button type="submit" name="generate_check" class="btn btn-primary btn-block">Generate PDF</button>
									<div class="clearfix"></div>
								</div>
							</form></h5>
	                    		</div>
	                    	</div>
	                    </div>
	                </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="pull-left"><h4>Desired Report</h4></div>  
                      <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                      <div class="padd">
                    
                          <div class="form quick-post">
                              <h5><form action='dashboard.php' method='POST' role="form">
                                <div class='input-group'>
                                  <span class='input-group-addon' id='basic-addon1'>From:</span>
                                  <input type='date' class='form-control' name='from' id='from' aria-describedby='basic-addon1'>
                                </div><br>
                                <div class='input-group'>
                                  <span class='input-group-addon' id='basic-addon1'>To:</span>
                                  <input type='date' class='form-control' name='to' id='to' aria-describedby='basic-addon1'>
                                </div><br>
                              <div class="form-group">
                                <button type="submit" name="generate_check" class="btn btn-primary btn-block">Generate PDF</button>
                                <div class="clearfix"></div>
                              </div>
                            </form></h5>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                </div>

          	<div class="row">
				<div class="col-lg-6">
            	</div>

                <div class="col-lg-6">

                </div>
            </div>

          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->
  <?php include("footer_links.html");?>
  </body>
</html>
