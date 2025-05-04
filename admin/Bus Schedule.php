<?php 
require_once("db_connection.php");

// View schedules after running a query to select all rows of schedules table
$sql = "SELECT * FROM schedule";
$result = mysqli_query($conn, $sql);

// Delete schedule if delete button is clicked
if(isset($_GET['delete_schedule'])) {
    $schedule_id = $_GET['schedule_id'];
    $delete_sql = "DELETE FROM schedule WHERE schedule_id = $schedule_id";
    mysqli_query($conn, $delete_sql);
    // Refresh page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
}

// Update schedule information if edit button is clicked
if(isset($_POST['edit_schedule'])) {
    // Retrieve schedule information from form
    $schedule_id = $_POST['schedule_id'];
    $schedule_name = $_POST['schedule_name'];
    $time_stamp= $_POST['time_stamp'];
    $date = $_POST['date'];
    $route_id = $_POST['route_id'];
    $bus_id= $_POST['bus_id'];
    $driver_id = $_POST['driver_id'];

    // Update schedule information in the database
    $update_sql = "UPDATE schedule SET schedule_name='$schedule_name', time_stamp='$time_stamp', date='$date', route_id='$route_id', bus_id='$bus_id', driver_id='$driver_id' WHERE schedule_id=$schedule_id";
    mysqli_query($conn, $update_sql);
    // Refresh page after update
    echo "<meta http-equiv='refresh' content='0'>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <style> 
    .type_sheet {
        display: flex;
        justify-content: space-between;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        color:black;
    }
    tr {
        transition-duration: .3s;
    }
    tr:hover {
        background-color: green;
        transition-duration: .3s;
    }
    button {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    .header {
        grid-area: header;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 30px 0 30px;
        box-shadow: 0 6px 7px -3px rgba(0, 0, 0, 0.35);
    }
    </style>
</head>
<body>
    <div class="grid-container">
        <?php include("header_sidebar.php"); ?>
        <!-- Main -->
        <main class="main-container">
            <h1>Schedule</h1>
            <table border="1">
                <tr>
                    <th>SCHEDULE ID</th>
                    <th>SCHEDULE NAME</th>
                    <th>TIME STAMP</th>
                    <th>DATE OF DEPARTURE</th>
                    <th>DRIVER_ID</th>
                    <th>VIEW MORE</th> <!-- New column header for view more button -->
                    <th>ACTION 1</th>
                    <th>ACTION 2</th>
                </tr>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['schedule_id']; ?></td>
                            <td><?php echo $row['schedule_name']; ?></td>
                            <td><?php echo $row['time_stamp']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['driver_id']; ?></td>
                            <td>
                            <button class="alt-btn"><a href="view_schedule.php?route_id=<?php 
                            echo $row['route_id']; ?>&bus_id=<?php echo $row['bus_id']; ?>">
                            View More</a></button>
                            </td>
                            <td>
                                <form method="POST" action="edit_schedule.php">
                                    <input type="hidden" name="schedule_id" value="<?php echo $row['schedule_id']; ?>">
                                    <button type="submit" class="alt-btn">Edit</button>
                                </form>
                            </td>
                            <td>
                                <button class="alt-btn" onclick="confirmDelete(<?php echo $row['schedule_id']; ?>)">Delete</button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='9'>No schedule found</td></tr>";
                }
                ?>
            </table>
            <br>
            <div class="type_sheet">
                <form action="add_schedule.php" method="post">
                    <button type="submit" class="add-btn">ADD A NEW SCHEDULE</button>
                </form>
                <br>
                <div class="PDF-download">
                    <a href="PDF/BusSchedulePDF.php">
                        <button class="alt-btn">Download PDF</button>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script>  function confirmDelete(schedule_id) {
            if (confirm("Are you sure you want to delete this schedule?")) {
                window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?delete_schedule&schedule_id=' + schedule_id;
            }
        }</script>
</body>
</html>
