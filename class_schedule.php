<?php
    session_start();

    include("conn/config.php");

    function connectToDatabase() {
        $servername = "localhost";
        $username = "tsdclk_main";
        $password = ",L;Gij4Cn7#K";
        $dbname = "tsdclk_main";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        return $conn;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $course = $_POST["course"];
    //$lecturer = $_POST["lecturer"];
    $seats = $_POST["seats"];
    $batch = $_POST["batch"];

    $conn = connectToDatabase();


    // Retrieve dynamic date and time fields
    $dates = $_POST["dates"];
    $startTimes = $_POST["start_times"];
    $endTimes = $_POST["end_times"];

    // Combine dynamic date and time fields into an array
    $dateTimes = [];
    
    for ($i = 0; $i < count($dates); $i++) {
        
            $tokenLength = 8;
            $token = substr(uniqid('', true), 0, $tokenLength);

            $dateTimes[] = [
                'token' => $token,
                'subject' => $course,
                'date' => $dates[$i],
                's_time' => $startTimes[$i],
                'e_time' => $endTimes[$i],
                //'lecturer' => $lecturer,
                'seat_amount' => $seats,
                'batch' => $batch,
            ];
        }

       // Insert data into the class_list table
$lastInsertedIds = [];  // To store the auto-generated IDs

foreach ($dateTimes as $dateTime) {
    $token = $dateTime['token'];
    $subject = $dateTime['subject'];
    $date = $dateTime['date'];
    $s_time = $dateTime['s_time'];
    $e_time = $dateTime['e_time'];
    //$lecturer = $dateTime['lecturer'];
    $seat_amount = $dateTime['seat_amount'];
    $batch = $dateTime['batch'];

    $sql = "INSERT INTO class_timetable (token, subject, date, s_time, e_time, seat_amount, batch) 
            VALUES ('$token', '$subject', '$date', '$s_time', '$e_time', '$seat_amount', '$batch')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the last auto-generated ID
        $lastInsertedIds[] = $conn->insert_id;
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        break;
    }
}

// Use the obtained IDs to insert data into the seats table
foreach ($lastInsertedIds as $classId) {
    // Modify the following code according to your seats table structure
    $sqlSeats = "INSERT INTO seats (class_id, class_schedule_id) VALUES ('$classId', '$token')";

    if ($conn->query($sqlSeats) !== TRUE) {
        $message = "Error: " . $sqlSeats . "<br>" . $conn->error;
        break;
    }
}


    // Convert the array to JSON format
    //$jsonDateTime = json_encode($dateTimes);


    // Insert query to classes table
    $sql = "INSERT INTO class_schedule (subject, seats, batch, class_schedule_id) VALUES ('$course', '$seats', '$batch', '$token')";

    if ($conn->query($sql) === TRUE) {
        $message = "Class Scheduled";

        // Redirects to successpage.
        //header("Location: class_schedule.php");
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Use JavaScript to show a popup with the message
    echo "<script>alert('$message');</script>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/class_schedule_style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Class Schedulling</title> 
</head>
<body>
    <div class="container">
        <header>Class Schedulling</header>

        <form action="#" method="post">
            <div>
                <div class="details personal">
                    <span class="title">Class Informations</span>

                    <div class="fields">

                    <div class="input-field">
                        <label>Program</label>
                            <select name="program" id="program" required>
                                <option disabled selected>Select Program</option>
                                <?php
                                    $conn = connectToDatabase();

                                    //fetch from db
                                    $sql = "SELECT program_id, program_name FROM program";
                                    $result = $conn->query($sql);

                                    //add to dropdown
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["program_name"] . "'>" . $row["program_name"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No programs available</option>";
                                    }

                                    $conn->close();
                                ?>
                            </select>
                        </div>

                        <div class="input-field">
                        <label>Subject</label>
                            <select name="subject" id="subject" required>
                                <option disabled selected>Select Subject</option>
                                <?php
                                    $conn = connectToDatabase();

                                    //fetch from db
                                    $sql = "SELECT sub_id, sub_name FROM subjects";
                                    $result = $conn->query($sql);

                                    //add to dropdown
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["sub_name"] . "'>" . $row["sub_name"] . "</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No subjects available</option>";
                                    }

                                    $conn->close();
                                ?>
                            </select>
                        </div>
