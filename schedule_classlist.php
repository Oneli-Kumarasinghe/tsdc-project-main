<?php
    session_start();

    include("conn/config.php");

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class Planner Table</title>
    <link rel="stylesheet" href="css/table_styles.css">
    <link rel="stylesheet" href="css/popup_styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <h2>Classes</h2>

    <div class="table-wrapper">
        <table class="fl-table" id="classesTable">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Lecturer</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>{$row['batch']}</td>";
                        echo "<td>{$row['subject']}</td>";
                        echo "<td>{$row['date']}</td>";
                        echo "<td>{$row['lecturer']}</td>";
                        echo "<td>{$row['s_time']}</td>";
                        echo "<td>{$row['e_time']}</td>";
                        echo "<td>{$row['status']}</td>";
                         echo "<td>
        <i class='fas fa-edit edit-btn' style='color: blue;' data-classid='{$row['class_id']}' data-subject='{$row['subject']}' data-batch='{$row['batch']}' data-status='{$row['status']}' data-from='{$row['s_time']}' data-to='{$row['e_time']}' data-date='{$row['date']}'></i> | 
        <i class='fas fa-trash-alt' style='color: red;' onclick='deleteRow({$row['class_id']})'></i>
      </td>";
    echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- pop up modal -->
    <section>

      <div class="modal-box">
        <h1>Batch Name <br> Subject Name</h1>
            <h5>from "s_time" to "e_time"</h5>
            <h5 class="date">2024 - 01 - 01</h5>
        <br>
            <label>Current Status: Planned</label>
        <br>
            <p>You can update the status for this class from here.</p>
            <br>
            <label for="status">Update Status to:</label>
            <select id="status">
                <option value="pending">Cancelled</option>
                <option value="completed">Completed</option>
                <option value="in-progress">Postponed</option>
            </select>
            <br>
        <div class="buttons">
          <button class="save-btn">Update</button>
        </div>
      </div>
    </section>
</body>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const section = document.querySelector("section");
    const editButtons = document.querySelectorAll(".edit-btn");
    const overlay = document.querySelector(".overlay");
    const modalTitle = document.querySelector(".modal-box h1");
    const timeSlots = document.querySelector(".modal-box h5");
    const dateElement = document.querySelector(".modal-box h5.date");
    const updateStatusLabel = document.querySelector("label");
    const statusSelect = document.getElementById("status");
    const saveBtn = document.querySelector(".save-btn");

    let currentClassId;

    editButtons.forEach(button => {
        button.addEventListener("click", () => {
            currentClassId = button.getAttribute("data-classid"); // Set the value of the global variable
            const classId = button.getAttribute("data-classid");
            const subject = button.getAttribute("data-subject");
            const batch = button.getAttribute("data-batch");
            const status = button.getAttribute("data-status");
            const sTime = button.getAttribute("data-from");
            const eTime = button.getAttribute("data-to");
            const date = button.getAttribute("data-date");

            // Update modal content with the class details
            modalTitle.innerHTML = `${batch} - ${subject}`;
            timeSlots.innerHTML = `from ${sTime} to ${eTime}`;
            dateElement.innerHTML = date;
            updateStatusLabel.innerHTML = `Current Status: ${status}`;

            statusSelect.innerHTML = "";

            const statusOptions = ["Cancelled", "Completed", "Postponed", "Planned"];
            for (const option of statusOptions) {
                const optionElement = document.createElement("option");
                optionElement.value = option.toLowerCase();
                optionElement.text = option;
                statusSelect.add(optionElement);
            }

            statusSelect.value = status.toLowerCase();

            section.classList.add("active");
        });
    });

    if (overlay) {
        overlay.addEventListener("click", () => {
            section.classList.remove("active");
        });
    }

    if (saveBtn) {
        saveBtn.addEventListener("click", () => {
            section.classList.remove("active");
        });
    }

    if (saveBtn) {
        saveBtn.addEventListener("click", () => {
            const newStatus = statusSelect.value;

            console.log("ClassId before update:", currentClassId); 
            updateClassStatus(currentClassId, newStatus);
        });
    }

    function updateClassStatus(classId, newStatus) {
        
    console.log("Updating status for classId:", classId);

        $.ajax({
            type: "POST",
            url: "backend_update_status.php",
            data: { classId: classId, newStatus: newStatus },
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                console.error("Error updating status:", error);
            }
        });
    }
});
function deleteRow(rowId) {
        var confirmDelete = confirm("Are you sure you want to remove this class? \nThis action cannot be undone.");

        if (confirmDelete) {
            $.ajax({
                type: "POST",
                url: "delete_row.php",
                data: { rowId: rowId },
                success: function(response) {
                    location.reload();
                }
            });
        }
    }

</script>

</html>
