<?php
require_once '../../db/login/login_fun.php';
$message = "";
$output = 0;

    $pass = $_POST['password'];
    $email = $_POST['nic'];
    $user_login = new login();
    $ret = $user_login->userLogin($email,$pass);
    //echo $ret;
    
    if($ret > 0){
        $output = 1;
        
    }
    else{
        $output = 2;
        $message = "Invalid NIC number / password";
        
    }


$data = array(
    'output' => $output,
    'message' =>$message
);

echo json_encode($data);

?>