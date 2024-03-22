<?php
session_start();
include("conn/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["access"])) {
    $access_type = $_POST["access"];
    $nic = $_POST["nic"];

    $update_query = "UPDATE students SET access_type = '$access_type' WHERE nic = '$nic'";
    
    if ($con->query($update_query) === TRUE) {
    $_SESSION['update_success'] = "Profile updated successfully";
} else {
    echo "Error updating profile: " . $con->error;
}
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
    <title>TSDC - Create New Admin Account</title>

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

    <script>
    <?php if (isset($_SESSION['update_success']) && !empty($_SESSION['update_success'])): ?>
    alert("<?php echo $_SESSION['update_success']; ?>");
    <?php unset($_SESSION['update_success']); ?>
    window.location.href = document.referrer; // Redirect to the previous page
<?php endif; ?>
</script>

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
                        <h2>Create New Admin or Staff Account</h2>
                        <ul class="bread-list">
                            <li><a href="index.php">Home</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li><a href="admin_panel.php">Admin Portal</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Staff or Admin Registration</li>
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
        <div class="row">
            <div class="col-lg-4 col-12">

                <div class="main-sidebar">
                    <!-- Single Widget -->
                    <div class="single-widget search">
                        <div class="form">
                            <form method="post" action="">
                                <input type="text" name="search_nic" placeholder="Search Here..." value="<?php echo isset($row['nic']) ? $row['nic'] : ''; ?>">
                                <button type="submit" class="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!--/ End Single Widget -->
                    <!-- Single Widget -->
                    <div class="single-widget category">
                        <?php
                        include("conn/config.php");

						if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["search_nic"])) {
							$search_nic = $_POST["search_nic"];

							$result = $con->query("SELECT * FROM students WHERE nic = '$search_nic'");
							
							if ($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								echo '<div class="single-schedule middle">';
								echo '<div class="inner">';
								echo '<div class="icon"><i class="icofont-user"></i></div>';
								echo '<div class="single-content">';
								echo '<span>Profile Found</span><br><br>';
								echo '<h4>' . $row['fullanme'] . '</h4>';
								echo '<p>NIC: ' . $row['nic'] . '<br> Phone: ' . $row['phone'] . '<br> Company:  ' . $row['company'] . '<br> Address:<br>' . $row['address'] . '<br> Current Access Type:  ' . $row['access_type'] .'</p>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
							} else {
								echo '<p>No matching profile found with NIC - ' . $search_nic . '</p>';
							}
						} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["search_nic"])) {
							echo '<p>Please enter a NIC in the search bar.</p>';
						}
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">

                <div class="row">
                    <div class="col-12">

                    </div>
                    <div class="col-12">

                    </div>
                    <div class="col-12">
                        <div class="comments-form">
                            <h2>Change Role and Access Type for This Profile</h2>
                            <!-- Contact Form -->
                            <form class="form" method="post" action="">
                                <div class="row">
                                    <div class="col-12">
										<div class="form-group">
                                            <i class="fa fa-id-card"></i>
											<input type="text" name="nic" placeholder="NIC" required="" value="<?php echo isset($row['nic']) ? $row['nic'] : ''; ?>" readonly>
										</div>
									</div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <i class="fa fa-user"></i>
                                            <input type="name" name="name" placeholder="Name" required="" value="<?php echo isset($row['fullanme']) ? $row['fullanme'] : ''; ?>" readonly>
                                        </div>
                                    </div>
									 <div class="col-12">
                                        <div class="form-group">
                                            <i class="fa fa-building"></i>
                                            <input type="text" name="company" placeholder="Company Details" required="" value="<?php echo isset($row['company']) ? $row['company'] : ''; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 col-12">
                                        <div class="form-group">
                                            <i class="fa fa-cogs"></i>
                                            <select class="access-select" name="access" required="required">
                                                <option value="" disabled selected>Change access type</option>
                                                <?php
                                                $accessTypes = array("adm" => "Admin", "std" => "Student", "com" => "Company");
                                                foreach ($accessTypes as $abbreviation => $fullName) {
                                                    $selected = isset($row['access_type']) && $row['access_type'] == $abbreviation ? 'selected' : '';
                                                    echo '<option value="' . $abbreviation . '" ' . $selected . '>' . $fullName . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <br>
                                        <div class="form-group button">
                                            <button type="submit" class="btn primary"><i class="fa fa-save"></i>Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--/ End Contact Form -->
                                    <br>
                        </div>
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
</body>

</html>