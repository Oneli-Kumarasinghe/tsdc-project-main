<?php
session_start();
include("conn/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $programId = $_POST["programId"];
    $updatedNote = $_POST["updatedNote"];

    // Debug: Log program ID and updated note to console
    error_log("Program ID: " . $programId);
    error_log("Updated Note: " . $updatedNote);


    $updateQuery = "UPDATE program SET prog_note = '$updatedNote' WHERE program_id = $programId";

    if ($con->query($updateQuery)) {
        echo json_encode(array("success" => true, "message" => "Program note updated successfully"));
        $con->commit();
    } else {
        echo json_encode(array("success" => false, "message" => "Error updating program note: " . $con->error));
    }

    $con->close();
}
?>
