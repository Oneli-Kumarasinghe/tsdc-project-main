<?php
    include("conn/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $classId = $_POST["classId"];
        $newStatus = $_POST["newStatus"];

        $updateSql = "UPDATE class_list SET status = '$newStatus' WHERE class_id = '$classId'";
        if ($con->query($updateSql) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $con->error;
        }

        $con->close();
    } else {
        echo "Invalid request method";
    }
?>
