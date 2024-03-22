<?php
session_start();

include("conn/config.php");

if (isset($_SESSION['valid'])) {
    
} else {
    header("Location: login.php");
    exit();
}

$classId = isset($_GET['class_id']) ? $_GET['class_id'] : '';
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';
$batch = isset($_GET['batch']) ? $_GET['batch'] : '';
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$duration = isset($_GET['duration']) ? $_GET['duration'] : '';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="tsdc">
    <title> TSDC Admin - Student Admissions and Certificate </title>
    <!-- Style CSS -->
    <link rel="stylesheet" href="./css/certify_modal_style.css">
    <link rel="stylesheet" href="./css/certificate_table_style.css">
    <link rel="stylesheet" href="./css/certificate_table_demo.css">
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Data Table CSS -->
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        @media only screen and (max-width: 767px) {
            /* Force table to not be like tables anymore */
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr,
            tfoot tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            td {
                /* Behave like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50% !important;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }

            .table td:nth-child(1) {
                background: #ccc;
                height: 100%;
                top: 0;
                left: 0;
                font-weight: bold;
            }

            /*
            Label the data
            */
            td:nth-of-type(1):before {
                content: "Student NIC";
            }

            td:nth-of-type(2):before {
                content: "Student Name";
            }

            td:nth-of-type(3):before {
                content: "Company";
            }

            td:nth-of-type(4):before {
                content: "Booked Seat";
            }

            td:nth-of-type(5):before {
                content: "Status";
            }

            td:nth-of-type(6):before {
                content: "Actions";
            }

            .dataTables_length {
                display: none;
            }
        }
    </style>
</head>

<body>
<header class="cd__intro">
    <h1> <?php echo "Class{$classId} - {$subject} - {$batch} ($duration)"; ?> </h1>
    <p> Mark students admissions and certify them once they made the payments.</p>
    <div class="cd__action">
        <a href="AP_admission_classlist.php" title="Admin Portal" class="cd__btn back">Back to Class List</a>
    </div>
</header>

<!--$%adsense%$-->
<main class="cd__main">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>Student NIC</th>
            <th>Student Name</th>
            <th>Company</th>
            <th>Booked Seat</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Initialize an empty array to store seats with NIC values
        $seatsWithNIC = array();

        // Loop through 8 rows
        for ($rowNumber = 1; $rowNumber <= 8; $rowNumber++) {
            // Loop through 8 seats for each row
            for ($seatNumber = 1; $seatNumber <= 5; $seatNumber++) {
                $seatIndex = ($rowNumber - 1) * 5 + $seatNumber;
                $seatStatus = $seatData["seat$seatIndex"];

                // Check if the seat is not empty and has a NIC value
                if ($seatStatus !== 'empty' && !empty($seatStatus)) {
                    // Store the seat number as the key and the NIC as the value in the array
                    $seatsWithNIC[$seatIndex] = $seatStatus;
                }
            }
        }

        // Loop through the seatsWithNIC array and populate the table rows
        foreach ($seatsWithNIC as $seatIndex => $nic) {

            $studentDetails = getStudentDetails($nic);

            // Check if student details are found
            if ($studentDetails) {
                // Extract full name from student details
                $fullName = $studentDetails['fullanme'];
                $company = $studentDetails['company'];

                // Output table row with student details and button
                echo "<tr>";
                echo "<td>{$nic}</td>";
                echo "<td>{$fullName}</td>";
                echo "<td>{$company}</td>";
                echo "<td>{$seatIndex}</td>";
                echo "<td>Unconfirmed</td>";
                echo "<td>
                    <i class='fas fa-edit certify-btn' style='color: blue; cursor: pointer;' onclick='certifyRow(\"$nic\", \"$fullName\", \"$company\", \"$seatIndex\")'></i>
                </td>";
                echo "</tr>";
            }
        }

        // Function to get student details from the students table based on NIC
        function getStudentDetails($nic) {
            global $con;
            $sql = "SELECT * FROM students WHERE nic = '$nic'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th>Student NIC</th>
            <th>Student Name</th>
            <th>Company</th>
            <th>Booked Seat</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </tfoot>
    </table>
</main>


<dialog id="dialog">
	<h2>ERROR</h2>
	<p>Error while fetching data from the table.</p>
	<p></p>
	<button onclick="window.dialog.close();" aria-label="close" class="x">❌</button>
</dialog>

<footer class="cd__credit">© TSDC 2024</footer>
<!-- jQuery -->
<script src='https://code.jquery.com/jquery-3.7.0.js'></script>
<!-- Data Table JS -->
<script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>
<!-- Script JS -->
<script src="./js/tablesort_script.js"></script>
<!-- certification button click -->
<script>
    function certifyRow(nic, fullName, company, seatIndex) {
        // Get the dialog element
        var dialog = document.getElementById('dialog');

        // Set the content of the dialog based on the selected row's data
        dialog.innerHTML = `
            <h2><?php echo "Class{$classId} - {$subject} - {$batch} ($duration)"; ?> </h2>
            <p>Student NIC: ${nic}</p>
            <p>Student Name: ${fullName}</p>
            <p>Company: ${company}</p>
            <p>Seat Index: ${seatIndex}</p>
            <label>
        <input type="checkbox" id="paymentCheckbox" name="payment" value="Payment">
        Payment
    </label>
    <label>
        <input type="checkbox" id="attendanceCheckbox" name="attendance" value="Attendance">
        Attendance
    </label>
            <button onclick="certifyStudent('${nic}', '${fullName}', '${company}', ${seatIndex});" class="btn-6" role="button">Confirm and Certify</button>
            <button onclick="closeDialog();" aria-label="close" class="x">❌</button>
        `;

        // Open the dialog
        dialog.showModal();
    }

    // Function to close the dialog
    function closeDialog() {
        var dialog = document.getElementById('dialog');
        // Close the dialog
        dialog.close();
    }


    // Function to certify the student via AJAX
    function certifyStudent(nic, fullName, company, seatIndex) {
        // Get the checkbox values
        var paymentCheckbox = document.getElementById('paymentCheckbox').checked;
        var attendanceCheckbox = document.getElementById('attendanceCheckbox').checked;

        // Perform an AJAX request to your server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "backend_certify_student.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Define the data to be sent
        var data = "nic=" + nic + "&fullName=" + fullName + "&company=" + company + "&seatIndex=" + seatIndex +
                   "&paymentCheckbox=" + paymentCheckbox + "&attendanceCheckbox=" + attendanceCheckbox;

        // Handle the AJAX response
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Do something with the response (if needed)
                alert(xhr.responseText);
            }
        };

        // Send the request
        xhr.send(data);

        // Close the dialog after certification
        closeDialog();
    }


</script>
<!-- HTML !-->
   </body>
</html>