<?php
include("conn/config.php");

if (isset($_GET["program"])) {
    $program = $_GET["program"];

    $conn = connectToDatabase();
    $sql = "SELECT sub_id, sub_name FROM subjects WHERE prog_name = '$program'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["sub_name"] . "'>" . $row["sub_name"] . "</option>";
        }
    } else {
        echo "<option value='' disabled>No subjects available for this program</option>";
    }

    $conn->close();
}
?>
