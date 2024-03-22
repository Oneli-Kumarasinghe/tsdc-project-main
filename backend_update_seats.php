<?php
session_start();

include("conn/config.php");

// Ensure that the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $classId = isset($_POST['classId']) ? mysqli_real_escape_string($con, $_POST['classId']) : '';
    $seatNumber = isset($_POST['seatNumber']) ? mysqli_real_escape_string($con, $_POST['seatNumber']) : '';
    $classScheduleToken = isset($_GET['classScheduleToken']) ? $_GET['classScheduleToken'] : '';

    // Validate the session variable
    if (!isset($_SESSION['valid'])) {
        echo 'Session variable "valid" not set.';
        exit();
    }

    // Sanitize the session variable
    $nic = mysqli_real_escape_string($con, $_SESSION['valid']);

    // Additional validation for $classId and $seatNumber
    if (empty($classId) || !is_numeric($classId) || empty($seatNumber) || !is_numeric($seatNumber)) {
        echo 'Invalid or missing classId or seatNumber.';
        exit();
    }

    // Retrieve the class_schedule_id for the given class
    $getClassScheduleIdQuery = "SELECT class_schedule_id FROM seats WHERE class_id = '$classId'";
    $classScheduleIdResult = $con->query($getClassScheduleIdQuery);

    if ($classScheduleIdResult) {
        $row = $classScheduleIdResult->fetch_assoc();
        $classScheduleId = $row['class_schedule_id'];

        // Update all classes with the same class_schedule_id
        $updateQuery = "UPDATE seats SET seat$seatNumber = '$nic' WHERE class_schedule_id = '$classScheduleId'";
        
        // Execute the query
        if ($con->query($updateQuery)) {
            // Return a success response
            echo 'Booking successful!';
        } else {
            // Return an error response
            echo 'Error updating seats: ' . $con->error;
        }
    } else {
        // Return an error response if there is an issue retrieving class_schedule_id
        echo 'Error retrieving class_schedule_id: ' . $con->error;
    }
} else {
    // Return an error response if the request method is not POST
    echo 'Invalid request method.';
}
?>
