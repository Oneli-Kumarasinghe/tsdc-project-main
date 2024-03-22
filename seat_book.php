<?php
session_start();

include("conn/config.php");

if (isset($_SESSION['valid'])) {
        // User is logged in, you can include any code here that should run when the user is logged in
    } else {
        header("Location: login.php");
        exit();
    }


$classScheduleToken = isset($_GET['class_schedule_token']) ? $_GET['class_schedule_token'] : '';
$classId = isset($_GET['class_id']) ? $_GET['class_id'] : '';
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';
$batch = isset($_GET['batch']) ? $_GET['batch'] : '';

// Fetch the user's ID
$nic = isset($_SESSION['valid']) ? mysqli_real_escape_string($con, $_SESSION['valid']) : '';

// Fetch the seat data into an array
$sql = "SELECT * FROM seats WHERE class_id = '$classId'";
$result = $con->query($sql);

// Fetch the seat data into an array
if ($result->num_rows > 0) {
    $seatData = $result->fetch_assoc();
} else {
    // Handle the case where the class_id does not exist or has no seats
    echo "Error: Class not found or no seats available.";
    exit();
}

//echo "<script>alert('Class Schedule Token: $classScheduleToken');</script>";
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
        <title>TSDC Seat Book - <?php echo "{$subject} - {$batch} Classes"; ?></title>
		
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
        
  <link rel="stylesheet" href="css/seat_book_style.css" />
		
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
							<h2>Seat Booking - <?php echo "{$subject} {$batch}"; ?></h2>
							<ul class="bread-list">
								<li><a href="index.php">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li><a href="schedule_categorised.php">Categorised TimeTable</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li><a href="javascript:window.history.back()"><?php echo "{$subject} - {$batch} Classes"; ?></a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active"><a href="">Seat Booking</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

  <ul class="showcase">
    <li>
      <div class="seat"></div>
      <small>Available</small>
    </li>
    <li>
      <div class="seat na"></div>
      <small>N/A</small>
    </li>
    <li>
      <div class="seat occupied"></div>
      <small>Occupied</small>
    </li>
  </ul>

    <div class="seats-container">
        <div class="screen"></div>

            <?php
                // Loop through 8 rows
                for ($rowNumber = 1; $rowNumber <= 8; $rowNumber++) {
                    echo '<div class="seat-row">';

                    // Loop through 8 seats for each row (update the limit to 8 for each row)
                    for ($seatNumber = 1; $seatNumber <= 5; $seatNumber++) {
                        $seatIndex = ($rowNumber - 1) * 5 + $seatNumber;
                        $seatStatus = $seatData["seat$seatIndex"];

                        // Determine the class for the seat based on its status
                        $seatClass = ($seatStatus === 'empty') ? 'seat' : 'seat occupied';

                        // Display the seat div with the determined class and data-seat-number attribute
                        echo '<div class="' . $seatClass . '" data-seat-number="' . $seatIndex . '"></div>';
                    }

                    echo '</div>';
                }
            ?>
        </div>
    </div>

<div class="booking-info">
  <p class="text">
     <?php
    // Check if the user has already selected a seat in the specified class
    $userAlreadySelected = false;
    foreach ($seatData as $seatIndex => $seatStatus) {
        if ($seatStatus === $nic) {
            $userAlreadySelected = true;
            break;
        }
    }

    if ($userAlreadySelected) {
        echo 'You have already selected a seat.';
    } else {
        echo 'You have selected <span id="count">0</span> out of 1 seat';
    }
    ?>
  </p>
  <br><br>

  <button class="button-80" id="bookButton" disabled onclick="bookSeat()">Book Seat</button>
  
</div>

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

<script>
    console.log(<?php echo json_encode($seatData); ?>);

// Declare selectedCount and userAlreadySelected outside the DOMContentLoaded event listener
let selectedCount = 0;
let userAlreadySelected = <?php echo $userAlreadySelected ? 'true' : 'false'; ?>;

document.addEventListener("DOMContentLoaded", function() {
    // Select all seats
    const seats = document.querySelectorAll('.seat');
    
    // Select the book button
    const bookButton = document.getElementById('bookButton');

    // Set the maximum number of seats a user can select
    const maxSeats = 1;

    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            // Check if the user has already selected a seat
            if (userAlreadySelected) {
                alert('You have already selected a seat.');
                return; // Exit the function, preventing further seat selection
            }

            // Check seat is not occupied or N/A and user has not reached the maximum limit
            if (!seat.classList.contains('occupied') && !seat.classList.contains('na') && selectedCount < maxSeats) {
                // Toggle the 'selected' class
                seat.classList.toggle('selected');

                // Update the count of selected seats
                updateSelectedCount();

                // Enable the book button
                if (selectedCount > 0) {
                    bookButton.removeAttribute('disabled');
                } else {
                    // Disable the book button
                    bookButton.setAttribute('disabled', 'true');
                }
            } else if (seat.classList.contains('selected')) {
                // If the seat is already selected, toggle off the 'selected' class
                seat.classList.remove('selected');

                // Update the count of selected seats
                updateSelectedCount();

                // Disable the book button
                bookButton.setAttribute('disabled', 'true');
            }
        });
    });

    function updateSelectedCount() {
        // Count the selected seats
        const selectedSeats = document.querySelectorAll('.seat.selected');

        // Update the count in the HTML
        document.getElementById('count').innerText = selectedSeats.length;

        // Update the selected count variable
        selectedCount = selectedSeats.length;

        // Disable seats if the user has reached the maximum limit or has already selected a seat
        if (selectedCount >= maxSeats || userAlreadySelected) {
            seats.forEach(seat => {
                if (!seat.classList.contains('selected')) {
                    seat.classList.add('disabled');
                }
            });
        } else {
            // Enable all seats if the user can still select more
            seats.forEach(seat => {
                seat.classList.remove('disabled');
            });
        }
    }
});

function bookSeat() {
    // Check if any seat is selected
    if (selectedCount === 0) {
        // Show an alert if no seat is selected
        alert('Please select a seat before booking.');
    } else {
        // Get the selected seat information
        const selectedSeats = document.querySelectorAll('.seat.selected');
        const selectedSeatNumbers = Array.from(selectedSeats).map(seat => seat.dataset.seatNumber);

        // Log classId and seatNumber to console
        console.log('Token:', <?php echo json_encode($classScheduleToken); ?>);
        console.log('Class ID:', <?php echo $classId; ?>);
        console.log('Seat Numbers:', selectedSeatNumbers.join(','));

        // Make an AJAX request to update the seats table
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_update_seats.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response, if needed
                alert('Booking successful!');
                
                // Reload the page after successful booking
                location.reload();
            }
        };

        // Include $classScheduleToken in the data sent to the backend
        const data = 'classId=' + <?php echo $classId; ?> + '&seatNumber=' + selectedSeatNumbers.join(',') + '&classScheduleToken=' + <?php echo json_encode($classScheduleToken); ?>;
        
        xhr.send(data);
    }
}

</script>

</html>