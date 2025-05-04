<?php
// Delete driver from the database
if (isset($_GET['driver_id'])) {
    require_once("db_connection.php");
    $driver_id = $_GET['driver_id'];
    $sql = "DELETE FROM driver WHERE driver_id=$driver_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: Drivers.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
