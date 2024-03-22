<?php

include("conn/config.php");

if(isset($_POST['batchId'])) {
    $batchId = $_POST['batchId'];

    $query = "SELECT tot_hours, seats FROM batch_schedule WHERE batch_ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $batchId);
    $stmt->execute();
    $stmt->bind_result($totHours, $seats);

    if($stmt->fetch()) {
        echo json_encode(['tot_hours' => $totHours, 'seats' => $seats]);
    } else {
        echo json_encode(['error' => 'No data found for the selected batch.']);
    }

    $stmt->close();
    $con->close();
} else {
    echo json_encode(['error' => 'Batch ID not provided.']);
}
?>
