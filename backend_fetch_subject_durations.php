<?php
include("conn/config.php");

if(isset($_POST['subjectId']) && !empty($_POST['subjectId'])) {
    $subjectId = mysqli_real_escape_string($con, $_POST['subjectId']);

    $query = "SELECT duration_h FROM subjects WHERE sub_id = '$subjectId'";

    $result = mysqli_query($con, $query);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        
        if(isset($row['duration_h'])) {
            echo json_encode(['duration_h' => $row['duration_h']]);
        } else {
            echo json_encode(['error' => 'Duration not found for the selected subject.']);
        }
    } else {
        echo json_encode(['error' => 'Failed to fetch duration_h.']);
    }
} else {
    echo json_encode(['error' => 'No subjectId provided.']);
}

mysqli_close($con);
?>
