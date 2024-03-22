<?php
session_start();

include("conn/config.php");

// Fetch data from the AJAX request
$nic = isset($_POST['nic']) ? mysqli_real_escape_string($con, $_POST['nic']) : '';
$fullName = isset($_POST['fullName']) ? mysqli_real_escape_string($con, $_POST['fullName']) : '';
$company = isset($_POST['company']) ? mysqli_real_escape_string($con, $_POST['company']) : '';
$seatIndex = isset($_POST['seatIndex']) ? mysqli_real_escape_string($con, $_POST['seatIndex']) : '';
$paymentCheckbox = isset($_POST['paymentCheckbox']) ? 1 : 0; // Convert to 1 for checked, 0 for unchecked
$attendanceCheckbox = isset($_POST['attendanceCheckbox']) ? 1 : 0; // Convert to 1 for checked, 0 for unchecked
$token = isset($_POST['token']) ? mysqli_real_escape_string($con, $_POST['token']) : '';


// Fetch additional data (classId, date, batch, from) from the session or wherever it's stored
$classId = isset($_SESSION['class_id']) ? $_SESSION['class_id'] : ''; 
$date = isset($_POST['date']) ? mysqli_real_escape_string($con, $_POST['date']) : '';
$batch = isset($_POST['batch']) ? mysqli_real_escape_string($con, $_POST['batch']) : '';
$from = isset($_POST['from']) ? mysqli_real_escape_string($con, $_POST['from']) : '';

// Generate the token as a combination of $batch + Class{$classId} + ${nic} + $date + $from
$token = $batch . "Class{$classId}" . $nic . $date . $from;

// Insert data into the "certificate" table
$sql = "INSERT INTO certificate (std_nic, std_name, company, certificate_no, payment_status, attendance, booked_seat, token)
        VALUES ('$nic', '$fullName', '$company', NULL, $paymentCheckbox, $attendanceCheckbox, '$seatIndex', '$token')";
$result = $con->query($sql);

if ($result) {
    echo "Certification successful!" .$token. " ".$classId;
} else {
    echo "Error inserting data: " . $con->error;
}

// Close the database connection
$con->close();
?>
