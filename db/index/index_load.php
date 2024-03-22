<?php
session_start();
require_once '../../db/db.php';
class load_index extends DbConnect{
        
        private $con;
        function __construct() {  
            $this->con = $this->connect();  
        }
        
        public function program_count_load(){
            $admin_count_query = "SELECT COUNT(*) AS admin_count FROM admin";
            $admin_count_result = mysqli_query($this->con, $admin_count_query);
            
            $admin_count = "";
            if ($admin_count_result) {
                $row = mysqli_fetch_assoc($admin_count_result);
                $admin_count = $row['admin_count'];
            } else {
                $admin_count = 0; // Default to 0 if there is an error
            }
            
            return $admin_count;
        }
        
        public function student_count_load(){
            $students_count_query = "SELECT COUNT(*) AS students_count FROM students";
            $students_count_result = mysqli_query($con, $students_count_query);
            
            $students_count = "";
            if ($students_count_result) {
                $row = mysqli_fetch_assoc($students_count_result);
                $students_count = $row['students_count'];
            } else {
                $students_count = 0; // Default to 0 if there is an error
            }
            
            return $students_count;
        }
}