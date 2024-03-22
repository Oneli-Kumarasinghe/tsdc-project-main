<?php
session_start();
require_once '../../db/db.php';
class login extends DbConnect{
        
        private $con;
        function __construct() {  
            $this->con = $this->connect();  
        }
        	
		public function userLogin($email,$pass){
            
            $pass = md5($pass);
            
            $sql =  "SELECT * FROM `login` WHERE `username` = '$email' AND password = '$pass'";
            //echo $sql;
            $query = mysqli_query($this->con,$sql);
            $rows = mysqli_num_rows($query);
			//echo $rows;
            if($rows > 0){
                $row = mysqli_fetch_array($query);
                $_SESSION['valid'] = $row['login_id'];
                $_SESSION['access_type'] = $row['type'];
                
                $type = $row['type'];
                $l_id = $row['login_id'];
                
                if($type == 1){
                    $_SESSION['fullname'] = $row['username'];
                    
                }
                else if($type == 3){
                    $name_sql = "SELECT name FROM student WHERE login_id = $l_id";
                    $name_query = mysqli_query($this->con,$name_sql);
                    $name_row = mysqli_fetch_array($name_query);
                     $_SESSION['fullname'] = $name_row['name'];
                    
                }
                else{
                    $name_sql = "SELECT comp_name FROM company WHERE login_id = $l_id";
                    $name_query = mysqli_query($this->con,$name_sql);
                    $name_row = mysqli_fetch_array($name_query);
                     $_SESSION['fullname'] = $name_row['comp_name'];
                }
                
                
                
            }
			return $rows; 
		}
}

?>