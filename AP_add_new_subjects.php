<?php
session_start();

include("conn/config.php");

function connectToDatabase() {
    $servername = "localhost";
    $username = "tsdclk_main";
    $password = ",L;Gij4Cn7#K";
    $dbname = "tsdclk_main";
    

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $added_by = $_SESSION['fullname'];

        // Iterate through the submitted subjects
        if (isset($_POST["subject_name"]) && isset($_POST["subject_duration"])) {
            $subject_names = $_POST["subject_name"];
            $subject_durations = $_POST["subject_duration"];

            // Open a database connection
            $con = connectToDatabase();

            // Insert subjects into the subject table
            for ($i = 0; $i < count($subject_names); $i++) {
                $subject_name = $con->real_escape_string($subject_names[$i]);
                $subject_duration = $con->real_escape_string($subject_durations[$i]);

                $insertQuery = "INSERT INTO subjects (sub_name, duration_h, added_by) VALUES ('$subject_name', '$subject_duration', '$added_by')";
                $con->query($insertQuery);
            }

            // Close the database connection
            $con->close();

            // Add any additional actions or redirection after successful insertion
             echo '<script>alert("Subjects added");</script>';
        }

        // Additional action: Check if delete button is clicked
    if (isset($_POST["delete_subject_id"])) {
        $deleteSubjectId = $_POST["delete_subject_id"];

        // Open a database connection
        $con = connectToDatabase();

        // Delete subject from the subjects table
        $deleteQuery = "DELETE FROM subjects WHERE sub_id = $deleteSubjectId";
        $con->query($deleteQuery);

        // Close the database connection
        $con->close();

        // Add any additional actions or redirection after successful deletion
        echo '<script>alert("Subject deleted");</script>';
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
    <title>TSDC Admin - Subject Adding</title>

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
                        <h2>Subject Register</h2>
                        <ul class="bread-list">
                            <li><a href="admin_panel.php"><b>Admin Panel</b></a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Subject Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Portfolio Details Area -->
    <section class="pf-details section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--<div class="inner-content">
                         <div class="image-slider">
                            <div class="pf-details-slider">
                                <img src="img/call-bg.jpg" alt="#">
                                <img src="img/call-bg.jpg" alt="#">
                                <img src="img/call-bg.jpg" alt="#">
                            </div> 
                    </div>
                    <div class="date">
                        <ul>
                            <li><span>Category :</span> Heart Surgery</li>
                            <li><span>Date :</span> April 20, 2019</li>
                            <li><span>Client :</span> Suke Agency</li>
                            <li><span>Ags :</span> Typo</li>
                        </ul>
                    </div>-->
                    <div class="body-text">
    <h3>Register New Subjects</h3>
    <br>

   <!--    <section class="error-page section">
     <div class="container">
            
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="error-inner">
                        <form class="search-form" method="" action="">
                            <input name="search_nic" placeholder="Search Subjects" type="text">
                            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>                      
        </div> 
    </section>-->
        <table>
            <tr>
                <th>Subject</th>
                <th>Duration (in Hours)</th>
                <th>Actions</th>
            </tr>
            <tbody>
                <?php
                // Assume $con is your database connection
                include("conn/config.php"); 
                    $result = $con->query("SELECT * FROM subjects");

                    // Loop through the results and display each student's details
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='nic'>" . $row['sub_name'] . "</td>";
                        echo "<td data-label='name'>" . $row['duration_h'] . "</td>";
                        echo "<td data-label='actions'><button class='btn deleteBtn' onclick='deleteSubject(" . $row['sub_id'] . ", \"" . $row['sub_name'] . "\")'>Delete</button></td>";
                        echo "</tr>";
                }

                // Close the database connection
                $con->close();
                ?>
            </tbody>
        </table>
        
        <div class="share">

        <form method="post" action="#">
            <div class="form first">
                <div class="details personal">
                    <span class="title"></span>

                    <div class="fields">
                        <div class="input-field">
                            <label for="prog_name"></label>
                            
                        </div>
                    </div>
                </div>

                <div class="detailsID">
                    <span class="title">Subject Details</span>
                    <div id="subjectFieldsContainer">
                        <!-- Dynamic fields will be added here -->
                    </div>
                    <button type="button" class="btn addSubBtn" onclick="addSubjectField()">Add Subject
                        <i class="uil uil-plus"></i>
                    </button>
                    <button class="btn registerBtn">Register
                        <i class="uil uil-save"></i>
                    </button>
                </div> 
            </div>
        </form>

        </div>
    </section>
    <!-- End Portfolio Details Area -->

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
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>

    <script>
    function addSubjectField() {
        var container = document.getElementById("subjectFieldsContainer");
        var newDiv = document.createElement("div");

        newDiv.className = "input-field";

        // Subject Name input
        var subjectInput = document.createElement("input");
        subjectInput.type = "text";
        subjectInput.name = "subject_name[]";
        subjectInput.placeholder = "Subject Name";
        subjectInput.required = true;

        // Duration input
        var durationInput = document.createElement("input");
        durationInput.type = "text";
        durationInput.name = "subject_duration[]";
        durationInput.placeholder = "Subject Duration (hours)";
        durationInput.required = true;

        // Remove button
        var removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.textContent = "Remove  -";
        removeButton.style.backgroundColor = "#941919";
        removeButton.style.color = "white";
        removeButton.addEventListener("click", function() {
            container.removeChild(newDiv);
        });

        newDiv.appendChild(subjectInput);
        newDiv.appendChild(durationInput);
        newDiv.appendChild(removeButton);
        container.appendChild(newDiv);
    }


    function deleteSubject(subjectId, subjectName) {
        // Prompt user for confirmation
        var confirmation = confirm("Are you sure you want to delete the subject: " + subjectName + "?");
        
        if (confirmation) {
            // Create a hidden input field to store the subject ID
            var deleteInput = document.createElement("input");
            deleteInput.type = "hidden";
            deleteInput.name = "delete_subject_id";
            deleteInput.value = subjectId;

            // Append the input field to the form
            document.querySelector("form").appendChild(deleteInput);

            // Submit the form
            document.querySelector("form").submit();
        }
    }

</script>

</body>

</html>