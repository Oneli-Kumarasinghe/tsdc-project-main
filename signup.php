<?php

session_start();

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
    <title>TSDC - Sign Up</title>

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

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="js/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


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
										<li><a href="index.php">Home <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="index.php">TSDC</a></li>
											</ul>
										</li>
										<li><a href="schedule_categorised.php">TimeTable </a></li>
										<li><a href="#">News & Blog <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="">Events and Functions</a></li>
												<li><a href="">Upcoming Classes</a></li>
												<li><a href="">Selfcare Training</a></li>
											</ul>
										</li>
										<li><a href="">About Us </a></li>
										<li class="active">
											<?php
												if (isset($_SESSION['valid'])) {
													echo '<a> logged in as, '. $_SESSION['fullname'] .' <i class="icofont-rounded-down"></i></a>';

													// Check user role and display appropriate dropdown item
													if ($_SESSION['access_type'] == "adm" || $_SESSION['access_type'] == "stf") 
													{
													echo '<ul class="dropdown">
																<li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
																<li><a class="dropdown-item" href=""><b>Admin Portal</b></a></li>
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

    <!-- Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Create Account</h2>
                        <ul class="bread-list">
                            <li><a href="index.php">Home</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li><a href="login.php">Login</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Registration</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Single News -->
    <section class="news-single section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <div class="col-12">
                        <div class="comments-form">
                            <h2>Create Account</h2>
                            <!-- Contact Form -->
                            <form class="form" method="post" id="signup_form" >
                                <div class="row">
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-user"></i>
                                            <input type="text" name="name" id="name" placeholder="Fullname" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-phone"></i>
                                            <input type="phone" name="phone" placeholder="Phone Number" id="phone" 
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-id-card"></i>
                                            <input type="text" name="nic" placeholder="NIC Number" id="nic" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" id="email" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-building"></i>
                                            <select class="company-select" name="company" required="required">
                                                <option value="" disabled selected>Select your company</option>
                                                <option value="1" >company 1</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-map-marker"></i>
                                            <input type="address" name="address" placeholder="Your Address" id="address" 
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-lock"></i>
                                            <input type="password" name="password" id="password" placeholder="Password"
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-lock"></i>
                                            <input type="password" name="con_password" id="con_password" placeholder="Confirm Password"
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="submit" value="Sign up" class="btn btn-primary">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ End Contact Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Single News -->

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
    <script src="js/sweetalert2/sweetalert2.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

</body>

</html>

<script>
    $(document).ready(function(){
    $('#signup_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        console.log("Form data:", form_data);
        $.ajax({
            url:"module/signup/signup.php",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
                var output = data.output;
                var message = data.message;
                if(output == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Account is Created',
                        text: message,
                    }).then((result) => {
                          window.location.replace('login.php');
                    });
                    //window.location.replace('login.php');
                }
                else if(output == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message,
                    });
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'System error....',
                        text: "Please try again",
                    });
                }
            }
        });
    });
});
</script>