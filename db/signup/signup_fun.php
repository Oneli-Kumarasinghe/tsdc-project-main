<?php
session_start();
require_once '../../db/db.php';

class signup extends DbConnect {
    private $con;

    function __construct() {  
        $this->con = $this->connect();  
    }

    public function userSignup($name, $phone, $nic, $email, $company, $address, $password) {
        $output = 0;
        $message = "";

        if(empty($name) || empty($phone) || empty($nic) || empty($email) || empty($company) || empty($address) || empty($password)) {
            $message = "All fields are required.";
            return array('output' => 5, 'message' => $message);
        }else{


            $username = mysqli_real_escape_string($this->con, $nic);
            $hashed_password = md5($password);
            $name = mysqli_real_escape_string($this->con, $name);
            $email = mysqli_real_escape_string($this->con, $email);
            $phone = mysqli_real_escape_string($this->con, $phone);
            $address = mysqli_real_escape_string($this->con, $address);
            $company = $company;
    
            // login table
            $login_sql = "INSERT INTO login (username, password,type) VALUES ('$username', '$hashed_password','3')";
            //echo $login_sql;
            $login_query = mysqli_query($this->con, $login_sql);
            if (!empty($login_query)) {
                $login_id = mysqli_insert_id($this->con);
    
                //student table
                $student_sql = "INSERT INTO student (name, email, phone, address, login_id,comp_id) VALUES ('$name', '$email', '$phone', '$address', $login_id,$company)";
                
                $student_query = mysqli_query($this->con, $student_sql);
                if (!empty($student_query)) {
                    $output = 1;
                     $message = "Please login to your account";
                } else {
                    $output = 2;
                    $message = "Login Created, Failed to Create Account" . mysqli_error($this->con);
                }
            } else {
                $output = 6;
                $message = "Unknown Error" .  mysqli_error($this->con);
            }
            
    
            $data = array(
                'output' => $output,
                'message' => $message
            );
    
            return $data;
        }
    }
}
?>
