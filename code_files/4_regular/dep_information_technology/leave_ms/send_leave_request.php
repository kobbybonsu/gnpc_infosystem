<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Send Request | GLMS</title>
  	<?php include("head_links.html");?>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <?php include("header.php");?>

      <?php include("navigation.php");?>

      <script type="text/javascript">
		  $(document).ready(function(){

			loadLeaveType();
			// loadHardwareStatus();
		});
		</script>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
              <div class="row">
      				<div class="col-lg-12">
      					<h3 class="page-header"><i class="icon_genius"></i> Send Request</h3>
      					<ol class="breadcrumb">
      						<li><i class="icon_genius"></i>Send Request</li> /
      					</ol>
      				</div>
      			</div><br><br>
			  <div class="row">
                    <div class="col-lg-8">
                      <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="pull-left"><h4>Leave Request Form</h4></div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                      <div class="padd">
                      <div class="form quick-post">
                        <form action='leave_action.php?cmd=4' method='POST' class='form-horizontal'>

                          <div class='input-group'>
                              <input type='hidden' class='form-control' name='employee_ref' id='employee_ref' value="<?php echo $_SESSION['u_id'];?>" aria-describedby='basic-addon1'>
                            </div>
                            <div class='input-group'>
                              <input type='hidden' class='form-control' name='num_days_left' id='num_days_left' value="<?php $id = null;
                                if (isset($_SESSION['u_id'])) {
                                  $id = $_SESSION['u_id'];
                                  check_my_days_left($id);
                                }?>" aria-describedby='basic-addon1'>
                            </div>

                          <div class="row">
                            <div class="col-lg-6">
                            <div>
                              <!-- <p align="center"><b>Leave Type</b></p> -->
                            <select name='leave_type_ref' id='leave_type_ref' class='form-control'>
                                       <option>Leave Type</option>
                                   </select>
                            </div><br>
                          </div>
                            <div class="col-lg-6">
                              <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Job Title</span>
                              <input type='text' class='form-control' name='job_title' id='job_title' placeholder='' aria-describedby='basic-addon1'>
                            </div><br>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Days Requested</span>
                              <input type='number' class='form-control' name='num_days_requested' id='num_days_requested' placeholder='' aria-describedby='basic-addon1'>
                            </div><br>
                            </div>
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Commencement Date</span>
                              <input type='date' class='form-control' name='commencement_date' id='commencement_date' placeholder='' aria-describedby='basic-addon1'>
                            </div>
                            </div><br>
                            </div>

                            <div class="row">
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>End Date</span>
                              <input type='date' class='form-control' name='end_date' id='end_date' placeholder='' aria-describedby='basic-addon1'>
                            </div><br>
                            </div>
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Resumption Date</span>
                              <input type='date' class='form-control' name='resumption_date' id='resumption_date' placeholder='' aria-describedby='basic-addon1'>
                            </div>
                            </div><br>
                            </div>

                            <div class="row">
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Officer Taking Over</span>
                              <input type='text' class='form-control' name='officer_taking_over' id='officer_taking_over' placeholder='' aria-describedby='basic-addon1'>
                            </div><br>
                            </div>
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Leave Address</span>
                              <textarea type='text' class='form-control' name='leave_address' id='leave_address' aria-describedby='basic-addon1'></textarea>
                            </div>
                            </div><br>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Contact</span>
                              <input type='text' class='form-control' name='contact' id='contact' placeholder='' aria-describedby='basic-addon1'>
                            </div><br>
                            </div>
                            <div class="col-lg-6">
                            <div class='input-group'>
                              <span class='input-group-addon' id='basic-addon1'>Email</span>
                              <input type='email' class='form-control' name='email' id='email' placeholder='' aria-describedby='basic-addon1'>
                            </div>
                            </div><br>
                            </div>

                            <div align="right">
                            <button type='submit' name='submit' class='btn btn-primary'>Submit Leave Request</button>
                        	</div>
                        </form>
                          </div>
                        </div>
                      </div>
                  </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="pull-left"><h4>Up-Coming Holidays</h4></div>  
                          <div class="clearfix"></div>
                        </div>
                      <div class="panel-body">
                        <div class="padd">
                            <div class="form quick-post">
                            <?php
                            see_all_holidays();
                            ?>
                          </div>
                        </div>
                      </div>
                      </div>
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