<!--
                        <div class="input-field">
                        <label>Lecturer</label>
                            <select name="lecturer" required>
                                <option disabled selected>Select Lecturer</option>
                                
                            </select>
                        </div>
                                -->

                        
                        <div class="input-field">
                            <label>Seats</label>
                            <input type="text" name="seats" placeholder="No of available seats" required>
                        </div>

                        <div class="input-field">
                            <label>Batch</label>
                            <input type="text" name="batch" placeholder="Batch Name" required>
                        </div>
                        
                    </div>
                </div>

                <div class="detailsID" >
                    <span class="title">Dates</span>

                    <div class="fields" id="fieldContainer">

                       <!--  <div class="input-field">
                            <label>Day 1</label>
                            <input type="date" placeholder="Enter your issued date" required>
                        </div>

                        <div class="input-field">
                            <label>Day 2</label>
                            <input type="date" placeholder="Enter expiry date" required>
                        </div>

                        
                        <div class="input-field">
                            <label>Day n</label>
                            <input type="date" placeholder="Enter expiry date" required>
                        </div>-->
                    </div>
                    <button onclick="addFields()">Add
                        <i class="uil uil-plus"></i> 
                    </button> 
                    <script>
                        let fieldIndex = 1;
                    
                        function addFields() {
                            // Check if this is not the first set of fields
                            if (fieldIndex > 1) {
                                // Check if the previous set of fields is filled
                                const previousSet = document.getElementById("fieldContainer").lastElementChild;
                                const dayInput = previousSet.querySelector("input[type='date']");
                                const startTimeInput = previousSet.querySelector("input[type='time']");
                                const endTimeInput = previousSet.querySelectorAll("input[type='time']")[1];
                    
                                if (!dayInput.value || !startTimeInput.value || !endTimeInput.value) {
                                    // Alert the user or provide feedback that the previous set of fields is not filled
                                    alert("Please fill in the previous date and time fields before adding new ones.");
                                    return;
                                }
                            }
                    
                            // Create a new set of fields container
                            const fieldSet = document.createElement("div");
                            fieldSet.classList.add("input-field-dates");
                    
                            // Day Label
                            const dayLabel = document.createElement("label");
                            dayLabel.classList.add("daynum")
                            dayLabel.textContent = "Day " + fieldIndex;
                            fieldSet.appendChild(dayLabel);
                    
                            // Day Input
                            const dayInputNew = document.createElement("input");
                            dayInputNew.type = "date";
                            dayInputNew.placeholder = "Enter day";
                            dayInputNew.required = true;
                            dayInputNew.name = "dates[]";
                            fieldSet.appendChild(dayInputNew);
                    
                            // Start Time Label
                            const startTimeLabel = document.createElement("label");
                            startTimeLabel.classList.add("starttime")
                            startTimeLabel.textContent = "Start time";
                            fieldSet.appendChild(startTimeLabel);
                    
                            // Start Time Input
                            const startTimeInputNew = document.createElement("input");
                            startTimeInputNew.type = "time";
                            startTimeInputNew.placeholder = "Enter start time";
                            startTimeInputNew.required = true;
                            startTimeInputNew.name = "start_times[]";
                            fieldSet.appendChild(startTimeInputNew);
                    
                            // End Time Label
                            const endTimeLabel = document.createElement("label");
                            endTimeLabel.textContent = "End time";
                            fieldSet.appendChild(endTimeLabel);
                    
                            // End Time Input
                            const endTimeInputNew = document.createElement("input");
                            endTimeInputNew.type = "time";
                            endTimeInputNew.placeholder = "Enter end time";
                            endTimeInputNew.required = true;
                            endTimeInputNew.name = "end_times[]";
                            fieldSet.appendChild(endTimeInputNew);
                    
                            // Append the new set of fields to the container
                            document.getElementById("fieldContainer").appendChild(fieldSet);
                    
                            // Increment the field index for the next set of fields
                            fieldIndex++;
                        }

                        function tablePreview() {
                            
                            // Define the URL of the web page you want to redirect to
                            var newPageURL = "schedule_classlist.php";

                            window.open(newPageURL, "_blank");
                        }
                    </script>
                    

                    <button class="nextBtn">Save
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
                <button onclick="tablePreview()">Class Table
                    <i class="uil uil-external-link-alt"></i>
                </button>
            </div>
        </form>
    </div>
</body>
</html>