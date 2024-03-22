<?php
include("conn/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['program_id'])) {
    $programId = $_POST['program_id'];

    // Fetch batch_count from the database
    $sql = "SELECT batch_count FROM program WHERE program_id = $programId";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $batchCount = $row['batch_count'];
        $response = array('success' => true, 'batch_count' => $batchCount);
    } else {
        $response = array('success' => false);
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

    $con->close();
    exit();
}
?>
