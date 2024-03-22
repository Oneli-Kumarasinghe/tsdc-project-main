<?php
include("conn/config.php");

if (isset($_GET['subject_id']) && isset($_GET['program_id'])) {
    $subjectId = $_GET['subject_id'];
    $programId = $_GET['program_id'];

    $sql = "DELETE FROM prog_subj WHERE subject_id = '$subjectId' AND program_id = '$programId'";
    $result = $con->query($sql);

    if ($result) {
        echo "Subject deleted successfully";
    } else {
        echo "Error deleting subject: " . $con->error;
    }
} else {
    echo "Invalid subject ID or program ID";
}

$con->close();
?>
