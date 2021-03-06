<?php
include_once '../../index_json_response.php';
    session_start();
    ob_start();
    if(!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        header("Location: ../../");
    }

    $inactive = 1800; // Set timeout period in seconds

    if (isset($_SESSION['timeout'])) {
        $session_life = time() - $_SESSION['timeout'];
        if ($session_life > $inactive) {
            session_destroy();
            header("Location: ../../logout.php");
        }
    }
    $_SESSION['timeout'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../img/GNPC.jpg">

	<title>GNPC Information Management System</title>

	<!-- CSS -->
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet" media="screen">
	<link href="assets/css/animate.css" rel="stylesheet">
    
	<!-- Custom styles CSS -->
	<link href="assets/css/style.css" rel="stylesheet" media="screen">
    
    <script src="assets/js/modernizr.custom.js"></script>
    <script src = "../../jquery-1.11.1.min.js"></script>
    <script type = "text/javascript" src = "../../functions.js"></script>
       
</head>
<body>

	<!-- Preloader -->

	<div id="preloader">
		<div id="status"></div>
	</div>

	<!-- Home start -->

	<section id="home" class="pfblock-image screen-height">
        <div class="home-overlay"></div>
		<div class="intro">
			<div class="start">Welcome, <?php 
                                echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            ?></div>
			<h1>GNPC Information Management System</h1>
			<!-- <div class="start">Click the arrow below to continue...</div> -->
		</div>

        <a href="#systems">
		<div class="scroll-down">
            <span>
                <i class="fa fa-angle-down fa-3x"></i>
            </span>
		</div>
        </a>

	</section>

	<!-- Home end -->

	<!-- Navigation start -->

	<header class="header">

		<nav class="navbar navbar-custom" role="navigation">

			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">
						<font style="font-family: Raleway, 'Calibri', Times, sans-serif;">GNPC</font></a>
				</div>

				<div class="collapse navbar-collapse" id="custom-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#home">Home</a></li>
                        <li><a href="#systems">Systems</a></li>
                        <!-- <li><a href="#statements">Statements</a></li> -->
						<li><a href="#contact_it">Talk to US</a></li>
						<li><a href="../../"><h4 style="color:#CC0000;">Log Out</h4></a></li>
					</ul>
				</div>

			</div><!-- .container -->

		</nav>

	</header>

	<!-- Navigation end -->
    
	<!-- Portfolio start -->

	<section id="systems" class="pfblock">
		<div class="container">
			<div class="row">

				<div class="col-sm-6 col-sm-offset-3">

					<div class="pfblock-header wow fadeInUp">
						<h2 class="pfblock-title">Our Systems</h2>
						<div class="pfblock-line"></div>
						<div class="pfblock-subtitle">
						</div>
					</div>

				</div>

			</div><!-- .row -->
            
            
            <div class="row">
                
                <div class="col-xs-12 col-sm-4 col-md-4">
                    
                    <a href="leave_ms/"><div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/beach.png" alt="leave_img"/>
                            <figcaption>
                                <h2>Leave Management System<span></span></h2>
                                <p>Need to take some time off?</p>
                            </figcaption>		
                        </figure>
                    </div></a>
                    
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4">
            
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/do_it_yourself.png" height="100%" alt="d_i_y"/>
                            <figcaption>
                                <h2>Do-It-Yourself Help System</h2>
                                <p>Want to learn how to fix your device?</p>
                            </figcaption>			
                        </figure>
                    </div>
                    
                </div>
                
                <div class="col-xs-12 col-sm-4 col-md-4">
            
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/classicclock.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Asset Control System<span></span></h2>
                                <p>Need to borrow a device or reserve a room for a meeting?</p>
                            </figcaption>			
                        </figure>
                    </div>
                    
                </div>
                
                <!-- <div class="col-xs-12 col-sm-4 col-md-4">
            
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-4.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Bang <span>Bang</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>			
                        </figure>
                    </div>
                    
                </div>
                
                <div class="col-xs-12 col-sm-4 col-md-4">
            
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-5.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Crypton <span>Dude</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>			
                        </figure>
                    </div>
                    
                </div>
                
                <div class="col-xs-12 col-sm-4 col-md-4">
            
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-6.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Don't <span>Poke</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>			
                        </figure>
                    </div>
                    
                </div> -->
                
            </div>


		</div><!-- .contaier -->

	</section>

	<!-- Portfolio end -->

	<!-- CallToAction start -->

	<section class="calltoaction">
		<div class="container">

			<div class="row">

				<div class="col-md-12 col-lg-12">
					<h2 class="wow slideInRight" data-wow-delay=".1s">ARE YOU FACING ANY CHALLENGES WITH OUR SYSTEMS OR DEVICES?</h2>
					<div class="calltoaction-decription wow slideInRight" data-wow-delay=".2s">
						We're willing to assist you.
					</div>
				</div>

				<div class="col-md-12 col-lg-12 calltoaction-btn wow slideInRight" data-wow-delay=".3s">
					<a href="#contact_it" class="btn btn-lg">Talk to us!</a>
				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</section>

	<!-- CallToAction end -->
    
    <!-- Skills start -->
    
    <!-- <section class="pfblock pfblock-gray" id="statements">
		
			<div class="container">
			
				<div class="row skills">
					
					<div class="row">

                        <div class="col-sm-6 col-sm-offset-3">

                            <div class="pfblock-header wow fadeInUp">
                                <h2 class="pfblock-title">Our Vision</h2>
                                <div class="pfblock-line"></div>
                                <div class="pfblock-subtitle">
                                	To be a leading global oil and gas company whose operations have a profound 
                                	impact on the quality of life of the people of Ghana.
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6 col-sm-offset-3">

                            <div class="pfblock-header wow fadeInUp">
                                <h2 class="pfblock-title">Our Mission</h2>
                                <div class="pfblock-line"></div>
                                <div class="pfblock-subtitle">
                                    To lead the sustainable exploration, development, production and disposal of the petroleum 
                                    resources of Ghana, by leveraging the right mix of domestic and foreign investments in 
                                    partnership with the people of Ghana.
                                </div>
                            </div>

                        </div>

                    </div>
					
				</div>
			
			</div>
		
    </section> -->
    
    <!-- Skills end -->


	<!-- Contact start -->

	<section id="contact_it" class="pfblock">
		<div class="container">
			<div class="row">

				<div class="col-sm-6 col-sm-offset-3">

					<div class="pfblock-header">
						<h2 class="pfblock-title">Send a message to the IT Department</h2>
						<div class="pfblock-line"></div>
						<div class="pfblock-subtitle">
							We're happy to serve!
						</div>
					</div>

				</div>

			</div><!-- .row -->

			<div class="row">

				<div class="col-sm-6 col-sm-offset-3">

					<form id="contact-form" role="form">
						<div class="ajax-hidden">
							<div class="form-group wow fadeInUp">
								<label class="sr-only" for="c_name">Name</label>
								<input type="text" id="c_name" class="form-control" name="c_name" value="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".1s">
								<label class="sr-only" for="c_email">Email</label>
								<input type="email" id="c_email" class="form-control" name="c_email" placeholder="Your e-mail">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".2s">
								<textarea class="form-control" id="c_message" name="c_message" rows="7" placeholder="Message..."></textarea>
							</div>

							<button type="submit" class="btn btn-lg btn-block wow fadeInUp" data-wow-delay=".3s">Submit Message</button>
						</div>
						<div class="ajax-response"></div>
					</form>

				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</section>

	<!-- Contact end -->

	<!-- Footer start -->

	<footer id="footer">
		<div class="container">
			<div class="row">

				<div class="col-sm-12">

					<!-- <ul class="social-links">
						<li><a href="index.html#" class="wow fadeInUp"><i class="fa fa-facebook"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".1s"><i class="fa fa-twitter"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".2s"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".4s"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".5s"><i class="fa fa-envelope"></i></a></li>
					</ul> -->

					<!-- <p class="heart">
                        Made with <span class="fa fa-heart fa-2x animated pulse"></span> in Nottingham
                    </p> -->
                    <p class="copyright">
                        Powered by GNPC IT Department &copy; 2015
					</p>

				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</footer>

	<!-- Footer end -->

	<!-- Scroll to top -->

	<div class="scroll-up">
		<a href="#home"><i class="fa fa-angle-up"></i></a>
	</div>
    
    <!-- Scroll to top end-->

	<!-- Javascript files -->

	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.parallax-1.1.3.js"></script>
	<script src="assets/js/imagesloaded.pkgd.js"></script>
	<script src="assets/js/jquery.sticky.js"></script>
	<script src="assets/js/smoothscroll.js"></script>
	<script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.easypiechart.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.cbpQTRotator.js"></script>
	<script src="assets/js/custom.js"></script>

</body>
</html>