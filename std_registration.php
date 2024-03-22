<?php
session_start();

// Include the config.php file
include("conn/config.php");

if (isset($_SESSION['valid'])) {
    // User is logged in, you can include any code here that should run when the user is logged in
} else {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nic = $_POST["nic"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $course = $_POST["subject"];

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $checkSql = "SELECT * FROM students WHERE nic = '$nic'";
    $result = $con->query($checkSql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Error: Student with NIC $nic is already registered.');</script>";
    } else {
        $insertSql = "INSERT INTO students (nic, name, address, phone, course) VALUES ('$nic', '$name', '$address', '$phone', '$course')";

        if ($con->query($insertSql) === TRUE) {
            echo "<script>alert('Student registered successfully');</script>";
        } else {
            echo "<script>alert('Error: " . $insertSql . "\\n" . $con->error . "');</script>";
        }
    }

    $con->close();
}
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
	<title>ICTPC - Student Registartion</title>

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


	<!-- Header Area -->
	<header class="header">
		<div class="header-inner">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-12">
							<!-- Start Logo -->
							<div class="logo">
								<a href="index.php"><img src="img/ictpc_logo.png" alt="#"></a>
							</div>
							<!-- End Logo -->
							<!-- Mobile Nav -->
							<div class="mobile-nav"></div>
							<!-- End Mobile Nav -->
						</div>
						<div class="col-lg-7 col-md-9 col-12">
							<!-- Main Menu -->
							<div class="main-menu">
								<nav class="navigation">
									<ul class="nav menu">
										<li ><a href="#">Home <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="index.html">Home Page 1</a></li>
											</ul>
										</li>
										<li><a href="all_students.php">Students </a></li>
										<li class="active"><a href="#">Manage <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="std_delete.php">Delete Students</a></li>
												<li><a href="std_profile_update.php">Edit Students Details</a></li>
											</ul>
										</li>
										<li><a href="">
											<?php
											if (isset($_SESSION['valid'])) {
												// User is logged in, display username and dropdown
												echo 'logged in as, '. $_SESSION['admin_fullname'];
											} else {
												// User is not logged in, display login link
												echo '<a class="nav-link" href="login.php">Login</a>';
											}
											?>
										</a></li>
									</ul>
								</nav>
							</div>
							<!--/ End Main Menu -->
						</div>
						<div class="col-lg-2 col-12">
							<div class="get-quote">
								<a href="logout_user.php" class="btn">Log out</a>
							</div>
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
						<h2>Student Registration</h2>
						<ul class="bread-list">
							<li><a href="index.php">Home</a></li>
							<li><i class="icofont-simple-right"></i></li>
							<li class="active">Student Registration</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Start Contact Us -->
	<section class="contact-us section">
		<div class="container">
			<div class="inner">
				<div class="row">
					<div class="col-lg-6">
						<div class="contact-us-left">
							<!--Start Google-map -->
							<div>
								<img src="img/std_registration.jpg" alt="Description of the image">
							</div>
							<!--/End Google-map -->
						</div>
					</div>
					<div class="col-lg-6">
						<div class="contact-us-form">
							<h2>Register New Student</h2>
							<p>Provide following required details to register the student.</p>
							<!-- Form -->
							<form class="form" method="post" action="">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" name="nic" placeholder="NIC" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="name" name="name" placeholder="Name" required="">
										</div>
									</div>
									<!-- <div class="col-lg-6">
										<div class="form-group">
											<input type="address" name="address" placeholder="Address" required="">
										</div>
									</div> -->
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" name="phone" placeholder="Phone" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" name="subject" placeholder="Course" required="">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<textarea name="address" placeholder="Address" required=""></textarea>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group login-btn">
											<button class="btn" type="submit">Register</button>
										</div>
										<!--<div class="checkbox">
											<label class="checkbox-inline" for="2"><input name="news" id="2"
													type="checkbox">Do you want to subscribe our Newsletter ?</label>
										</div>
									</div> -->
									</div>
							</form>
							<!--/ End Form -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ End Contact Us -->

	<!-- Footer Area -->
	<footer id="footer" class="footer ">
		<!-- Footer Top -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer">
							<h2>About Us</h2>
							<p>Welcome to ICTPC Student Management Portal. We're here to guide and assist our students throughout their academic journey. Our dedicated team ensures real-time monitoring and personalized support. At ICTPC, we are committed to nurturing success and fostering a thriving learning environment.</p>
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
	<!-- Google Map API Key JS -->
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyDGqTyqoPIvYxhn_Sa7ZrK5bENUWhpCo0w"></script>
	<!-- Gmaps JS -->
	<script src="js/gmaps.min.js"></script>
	<!-- Map Active JS -->
	<script src="js/map-active.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>
</body>

</html>