<?php
    session_start();
    
   

    //include("conn/config.php");

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="Site keywords here">
	<meta name="description" content="">
	<meta name='copyright' content=''>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title -->
	<title>TSDC Main</title>

	<!-- Favicon -->
	<link rel="icon" href="img/favicon.png">

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
		rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Nice Select CSS -->
	<link rel="stylesheet" href="css/nice-select.css">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- icofont CSS -->
	<link rel="stylesheet" href="css/icofont.css">
	<!-- Slicknav -->
	<link rel="stylesheet" href="css/slicknav.min.css">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Datepicker CSS -->
	<link rel="stylesheet" href="css/datepicker.css">
	<!-- Animate CSS -->
	<link rel="stylesheet" href="css/animate.min.css">
	<!-- Magnific Popup CSS -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Medipro CSS -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/responsive.css">

</head>

<body>

	<!-- Preloader -->
	<div class="preloader">
		<div class="loader">
			<div class="loader-outter"></div>
			<div class="loader-inner"></div>

			<div class="indicator">
				<svg width="16px" height="12px">
					<polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
					<polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
				</svg>
			</div>
		</div>
	</div>
	<!-- End Preloader -->

	<!-- Get Pro Button 
		<ul class="pro-features">
			<a class="get-pro" href="#">Get Pro</a>
			<li class="big-title">Pro Version Available on Themeforest</li>
			<li class="title">Pro Version Features</li>
			<li>2+ premade home pages</li>
			<li>20+ html pages</li>
			<li>Color Plate With 12+ Colors</li>
			<li>Sticky Header / Sticky Filters</li>
			<li>Working Contact Form With Google Map</li>
			<div class="button">
				<a href="http://preview.themeforest.net/item/mediplus-medical-and-doctor-html-template/full_screen_preview/26665910?_ga=2.145092285.888558928.1591971968-344530658.1588061879" target="_blank" class="btn">Pro Version Demo</a>
				<a href="https://themeforest.net/item/mediplus-medical-and-doctor-html-template/26665910" target="_blank" class="btn">Buy Pro Version</a>
			</div>
		</ul> -->

	<!-- Header Area -->
	<header class="header">
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-12">
							<!-- Start Logo -->
							<div class="logo">
								<a href="index.php"><img src="img/tsdc_logo_main.jpg" alt="#"></a>
							</div>
							<!-- End Logo -->
							<!-- Mobile Nav -->
							<div class="mobile-nav"></div>
							<!-- End Mobile Nav -->
						</div>
						<div class="col-lg-9 col-md-9 col-12">
							<!-- Main Menu -->
							<div class="main-menu">
								<nav class="navigation">
									<ul class="nav menu">
										<li class="active"><a href="index.php">Home <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="index.php">TSDC</a></li>
											</ul>
										</li>
										<li><a href="schedule_categorised.php">TimeTable </a></li>
										<li><a href="#">News & Blog <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="coming_soon.html">Events and Functions</a></li>
												<li><a href="coming_soon.html">Upcoming Classes</a></li>
												<li><a href="coming_soon.html">Selfcare Training</a></li>
											</ul>
										</li>
										<li><a href="coming_soon.html">About Us </a></li>
										<li>
											<?php
												if (isset($_SESSION['valid'])) {
													echo '<a> Logged in as, '. $_SESSION['fullname'] .' <i class="icofont-rounded-down"></i></a>';

													// Check user role and display appropriate dropdown item
													if ($_SESSION['access_type'] == "1" || $_SESSION['access_type'] == "2") 
													{
													echo '<ul class="dropdown">
																<li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
																<li><a class="dropdown-item" href="admin_panel.php"><b>Admin Portal</b></a></li>
																<li><a class="dropdown-item" href="coming_soon.html">Help</a></li>
																<li><a class="dropdown-item" href="logout_user.php">Logout</a></li>
															</ul>';
													} 
													elseif ($_SESSION['access_type'] == "3" || $_SESSION['access_type'] == "4") 
													{
													echo '<ul class="dropdown">
																<li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
																<li><a class="dropdown-item" href="">Help</a></li>
																<li><a class="dropdown-item" href="logout_user.php">Logout</a></li>
															</ul>';
													}
												} 
												
												else {
													echo '<a href="login.php">Log in</a>';
												}
												
											?></li>
									</ul>
								</nav>
							</div>
							<!--/ End Main Menu -->
						</div>
						<!--
						<div class="col-lg-2 col-12">
							<div class="get-quote">
								<a href="logout_user.php" class="btn">Log out</a>
							</div>
						</div>
											-->
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!-- End Header Area -->

	<!-- Slider Area -->
	<section class="slider">
		<div class="hero-slider">
			<!-- Start Single Slider -->
			<div class="single-slider" style="background-image:url('img/sliderbg1.jpg')">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="text">
								<h1>Welcome to <span> Telecom Skill Development </span> Centre.<span></span></h1>
								<p>We believe in learning by doing. Our programs incorporate practical exercises and real-world scenarios, 
                        allowing you to apply theoretical knowledge in simulated environments. 
                        This hands-on approach prepares you with challenges you'll face in the field prioritizing safety.</p>
								<div class="button">
									<a href="" class="btn">Learn More...</a>
									<!-- <a href="#" class="btn primary">Learn More</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Single Slider -->
			<!-- Start Single Slider -->
			<div class="single-slider" style="background-image:url('img/sliderbg2.jpg')">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="text">
								<h1>A Place <span>To Manage </span>Your Studies!<span></span></h1>
								<p>
                        Designed programs specially for the New comers, Riggers and Electricians working in the 
                        Telecommunication and Construction industries in Sri Lanka aiming to prevent 
                        from injuries and ill-health by controlling workplace hazards.</p>
								<div class="button">
									<a href="coming_soon.html" class="btn">Learn More...</a>
									<!-- <a href="#" class="btn primary">About Us</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Start End Slider -->
			<!-- Start Single Slider -->
			<div class="single-slider" style="background-image:url('img/sliderbg3.jpg')">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="text">
								<h1>All Basic <span>Functionalities</span> You Needed Now In One <span>Place!</span></h1>
								<p>With this student management website, Now our staff members gain access to all basic funtionalities which are required to manage students details.</p>
								<div class="button">
									<a href="coming_soon.html" class="btn">Learn More...</a>
									<!-- <a href="#" class="btn primary">About Us</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Single Slider -->
		</div>
	</section>
	<!--/ End Slider Area -->

	<!-- Start Schedule Area -->
	<section class="schedule">
		<div class="container">
			<div class="schedule-inner">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12 ">
						<!-- single-schedule -->
						<div class="single-schedule first">
							<div class="inner">
								<div class="icon">
									<i class="icofont-student-alt"></i>
								</div>
								<div class="single-content">
									<span>List of</span>
									<h4>Registered Students</h4>
									<p>Check out the the students and thier details who enrolled with us.</p>
									<a href="coming_soon.html">Check Out<i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<!-- single-schedule -->
						<div class="single-schedule middle">
							<div class="inner">
								<div class="icon">
									<i class="icofont-book"></i>
								</div>
								<div class="single-content">
									<span>More about</span>
									<h4>Programs at TSDC</h4>
									<p>Review programs within our offerings that align with your training needs.</p>
									<a href="coming_soon.html">Check Out<i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-12">
						<!-- single-schedule -->
						<div class="single-schedule last">
							<div class="inner">
								<div class="icon">
									<i class="icofont-ui-clock"></i>
								</div>
								<div class="single-content">
									<span>Explore</span>
									<h4>Ongoing Classes</h4>
									<p>Feel free to review and enroll in our ongoing classes</p>
									<a href="coming_soon.html">Check Out<i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/End Start schedule Area -->

	<!-- Start Feautes -->
	<section class="Feautes section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>We Are Always Ready to Help Our Students to Choose thier Paths</h2>
						<img src="img/section-img.png" alt="#">
						<p>Our lecturers and all other co-workers always try their best to provide better opportunities for our students. We are dedicated to guiding them towards success in the Telecommunication industry.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-12">
					<!-- Start Single features -->
					<div class="single-features">
						<div class="signle-icon">
							<i class="icofont-search-1"></i>
						</div>
						<h3>Realtime Monitoring</h3>
						<p>Our staff members always keep an eye on every student and are ready to reach out when they are needed.</p>
					</div>
					<!-- End Single features -->
				</div>
				<div class="col-lg-4 col-12">
					<!-- Start Single features -->
					<div class="single-features">
						<div class="signle-icon">
							<i class="icofont-holding-hands"></i>
						</div>
						<h3>Always Guiding Through</h3>
						<p>We provide continuous guidance and support to our students throughout their academic journey.</p>
        			</div>
					<!-- End Single features -->
				</div>
				<div class="col-lg-4 col-12">
					<!-- Start Single features -->
					<div class="single-features last">
						<div class="signle-icon">
							<i class="icofont-win-trophy"></i>
						</div>
						<h3>Until They Certified</h3>
						<p>We are dedicated to supporting until you certify, ensuring you have the knowledge and skills needed for success in your chosen fields.</p>
        			</div>
					<!-- End Single features -->
				</div>
			</div>
		</div>
	</section>
	<!--/ End Feautes -->

	<!-- Start Fun-facts -->
	<div id="fun-facts" class="fun-facts section overlay">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Fun
					<div class="single-fun">
						<i class="icofont icofont-home"></i>
						<div class="content">
							<span class="counter">3468</span>
							<p>Hospital Rooms</p>
						</div>
					</div>
					End Single Fun -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
    <!-- Start Single Fun -->
    <div class="single-fun">
        <i class="icofont-book-alt"></i>
        <div class="content">
            <span class="counter" id="program_counter"></span>
            
            <p>Programs</p>
        </div>
    </div>
    <!-- End Single Fun -->
