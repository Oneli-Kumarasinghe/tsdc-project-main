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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $added_by = $_SESSION['fullname'];

    if (isset($_POST["program_name"])) {
        $program_names = $_POST["program_name"];
        $prog_notes = $_POST["prog_note"];

        $con = connectToDatabase();

        for ($i = 0; $i < count($program_names); $i++) {
            $program_name = $con->real_escape_string($program_names[$i]);
            $prog_note = $con->real_escape_string($prog_notes[$i]);

            $insertQuery = "INSERT INTO program (program_name, prog_note, added_by) VALUES ('$program_name', '$prog_note', '$added_by')";
            $con->query($insertQuery);
        }

        $con->close();

        echo '<script>alert("Program(s) added");</script>';
    }

    if (isset($_POST["delete_prog_id"])) {
        $deleteProgId = $_POST["delete_prog_id"];

        $con = connectToDatabase();

        $deleteQuery = "DELETE FROM program WHERE program_id = $deleteProgId";
        $con->query($deleteQuery);

        $con->close();

        echo '<script>alert("Program deleted");</script>';
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
                        <h2>Program Register</h2>
                        <ul class="bread-list">
                            <li><a href="admin_panel.php"><b>Admin Panel</b></a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Program Register</li>
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
                        <h3>Register New Programs</h3>
                        <br>

                        <table>
                            <tr>
                                <th>Program</th>
                                <th>Course Note</th>
                                <th>Actions</th>
                            </tr>
                            <tbody>
                                <?php
                                    include("conn/config.php");
                                    $result = $con->query("SELECT * FROM program");

                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td data-label='program_name'>" . $row['program_name'] . "</td>";
                                        echo "<td data-label='prog_note' onclick='editProgramNote(" . $row['program_id'] . ")'>" . $row['prog_note'] . "</td>";
                                        echo "<td data-label='actions'><button class='btn deleteBtn' onclick='deleteSubject(" . $row['program_id'] . ", \"" . $row['program_name'] . "\")'>Delete</button></td>";
                                        echo "</tr>";
                                    }

                                    $con->close();
                                    ?>
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

        <div class="detailsID">
            <span class="title">Enter New Program Details</span>
            <div id="subjectFieldsContainer">
                <!-- Dynamic fields will be added here -->
            </div>
            <button type="button" class="btn addSubBtn" onclick="addSubjectField()">Add Program
                <i class="uil uil-plus"></i>
            </button>
            <button class="btn registerBtn">Register
                <i class="uil uil-save"></i>
            </button>
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
        var container = document.getElementById("subjectFieldsContainer");
        var newDiv = document.createElement("div");

        newDiv.className = "input-field";

        // Program Name input
        var programInput = document.createElement("input");
        programInput.type = "text";
        programInput.name = "program_name[]";
        programInput.placeholder = "Program Name";
        programInput.required = true;

        // Program Note input
        var noteInput = document.createElement("input");
        noteInput.type = "text";
        noteInput.name = "prog_note[]";
        noteInput.placeholder = "Program Note";

        // Remove button
        var removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.textContent = "Remove  -";
        removeButton.style.backgroundColor = "#941919";
        removeButton.style.color = "white";
        removeButton.addEventListener("click", function () {
            container.removeChild(newDiv);
        });

        newDiv.appendChild(programInput);
        newDiv.appendChild(noteInput);
        newDiv.appendChild(removeButton);
        container.appendChild(newDiv);
    }

    function deleteSubject(subjectId, subjectName) {

        var confirmation = confirm("Are you sure you want to delete the subject: " + subjectName + "?");

        if (confirmation) {
            var deleteInput = document.createElement("input");
            deleteInput.type = "hidden";
            deleteInput.name = "delete_prog_id";
            deleteInput.value = subjectId;

            document.querySelector("form").appendChild(deleteInput);
            document.querySelector("form").submit();
        }
    }

    function editProgramNote(programId) {
    var noteCell = document.querySelector("[data-label='prog_note'][onclick^='editProgramNote(" + programId + ")']");

    var currentText = noteCell.textContent;

    noteCell.innerHTML = "<input type='text' id='editedNote' value='" + currentText + "'>";

    var updateButton = document.createElement("button");
    updateButton.className = "btn update-prognote";
    updateButton.textContent = "Update";
    updateButton.style.marginRight = "5px"; // Add margin to the right (adjust as needed)
    updateButton.onclick = function () {
        var updatedNote = document.getElementById('editedNote').value;

        $.ajax({
            url: 'backend_update_program_note.php',
            type: 'POST',
            data: {
                programId: programId,
                updatedNote: updatedNote
            },
            success: function (response) {
                console.log(response);
                noteCell.innerHTML = updatedNote;
            },
            error: function (error) {
                console.error(error);
            }
        });
    };

    var gotoLinkButton = document.createElement("button");
    gotoLinkButton.className = "btn goto-link";
    gotoLinkButton.textContent = "Go to Link";
    gotoLinkButton.onclick = function () {
        var courseNote = currentText;
        window.open(courseNote, '_blank');
        
        noteCell.innerHTML = courseNote;
    };

    var buttonsContainer = document.createElement("div");
    buttonsContainer.appendChild(updateButton);
    buttonsContainer.appendChild(gotoLinkButton);

    noteCell.appendChild(buttonsContainer);
}
    </script>

</body>

</html>
