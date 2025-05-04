<?php
// Update schedule information in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("db_connection.php");
    $schedule_id = $_POST['schedule_id'];
    $schedule_name = $_POST['schedule_name'];
    $time_stamp= $_POST['time_stamp'];
    $date = $_POST['date'];
    $route_id = $_POST['route_id'];
    $bus_id= $_POST['bus_id'];
    $driver_id = $_POST['driver_id'];
    
    // Repeat this for other fields
    $sql = "UPDATE schedule
            SET schedule_id='$schedule_id', 
                 schedule_name='$schedule_name', 
                 time_stamp='$time_stamp', 
                 date='$date', 
                 route_id='$route_id',
                 bus_id='$bus_id', 
                 driver_id='$driver_id'

            WHERE schedule_id=$schedule_id";
    // Repeat this for other fields
    if (mysqli_query($conn, $sql)) {
        header("Location:Bus Schedule.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>