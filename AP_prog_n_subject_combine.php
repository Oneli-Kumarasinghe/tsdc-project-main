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
    <title>TSDC Admin - Programs and Subjects Combine</title>

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
                        <h2>Programs and Subjects Combine</h2>
                        <ul class="bread-list">
                            <li><a href="admin_panel.php"><b>Admin Panel</b></a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Programs and Subjects Combine</li>
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
                    <div class="body-text">
                        <h3>Select a Program and a Subject to combine</h3>
                    </div>
                </div>

                        <br>

                        <div class="input-field">
                        <label>Program</label>
                            <select name="program" id="program" onchange="getSubjects()" required>
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

                        <div class="input-field">
                        <label>Subject</label>
                            <select name="subject" id="subject" required>
                                <option disabled selected>Select Subject</option>
                                <?php
                                    $conn = connectToDatabase();

                                    //fetch from db
                                    $sql = "SELECT sub_id, sub_name FROM subjects";
                                    $result = $conn->query($sql);

                                    //add to dropdown
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["sub_id"] . "'>" . $row["sub_name"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No subjects available</option>";
                                    }

                                    $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="detailsID">
                                        <div class="fields">

                                        

                                        </div>
                                        <button type="button" class="btn btnCombine" onclick="addSubjectField()">Save
                                            <i class="uil uil-plus"></i>
                                        </button>
                                    </div>

                        <table>
                            <tr>
                            </tr>
                            <tbody id="subjectsTable">
                                <tr>
                                    <td>Select a program</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="share">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="form first">
                                    <div class="details personal">
                                        <span class="title"></span>

                                        <div class="fields">
                                            <div class="input-field">
                                                <label for="prog_name"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
    var programName = document.getElementById("program").options[document.getElementById("program").selectedIndex].text;
    var programId = document.getElementById("program").value;
    var subjectName = document.getElementById("subject").options[document.getElementById("subject").selectedIndex].text;
    var subjectId = document.getElementById("subject").value;


    var alertMessage = "Program Name: " + programName + "\n" +
        "Program ID: " + programId + "\n" +
        "Subject Name: " + subjectName + "\n" +
        "Subject ID: " + subjectId;

    alert(alertMessage);


    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "backend_prog_subj_combine.php");

    var programNameInput = document.createElement("input");
    programNameInput.setAttribute("type", "hidden");
    programNameInput.setAttribute("name", "program_name");
    programNameInput.setAttribute("value", programName);

    var programIdInput = document.createElement("input");
    programIdInput.setAttribute("type", "hidden");
    programIdInput.setAttribute("name", "program_id");
    programIdInput.setAttribute("value", programId);

    var subjectNameInput = document.createElement("input");
    subjectNameInput.setAttribute("type", "hidden");
    subjectNameInput.setAttribute("name", "subject_name");
    subjectNameInput.setAttribute("value", subjectName);

    var subjectIdInput = document.createElement("input");
    subjectIdInput.setAttribute("type", "hidden");
    subjectIdInput.setAttribute("name", "subject_id");
    subjectIdInput.setAttribute("value", subjectId);

    form.appendChild(programNameInput);
    form.appendChild(programIdInput);
    form.appendChild(subjectNameInput);
    form.appendChild(subjectIdInput);

    document.body.appendChild(form);

    form.submit();
}

function getSubjects() {
    var programId = document.getElementById("program").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("subjectsTable").innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "backend_sub_prog_combine_get_subjects.php?program_id=" + programId, true);
    xhr.send();
}

function deleteSubject(subjectId, programId) {
    console.log("Deleting subject with ID:", subjectId, "for program ID:", programId);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            console.log("XHR status:", xhr.status);
            if (xhr.status == 200) {
                // Handle success
                console.log("Subject deleted successfully");
                getSubjects(); // Call a function to refresh the subjects after deletion
            } else {
                // Handle errors
                console.error("Error deleting subject");
            }
        }
    };

    xhr.open("GET", "backend_sub_prog_combine_delete_subject.php?subject_id=" + subjectId + "&program_id=" + programId, true);
    xhr.send();
}


</script>

</body>

</html>
