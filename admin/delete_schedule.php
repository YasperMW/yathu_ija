<?php
// Delete schedule from the database
if (isset($_GET['schedule_id'])) {
    require_once("db_connection.php");
    $schedule_id = $_GET['schedule_id'];
    $sql = "DELETE FROM schedule WHERE schedule_id=$schedule_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: Schedule.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>