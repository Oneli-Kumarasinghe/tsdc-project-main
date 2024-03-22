<?php
require_once '../../db/signup/signup_fun.php';
$message = "";
$output = 0;

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $user_signup = new signup();
    $ret = $user_signup->userSignup($name,$phone,$nic,$email,$company,$address,$password);
   // echo $ret;
    
    // if($ret == 1){
    //     $output = 1;
        
    // }
    // else if($ret == 2){
    //     $output = 2;
    //     $message = "Login Created, Failed to Create Account";
    // }
    // else if($ret == 3){
    //     $output = 3;
    //     $message = "";
    // }
    // else if($ret == 5){
    //     $output = 5;
    //     $message = "Missing Fields";
    // }
    // else{
    //     $output = 6;
    //     $message = "Unknown Error";
        
    // }


// $data = array(
//     'output' => $output,
//     'message' =>$message
// );

$data = $ret;

echo json_encode($data);

?>