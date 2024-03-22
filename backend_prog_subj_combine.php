<?php
session_start();

include("conn/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $programId = isset($_POST["program_id"]) ? $_POST["program_id"] : null;
    $subjectId = isset($_POST["subject_id"]) ? $_POST["subject_id"] : null;
    $programName = isset($_POST["program_name"]) ? $_POST["program_name"] : null;
    $subjectName = isset($_POST["subject_name"]) ? $_POST["subject_name"] : null;

    
    $checkSql = "SELECT * FROM prog_subj WHERE program_id = '$programId' AND subject_id = '$subjectId'";
    $checkResult = $con->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Subject already registered to selected program'); window.history.back();</script>";
    } else {
        $sql = "INSERT INTO prog_subj (program_id, program_name, subject_id, subject_name) VALUES ('$programId', '$programName', '$subjectId', '$subjectName')";

        echo "Debug: SQL Query - $sql<br>";

        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Data inserted successfully!'); window.history.back();</script>";
        } else {
            echo "Error: " . $con->error;
        }
    }
}

$con->close();
?>
