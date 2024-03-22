<?php
session_start();
include("conn/config.php");

if (isset($_SESSION['valid'])) {
      
} else {
    header("Location: login.php");
    exit();
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
    <title>TSDC Admin - Class Schedule</title>

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
    

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="js/jquery.timepicker.min.js"></script>
    <link rel="stylesheet" href="css/jquery.timepicker.min.css">

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/stdlisttable.css">

    <!-- jQuery library -->
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
                        <h2>Class Scheduler</h2>
                        <ul class="bread-list">
                            <li><a href="admin_panel.php"><b>Admin Panel</b></a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Class Scheduler</li>
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
						<h2>Class Scheduler</h2>
						<p>Schedule classes under a Batch</p>
						<!-- Form -->
						<form class="form" method="post" action="">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<select class="company-select" name="prog" id="programDropdown" required="required">

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
										<select class="company-select" name="batch" id="batchDropdown" required="required">
											<option value="" disabled selected>Select a Batch</option>
										</select>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" name="seats" placeholder="Reserved Seat Count" required="" readonly>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" name="tothours" placeholder="Batch planned time duration" required="" readonly>
									</div>
								</div>

								<div class="col-12">
									<!--
									<div class="">
										<label class="checkbox-inline" for="2">Add the class dates to this batch by
											clicking on Add Dates</label>
									</div>-->
								</div><br>
								<br>
								<div class="form-group login-btn" style="margin-right: 10px;">
                                    <button class="btn" type="button" id="add-dates-btn" onclick="addFields()">Add Dates</button>
                                </div>
								<div class="form-group login-btn" style="margin-right: 10px;">
									<button class="btn" type="submit">Schedule</button>
								</div>
								<div class="form-group login-btn">
									<button class="btn" type="submit">Check TimeTable</button>
								</div>
							</div>

                            <div id="date-time-picker-container" style="margin-top: 20px;"></div>

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



let fieldIndex = 1;

function addFields() {
    // Check if this is not the first set of fields
    if (fieldIndex > 1) {
        // Check if the previous set of fields is filled
        const previousSet = document.getElementById("date-time-picker-container").lastElementChild;
        const dayInput = previousSet.querySelector("input[type='date']");
        const startTimeInput = previousSet.querySelector("input[type='time']");
        const endTimeInput = previousSet.querySelectorAll("input[type='time']")[1];

        if (!dayInput.value || !startTimeInput.value || !endTimeInput.value) {
            alert("Please fill in the previous date and time fields before adding new ones.");
            return;
        }
    }

    
    // Create a new set of fields container
    const fieldSet = document.createElement("div");
    fieldSet.classList.add("date-time-picker-group");

    

    // Remove Button
    const removeButton = document.createElement("button");
    removeButton.type = "button";
    removeButton.textContent = "Remove";
    removeButton.classList.add("remove-btn");
    removeButton.onclick = function() {
        // Remove the current set of fields
        document.getElementById("date-time-picker-container").removeChild(fieldSet);
        // Decrement the field index when removing a set of fields
        fieldIndex--;
    };
    fieldSet.appendChild(removeButton);


    fieldSet.appendChild(document.createElement("br")); 
    fieldSet.appendChild(document.createElement("br")); 

    // Day Label
    const dayLabel = document.createElement("label");
    dayLabel.classList.add("daynum");
    dayLabel.textContent = "Day " + fieldIndex;
    fieldSet.appendChild(dayLabel);

    // Day Input
    const dayInputNew = document.createElement("input");
    dayInputNew.type = "date";
    dayInputNew.placeholder = "Select Date";
    dayInputNew.required = true;
    dayInputNew.name = "dates[]";
    fieldSet.appendChild(dayInputNew);

    // Start Time Label
    const startTimeLabel = document.createElement("label");
    startTimeLabel.classList.add("starttime");
    startTimeLabel.textContent = "Start Time";
    fieldSet.appendChild(startTimeLabel);

    // Start Time Input
    const startTimeInputNew = document.createElement("input");
    startTimeInputNew.type = "time";
    startTimeInputNew.placeholder = "Select Start Time";
    startTimeInputNew.required = true;
    startTimeInputNew.name = "start_times[]";
    fieldSet.appendChild(startTimeInputNew);

    // End Time Label
    const endTimeLabel = document.createElement("label");
    endTimeLabel.textContent = "End Time";
    fieldSet.appendChild(endTimeLabel);

    // End Time Input
    const endTimeInputNew = document.createElement("input");
    endTimeInputNew.type = "time";
    endTimeInputNew.placeholder = "Select End Time";
    endTimeInputNew.required = true;
    endTimeInputNew.name = "end_times[]";
    fieldSet.appendChild(endTimeInputNew);


    fieldSet.appendChild(document.createElement("br")); 

    // Subject Dropdown
const subjectDropdown = document.createElement("select");
subjectDropdown.name = "subjects[]";
subjectDropdown.required = true;

// Add a default option
const defaultOption = document.createElement("option");
defaultOption.value = "";
defaultOption.text = "Select Subject";
defaultOption.disabled = true;
defaultOption.selected = true;
subjectDropdown.appendChild(defaultOption);

// Fetch subjects based on the selected program
const selectedProgramId = $('select[name="prog"]').val();
$.ajax({
    url: 'backend_fetch_subjects.php', 
    type: 'POST',
    data: { programId: selectedProgramId },
    dataType: 'json',
    success: function(data) {
        $.each(data, function(index, item) {
            const option = document.createElement("option");
            option.value = item.subject_id;
            option.text = item.subject_name;
            subjectDropdown.appendChild(option);
        });
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
});

fieldSet.appendChild(subjectDropdown);

// Event listener for subject selection
subjectDropdown.addEventListener('change', function() {
    const selectedSubjectId = this.value;
    const durationTextbox = fieldSet.querySelector(".duration-textbox");

    $.ajax({
        url: 'backend_fetch_subject_durations.php',
        type: 'POST',
        data: { subjectId: selectedSubjectId },
        dataType: 'json',
        success: function(data) {
            if (data.duration_h) {
                if (durationTextbox) {
                    durationTextbox.value = data.duration_h;
                } else {
                    fieldSet.appendChild(document.createElement("br")); 

                    const durationLabel = document.createElement("label");
                    durationLabel.textContent = "Target Duration: ";
                    fieldSet.appendChild(durationLabel);
                    
                    const newDurationTextbox = document.createElement("input");
                    newDurationTextbox.type = "text";
                    newDurationTextbox.placeholder = "Duration (hours)";
                    newDurationTextbox.value = data.duration_h;
                    newDurationTextbox.readOnly = true;
                    newDurationTextbox.classList.add("duration-textbox");
                    newDurationTextbox.style.border = "1px solid #ccc";
                    newDurationTextbox.style.padding = "8px";
                    fieldSet.appendChild(newDurationTextbox);
                }
                console.log(data);
            } else {
                console.error("Duration not found for the selected subject.");
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});


    // Append the new set of fields to the container
    document.getElementById("date-time-picker-container").appendChild(fieldSet);

    // Increment the field index for the next set of fields
    fieldIndex++;
}

   $(document).ready(function() {
    $('select[name="prog"]').change(function() {
        var programId = $(this).val();
        var programName = $("select[name='prog'] option:selected").text();

        // Prepare the data for alerting
        var alertMessage = 'Sending request with programId: ' + programId + ', programName: ' + programName;
        alert(alertMessage);

        $.ajax({
            url: 'backend_fetch_batches.php',
            type: 'POST',
            data: {programId: programId, programName: programName},
            dataType: 'json',
            success: function(data) {
                $('select[name="batch"]').empty();
                $('select[name="batch"]').append('<option value="" disabled selected>Select a Batch</option>');

                $.each(data, function(index, item) {
                    $('select[name="batch"]').append('<option value="' + item.batch_ID + '">Batch ' + item.batch + '</option>');
                });

                // Show the batch dropdown
                $('select[name="batch"]').show();

                // Fetch seats based on selected batch_ID
                var selectedBatchId = $('select[name="batch"]').val();
                fetchSeats(selectedBatchId);

                console.log(data);
                var dataString = JSON.stringify(data);
                alert(dataString);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Fetch seats based on selected batch_ID
    $('select[name="batch"]').change(function() {
        var selectedBatchId = $(this).val();
        fetchSeats(selectedBatchId);
    });

    function fetchSeats(batchId) {
        $.ajax({
            url: 'backend_fetch_batch_info.php',
            type: 'POST',
            data: {batchId: batchId},
            dataType: 'json',
            success: function(data) {
                $('input[name="seats"]').val(data.seats); // Set seats
                $('input[name="tothours"]').val(data.tot_hours); // Set tot_hours

                console.log(data);
                var dataString = JSON.stringify(data);
                alert(dataString);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});
</script>
</body>

</html>