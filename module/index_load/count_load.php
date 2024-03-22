<?php

require_once '../../db/index/index_load.php';


    
    $student = new load_index();
    $program = $student->program_count_load();
    $student = $student->student_count_load();
    
    
    $data = array(
    'studnet' => $student,
    'program' =>$program
);

echo json_encode($data);
    
    

?>