<?php
include("conn/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $programId = $_POST["programId"];

    // Fetch subjects based on the selected program
    $sql = "SELECT subject_id, subject_name FROM prog_subj WHERE program_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $programId);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = array();
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }

    $stmt->close();

    echo json_encode($subjects);
}

$con->close();
?>
