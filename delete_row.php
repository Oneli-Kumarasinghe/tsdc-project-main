<?php
    session_start();

    include("conn/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["rowId"])) {
        $rowId = $_POST["rowId"];

        $sql = "DELETE FROM class_list WHERE class_id = $rowId";
        if ($con->query($sql) === TRUE) {
            echo "Row deleted successfully";
        } else {
            echo "Error deleting row: " . $con->error;
        }
    } else {
        echo "Invalid request";
    }
?>