</div>
				<div class="col-lg-3 col-md-6 col-12">
    <!-- Start Single Fun -->
    <div class="single-fun">
        <i class="icofont-simple-smile"></i>
        <div class="content">
            <span class="counter" id="student_counter"></span>
            
            <p>Students</p>
        </div>
    </div>
    <!-- End Single Fun -->
</div>

				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Fun -->
					<div class="single-fun">
						<i class="icofont icofont-table"></i>
						<div class="content">
							<span class="counter">2</span>
							<p>Years of Service</p>
						</div>
					</div>
					<!-- End Single Fun -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Fun-facts -->

	<!-- Start Why choose -->
	<section class="why-choose section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2></h2>
						<img src="img/section-img.png" alt="#">
						<p></p>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
	<!--/ End Why choose -->

	<!-- Start Call to action -->
	<section class="call-action overlay" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-12">
					<div class="content">
						<h2>Do you need any Support? <br>Call @ 071 105 063 8</h2>
						<p>You can reach out our customer help and support team at anytime in the day by calling this
							hotline.</p>
						<!-- <div class="button">
							<a href="#" class="btn">Contact Now</a>
							<a href="#" class="btn second">Learn More<i class="fa fa-long-arrow-right"></i></a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ End Call to action -->


	<!-- Footer Area -->
	<footer id="footer" class="footer ">
		<!-- Footer Top -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<div class="single-footer">
							<h2 style="text-align:center;">About Us</h2>
							<!--p class ="About"><B>About Us</p>-->
							<p style="text-align:center;">Welcome to the Telecom Skill Development Centre, where excellence meets expertise! With a legacy of over 20 years in the Local and Overseas Telecommunication industry, our seasoned industry experts bring a wealth of knowledge and hands-on experience to empower individuals like you. Our distinguished trainers, affiliated with IOSH, NBCD accredited Fire trainers, and Professional First Aid trainers, are committed to delivering top-notch programs.</p>
                <!-- Social -->
							<ul class="social">
								<li><a href="#"><i class="icofont-facebook"></i></a></li>
								<li><a href="#"><i class="icofont-google-plus"></i></a></li>
								<li><a href="#"><i class="icofont-twitter"></i></a></li>
								<li><a href="#"><i class="icofont-vimeo"></i></a></li>
								<li><a href="#"><i class="icofont-pinterest"></i></a></li>
							</ul>
							<!-- End Social -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Footer Top -->

	</footer>
	<!--/ End Footer Area -->

	<!-- jquery Min JS -->
	<script src="js/jquery.min.js"></script>
	<!-- jquery Migrate JS -->
	<script src="js/jquery-migrate-3.0.0.js"></script>
	<!-- jquery Ui JS -->
	<script src="js/jquery-ui.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Color JS -->
	<script src="js/colors.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Datepicker JS -->
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Jquery Nav JS -->
	<script src="js/jquery.nav.js"></script>
	<!-- Slicknav JS -->
	<script src="js/slicknav.min.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/jquery.scrollUp.min.js"></script>
	<!-- Niceselect JS -->
	<script src="js/niceselect.js"></script>
	<!-- Tilt Jquery JS -->
	<script src="js/tilt.jquery.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl-carousel.js"></script>
	<!-- counterup JS -->
	<script src="js/jquery.counterup.min.js"></script>
	<!-- Steller JS -->
	<script src="js/steller.js"></script>
	<!-- Wow JS -->
	<script src="js/wow.min.js"></script>
	<!-- Magnific Popup JS -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- Counter Up CDN JS -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>
</body>

</html>

<script>
    $(document).ready(function(){
       // $('#program_counter').html('<span>10</span>');
        function load_counts(){
            $.ajax({
    			url:"module/index_load/count_load.php",
    			method:"POST",
    			dataType:"json",
    			success:function(data)
    			{
    			    var student = data.studnet;
                    var program = data.program;
    			
    			    $('#student_counter').html(student);
    			    $('#program_counter').html(program);
    			
    			}
		    });
        }
        
        load_counts();
        
    });
    </script>