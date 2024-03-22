<?php
session_start();

include("conn/config.php");

if (isset($_SESSION['valid'])) {
    } else {
        header("Location: login.php");
        exit();
    }

$sql = "SELECT subject, batch, class_schedule_id FROM class_schedule";
$result = $con->query($sql);

$batchNames = array(); //array to store batch names
$classDetails = array(); //array to store class details

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $subject = $row['subject'];
        $batch = $row['batch'];
        $classToken = $row['class_schedule_id'];

        error_log("Subject: $subject, Batch: $batch, Class Token: $classToken");

        //echo "<script>alert('Subject: $subject, Batch: $batch, Class Token: $classToken');</script>";

        // Store batch names
        $batchNames[] = $batch;

        // Store class details
        $classDetails[] = array(
            'subject' => $subject,
            'batch' => $batch,
            'classToken' => $classToken
        );
    }

    $result->free();
} else {
    error_log("Error in SQL query: " . $con->error);

    echo "<script>alert('Error in SQL query: " . $con->error . "');</script>";
}

$con->close();
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
    <title>Classes Summary</title>
		
		<!-- Favicon -->
        <link rel="icon" href="img/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

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
		<header class="header" >
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
										<li ><a href="index.php">Home <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="index.php">TSDC</a></li>
											</ul>
										</li>
										<li class="active"><a href="schedule_categorised.php">TimeTable </a></li>
										<li><a href="#">News & Blog <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="">Events and Functions</a></li>
												<li><a href="">Upcoming Classes</a></li>
												<li><a href="">Selfcare Training</a></li>
											</ul>
										</li>
										<li><a href="">About Us </a></li>
										<li>
											<?php
												if (isset($_SESSION['valid'])) {
													echo '<a> logged in as, '. $_SESSION['fullname'] .' <i class="icofont-rounded-down"></i></a>';

													// Check user role and display dropdown items
													if ($_SESSION['access_type'] == "adm" || $_SESSION['access_type'] == "stf") 
													{
													echo '<ul class="dropdown">
																<li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
																<li><a class="dropdown-item" href="admin_panel.php"><b>Admin Portal</b></a></li>
																<li><a class="dropdown-item" href="">Help</a></li>
																<li><a class="dropdown-item" href="logout_user.php">Logout</a></li>
															</ul>';
													} 
													elseif ($_SESSION['access_type'] == "std") 
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
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
		
		<!-- Breadcrumbs -->
		<div class="breadcrumbs overlay">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Schedule</h2>
							<ul class="bread-list">
								<li><a href="index.php">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Schedule</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		
	<section class="timetable-cat section">
        <div class="container">
            <?php
            $count = 0;
            foreach ($classDetails as $classDetail) {
                if ($count % 3 == 0) {
                    //new row for every three iterations
                    echo '<div class="row">';
                }

                echo '<div class="col-lg-4 col-12">';
                echo '<div class="single-info">';
                echo '<i class="icofont-calendar"></i>';
                echo '<div class="content">';
                echo '<h3>' . htmlspecialchars($classDetail['batch']) .  '</h3>';
                echo '<p>' .  htmlspecialchars($classDetail['subject']) . '</p>
                <p class="btn-note">Click on the button below to view all the classes for this subject.</p>
                <br>
                <a href="student_view_timetable.php?subject=' . $classDetail['subject'] . '&batch=' . $classDetail['batch'] . '&token=' . $classDetail['classToken'] . '" class="btn-primary btn-book">Check Classes</a>';
                
                echo ' </div>';
                echo '</div>';
                        echo '<br>';
                        echo '<br>';
                echo '</div>';

                if ($count % 3 == 2 || $count == count($classDetails) - 1) {
                    // close the row for every three iterations or on the last iteration
                    echo '</div>';
                }

                $count++;
            }
            ?>
        </div>
    </section>
		
		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>About Us</h2>
								<p>Welcome to the Telecom Skill Development Centre, where excellence meets expertise! 
                With a legacy of over 20 years in the Local and Overseas Telecommunication industry, 
                our seasoned industry experts bring a wealth of knowledge and hands-on experience to empower individuals like you. Our distinguished trainers, 
                affiliated with IOSH, 
                NBCD accredited Fire trainers, 
                and Professional First Aid trainers, are committed to delivering top-notch programs.</p>
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