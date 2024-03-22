<?php
include("conn/config.php");

if (isset($_POST['programId'])) {
    $programId = $_POST['programId'];
    $response = [];

    //getting related batches from batch_schedule table. (filtered using program_id)
    $stmt = $con->prepare("SELECT batch_ID, batch, tot_hours, seats FROM batch_schedule WHERE program_id = ?");
    $stmt->bind_param("s", $programId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = array("batch_ID" => $row['batch_ID'], "batch" => $row['batch'], "tot_hours" => $row['tot_hours'], "seats" => $row['seats']);
        }
    }

    $stmt->close();
    $con->close();

    echo json_encode($response);
}
?>
