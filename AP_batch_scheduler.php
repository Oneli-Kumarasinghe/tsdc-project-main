<?php
session_start();
include("conn/config.php");

if (isset($_SESSION['valid'])) {
      
} else {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_batch'])) {
	
    $program_id = $_POST['prog'];
    $batch = $_POST['batch'];
    $seats = $_POST['seats'];
    $duration_hours = $_POST['duration_hours'];

    // Fetch program name from the program table
    $program_name_query = "SELECT program_name FROM program WHERE program_id = '$program_id'";
    $result_program_name = $con->query($program_name_query);

    // Fetch batch_count from the program table
    $current_batch_query = "SELECT batch_count FROM program WHERE program_id = '$program_id'";
    $result_batch_count = $con->query($current_batch_query);

    if ($result_program_name->num_rows > 0 && $result_batch_count->num_rows > 0) {
        $row_program_name = $result_program_name->fetch_assoc();
        $program_name = $row_program_name['program_name'];

        $row_batch_count = $result_batch_count->fetch_assoc();
        $current_batch_count = $row_batch_count['batch_count'];

        $new_batch_count = $current_batch_count + 1;

        $update_batch_count_query = "UPDATE program SET batch_count = '$new_batch_count' WHERE program_id = '$program_id'";
        $con->query($update_batch_count_query);

        $sql = "INSERT INTO batch_schedule (program, program_id, batch, tot_hours, seats) 
                VALUES ('$program_name', '$program_id', '$batch', '$duration_hours', '$seats')";

        if ($con->query($sql) === TRUE) {
            echo '<script>alert("Batch added successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . $sql . ' ' . $con->error . '");</script>';
        }
    } else {
        echo '<script>alert("Error: Program not found!");</script>';
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
    <title>TSDC Admin - Batch Schedule</title>

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
    <link rel="stylesheet" href="css/stdlisttable.css">

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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
                                        <li><a href="admin_panel.php">Home <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="index.php">TSDC</a></li>
                                                <li><a href="admin_panel.php"><b>Admin Panel</b></a></li>
                                            </ul>
                                        </li>
                                        <li><a href="schedule_categorised.php">TimeTable </a></li>
                                        <li><a href="#">Quick Actions<i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="">Check Booked Seats</a></li>
                                                <li><a href="">Upcoming Classes</a></li>
                                                <li><a href="">Recent Activities</a></li>
                                                <li><a href="">Check/Manage Timetable</a></li>
                                            </ul>
                                        </li>
                                        <!--<li><a href="">About Us </a></li>-->
                                        <li class="active">
                                            <?php
                                                if (isset($_SESSION['valid'])) {
                                                    echo '<a> logged in as, '. $_SESSION['fullname'] .' <i class="icofont-rounded-down"></i></a>';

                                                    // Check user role
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
                        <h2>Batch Scheduler</h2>
                        <ul class="bread-list">
                            <li><a href="admin_panel.php"><b>Admin Panel</b></a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Batch Scheduler</li>
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
				<div class="col-lg-12">
					<div class="contact-us-form">
						<h2>Batch Scheduler</h2>
						<p>Schedule a batch</p>
						<!-- Form -->
						<form class="form" method="post" action="">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<select class="company-select" name="prog" required="required" onchange="showProgramId(this.value)">
											<option disabled selected>Select Program</option>
                                <?php

                                    //fetch from db
                                    $sql = "SELECT program_id, program_name FROM program";
                                    $result = $con->query($sql);

                                    //add to dropdown
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["program_id"] . "'>" . $row["program_name"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No subjects available</option>";
                                    }

                                    $con->close();
                                ?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" id="batch" name="batch" placeholder="Batch" required="" readonly>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" name="seats" placeholder="Number of Seats" required="">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" name="duration_hours" placeholder="Duration (in hours)" required="">
									</div>
								</div>
								<div class="col-12">
									<!--
									<div class="">
										<label class="checkbox-inline" for="2">Add the class dates to this batch by
											clicking on Add Dates</label>
									</div>-->
								</div>
								<!--<div class="form-group login-btn" style="margin-right: 10px;">
									<button class="btn" type="submit">Add Dates</button>
								</div>-->
								<br>
								<br>
								<div class="form-group login-btn" style="margin-right: 10px;">
									<button class="btn" type="submit" name="add_batch">Add this Batch</button>
								</div>
								<div class="form-group login-btn">
									<button class="btn">Check Batches</button>
								</div>
							</div>

						</form>

						<!--/ End Form -->
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
                            <p>TSDC 2024</p>
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

	<script>
		 function showProgramId(selectedProgramId) {
        if (selectedProgramId) {
            $.ajax({
                type: 'POST',
                url: 'bakend_get_next_batch.php',
                data: { program_id: selectedProgramId },
                success: function(response) {
                    if (response.success) {
                        // batch_count + 1
                        $('#batch').val(parseInt(response.batch_count) + 1);
                    } else {
                        alert('Error fetching batch_count');
                    }
                },
                error: function() {
                    alert('Error fetching batch_count');
                }
            });
        }
    }
</script>

</body>

</html>