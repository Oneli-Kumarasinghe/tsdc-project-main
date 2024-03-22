<?php
    session_start();

    include("conn/config.php");

    
    if (isset($_SESSION['valid'])) {
        // User is logged in, you can include any code here that should run when the user is logged in
    } else {
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT * FROM class_timetable"; 
    $result = $con->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="tsdc">
      <title> TSDC Admin - Student Admissions and Certificate </title>
      <!-- Style CSS -->
      <link rel="stylesheet" href="./css/certificate_table_style.css">
      <link rel="stylesheet" href="./css/certificate_table_demo.css">
      <!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<!-- Data Table CSS -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


   <style> 

@media only screen and (max-width: 767px) {
  /* Force table to not be like tables anymore */
  table,
  thead,
  tbody,
  th,
  td,
  tr {
    display: block;
  }

  /* Hide table headers (but not display: none;, for accessibility) */
  thead tr,
  tfoot tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }

  td {
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50% !important;
  }

  td:before {
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
  }

  .table td:nth-child(1) {
    background: #ccc;
    height: 100%;
    top: 0;
    left: 0;
    font-weight: bold;
  }

  /*
  Label the data
  */
  td:nth-of-type(1):before {
    content: "Class";
  }

  td:nth-of-type(2):before {
    content: "Batch";
  }

  td:nth-of-type(3):before {
    content: "Subject";
  }

  td:nth-of-type(4):before {
    content: "Date";
  }

  td:nth-of-type(5):before {
    content: "Duration";
  }

  td:nth-of-type(6):before {
    content: "Actions";
  }

  .dataTables_length {
    display: none;
  }
}

   </style>

   </head>


   <body>
      <header class="cd__intro">
         <h1> Student Admissions and Certificate </h1>
         <p> To view the students who have booked seats for a class., click on the blue forward arrow on that class's row.</p>
         <div class="cd__action">
            <a href="admin_panel.php" title="Admin Portal" class="cd__btn back">Back to Admin Portal</a>
         </div>
      </header>
      
      <!--$%adsense%$-->
      <main class="cd__main">
         <table id="example" class="table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th>Class</th>
                  <th>Batch</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Duration</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
              <?php
foreach ($data as $row) {
    echo "<tr>";
    echo "<td>Class{$row['class_id']}</td>";
    echo "<td>{$row['batch']}</td>";
    echo "<td>{$row['subject']}</td>";
    echo "<td>{$row['date']}</td>";
    // Concatenate start time and end time
    $timeRange = "{$row['s_time']} - {$row['e_time']}";
    echo "<td>{$timeRange}</td>";
    echo "<td>
              <i class='fas fa-arrow-right edit-btn' style='color: blue;' data-classid='{$row['class_id']}' data-subject='{$row['subject']}' data-batch='{$row['batch']}' data-from='{$row['s_time']}' data-to='{$row['e_time']}' data-date='{$row['date']}' data-timeRange='{$timeRange}'></i>
          </td>";
    echo "</tr>";
}
?>
            </tbody>
            <tfoot>
               <tr>
                  <th>Class</th>
                  <th>Batch</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Duration</th>
                  <th>Actions</th>
               </tr>
            </tfoot>
         </table>
      </main>
      <footer class="cd__credit">© TSDC 2024</footer>
      <!-- jQuery -->
<script src='https://code.jquery.com/jquery-3.7.0.js'></script>
<!-- Data Table JS -->
<script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>
      <!-- Script JS -->
      <script src="./js/tablesort_script.js"></script>
      <!--$%analytics%$-->
   </body>
</html>