<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Display Requests | GLMS</title>
  	<?php include("head_links.html");?>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <?php include("header.php");?>

      <?php include("navigation.php");?>

      <script type="text/javascript">
		  $(document).ready(function(){

			// loadHardwareType();
			// loadHardwareStatus();
		});
		</script>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">        
              <!--overview start-->
              <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="icon_table"></i> Display Requests</h3>
					<ol class="breadcrumb">
						<li><i class="icon_table"></i>Display Requests</li> /			  	
					</ol>
				</div>
			</div><br><br>
			  <div class="row">
          <div class="col-lg-2">
            </div>
			  	<div class="col-lg-8">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="padd">
                    <div class="form quick-post">
                      <?php
                            $id = null;
                            if (isset($_SESSION['u_id'])) {
                              $id = $_SESSION['u_id'];
                              see_all_my_requests($id);
                            }
                      ?>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
                    <div class="col-lg-2">
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