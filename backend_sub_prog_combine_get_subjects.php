<?php
include("conn/config.php");

if (isset($_GET['program_id'])) {
    $programId = $_GET['program_id'];

    $sql = "SELECT program_id, subject_id, subject_name FROM prog_subj WHERE program_id = '$programId'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        echo "<tr><th>Subjects</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td data-label='subject'>" . $row['subject_name'] . "</td>";
            echo "<td data-label='actions'><button class='btn deleteBtn' onclick='deleteSubject(" . $row['subject_id'] . ", " . $row['program_id'] . ")'>Delete</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No subjects available for the selected program</td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>Invalid program ID</td></tr>";
}

$con->close();
?>
